<?php
return [
    'id' => 4,
    'type' => 4,
    'name' => 'book_service',
    'fields' => [
        'trans' => [
            'title' => [
                'type' => 'text',
                'error_msg' => 'title_is_required',
                'required' => 'required',
                'max' => '100',
                'min' => '3',

            ],
            
            'desc' => [
                'type' => 'text',
            
            ],
            
           
        ],

        'nonTrans' => [
           
            'images' => [
                'type' => 'images'
            ],
            'date' => [
                'type' => 'date',
                'required' => 'required',
                'validation' => 'required|max:20',
                'placeholder' => 'sdf'
            ],
            'active' => [
                'type' => 'checkbox',
            ],
            
        ]



    ]

];
