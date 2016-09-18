<?php

namespace Tests\Form\Examples;

use \Form\Form;
use \Form\Filter\Scalar as FilterScalar;
use \Form\Validator\IsType;
use \Form\Validator\InArray;
use \Form\Validator\String\Length\Between as StrBetween;

/**
 * @property int $type
 * @property string $title
 * @property float $value
 * @property int $currency
 */
class ComplexPrice extends Form
{
    public function __construct()
    {
        $this->addRules(
            'type',
            [
                FilterScalar::create('int'),
                IsType::create('int'),
                InArray::create([1, 2, 3, 4, 5])
            ]
        );

        $this->addRules(
            'title',
            [
                FilterScalar::create('string'),
                IsType::create('string'),
                StrBetween::create(5, 8)
            ]
        );

        $this->addRules(
            'value',
            [
                FilterScalar::create('float'),
                IsType::create('float'),
            ]
        );

        $this->addRules(
            'currency',
            [
                FilterScalar::create('int'),
                IsType::create('int'),
                InArray::create([1, 2, 3])
            ]
        );
    }
}
