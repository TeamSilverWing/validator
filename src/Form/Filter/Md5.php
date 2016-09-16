<?php

namespace Form\Filter;

use Form\Filter;

class Md5 extends Filter
{
    public function filter($value)
    {
        return md5($value);
    }
}
