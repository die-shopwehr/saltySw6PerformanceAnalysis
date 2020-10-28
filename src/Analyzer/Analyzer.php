<?php

declare(strict_types=1);

namespace salty\Sw6PerformanceAnalysis\Analyzer;

use salty\Sw6PerformanceAnalysis\Struct\Result;
use salty\Sw6PerformanceAnalysis\Struct\ResultCollection;

abstract class Analyzer
{
    public const STATUS_PASSED              = 'success';
    public const STATUS_PASSED_WITH_WARNING = 'warning';
    public const STATUS_FAILED              = 'error';
    public const STATUS_INFO                = 'info';

    abstract public function analyze(ResultCollection $collection): ResultCollection;

    /**
     * @param bool|float|int|string $value
     */
    protected function getResult(
        ResultCollection $collection,
        string $name,
        $value,
        array $requirements,
        string $operator = '>='
    ): void {
        $status = $this->compareValues($name, $value, $requirements, $operator);

        $data = [
            'name'   => $name,
            'value'  => $value,
            'status' => $status,
        ];

        $data   = array_merge_recursive($data, $requirements[$name]);
        $result = (new Result())->assign($data);

        $collection->add($result);
    }

    /**
     * @param float|int|string $value
     */
    private function compareValues(
        string $name,
        &$value,
        array $requirements,
        string $operator = '>='
    ): string {
        $status = self::STATUS_FAILED;

        if ($operator === '>=') {
            $value  = (int) $value;
            $status = $this->valueIsGreaterThan($value, $requirements[$name]);
        }

        if ($operator === 'v+') {
            $value  = (string) $value;
            $status = $this->versionIsGreaterThan($value, $requirements[$name]);
        }

        if ($operator === '=') {
            $value  = (string) $value;
            $status = $value === $requirements[$name]['expected'] ? self::STATUS_PASSED : self::STATUS_FAILED;
        }

        if ($operator === '!=') {
            $value  = (string) $value;
            $status = $value !== $requirements[$name]['isNot'] ? self::STATUS_PASSED : self::STATUS_FAILED;
        }

        if (array_key_exists('invalidValues', $requirements[$name]) && in_array($value, $requirements[$name]['invalidValues'], false)) {
            $status = self::STATUS_FAILED;
        }

        return $status;
    }

    private function valueIsGreaterThan(int $value, array $requirements): string
    {
        if ($value >= $requirements['suggestedValue']) {
            return self::STATUS_PASSED;
        }

        if ($value < $requirements['minValue']) {
            return self::STATUS_FAILED;
        }

        return self::STATUS_PASSED_WITH_WARNING;
    }

    private function versionIsGreaterThan(string $value, array $requirements): string
    {
        if (version_compare($value, $requirements['suggestedValue'], '>=')) {
            return self::STATUS_PASSED;
        }

        if (version_compare($value, $requirements['minValue'], '<')) {
            return self::STATUS_FAILED;
        }

        return self::STATUS_PASSED_WITH_WARNING;
    }
}
