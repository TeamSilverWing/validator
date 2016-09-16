<?php

namespace Form\Validator;

use Form\Validator;

/**
 * @validator: isScalar
 */
class IsScalar extends Validator
{
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
