<?php

declare(strict_types=1);

namespace salty\Sw6PerformanceAnalysis\Struct;

use Shopware\Core\Framework\Struct\Struct;

class Result extends Struct
{
    /** @var string */
    protected $name;

    /** @var string */
    protected $value;

    /** @var string */
    protected $minValue;

    /** @var string */
    protected $suggestedValue;

    /** @var string */
    protected $status;

    /** @var array */
    protected $invalidValues = [];

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function getMinValue(): string
    {
        return $this->minValue;
    }

    public function setMinValue(string $minValue): void
    {
        $this->minValue = $minValue;
    }

    public function getSuggestedValue(): string
    {
        return $this->suggestedValue;
    }

    public function setSuggestedValue(string $suggestedValue): void
    {
        $this->suggestedValue = $suggestedValue;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getInvalidValues(): array
    {
        return $this->invalidValues;
    }

    public function setInvalidValues(array $invalidValues): void
    {
        $this->invalidValues = $invalidValues;
    }
}
