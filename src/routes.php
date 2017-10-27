<?php

//dataform routing
// use Ado\Formx\Route\Burp;

Burp::post(null, 'process=1', array('as'=>'save', function() {
    BurpEvent::queue('dataform.save');
}));

//datagrid routing
Burp::get(null, 'page/(\d+)', array('as'=>'page', function($page) {
    BurpEvent::queue('dataset.page', array($page));
}));
Burp::get(null, 'ord=(-?)(\w+)', array('as'=>'orderby', function($direction, $field) {
    $direction = ($direction == '-') ? "DESC" : "ASC";
    BurpEvent::queue('dataset.sort', array($direction, $field));
}))->remove('page');

//todo: dataedit  


if (version_compare(app()->version(), '5.2')>0)
{
    Route::group(['middleware' => 'web'], function () {
        Route::get('formx-ajax/{hash}', array('as' => 'formx.remote', 'uses' => '\Ado\Formx\Controllers\AjaxController@getRemote'));
        //Route::controller('formx-demo', '\Ado\Formx\Demo\DemoController');

    });
} else {
    Route::get('formx-ajax/{hash}', array('as' => 'formx.remote', 'uses' => '\Ado\Formx\Controllers\AjaxController@getRemote'));
    //Route::controller('formx-demo', '\Ado\Formx\Demo\DemoController');
}

Route::any('/upload', array('as' => 'formx.upload', 'uses' => '\Ado\Formx\Controllers\UploadController@post'));
