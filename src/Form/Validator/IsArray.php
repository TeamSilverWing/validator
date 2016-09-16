<?php

namespace Form\Validator;

use Form\Validator;

/**
 * @validator: isArray
 */
class IsArray extends Validator
{
    /**
     * {@inheritdoc}
     */
    public function validate($value): bool
    {
        return is_array($value);
    }
}
