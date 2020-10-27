<?php

declare(strict_types=1);

namespace salty\Sw6PerformanceAnalysis\Analyzer;

use salty\Sw6PerformanceAnalysis\Struct\Result;
use salty\Sw6PerformanceAnalysis\Struct\ResultCollection;

abstract class Analyzer
{
    public const STATUS_PASSED              = 'passed';
    public const STATUS_PASSED_WITH_WARNING = 'warning';
    public const STATUS_FAILED              = 'failed';
    public const STATUS_INFO                = 'info';

    abstract public function analyze(ResultCollection $collection): ResultCollection;

    /**
     * @param float|int|string $value
     */
    protected function getResult(
        ResultCollection $collection,
        string $name,
        $value,
        array $requirements,
        string $operator = '>='
    ): void {
        $status = self::STATUS_FAILED;

        if ($operator === '>=') {
            $value  = (int) $value;
            $status = $this->valueIsGreaterThan($value, $requirements[$name]);
        }

        if ($operator === 'v+') {
            $value  = (string) $value;
            $status = $this->versionIsGreaterThan($value, $requirements[$name]);
        }

        $data = [
            'name'   => $name,
            'value'  => $value,
            'status' => $status,
        ];

        $data   = array_merge_recursive($data, $requirements[$name]);
        $result = (new Result())->assign($data);

        $collection->add($result);
    }

    protected function valueIsGreaterThan(int $value, array $requirements): string
    {
        if ($value >= $requirements['suggestedValue']) {
            return self::STATUS_PASSED;
        }

        if ($value < $requirements['minValue']) {
            return self::STATUS_FAILED;
        }

        return self::STATUS_PASSED_WITH_WARNING;
    }

    protected function versionIsGreaterThan(string $value, array $requirements): string
    {
        if (version_compare($value, $requirements['suggestedValue'], '>=')) {
            return self::STATUS_PASSED;
        }

        if (version_compare($value, $requirements['suggestedValue'], '<')) {
            return self::STATUS_FAILED;
        }

        return self::STATUS_PASSED_WITH_WARNING;
    }
}
