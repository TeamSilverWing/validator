<?php

use Form\Errors;

return [
    // set #0
    [
        \Tests\Form\Examples\Item::class,
        [
            'id' => 1,
            'title' => 'Item <b>black</b> title',
            'description' => 'Item for <b>black</b> sale & <div>white</div>',
            'user_id' => 2,
            'category_id' => 3,
            'params' => [
                242 => 3,
                234 => 'Some text',
                988 => false
            ],
            'phone' => '+7 (999) 123 - 45-67',
            'images' => [1232, 4342, 3534, 4234, '123a', 'bad'],
            'complex' => [
                'id' => 9,
                'title' => 'complex object',
                'price' => [
                    'type' => 1,
                    'title' => 'Cost',
                    'value' => 5,
                    'currency' => 3
                ]
            ],
            'complexParams' => [
                [
                    'id' => 1,
                    'title' => 'set 1',
                    'digits' => 9
                ],
                [
                    'id' => 2,
                    'title' => 'set 2',
                    'digits' => 9
                ],
                [
                    'id' => 3,
                    'title' => 'set 3',
                    'digits' => 9
                ],
                [
                    'id' => 4,
                    'title' => 'set 4',
                    'digits' => 9
                ]
            ]
        ],
        false,
        [
            'id' => 1,
            'title' => 'Item <b>black</b> title',
            'description' => 'Item for <b>black</b> sale & white',
            'user_id' => 2,
            'category_id' => 3,
            'phone' => '79991234567',
            'params' => null,
            'images' => null,
        ],
        [
            'params' => [
                'category.params.3' => [
                    234 => [
                        Errors::ERROR_CODE_VALIDATOR_STR_BETWEEN => [
                            1 => true
                        ]
                    ]
                ]
            ],
            'images' => [
                'images.array' => [
                    5 => [
                        Errors::ERROR_CODE_VALIDATOR_INT_MORE => [
                            1 => true
                        ]
                    ]
                ]
            ],
            'complex' => [
                'complex.type' => []
            ],
            'complexParam' => [
                3 => 'digit 4'
            ]
        ]
    ]
];
