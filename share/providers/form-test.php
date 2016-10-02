<?php

use Form\Errors;

return [
    // set #0
    [
        // class name
        \Tests\Form\Examples\Item::class,
        // form data
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
                    'digits' => 9,
                    'price' => [
                        'type' => 8,
                        'title' => 'Cost',
                        'value' => 5,
                        'currency' => 3
                    ],
                ],
                [
                    'id' => 4,
                    'title' => 'set 4',
                    'digits' => 9,
                    'price' => [
                        'type' => 1,
                        'title' => 'Cost',
                        'value' => 5,
                        'currency' => 3
                    ]
                ]
            ],
            // @todo: for release 0.0.4
            // @todo: allowEmpty(required?) + if (!empty) array.length validator
            // @todo: callback validator for check elements with required
            'someParam' => [
                [
                    'id' => 5,
                    'type' => 5,
                    'title' => 'Very big title',
                    'required' => false,
                    'images' => [34, 545, 5345, 2434]
                ],
                [
                    'id' => 6,
                    'type' => 1,
                    'title' => 'Very small title',
                    'required' => true,
                ],
                [
                    'id' => 7,
                    'type' => 6,
                    'title' => 'Hello world title!',
                    'required' => true,
                    'images' => [445, 673, 463]
                ]
            ]
        ],
        // is valid?
        false,
        // expected in safe data
        [
            'id' => 1,
            'title' => 'Item <b>black</b> title',
            'description' => 'Item for <b>black</b> sale & white',
            'user_id' => 2,
            'category_id' => 3,
            'phone' => '79991234567',
            'params' => null,
            'images' => null,
            'complex' => null,
            'complexParams' => null,
            'someParam' => [
                [
                    'id' => 5,
                    'type' => 5,
                    'title' => 'Very big title',
                    'required' => false,
                    'images' => [34, 545, 5345, 2434]
                ],
                [
                    'id' => 6,
                    'type' => 1,
                    'title' => 'Very small title',
                    'required' => true,
                ],
            ]
        ],
        // expected errors
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
                'complex.type' => [
                    'title' => [
                        Errors::ERROR_CODE_VALIDATOR_STR_BETWEEN => [
                            1 => true
                        ]
                    ],
                    'price' => [
                        'complex.price' => [
                            'title' => [
                                Errors::ERROR_CODE_VALIDATOR_STR_BETWEEN => [
                                    1 => true
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'complexParams' => [
                'complex.params' => [
                    2 => [
                        'price' => [
                            'complex.price' => [
                                'type' => [
                                    Errors::ERROR_CODE_VALIDATOR_IN_ARRAY => [
                                        1 => true
                                    ]
                                ],
                                'title' => [
                                    Errors::ERROR_CODE_VALIDATOR_STR_BETWEEN => [
                                        1 => true
                                    ]
                                ]
                            ]
                        ]
                    ],
                    3 => [
                        'price' => [
                            'complex.price' => [
                                'title' => [
                                    Errors::ERROR_CODE_VALIDATOR_STR_BETWEEN => [
                                        1 => true
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];
