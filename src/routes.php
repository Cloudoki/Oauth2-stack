<?php

/*
|--------------------------------------------------------------------------
| Oauth2 Routes
|--------------------------------------------------------------------------
|
| All the Oauth2 Endpoints are defined here.
| You may want to include or copy them to your general ./app/routes.php file.
|
*/

Route::group(array ('prefix'=> 'oauth2'), function ()
{
	# User
	Route::get ('login', ['as' => 'login', 'uses'=> '\Cloudoki\OaStack\Controllers\OaStackViewController@login']);
	Route::post ('login', ['before'=> 'csrf', 'uses'=> '\Cloudoki\OaStack\Controllers\OaStackViewController@loginrequest']);

	Route::get ('forgot', '\Cloudoki\OaStack\Controllers\OaStackViewController@forgot');
	Route::post ('forgot', ['before'=> 'csrf', 'uses'=> '\Cloudoki\OaStack\Controllers\OaStackViewController@resetrequest']);
	Route::get ('reset/{reset_token}', '\Cloudoki\OaStack\Controllers\OaStackViewController@reset');
	Route::post ('reset/{reset_token}', '\Cloudoki\OaStack\Controllers\OaStackViewController@changepassword');

	Route::post ('authorize', ['before'=> 'csrf', 'uses'=> '\Cloudoki\OaStack\Controllers\OaStackViewController@approve']);

	Route::get ('invitation/{path?}', '\Cloudoki\OaStack\Controllers\OaStackViewController@subscribe');
	Route::post ('invitation/{path?}', '\Cloudoki\OaStack\Controllers\OaStackViewController@subscribed');
});

# Authentication required.

Route::group(array ('prefix'=> 'oauth2', 'before'=> 'auth'), function ()
{
	# User
	Route::get ('invite', '\Cloudoki\OaStack\Controllers\OaStackViewController@invite');

	# App
	Route::get ('register', '\Cloudoki\OaStack\Controllers\OaStackViewController@registerapp');
	Route::post ('register', '\Cloudoki\OaStack\Controllers\OaStackViewController@registeredapp');
});