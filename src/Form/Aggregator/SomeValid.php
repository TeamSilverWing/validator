<?php

namespace Form\Aggregator;

use Form\Aggregator;

class SomeValid extends Aggregator
{
    protected function aggregate(): bool
    {
        return in_array(true, $this->maskValid, true);
    }
}
