<?php

namespace Tests\Form\Examples;

use \Form\Form;
use \Form\Validator\Integer\MoreThan as IntMoreThan;
use \Form\Filter\Scalar as FilterScalar;
use \Form\Validator\IsType;
use \Form\Validator\String\Length\Between as StrBetween;

/**
 * @property int $id
 * @property string $title
 * @property array $price
 */
class ComplexType extends Form
{
    const ERROR_CODE = 'complex.type';

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
            'price',
            [
                ComplexPrice::create()
            ]
        );
    }
}
