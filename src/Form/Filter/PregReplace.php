<?php

namespace Form\Filter;

use Form\Filter;

class PregReplace extends Filter
{
    /**
     * @var string
     */
    private $search;

    /**
     * @var string
     */
    private $replace;

    public function __construct(string $search = '', string $replace = '')
    {
        $this->search = $search;
        $this->replace = $replace;
    }

    /**
     * @param string $value
     * @return string
     */
    public function filter($value)
    {
        return preg_replace($this->search, $this->replace, $value);
    }
}
