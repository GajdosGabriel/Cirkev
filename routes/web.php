<?php

//Route::get('/error', function() {
//    abort(500);
//});


// cirkev.dev/kategorie/34
Route::get('post/{id}/{slug}' , 'PostsController@show')->name('post.show');
Route::get('/', 'PostsController@index');
Route::get('online','PagesController@online');
Route::get('megabalik-krestapnskych-knih', 'PagesController@megabalik');
Route::get('zamyslenia/{slug?}' , 'VersController@index');
Route::get('kategorie/{slug}' , 'GroupController@index');

Route::get('tema/{tag}' , 'TagController@show')->name('tema');

// oAuth Routes...
Route::get('/auth/{service}', 'Auth\AuthController@redirectToProvider')
    ->where('service', '(github|facebook|google|twitter|linkedin|bitbucket)');
Route::get('/auth/{service}/callback', 'Auth\AuthController@handleProviderCallback')
    ->where('service', '(github|facebook|google|twitter|linkedin|bitbucket)');



Route::group(['middleware' => ['auth']], function () {

    Route::get  ('kategorie', 'GroupController@createNewGroup');
    Route::post ('kategorie', 'GroupController@store');
    Route::get ('kategorie/{id}', 'AdminController@newsConfirmed');

    Route::get('post/{id}/{slug}/edit', 'PostsController@edit')->name('post.edit');
    Route::get('post/{post}/{slug}/delete', 'PostsController@delete');

    Route::get('akcia/{event}/{slug}/editevent', 'EventsController@edit')->name('event.edit');
    Route::get('akcia/{event}/{slug}/copyevent', 'EventsController@copy')->name('event.copy');

    Route::get('user/{id}/{user}/edit', 'UserController@edit')->name('user.edit');
    Route::get('user/{slug}/{user}/create', 'PostsController@create')->name('post.create');

    Route::get('contact/{id}/{slug}/contats', 'ContactsController@import')->name('contacts.import');
    Route::post ('contact/{user}/saveemails', 'ContactsController@store')->name('user.save.emails');

    Route::post('post/{user}', 'PostsController@store');

    Route::put('post/{post}/update', ['as'=>'post.update', 'uses'=>'PostsController@update'] );
    Route::delete('post/{post}/destroy', 'PostsController@destroy')->name('post.destroy');



    Route::patch('{user}/{slug}/update', ['as'=>'user.update', 'uses'=>'UserController@update'] );
    Route::get('user/{user}/notifications', 'UserController@indexNotifications');
    Route::delete('user/{user}/notifications/{notificationId}', 'UserController@destroyNotifications')->name('user.destroyNotifications');



    Route::post('{post}/subscriptions', 'PostSubscriptionController@store');
    Route::delete('{post}/subscriptions', 'PostSubscriptionController@destroy');

    Route::patch('comments/replies/{comment}', 'CommentsController@update');
    Route::delete('comments/replies/{comment}', 'CommentsController@destroy');


    Route::get('profiles/{user}/notifications', 'UserController@indexmessage');
    Route::delete('profiles/{user}/notifications/{notifikationId}', 'UserController@destroymessage');



    Route::delete('reportcomments', 'CommentsController@reportComments');

    Route::get ('admin', 'AdminController@indexUsers');
    Route::patch ('adminUpdateUser/{id}', 'AdminController@adminUpdateUser')->name('adminUpdateUser');

//    Events
    Route::get('{user}/{slug}/akcia/vytvorit', 'EventsController@create');
    Route::get('{user}/{slug}/akcie/admin', 'EventsController@adminEvents')->name('akcie.admin');

    Route::post('{user}/event/', 'EventsController@store')->name('event.store');
    Route::patch('event/{event}/eventupdate', 'EventsController@update')->name('event.update');

    Route::delete('event/{event}', 'EventsController@destroy')->name('event.delete');
//    Route::get('akcia/{event}/subscriptions', 'EventSubscriptionController@store')->name('event.subscriptions');
    Route::post('akcia/{event}/subscriptions', 'EventSubscriptionController@store')->name('event.subscriptions');



//    Reklamnný systém
    Route::get('reklama', 'WidgetController@createWidget');
    Route::post('reklama', 'WidgetController@storeWidget')->name('reklama');
    Route::delete('zmazat/{id}', 'WidgetController@destroyWidget')->name('zmazat');
    Route::post('update/{id}', 'WidgetController@updateWidget')->name('update');
    Route::get('reklama/edit/{id}','WidgetController@editWidget')->name('edit');


    Route::post('comments/{comment}/favorites', 'FavoritesController@store');


    Route::get('/trash', 'PostsController@trash')->name('trash.index');
    Route::get('/trash/{id}', 'PostsController@restore')->name('trash.restore');
    Route::get('/trash/{post}/forcedelete', 'PostsController@forceDelete')->name('trash.forceDelete');

});

Route::get('akcia/{event}/{slug}', 'EventsController@show')->name('event.show');
Route::get('akcia/', 'EventsController@index');
Route::get('user/{id}/{slug}', 'UserController@show')->where('id', '[0-9]+')->name('user.show');



Route::auth();

Route::post('/', ['as' => 'search.index', 'uses' => 'PostsController@index'] );

Route::get('user', 'UserController@index');

Route::get('tag/{slug}' , 'TagController@index');




Route::post('comments/{post}/store', 'CommentsController@store')->name('comments.store');
//Route::resource('comment', 'CommentsController', [ 'only' => ['show', 'store']] );




Route::get('contact', ['as' => 'contact', 'uses' => 'PagesController@contact']);
Route::post('contact', ['as' => 'contact_store', 'uses' => 'PagesController@contact_store']);
Route::post('podnety', 'MessengerController@newmessage');

//Route::post('images', ['as' => 'images', 'uses' => 'ImagesController@store']);

Route::post('contactuser/{user}', 'MessengerController@contactStoreUser')->name('contactStoreUser');
Route::post('user/knowUser/{user}', 'UserController@knowUser')->name('knowUser');


Route::get('lang/{lang}', 'UserController@setLanguage');

//Official tutorial
Route::get('/verify/{email}/token/{token}', 'UserVerificationController@verify')->name('userverification.verify');
Route::get('/verify/resend/{email}', 'UserVerificationController@resend')->name('userverification.resend');
//Route::get('/verify/resend/email/{email}', 'UserVerificationController@resend')->name('userverification.resend');


