<?php

namespace Form\Validator\Integer;

use \Form\Validator;
use \Form\Errors;

/**
 * @validator: between
 */
class Between extends Validator
{
    const ERROR_CODE = Errors::ERROR_CODE_VALIDATOR_INT_BETWEEN;

    /**
     * @var int
     */
    protected $min;

    /**
     * @var int
     */
    protected $max;

    /**
     * @var bool
     */
    protected $minEq;

    /**
     * @var bool
     */
    protected $maxEq;

    public function __construct(int $min, int $max, bool $minEq = true, bool $maxEq = true)
    {
        $this->min = $min;
        $this->max = $max;
        $this->minEq = $minEq;
        $this->maxEq = $maxEq;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value): bool
    {
        return (
            (($this->minEq && $this->min <= $value) || (!$this->minEq && $this->min < $value))
            && (($this->maxEq && $this->max >= $value) || (!$this->maxEq && $this->max > $value))
        );
    }
}
