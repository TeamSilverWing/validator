<?php

namespace Form\Validator\Integer;

use \Form\Errors;

/**
 * @validator: moreThan
 */
class MoreThan extends Base
{
    const ERROR_CODE = Errors::ERROR_CODE_VALIDATOR_INT_MORE;

    /**
     * {@inheritdoc}
     */
    public function validate($value): bool
    {
        return (
            ($this->equal && $this->value <= $value)
            || (!$this->equal && $this->value < $value)
        );
    }
}
