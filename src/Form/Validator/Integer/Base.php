<?php

namespace Form\Validator\Integer;

use Form\Validator;

class Base extends Validator
{
    /**
     * @var int
     */
    protected $value;

    /**
     * @var bool
     */
    protected $equal;

    public function __construct(int $value, bool $equal = false)
    {
        $this->value = $value;
        $this->equal = $equal;
    }
}
