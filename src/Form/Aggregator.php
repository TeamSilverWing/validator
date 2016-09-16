<?php

namespace Form;

use Form\Interfaces\IAggregator;

abstract class Aggregator extends Base implements IAggregator
{
    /**
     * Статус валидности/невалидности данных
     * @var bool[]
     */
    protected $maskValid;

    /**
     * Ошибки валидации данных
     * @var array
     */
    protected $aggregateErrors;

    /**
     * Агреграция отвалидированных данных
     * @var array
     */
    protected $aggregateSafeData;

    /**
     * Функция агрегирущая данные
     * @return bool
     */
    abstract protected function aggregate(): bool;

    /**
     * @param array $data
     * @return bool
     */
    public function validate($data): bool
    {
        foreach ($data as $i => $rowData) {
            $this->maskValid[$i] = parent::validate($rowData);
            $this->aggregateSafeData[$i] = $this->safeData;

            if (!empty($this->errors)) {
                $this->aggregateErrors[$i] = $this->errors;
                $this->errors = [];
            }

            $this->safeData = [];
        }

        $isValid = $this->aggregate();

        if ($isValid) {
            $this->errors = [];
        }

        return $isValid;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->aggregateErrors;
    }

    /**
     * @param bool $onlyValidSet Только те что прошли валидацию
     * @return array
     */
    public function getSafeData(bool $onlyValidSet = true): array
    {
        if (!$onlyValidSet) {
            return $this->aggregateSafeData;
        } else {
            $data = [];

            foreach ($this->maskValid as $i => $isValid) {
                if ($isValid) {
                    $data[$i] = $this->aggregateSafeData[$i];
                }
            }

            return $data;
        }
    }
}
