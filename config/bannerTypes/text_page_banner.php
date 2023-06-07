<?php
return [
    'id' => 6,
    'type' => 6,
    'name' => 'text_page_banner',
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
