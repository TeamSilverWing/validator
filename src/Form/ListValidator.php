<?php

namespace Form;

use Form\Interfaces\IForm;
use Form\Interfaces\IList;

class ListValidator implements IList
{
    const ERROR_CODE = Errors::ERROR_CODE_VALIDATOR_LIST;

    protected $rules = [];

    protected $errorMessages = [];

    /**
     * @var IForm
     */
    protected $form;

    /**
     * @param mixed $rules
     * @return $this
     */
    public function addRules($rules)
    {
        if (is_array($rules)) {
            foreach ($rules as $rule) {
                $this->rules[] = $rule;
            }
        } else {
            $this->rules[] = $rules;
        }

        return $this;
    }

    /**
     * Установка сообщений ошибок
     * @param int $errorCode
     * @param string $errorMessage
     * @return $this
     */
    public function setErrorMessage(int $errorCode, string $errorMessage)
    {
        $this->errorMessages[$errorCode] = $errorMessage;
        return $this;
    }

    /**
     * @return int|string
     */
    public function getId()
    {
        return static::ERROR_CODE;
    }

    /**
     * @return bool
     */
    public function isBreak(): bool
    {
        return false;
    }

    /**
     * @param $data
     * @return bool
     */
    public function validate($data): bool
    {
        $this->form = $this->getForm();

        foreach ($data as $i => $value) {
            $this->form->addRules($i, $this->rules);
        }

        return $this->form->validate($data);
    }

    /**
     * @return IForm
     */
    protected function getForm()
    {
        return new class extends Form
        {
            // some body
        }
        ;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->form->getErrors();
    }

    /**
     * @return bool
     */
    public function hasError(): bool
    {
        return $this->form->hasError();
    }
}
