<?php

namespace Form\Validator\Integer;

/**
 * @validator: lessThan
 */
class LessThan extends Base
{
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
