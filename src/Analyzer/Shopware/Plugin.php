<?php

declare(strict_types=1);

namespace salty\Sw6PerformanceAnalysis\Analyzer\Shopware;

use salty\Sw6PerformanceAnalysis\Analyzer\Analyzer;
use salty\Sw6PerformanceAnalysis\Struct\ResultCollection;

class Plugin extends Analyzer
{
    public function analyze(ResultCollection $collection): ResultCollection
    {
        return $collection;
    }
}
