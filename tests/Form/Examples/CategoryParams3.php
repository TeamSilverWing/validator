<?php

namespace Tests\Form\Examples;

use Form\Filter\Scalar;
use Form\Validator\IsType;
use Form\Validator\Integer\Between as IntBetween;
use Form\Validator\String\Length\Between as StrBetween;

class CategoryParams3 extends \Form\Form
{
    public function __construct()
    {
        $this->setDefaultRequired();

        $this->addRules(
            234,
            [
                Scalar::create('string'),
                IsType::create('string'),
                StrBetween::create(4, 8)
            ]
        );

        $this->addRules(
            242,
            [
                Scalar::create('integer'),
                IsType::create('integer'),
                IntBetween::create(2, 5)
            ]
        );

        $this->addRules(
            988,
            [
                Scalar::create('bool'),
                IsType::create('bool'),

            ]
        );

        $this->addRules(
            1056,
            [
                Scalar::create('string'),
                IsType::create('string'),
                StrBetween::create(5, 10)
            ]
        );

        $this->setRequired(1056, false);
    }
}
