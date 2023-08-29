<?php

namespace App\App\ValueObjects;

class Phone extends StringValueObject
{
    public function __construct(string $value)
    {
        $this->guardNoLetters($value);

        parent::__construct($this->normalize($value));
    }

    private function normalize(string $value): string
    {
        return preg_replace('/[^0-9+]/', '', $value);
    }

    private function guardNoLetters(string $value)
    {
        if (preg_match('/[a-zA-Z]/', $value)) {
            throw new \Exception('Letters not allowed on Phone numbers: "' . $value . '"');
        }
    }
}