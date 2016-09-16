<?php

namespace Form\Validator;

use \Form\Validator;
use \Form\Exception\InvalidArgumentException;

/**
 * @validator: type
 */
class IsType extends Validator
{
    const TYPE_INTEGER = 0;
    const TYPE_STRING = 1;
    const TYPE_BOOLEAN = 2;
    const TYPE_ARRAY = 3;
    const TYPE_FLOAT = 4;

    const ALLOWED_TYPES = [
        self::TYPE_INTEGER => true,
        self::TYPE_STRING => true,
        self::TYPE_BOOLEAN => true,
        self::TYPE_ARRAY => true,
        self::TYPE_FLOAT => true
    ];

    const ERROR_CODE_INVALID_TYPE = 1;

    /**
     * @var int
     */
    protected $type;

    public function __construct($type)
    {
        if (is_integer($type) && array_key_exists($type, self::ALLOWED_TYPES)) {
            $this->type = $type;
            return;
        }

        switch ($type) {
            case 'string':
                $type = self::TYPE_STRING;
                break;
            case 'int':
            case 'integer':
                $type = self::TYPE_INTEGER;
                break;
            case 'bool':
            case 'boolean':
                $type = self::TYPE_BOOLEAN;
                break;
            case 'array':
                $type = self::TYPE_ARRAY;
                break;
            case 'real':
            case 'double':
            case 'float':
                $type = self::TYPE_FLOAT;
                break;
            default:
                throw new InvalidArgumentException();
                break;
        }

        $this->type = $type;
    }

    /**
     * Проверка типа
     *
     * @param mixed $value
     *
     * @return bool
     */
    public function validate($value): bool
    {
        if (is_integer($value) && $this->type == self::TYPE_INTEGER) {
            return true;
        } elseif (is_string($value) && $this->type == self::TYPE_STRING) {
            return true;
        } elseif (is_bool($value) && $this->type == self::TYPE_BOOLEAN) {
            return true;
        } elseif (is_array($value) && $this->type == self::TYPE_ARRAY) {
            return true;
        } elseif (is_float($value) && $this->type == self::TYPE_FLOAT) {
            return true;
        }

        $this->errors[self::ERROR_CODE_INVALID_TYPE] = true;

        return false;
    }
}
