<?php

namespace Form;

use Form\Interfaces\IValidator;

abstract class Validator implements IValidator
{
    const DEFAULT_ERROR = 0;
    const ERROR_CODE = Errors::ERROR_CODE_VALIDATOR;

    protected $errors = [];

    protected $errorMessages = [
        self::DEFAULT_ERROR => 'Unknown error'
    ];

    /**
     * @return static
     */
    public static function create()
    {
        $args = func_get_args();
        return new static(...$args);
    }

    /**
     * @return int|string
     */
    public function getId()
    {
        return static::ERROR_CODE;
    }

    /**
     * Валидация данных
     * @param mixed $value
     * @return bool
     */
    public function validate($value): bool
    {
        return true;
    }

    /**
     * Нужно ли дальше продолжать прогонять данные по цепочке валидаторов
     * @return bool
     */
    public function isBreak(): bool
    {
        return false;
    }

    /**
     * Установка сообщений ошибок
     * @param int $errorCode
     * @param string $errorMessage
     * @return $this
     */
    public function setErrorMessage(int $errorCode, string $errorMessage)
    {
        $this->errorMessages[$errorCode] = $errorMessage;
        return $this;
    }

    /**
     * Есть ошибки валидации?
     * @return bool
     */
    public function hasError(): bool
    {
        return !empty($this->errors);
    }

    /**
     * Ошибки
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
