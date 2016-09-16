<?php

namespace Tests\Form\Data;

class Base extends \PHPUnit_Framework_TestCase
{
    protected $testCase = '';

    protected $data = [];

    protected $baseDir = '/share/providers';

    /**
     * @return string
     */
    public function getTestCase()
    {
        return $this->testCase;
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (empty($this->data)) {
            $basePath = dirname(dirname(dirname(__DIR__)));
            $this->data = include_once sprintf('%s%s/%s.php', $basePath, $this->baseDir, $this->testCase);
        }

        return $this->data;
    }
}
