<?php

namespace Form\Validator;

use Form\Validator;
use Form\Errors;

/**
 * @validator: isScalar
 */
class IsScalar extends Validator
{
    const ERROR_CODE = Errors::ERROR_CODE_VALIDATOR_IS_SCALAR;

    /**
     * {@inheritdoc}
     */
    public function validate($value): bool
    {
        return is_scalar($value);
    }

    /**
     * {@inheritdoc}
     */
    public function isBreak(): bool
    {
        return true;
    }
}
