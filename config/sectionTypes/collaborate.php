<?php
return [
    'id' => 7,
    'type' => 7,
    'folder' => 'collaborate',
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
                'max' => '100',
                'min' => '3',

            ],
            'desc' => [
                'type' => 'textarea',
               

            ],
			'Additional_Text' => [
                'type' => 'textarea',
            
            ],
           
           
        ],
        'nonTrans' => [
            'form_select' => [
                'type' => 'form',
            ],
			'image' => [
                'type' => 'file',

            ],
            'active' => [
                'type' => 'checkbox',
            ],
        ],
    ]
];
