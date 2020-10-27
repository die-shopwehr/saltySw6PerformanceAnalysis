<?php

declare(strict_types=1);

namespace salty\Sw6PerformanceAnalysis\Analyzer\Server;

use salty\Sw6PerformanceAnalysis\Analyzer\Analyzer;
use salty\Sw6PerformanceAnalysis\Struct\ResultCollection;

class Php extends Analyzer
{
    private const REQUIREMENTS = [
        'php_memory_limit' => [
            'minValue'       => 512,
            'suggestedValue' => 768,
        ],
        'php_max_execution_time' => [
            'minValue'       => 30,
            'suggestedValue' => 30,
        ],
        'php_version' => [
            'minValue'       => '7.2.0',
            'suggestedValue' => '7.4.0',
        ],
    ];

    public function analyze(ResultCollection $collection): ResultCollection
    {
        $this->checkPhpVersion($collection);
        $this->checkMemoryLimit($collection);
        $this->checkMaxExecutionTime($collection);

        return $collection;
    }

    private function checkPhpVersion(ResultCollection $collection): void
    {
        $version = explode('-', PHP_VERSION)[0];

        $this->getResult($collection, 'php_version', $version, self::REQUIREMENTS, 'v+');
    }

    private function checkMemoryLimit(ResultCollection $collection): void
    {
        $memoryLimit = $this->convertToBytes(@ini_get('memory_limit')) / 1024 / 1024;

        $this->getResult($collection, 'php_memory_limit', $memoryLimit, self::REQUIREMENTS);
    }

    private function checkMaxExecutionTime(ResultCollection $collection): void
    {
        $maxExecutionTime = (int) @ini_get('max_execution_time');
        $this->getResult($collection, 'php_max_execution_time', $maxExecutionTime, self::REQUIREMENTS);
    }

    /**
     * @param false|string $memoryLimit
     */
    private function convertToBytes($memoryLimit): int
    {
        if ('-1' === $memoryLimit) {
            return -1;
        }

        if (false === $memoryLimit) {
            return -1;
        }

        $memoryLimit = strtolower($memoryLimit);
        $max         = strtolower(ltrim($memoryLimit, '+'));

        if (0 === strpos($max, '0x')) {
            $max = intval($max, 16);
        } elseif (0 === strpos($max, '0')) {
            $max = intval($max, 8);
        } else {
            $max = (int) $max;
        }

        switch (substr($memoryLimit, -1)) {
            case 't': $max *= 1024;
            // no break
            case 'g': $max *= 1024;
            // no break
            case 'm': $max *= 1024;
            // no break
            case 'k': $max *= 1024;
        }

        return $max;
    }
}
