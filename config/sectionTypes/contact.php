<?php
return [
    'id' => 4,
    'type' => 4,
    'folder' => 'contact',
    'fields' => [
        'trans' => [
            'title' => [
                'type' => 'text',
                'error_msg' => 'title_is_required',
                'required' => 'required',
                'max' => '100',
                'min' => '3',

            ],
            'slug' => [
                'type' => 'text',
                'error_msg' => 'slug_is_required',
                'required' => 'required',
            ],

        ],
        'nonTrans' => [
            'email' => [
                'type' => 'text',
            ],
           
            'phone' => [
                'type' => 'text',
            ],
            'adress' => [
                'type' => 'text'
            ]
          
        ],




    ]
];
