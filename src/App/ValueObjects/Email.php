<?php

namespace App\App\ValueObjects;

class Email extends StringValueObject
{
    private string $name;
    private string $domain;

    public function __construct(string $value)
    {
        parent::__construct($this->normalize($value));

        if (!$this->is_mail($value)) {
            throw new \Exception('Not a valid e-mail');
        }

        [ $this->name, $this->domain ] = explode('@', $this->value);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    private function normalize(string $value)
    {
        return trim(strtolower($value));
    }

    private function is_mail(string $value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}