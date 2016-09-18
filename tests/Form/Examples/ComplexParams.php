<?php

namespace Tests\Form\Examples;

use \Form\Aggregator\AllValid;
use \Form\Filter\Scalar as FilterScalar;
use Form\Validator\Integer\MoreThan as IntMoreThan;
use \Form\Validator\IsType;
use \Form\Validator\String\Length\Between as StrBetween;

class ComplexParams extends AllValid
{
    public function __construct()
    {
        $this->addRules(
            'id',
            [
                FilterScalar::create('int'),
                IsType::create('int'),
                IntMoreThan::create(0)
            ]
        );

        $this->addRules(
            'title',
            [
                FilterScalar::create('string'),
                IsType::create('string'),
                StrBetween::create(5, 12)
            ]
        );

        $this->addRules(
            'digits',
            [
                FilterScalar::create('int'),
                IsType::create('int'),
                IntMoreThan::create(0)
            ]
        );

        $this->setRequired('price', false);

        $this->addRules(
            'price',
            [
                ComplexPrice::create()
            ]
        );
    }
}
