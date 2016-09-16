<?php

namespace Form\Interfaces;

interface IValidator extends IValidate
{
    /**
     * Установка сообщений об ошибках
     * @param int $errorCode
     * @param string $errorMessage
     * @return IValidator
     */
    public function setErrorMessage(int $errorCode, string $errorMessage);

    /**
     * Нужно ли прогонять данные дальше по цепочке валидации
     * @return bool
     */
    public function isBreak(): bool;
}
