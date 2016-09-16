<?php

namespace Form\Filter;

use Form\Filter;

/**
 * @filter: stripTags
 */
class StripTags extends Filter
{
    /**
     * Допустимые тэги
     * @var string
     */
    protected $allowedTags;

    public function __construct($allowedTags = '')
    {
        $this->allowedTags = $allowedTags;
    }

    /**
     * Допустимые тэги
     * @param string $allowedTags
     * @return static
     */
    public static function create($allowedTags = '')
    {
        return new static($allowedTags);
    }

    /**
     * {@inheritdoc}
     */
    public function filter($value)
    {
        do {
            $newVar = strip_tags($value, $this->allowedTags);

            if ($newVar == $value) {
                break;
            }

            $value = $newVar;
        } while (true);

        return trim($value);
    }
}
