<?php

namespace Form\Validator\Integer;

use \Form\Errors;

/**
 * @validator: lessThan
 */
class LessThan extends Base
{
    const ERROR_CODE = Errors::ERROR_CODE_VALIDATOR_INT_LESS;

    /**
     * {@inheritdoc}
     */
    public function validate($value): bool
    {
        return (
            ($this->equal && $value <= $this->value)
            || (!$this->equal && $value < $this->value)
        );
    }
}
