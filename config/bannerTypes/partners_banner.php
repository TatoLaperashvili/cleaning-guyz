<?php
return [
    'id' => 7,
    'type' => 7,
    'name' => 'partners_banner',
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
            'image' => [
                'type' => 'bannericon'
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
