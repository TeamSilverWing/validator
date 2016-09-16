<?php

namespace Form;

use Form\Interfaces\IBase;
use Form\Interfaces\IForm;
use Form\Interfaces\IFilter;
use Form\Interfaces\IValidator;

abstract class Base implements IBase
{
    protected $errors = [];

    protected $rules = [];

    protected $errorMessages = [];

    protected $validData = [];

    protected $safeData = [];

    protected $requiredMap = [];

    protected $defaultRequired = true;

    /**
     * Валидация данных
     * @param mixed $data
     * @return bool
     */
    public function validate($data): bool
    {
        $this->safeData = [];
        $this->errors = [];

        $this->validData = $data;

        foreach ($this->rules as $param => $ruleSet) {
            if ($this->validateValue($param)) {
                $this->safeData[$param] = $this->validData[$param];
            }
        }

        return !$this->hasError();
    }

    /**
     * Валидация значений со всеми правилами
     * @param int|string $param
     * @return bool
     */
    protected function validateValue($param): bool
    {
        $isValidRule = true;

        if (empty($this->rules[$param])) {
            return $isValidRule;
        }

        foreach ($this->rules[$param] as $ruleNum => $rule) {
            $isValid = $this->validateRuleValue($ruleNum, $param);

            if (!$isValid) {
                $isValidRule = false;

                if ($rule instanceof IValidator && $rule->isBreak()) {
                    break;
                }
            }
        }

        return $isValidRule;
    }

    /**
     * Валидация значения по правилу
     * @param int $ruleNum
     * @param int|string $param
     * @return bool
     */
    protected function validateRuleValue(int $ruleNum, $param): bool
    {
        $isValidRule = true;
        $rule = $this->getRule($param, $ruleNum);

        if ($rule instanceof IFilter) {
            $this->setValidData(
                $param,
                $rule->filter($this->getValidData($param))
            );
        } elseif (is_callable($rule) && ($code = $rule($this->getValidData($param)))) {
            $isValidRule = false;
            $this->setError($param, $ruleNum, [$code]);
        } elseif ($rule instanceof IForm) {
            if ($isValidRule = $rule->validate($this->getValidData($param))) {
                $this->setValidData($param, $rule->getSafeData());
            } else {
                $this->setError($param, $ruleNum, $rule->getErrors());
            }
        } elseif ($rule instanceof IValidator) {
            if (!($isValidRule = $rule->validate($this->getValidData($param)))) {
                $this->setError($param, $ruleNum, $rule->getErrors());
            }
        }

        return $isValidRule;
    }

    /**
     * Список ошибок
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Установка ошибки
     * @param string $param
     * @param int $ruleNum
     * @param array $errors
     */
    protected function setError($param, int $ruleNum, array $errors)
    {
        if (empty($this->errorMessages[$param][$ruleNum])) {
            $this->errors[$param][$ruleNum] = $errors;
        } else {
            $this->errors[$param][$ruleNum] = $this->errorMessages[$param][$ruleNum];
        }
    }

    /**
     * Есть ошибки?
     * @return bool
     */
    public function hasError(): bool
    {
        return !empty($this->errors);
    }

    /**
     * Добавление правила валидации
     * @param int|string $param
     * @param mixed $rule
     * @param string $message
     * @return $this
     */
    public function addRule($param, $rule, string $message = '')
    {
        if (!isset($this->requiredMap[$param])) {
            $this->requiredMap[$param] = $this->defaultRequired;
        }

        $this->rules[$param][] = $rule;
        $ruleId = count($this->rules[$param]) - 1;
        $this->errorMessages[$param][$ruleId] = $message;
        return $this;
    }

    /**
     * Добавление правил пачкой
     * @param int|string $param
     * @param array $rules
     * @return $this
     */
    public function addRules($param, array $rules)
    {
        foreach ($rules as $row) {
            if (is_array($row)) {
                $this->addRule($param, ...$row);
            } else {
                $this->addRule($param, $row);
            }
        }

        return $this;
    }

    /**
     * @param int|string $param
     * @param int $ruleNum
     * @return mixed
     */
    protected function getRule($param, int $ruleNum)
    {
        return $this->rules[$param][$ruleNum];
    }

    /**
     * Получить данные валидации
     * @param int|string $param
     * @return mixed
     */
    protected function getValidData($param)
    {
        return $this->validData[$param];
    }

    /**
     * Установка новых данных валидации
     * @param int|string $param
     * @param mixed $value
     */
    protected function setValidData($param, $value)
    {
        $this->validData[$param] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getSafeData(): array
    {
        return $this->safeData;
    }

    /**
     * По умолчанию обязательное поле
     *
     * @param bool $isRequired
     *
     * @return $this
     */
    public function setDefaultRequired(bool $isRequired = true)
    {
        $this->defaultRequired = $isRequired;
        return $this;
    }

    /**
     * Устанавливает флаг (не)обязательности поля
     *
     * @param int|string $param
     * @param bool $required
     *
     * @return $this
     */
    public function setRequired($param, bool $required = true)
    {
        $this->requiredMap[$param] = $required;
        return $this;
    }
}
