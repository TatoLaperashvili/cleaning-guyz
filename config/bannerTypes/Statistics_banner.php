<?php
return [
    'id' => 3,
    'type' => 3,
    'name' => 'statics_banner',
    'fields' => [
        'trans' => [
            'title' => [
                'type' => 'text',
                'error_msg' => 'title_is_required',
                'required' => 'required',
                'max' => '100',
                'min' => '3',

            ],
            
            'numbers' => [
                'type' => 'text',
               

            ],
           
        ],

        'nonTrans' => [
        
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
