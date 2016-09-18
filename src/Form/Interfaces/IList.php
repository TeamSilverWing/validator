<?php

namespace Form\Interfaces;

interface IList extends IValidator
{
    /**
     * @param $rule
     * @return mixed
     */
    public function addRules($rule);
}