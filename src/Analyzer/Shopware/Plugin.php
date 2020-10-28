<?php

declare(strict_types=1);

namespace salty\Sw6PerformanceAnalysis\Analyzer\Shopware;

use salty\Sw6PerformanceAnalysis\Analyzer\Analyzer;
use salty\Sw6PerformanceAnalysis\Struct\Result;
use salty\Sw6PerformanceAnalysis\Struct\ResultCollection;

class Plugin extends Analyzer
{
    public function analyze(ResultCollection $collection): ResultCollection
    {
        $result = new Result();
        $result->setStatus(self::STATUS_PASSED_WITH_WARNING);
        $collection->add($result);
        $result = new Result();
        $result->setStatus(self::STATUS_INFO);
        $collection->add($result);

        return $collection;
    }
}
