<?php

namespace Form\Filter\Arrays;

use Form\Filter;
use Form\Interfaces\IFilter;

class Base extends Filter
{
    /**
     * @var IFilter
     */
    protected $valueFilter;

    /**
     * @var IFilter
     */
    protected $keyFilter;

    /**
     * @param IFilter|null $valueFilter
     * @param IFilter|null $keyFilter
     * @return static
     */
    public static function create(IFilter $valueFilter = null, IFilter $keyFilter = null)
    {
        return new static($valueFilter, $keyFilter);
    }

    public function __construct(IFilter $valueFilter = null, IFilter $keyFilter = null)
    {
        $this->keyFilter = $keyFilter;
        $this->valueFilter = $valueFilter;
    }

    /**
     * @param array $value
     * @return array
     */
    public function filter($value)
    {
        $list = [];

        foreach ($value as $k => $v) {
            if ($this->keyFilter !== null) {
                $k = $this->keyFilter->filter($k);
            }

            if ($this->valueFilter !== null) {
                $v = $this->valueFilter->filter($v);
            }

            $list[$k] = $v;
        }

        return $list;
    }
}
