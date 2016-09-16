<?php

namespace Form\Validator\String\Length;

use Form\Validator;

abstract class Base extends Validator
{
    /**
     * @var int
     */
    protected $length;

    /**
     * @var bool
     */
    protected $equal;

    /**
     * @var string
     */
    protected $encode;

    public function __construct(int $length, bool $equal = false, string $encode = 'UTF-8')
    {
        $this->length = $length;
        $this->equal = $equal;
        $this->encode = $encode;
    }
}
