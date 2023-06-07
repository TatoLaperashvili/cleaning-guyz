<?php
return [
    'id' => 3,
    'type' => 3,
    'folder' => 'vacancy',
	'paginate' => 16,
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
                'max' => '1000',
                'min' => '3',

            ],
            'Additional_Text' => [
                'type' => 'textarea',
               

            ],
			'Responsibilities' => [
                'type' => 'addinput',

            ],
            'Position' =>[
                'type' => 'text',
            ],
            'address' => [
                'type' => 'text',

            ],
         
            
        ],
        'nonTrans' => [
            'Working_Time' => [
                'type' => 'text',
            ],
            'Working_Monthly_Rate' => [
                'type' => 'text',
            ],
            'form_select' => [
                'type' => 'form',
            ],
            'start_date' => [
                'type' => 'date',
                'required' => 'required',
                'validation' => 'required|max:20'
            ],
            'end_date' => [
                'type' => 'date',
                'required' => 'required',
                'validation' => 'required|max:20'
            ],
            'active' => [
                'type' => 'checkbox',
            ],

        ],




    ]

];
