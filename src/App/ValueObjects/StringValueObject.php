<?php

declare(strict_types=1);

namespace App\App\ValueObjects;

abstract class StringValueObject
{
    protected $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }

    public function __invoke(): string
    {
        return $this->__toString();
    }
}
