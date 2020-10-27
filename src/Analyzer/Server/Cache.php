<?php

declare(strict_types=1);

namespace salty\Sw6PerformanceAnalysis\Analyzer\Server;

use salty\Sw6PerformanceAnalysis\Analyzer\Analyzer;
use salty\Sw6PerformanceAnalysis\Struct\ResultCollection;

class Cache extends Analyzer
{
    private const REQUIREMENTS = [
        'apcu' => [
            'minValue'       => 1,
            'suggestedValue' => 1,
        ],
        'apcu_memory' => [
            'minValue'       => 128,
            'suggestedValue' => 128,
        ],
        'opcache' => [
            'minValue'       => 1,
            'suggestedValue' => 1,
        ],
        'opcache_memory' => [
            'minValue'       => 256,
            'suggestedValue' => 256,
        ],
    ];

    public function analyze(ResultCollection $collection): ResultCollection
    {
        $this->checkApcuEnabled($collection);
        $this->checkOpcacheEnabled($collection);

        return $collection;
    }

    private function checkApcuEnabled(ResultCollection $collection): void
    {
        $isApcuEnabled = extension_loaded('apcu');
        $this->getResult($collection, 'apcu', (int) $isApcuEnabled, self::REQUIREMENTS);

        if ($isApcuEnabled !== true) {
            return;
        }

        $this->getResult($collection, 'apcu_memory', APC_ITER_MEM_SIZE, self::REQUIREMENTS);
    }

    private function checkOpcacheEnabled(ResultCollection $collection): void
    {
        $isOpcacheEnabled = extension_loaded('Zend OPcache');
        $this->getResult($collection, 'apcu', (int) $isOpcacheEnabled, self::REQUIREMENTS);

        if ($isOpcacheEnabled !== true) {
            return;
        }

        try {
            $opcacheConfiguration = opcache_get_configuration();
            $opcacheMemory        = $opcacheConfiguration['directives']['opcache.memory_consumption'] / 1024 / 1024;
        } catch (\Throwable $e) {
            return;
        }

        $this->getResult($collection, 'opcache_memory', (int) $opcacheMemory, self::REQUIREMENTS);
    }
}