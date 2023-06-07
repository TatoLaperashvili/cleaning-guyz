<?php
return [
    'id' => 1,
    'type' => 1,
    'folder' => 'text_page',
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
                'error_msg' => 'title_is_required',
                'required' => 'required',
                'max' => '100',
                'min' => '3',

            ],
			'text' => [
                'type' => 'textarea',
                'max' => '2000',
                'min' => '3',
                'validation' => 'min:3|max:20'
            ],
            'Additional_Text' => [
                'type' => 'textarea',
                'max' => '2000',
                'min' => '3',
                'validation' => 'min:3|max:20'
            ],
            'Feature_1' => [
                'type' => 'text',
            
            ],
            'Feature_2' => [
                'type' => 'text',
            
            ],
            'Feature_3' => [
                'type' => 'text',
            
            ],
            'Feature_4' => [
                'type' => 'text',
            
            ],
            'Feature_5' => [
                'type' => 'text',
            
            ],
            'Feature_6' => [
                'type' => 'text',
            
            ],
           
        ],
        'nonTrans' => [
            // 'date' => [
            //     'type' => 'date',
            //     'required' => 'required',
            //     'validation' => 'required|max:20'
            // ],
			'image' => [
                'type' => 'file',

            ],
            'active' => [
                'type' => 'checkbox',
            ],
        ],
    ]
];
