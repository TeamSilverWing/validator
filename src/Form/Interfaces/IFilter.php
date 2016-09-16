<?php

namespace Form\Interfaces;

interface IFilter
{
    /**
     * Фильтрация данных
     * @param mixed $value
     * @return mixed
     */
    public function filter($value);
}
