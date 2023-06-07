<?php
return [
    'id' => 12,
    'type' => 12,
    'folder' => 'project',
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

            ],
            'testimonials' => [
                'type' => 'textarea',
                'max' => '100',
            ],
            'testimonials_author' => [
                'type' => 'text',
            ],
            'keywords' => [
                'type' => 'keywords',
                'max' => '100',
            ],
          
        ],
        'nonTrans' => [
            'images' => [
                'type' => 'images',
            ],
            
            'date' => [
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
