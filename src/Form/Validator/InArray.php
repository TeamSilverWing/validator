<?php

namespace Form\Validator;

use Form\Errors;
use \Form\Validator;

class InArray extends Validator
{
    const ERROR_CODE = Errors::ERROR_CODE_VALIDATOR_IN_ARRAY;
    const DEFAULT_ERROR = 1;

    protected $allowedValues = [];
    protected $strict;

    public function __construct(array $allowedValues = [], bool $strict = false)
    {
        $this->allowedValues = $allowedValues;
        $this->strict = $strict;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function validate($value): bool
    {
        return in_array($value, $this->allowedValues, $this->strict);
    }
}
