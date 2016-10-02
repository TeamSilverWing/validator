<?php

namespace Tests\Form;

use \Tests\Form\Data\Base;
use \Form\Form as Form;

class FormTest extends Base
{
    protected $testCase = 'form-test';

    /**
     * @dataProvider getData
     *
     * @param string $formClass
     * @param array $data
     * @param bool $isValid
     * @param array $safeParams
     * @param array $errorCodes
     */
    public function testRules(string $formClass, array $data, bool $isValid, array $safeParams, array $errorCodes)
    {
        if (!class_exists($formClass)) {
            $this->fail(sprintf('%s class not exists', $formClass));
        }

        /** @var Form $form */
        $form = new $formClass();
        $this->assertEquals($isValid, $form->validate($data));

        if (!empty($safeParams)) {
            foreach ($safeParams as $param => $expectedValue) {
                if ($expectedValue !== null) {
                    $this->assertNotNull($form->{$param});
                    $this->assertEquals($expectedValue, $form->{$param});
                }

                if ($expectedValue === null) {
                    $this->assertNull($form->{$param});
                }
            }
        }

        if (!empty($form->getErrors()) && !empty($errorCodes)) {
            $this->assertEquals($errorCodes, $form->getErrors());
        }
    }
}
