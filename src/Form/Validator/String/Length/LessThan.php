<?php

namespace Form\Validator\String\Length;

use Form\Errors;

/**
 * @validator: lengthLessThan
 */
class LessThan extends Base
{
    const ERROR_CODE = Errors::ERROR_CODE_VALIDATOR_STR_LESS;

    /**
     * {@inheritdoc}
     */
    public function validate($value): bool
    {
        $length = mb_strlen($value, $this->encode);

        return (
            ($this->equal && $length <= $this->length)
            || (!$this->equal && $length < $this->length)
        );
    }
}
