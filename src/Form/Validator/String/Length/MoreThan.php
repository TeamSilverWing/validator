<?php

namespace Form\Validator\String\Length;

/**
 * @validator: lengthMoreThan
 */
class MoreThan extends Base
{
    /**
     * {@inheritdoc}
     */
    public function validate($value): bool
    {
        $length = mb_strlen($value, $this->encode);

        return (
            ($this->equal && $length >= $this->length)
            || (!$this->equal && $length > $this->length)
        );
    }
}
