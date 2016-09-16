<?php

namespace Form;

use Form\Interfaces\IFilter;

abstract class Filter implements IFilter
{
    /**
     * Создание класса
     * @return static
     */
    public static function create()
    {
        $args = func_get_args();
        return new static(...$args);
    }

    /**
     * {@inheritdoc}
     */
    public function filter($value)
    {
        return $value;
    }
}
