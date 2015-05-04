<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::get('/', 'UserController@dashboard');
Route::get('/dashboard',['as'=>'dashboard','uses'=>'UserController@dashboard']);

Route::get('test',function(){
    $data = ['title'=>'','form'=>''];
    \Mail::send('emails.notification',$data,function($message) {
                $message->to('taqmaninw@gmail.com','retetr')->subject('การแจ้งเตือน จาก PAPM!!');
            });
});
Route::group(['prefix' => 'notification'], function() {

    Route::any('/', ['as' => 'notification.index', 'uses' => 'NotificationController@index']);
});
Route::group(['prefix' => 'project'], function() {
    Route::any('/gantt/{id}', ['as' => 'project.gantt', 'uses' => 'ProjectController@gantt']);
    Route::any('/ganttdata/{id}', ['as' => 'project.ganttdata', 'uses' => 'ProjectController@ganttdata']);
    Route::any('/', ['as' => 'project.index', 'uses' => 'ProjectController@index']);
    Route::any('/create', ['as' => 'project.create', 'uses' => 'ProjectController@create']);
    Route::any('/edit/{id}', ['as' => 'project.edit', 'uses' => 'ProjectController@edit']);
    Route::any('/update', ['as' => 'project.update', 'uses' => 'ProjectController@update']);
    Route::any('/delete/{id}', ['as' => 'project.delete', 'uses' => 'ProjectController@delete']);
});
Route::group(['prefix' => 'appointment'], function() {
 Route::any('/postponse', ['as' => 'appointment.postponse', 'uses' => 'AppointmentController@postponse']);
    Route::any('/', ['as' => 'appointment.index', 'uses' => 'AppointmentController@index']);
    Route::any('/create', ['as' => 'appointment.create', 'uses' => 'AppointmentController@create']);
    Route::any('/edit/{id}', ['as' => 'appointment.edit', 'uses' => 'AppointmentController@edit']);
    Route::any('/update', ['as' => 'appointment.update', 'uses' => 'AppointmentController@update']);
    Route::any('/delete/{id}', ['as' => 'appointment.delete', 'uses' => 'AppointmentController@delete']);
});
Route::group(['prefix' => 'user'], function() {
    Route::get('/activate',['as'=>'activate','uses'=>'UserController@activate']);
     Route::get('/sendemailagain/{id}',['as'=>'sendemailagain','uses'=>'UserController@sendemailagain']);
    Route::any('/register', ['as' => 'register', 'uses' => 'UserController@register']);
    Route::get('/getlogin', ['as' => 'getlogin', 'uses' => 'UserController@getlogin']);
    Route::get('/logout', ['as' => 'logout', 'uses' => 'UserController@logout']);
    Route::any('/profile', ['as' => 'profile', 'uses' => 'UserController@profile']);
    Route::any('/update_profile', ['as' => 'update_profile', 'uses' => 'UserController@update_profile']);
    Route::post('/postlogin', ['as' => 'postlogin', 'uses' => 'UserController@postlogin']);
    Route::any('/dashboard', ['as' => 'dashboard', 'uses' => 'UserController@dashboard']);
});
Route::group(['prefix' => 'task'], function() {
    Route::any('/', ['as' => 'task.index', 'uses' => 'TaskController@index']);
    Route::any('/addstatus', ['as' => 'task.addstatus', 'uses' => 'TaskController@addstatus']);
    Route::any('/create', ['as' => 'task.create', 'uses' => 'TaskController@create']);
    Route::any('/edit/{id}', ['as' => 'task.edit', 'uses' => 'TaskController@edit']);
    Route::any('/update', ['as' => 'task.update', 'uses' => 'TaskController@update']);
    Route::any('/delete/{id}', ['as' => 'task.delete', 'uses' => 'TaskController@delete']);
});

Route::group(['prefix' => 'activity'], function() {
    
    Route::any('/selectuser', ['as' => 'selectuser', 'uses' => 'ActivityController@selectuser']);
    Route::any('/ganttdata', ['as' => 'ganttdata', 'uses' => 'ActivityController@ganttdata']);
    Route::any('/', ['as' => 'activity.index', 'uses' => 'ActivityController@index']);
    Route::get('/getcreate', ['as' => 'activity.getcreate', 'uses' => 'ActivityController@getCreate']);
    Route::post('/postcreate', ['as' => 'activity.postcreate', 'uses' => 'ActivityController@postCreate']);
    
    Route::any('/edit/{id}', ['as' => 'activity.edit', 'uses' => 'ActivityController@edit']);
    Route::any('/update', ['as' => 'activity.update', 'uses' => 'ActivityController@update']);
    Route::any('/delete/{id}', ['as' => 'activity.delete', 'uses' => 'ActivityController@delete']);
});

Route::group(['prefix' => 'task'], function() {
    Route::any('/', ['as' => 'task.index', 'uses' => 'TaskController@index']);
    Route::any('/view/{id}', ['as' => 'task.view', 'uses' => 'TaskController@view']);
    Route::get('/getcreate', ['as' => 'task.getcreate', 'uses' => 'TaskController@getCreate']);
    Route::post('/postcreate', ['as' => 'task.postcreate', 'uses' => 'TaskController@postCreate']);
    Route::any('/edit/{id}', ['as' => 'task.edit', 'uses' => 'TaskController@edit']);
    Route::any('/update', ['as' => 'task.update', 'uses' => 'TaskController@update']);
    Route::any('/delete/{id}', ['as' => 'task.delete', 'uses' => 'TaskController@delete']);
    Route::get('change_task_status',['as'=>'change_task_status','uses'=>'TaskController@change_task_status']);
     Route::get('change_approve_status',['as'=>'change_approve_status','uses'=>'TaskController@change_approve_status']);
    
});
Route::group(['prefix' => 'notification'], function() {
    Route::any('/', ['as' => 'notification.index', 'uses' => 'NotificationController@index']);
    Route::any('/markasread/{id}', ['as' => 'notification.markasread', 'uses' => 'NotificationController@markasread']);
    Route::any('/delete/{id}', ['as' => 'notification.delete', 'uses' => 'NotificationController@delete']);
});
