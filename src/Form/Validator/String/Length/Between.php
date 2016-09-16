<?php

namespace Form\Validator\String\Length;

use Form\Validator;

/**
 * @validator: lengthBetween
 */
class Between extends Validator\Integer\Between
{
    /**
     * @var string
     */
    protected $encode;

    public function __construct(int $min, int $max, bool $minEq = true, bool $maxEq = true, string $encode = 'UTF-8')
    {
        parent::__construct($min, $max, $minEq, $maxEq);
        $this->encode = $encode;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value): bool
    {
        $length = mb_strlen($value, $this->encode);
        return parent::validate($length);
    }
}
