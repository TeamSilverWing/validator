<?php

namespace Form\Filter;

use \Form\Filter;
use \Form\Exception\InvalidArgumentException;

class Scalar extends Filter
{
    const TYPE_UNKNOWN = 0;
    const TYPE_INT = 1;
    const TYPE_FLOAT = 2;
    const TYPE_STRING = 3;
    const TYPE_BOOL = 4;

    const ALLOWED_TYPE_LIST = [
        self::TYPE_INT => true,
        self::TYPE_FLOAT => true,
        self::TYPE_STRING => true,
        self::TYPE_BOOL => true
    ];

    protected $type;

    public function __construct($type)
    {
        if (is_integer($type) && array_key_exists($type, self::ALLOWED_TYPE_LIST)) {
            $this->type = $type;
            return;
        }

        switch ($type) {
            case 'string':
                $type = self::TYPE_STRING;
                break;
            case 'int':
            case 'integer':
                $type = self::TYPE_INT;
                break;
            case 'bool':
            case 'boolean':
                $type = self::TYPE_BOOL;
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
     * Приведение к одному скалярному типу
     *
     * @param bool|float|int|string $value
     *
     * @return bool|float|int|string
     *
     * @throws InvalidArgumentException
     */
    public function filter($value)
    {
        if (!is_scalar($value)) {
            throw new InvalidArgumentException();
        }

        switch ($this->type) {
            case self::TYPE_INT:
                return intval($value);
            case self::TYPE_FLOAT:
                return floatval($value);
            case self::TYPE_STRING:
                return strval($value);
            case self::TYPE_BOOL:
                return boolval($value);
        }

        throw new InvalidArgumentException('Invalid type');
    }
}
