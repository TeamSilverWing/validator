<?php

namespace Form;

use Form\Interfaces\IForm;

abstract class Form extends Base implements IForm
{
    protected $data = [];

    /**
     * Валидация формы
     * @param array $data
     * @return bool
     */
    public function validate($data): bool
    {
        return parent::validate(array_merge($this->data, $data));
    }

    /**
     * Получаем только валидные данные
     * @param string $param
     * @return mixed
     */
    public function __get(string $param)
    {
        return isset($this->safeData[$param]) ? $this->safeData[$param] : null;
    }

    /**
     * Устанавливаем данные требующие валидацию
     * @param string $param
     * @param mixed $value
     */
    public function __set(string $param, $value)
    {
        $this->data[$param] = $value;
    }
}
