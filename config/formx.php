<?php


return [


    /*
    |--------------------------------------------------------------------------
    | Data Edit defaults
    |--------------------------------------------------------------------------
    */
    'data_edit' => [
        'button_position' => [
            'save' => 'BL', // BR = Bottom Right, BL = Bottom Left, TL, TR
            'show' => 'TR',
            'modify' => 'TR',
            'undo' => 'TR',
            'delete' => 'BL',
            ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Data Cell sanitization defaults
    |--------------------------------------------------------------------------
    */
    'sanitize' => [
        'num_characters' => 100, // Number of characters to return during cell value sanitization. 0 = no limit
    ],

    /*
    |--------------------------------------------------------------------------
    | Field's default configuration
    |--------------------------------------------------------------------------
    */
    'fields'=> [
       // 'attributes' => ['class'=>'form-control'],
        'date' => [
            'format' => 'm/d/Y',
        ],
        'datetime' => [
            'format' => 'm/d/Y H:i:s',
            'store_as' => 'Y-m-d H:i:s',
        ],
    ],
    'upload_dir'=> public_path().'/uploads/images',
    'upload_web_path'=> '/uploads/images/',
    'image_resize_dir'=> 'uploads/resize',
    'images_size'=>[
        'x9665'=>['width'=>96,'height'=>65],
        'x30'=>['width'=>30,'height'=>30],
        'x40'=>['width'=>40,'height'=>40],
        'x80'=>['width'=>80,'height'=>80],
        'x120'=>['width'=>120,'height'=>120],
        'x200'=>['width'=>200,'height'=>200],
        'x240120'=>['width'=>240,'height'=>120],
        'x240'=>['width'=>240,'height'=>240],
        'x360150'=>['width'=>360,'height'=>150],
        'x360240'=>['width'=>360,'height'=>240],
        'x400300'=>['width'=>400,'height'=>300],
        'x520390'=>['width'=>520,'height'=>390],
        'x520260'=>['width'=>520,'height'=>260],
        'x640480'=>['width'=>640,'height'=>480],
        'x240360'=>['width'=>240,'height'=>360],
        'x600800'=>['width'=>600,'height'=>800],
        'x600200'=>['width'=>600,'height'=>200],
        'x250300'=>['width'=>250,'height'=>300],
        'x800600'=>['width'=>800,'height'=>600],
        'x640'=>['width'=>640,'height'=>null],
        'x690'=>['width'=>690,'height'=>null],
        'x590'=>['width'=>590,'height'=>null],
        'x720'=>['width'=>720,'height'=>null],
        'x600'=>['width'=>600,'height'=>null],
        'x520'=>['width'=>520,'height'=>null],
        'x480'=>['width'=>480,'height'=>null],
        'x360'=>['width'=>360,'height'=>null],
        'x320'=>['width'=>320,'height'=>null],
        'x240'=>['width'=>240,'height'=>null],
    ],
    'image_web_path'=>[
        //头像
        'x30'=>'/uploads/resize/30x30/',
        'x40'=>'/uploads/resize/40x40/',
        'x80'=>'/uploads/resize/80x80/',
        'x120'=>'/uploads/resize/120x120/',
        'x200'=>'/uploads/resize/200x200/',
        //文章小图
        'x9665'=>'/uploads/resize/96x65/',
        'x240120'=>'/uploads/resize/240x120/',
        'x240'=>'/uploads/resize/240x240/',
        //广告小图
        'x360240'=>'/uploads/resize/360x240/',
        'x240360'=>'/uploads/resize/240x360/',
        'x250300'=>'/uploads/resize/250x300/',
        'x360150'=>'/uploads/resize/360x150/',
        'x400300'=>'/uploads/resize/400x300/',
        'x520260'=>'/uploads/resize/520x260/',
        'x520390'=>'/uploads/resize/520x390/',
        'x640480'=>'/uploads/resize/640x480/',
        'x800600'=>'/uploads/resize/800x600/',

        //文章大图
        'x600800'=>'/uploads/resize/600x800/',
        //广告大图
        'x600200'=>'/uploads/resize/600x200/',
        'x640'=>'/uploads/resize/640x/',
        'x690'=>'/uploads/resize/690x/',
        'x590'=>'/uploads/resize/590x/',
        'x720'=>'/uploads/resize/720x/',
        'x600'=>'/uploads/resize/600x/',
        'x520'=>'/uploads/resize/520x/',
        'x480'=>'/uploads/resize/480x/',
        'x360'=>'/uploads/resize/360x/',
        'x320'=>'/uploads/resize/320x/',
        'x240'=>'/uploads/resize/240x/',
    ],
    'allow_extension'=>['jpg','jpeg','gif','png','doc','rar','csv','xls','txt'],
    'allow_image_type'=>['jpg','jpeg','gif','png'],
    'allow_file_type'=>['doc','rar','csv','xls','txt'],
];
