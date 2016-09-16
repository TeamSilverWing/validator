<?php

namespace Form\Validator\Integer;

/**
 * @validator: moreThan
 */
class MoreThan extends Base
{
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
