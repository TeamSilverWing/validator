<?php

namespace Form\Validator\String\Length;

use Form\Validator;
use Form\Errors;

/**
 * @validator: lengthBetween
 */
class Between extends Validator\Integer\Between
{
    const ERROR_CODE = Errors::ERROR_CODE_VALIDATOR_STR_BETWEEN;
    const DEFAULT_ERROR = 1;

    /**
     * @var string
     */
    protected $encode;

    public function __construct(int $min, int $max, bool $minEq = true, bool $maxEq = true, string $encode = 'UTF-8')
    {
        parent::__construct($min, $max, $minEq, $maxEq);
        $this->encode = $encode;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value): bool
    {
        $length = mb_strlen($value, $this->encode);
        return parent::validate($length);
    }
}
