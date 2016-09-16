<?php

namespace Form\Interfaces;

interface IBase extends IValidate
{
    /**
     * Добавление правила
     * @param int|string $param
     * @param mixed $rule
     * @param string $message
     * @return IForm
     */
    public function addRule($param, $rule, string $message = '');

    /**
     * Добавление правил пачкой
     * @param int|string $param
     * @param array $rules
     * @return IForm
     */
    public function addRules($param, array $rules);

    /**
     * Возвращает отвалидированные данные
     * @return array
     */
    public function getSafeData(): array;
}
