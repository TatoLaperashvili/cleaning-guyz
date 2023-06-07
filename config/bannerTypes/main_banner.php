<?php
return [
    'id' => 1,
    'type' => 1,
    'name' => 'main_banner',
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
          
            'logo_desc' => [
                
                'type' => 'text',

            ],
            'desc' => [
                'type' => 'textarea',
                

            ],
    
         
        ],

        'nonTrans' => [
            'logo' => [
                'type' => 'bannericon',

            ],
           
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
