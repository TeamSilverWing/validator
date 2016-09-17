<?php

namespace Form\Validator;

use Form\Validator;
use Form\Errors;

/**
 * @validator: isArray
 */
class IsArray extends Validator
{
    const ERROR_CODE = Errors::ERROR_CODE_VALIDATOR_IS_ARRAY;

    /**
     * {@inheritdoc}
     */
    public function validate($value): bool
    {
        return is_array($value);
    }
}
