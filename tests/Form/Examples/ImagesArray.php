<?php

namespace Tests\Form\Examples;

use Form\ListValidator;
use Form\Validator\Integer\MoreThan;
use Form\Filter\Scalar;

class ImagesArray extends ListValidator
{
    const ERROR_CODE = 'images.array';

    public function __construct()
    {
        $this->addRules([
            Scalar::create('int'),
            MoreThan::create(0)
        ]);
    }
}
