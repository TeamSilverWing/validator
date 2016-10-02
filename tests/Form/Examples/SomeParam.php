<?php

namespace Tests\Form\Examples;

use \Form\Form;
use \Form\Validator\Integer\MoreThan as IntMoreThan;
use \Form\Filter\Scalar as FilterScalar;
use \Form\Validator\IsType;
use \Form\Validator\String\Length\Between as StrBetween;
use \Form\Validator\InArray;
use \Form\Validator\IsArray;
use \Form\Aggregator\SomeValid;

/**
 * @property int $id
 * @property int $type
 * @property string $title
 * @property bool $required
 * @property int[] $images
 */
class SomeParam extends SomeValid
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
                StrBetween::create(5, 17)
            ]
        );

        $this->addRules(
            'required',
            [
                FilterScalar::create('bool'),
                IsType::create('bool'),
            ]
        );

        $this->setRequired('images', false);

        $this->addRules(
            'images',
            [
                IsArray::create(),
                ImagesArray::create()
            ]
        );
    }
}
