<?php

namespace Form;

use Form\Interfaces\IAggregator;
use Form\Interfaces\IBase;
use Form\Interfaces\IForm;
use Form\Interfaces\IFilter;
use Form\Interfaces\IList;
use Form\Interfaces\IValidator;

abstract class Base implements IBase
{
    const REQUIRED_RULE_NUM = -1;

    const ERROR_CODE = Errors::ERROR_CODE_FORM;

    /**
     * Ошибки формы
     * @var array
     */
    protected $errors = [];

    /**
     * Правила валидации
     * @var array
     */
    protected $rules = [];

    /**
     * Тексты ошибок
     * @var array
     */
    protected $errorMessages = [];

    /**
     * Промежуточные, валидируемые данные
     * @var array
     */
    protected $validData = [];

    /**
     * Валидные данные
     * @var array
     */
    protected $safeData = [];

    /**
     * Карта присутствующих/отсутствующих параметров
     * @var array
     */
    protected $existsMap = [];

    /**
     * Required-поля
     * @var array
     */
    protected $requiredMap = [];

    protected $defaultRequired = true;

    /**
     * @return static
     */
    public static function create()
    {
        $args = func_get_args();
        return new static(...$args);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return static::ERROR_CODE;
    }

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
            if ($this->validateValue($param) && !empty($this->existsMap[$param])) {
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

        $isRequired = $this->isRequired($param);
        $isExists = array_key_exists($param, $this->validData);
        $this->existsMap[$param] = $isExists;

        if ($isRequired && !$isExists) {
            $this->setError($param, self::REQUIRED_RULE_NUM, [Errors::FIELD_IS_REQUIRED]);
            return false;
        } elseif (!$isRequired && !$isExists) {
            return true;
        }

        foreach ($this->rules[$param] as $ruleNum => $rule) {
            $isValid = $this->execOne($ruleNum, $param);

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
     * @param string|int $param
     * @return bool
     */
    protected function isRequired($param)
    {
        if (!isset($this->requiredMap[$param])) {
            $this->requiredMap[$param] = $this->defaultRequired;
        }

        return $this->requiredMap[$param];
    }

    /**
     * Валидация значения по правилу
     * @param int $ruleNum
     * @param int|string $param
     * @return bool
     */
    protected function execOne(int $ruleNum, $param): bool
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
            $this->setError($param, 'callback_' . $ruleNum, $code);
        } elseif ($rule instanceof IAggregator) {
            if ($isValidRule = $rule->validate($this->getValidData($param))) {
                $this->setValidData($param, $rule->getSafeData());
            } else {
                $this->setError($param, $rule->getId(), $rule->getErrors());
            }
        } elseif ($rule instanceof IForm) {
            if ($isValidRule = $rule->validate($this->getValidData($param))) {
                $this->setValidData($param, $rule->getSafeData());
            } else {
                $this->setError($param, $rule->getId(), $rule->getErrors());
            }
        } elseif ($rule instanceof IList) {
            if ($isValidRule = $rule->validate($this->getValidData($param))) {
                $this->setValidData($param, $rule->getSafeData());
            } else {
                $this->setError($param, $rule->getId(), $rule->getErrors());
            }
        } elseif ($rule instanceof IValidator) {
            if (!($isValidRule = $rule->execValidate($this->getValidData($param)))) {
                $this->setError($param, $rule->getId(), $rule->getErrors());
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
     * @param int|string $ruleNum
     * @param mixed $errorCode
     */
    protected function setError($param, $ruleNum, $errorCode)
    {
        if (empty($this->errorMessages[$param][$ruleNum])) {
            $this->errors[$param][$ruleNum] = $errorCode;
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
     * @return $this
     */
    public function addRule($param, $rule)
    {
        if (!isset($this->requiredMap[$param])) {
            $this->requiredMap[$param] = $this->defaultRequired;
        }

        $this->rules[$param][] = $rule;
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
        foreach ($rules as $rule) {
            $this->addRule($param, $rule);
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
        return array_key_exists($param, $this->validData) ? $this->validData[$param] : null;
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
