<?php

namespace Tests\Form\Examples;

use \Form\Form;
use \Form\Validator\IsType;
use \Form\Validator\Integer\MoreThan as IntMoreThan;
use \Form\Filter\Scalar as FilterScalar;
use \Form\Validator\String\Length\Between as StrBetween;
use \Form\Filter\StripTags;
use \Form\Validator\String\AllowedCountDigits;
use \Form\Validator\String\Length\MoreThan as StrMoreThan;
use \Form\Filter\PregReplace;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 */
class Item extends Form
{
    public function __construct()
    {
        $this->setDefaultRequired();

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
                StrBetween::create(4, 128),
                StripTags::create('<b></b>'),
                AllowedCountDigits::create(4)
            ]
        );

        $this->addRules(
            'description',
            [
                FilterScalar::create('string'),
                IsType::create('string'),
                StrMoreThan::create(8),
                StripTags::create('<b></b>'),
            ]
        );

        $this->addRules(
            'user_id',
            [
                FilterScalar::create('int'),
                IsType::create('int'),
                IntMoreThan::create(0)
            ]
        );

        $this->addRules(
            'category_id',
            [
                FilterScalar::create('integer'),
                IsType::create('integer'),
                IntMoreThan::create(0)
            ]
        );

        $this->addRules(
            'params',
            [
                IsType::create('array'),
                CategoryParams3::create()
            ]
        );

        $this->addRules(
            'phone',
            [
                FilterScalar::create('string'),
                IsType::create('string'),
                PregReplace::create('/\D+/s', '')
            ]
        );
    }
}
