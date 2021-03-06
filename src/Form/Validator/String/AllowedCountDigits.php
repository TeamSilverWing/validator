<?php

namespace Form\Validator\String;

use \Form\Validator;
use Form\Errors;

class AllowedCountDigits extends Validator
{
    const ERROR_CODE = Errors::ERROR_CODE_VALIDATOR_STR_ALLOWED_DIGITS;

    const TYPE_LESS = -1;
    const TYPE_EQUAL = 0;
    const TYPE_MORE = 1;

    /**
     * @var int
     */
    protected $countDigits;

    /**
     * @var int
     */
    protected $type;

    public function __construct(int $countDigits, int $type = self::TYPE_LESS)
    {
        $this->countDigits = $countDigits;
        $this->type = $type;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function validate($value): bool
    {
        $newValue = preg_replace('/\D+/s', '', $value);

        return (strlen($newValue) <=> $this->countDigits) === $this->type;
    }
}
