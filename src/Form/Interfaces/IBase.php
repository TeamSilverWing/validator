<?php

namespace Form\Interfaces;

interface IBase extends IValidate
{
    /**
     * Добавление правила
     * @param int|string $param
     * @param mixed $rule
     * @return IForm
     */
    public function addRule($param, $rule);

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
