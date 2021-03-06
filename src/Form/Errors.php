<?php

namespace Form;

class Errors
{
    // base error codes ...
    const ERROR_CODE_FORM = 0;
    const ERROR_CODE_VALIDATOR = 1;

    // error codes ...
    const ERROR_CODE_VALIDATOR_INT_BETWEEN = 2;
    const ERROR_CODE_VALIDATOR_INT_LESS = 3;
    const ERROR_CODE_VALIDATOR_INT_MORE = 4;

    const ERROR_CODE_VALIDATOR_STR_BETWEEN = 5;
    const ERROR_CODE_VALIDATOR_STR_LESS = 6;
    const ERROR_CODE_VALIDATOR_STR_MORE = 7;

    const ERROR_CODE_VALIDATOR_STR_ALLOWED_DIGITS = 8;

    const ERROR_CODE_VALIDATOR_IS_ARRAY = 9;
    const ERROR_CODE_VALIDATOR_IS_SCALAR = 10;
    const ERROR_CODE_VALIDATOR_IS_TYPE = 11;

    const ERROR_CODE_VALIDATOR_LIST = 12;

    const ERROR_CODE_VALIDATOR_IN_ARRAY = 13;

    const FIELD_IS_REQUIRED = 1;
}
