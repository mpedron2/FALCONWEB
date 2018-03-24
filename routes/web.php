<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// CPANEL ROUTES
Route::group(['prefix' => '/control-panel'], function () {
	
	// NEWS & EVENTS
	Route::group(['prefix' => '/news-events'], function () {
		Route::get('', 'cpanel\NewseventsController@index')->name('news-events');
		Route::get('news_events_add', 'cpanel\NewseventsController@news_events_add')->name('news_events_add');
		Route::get('fetch_articles_data', 'cpanel\NewseventsController@fetch_articles_data')->name('fetch_articles_data');
		Route::post('news_events_update', 'cpanel\NewseventsController@news_events_update')->name('news_events_update');
		Route::get('news_events_delete', 'cpanel\NewseventsController@news_events_delete')->name('news_events_delete');
		Route::post('selected_gallery_save', 'cpanel\NewseventsController@selected_gallery_save')->name('selected_gallery_save');
		Route::post('save_articles', 'cpanel\NewseventsController@save_articles')->name('save_articles');
	});


	// ACHIVEMENTS
	Route::group(['prefix' => '/achivements'], function () {
		Route::get('', 'cpanel\AchivementsController@index')->name('achivements');
		Route::post('achivements_add_form', 'cpanel\AchivementsController@achivements_add_form')->name('achivements_add_form');
		Route::post('achivements_add_save', 'cpanel\AchivementsController@achivements_add_save')->name('achivements_add_save');
		Route::post('achivements_update_save', 'cpanel\AchivementsController@achivements_update_save')->name('achivements_update_save');
		Route::get('fetch_achivements_data', 'cpanel\AchivementsController@fetch_achivements_data')->name('fetch_achivements_data');
		Route::get('achivements_delete', 'cpanel\AchivementsController@achivements_delete')->name('achivements_delete');
		Route::post('ach_selected_gallery_save', 'cpanel\AchivementsController@ach_selected_gallery_save')->name('ach_selected_gallery_save');
		
	});

	// FALCON GAZETTE
	Route::group(['prefix' => '/gazette'], function () {
		Route::get('', 'cpanel\FalconGazetteController@index')->name('gazette');
		Route::post('gazette_add_form', 'cpanel\FalconGazetteController@gazette_add_form')->name('gazette_add_form');
		Route::post('gazette_add_save', 'cpanel\FalconGazetteController@gazette_add_save')->name('gazette_add_save');
		Route::get('fetch_gazette_data', 'cpanel\FalconGazetteController@fetch_gazette_data')->name('fetch_gazette_data');
		Route::post('gazette_update_save', 'cpanel\FalconGazetteController@gazette_update_save')->name('gazette_update_save');
		Route::get('gazette_delete', 'cpanel\FalconGazetteController@gazette_delete')->name('gazette_delete');		
	});


	// GALLERY
	Route::group(['prefix' => '/gallery'], function () {
		Route::get('', 'cpanel\GalleryController@index')->name('gallery');
		Route::post('album_add_modal', 'cpanel\GalleryController@album_add_modal')->name('album_add_modal');
		Route::post('gallery_add_save', 'cpanel\GalleryController@gallery_add_save')->name('gallery_add_save');
		Route::get('fetch_album_data', 'cpanel\GalleryController@fetch_album_data')->name('fetch_album_data');
		Route::post('gallery_update_save', 'cpanel\GalleryController@gallery_update_save')->name('gallery_update_save');
		Route::get('album_delete', 'cpanel\GalleryController@album_delete')->name('album_delete');
		
		Route::get('{id}/manage-gallery', 'cpanel\GalleryController@manage_gallery')->name('manage_gallery');
		Route::post('', 'cpanel\GalleryController@post_gallery')->name('post_gallery');
		Route::get('delete_gallery_images', 'cpanel\GalleryController@delete_gallery_images')->name('delete_gallery_images');
		Route::get('fetch_images_data', 'cpanel\GalleryController@fetch_images_data')->name('fetch_images_data');
		Route::post('images_data_update_save', 'cpanel\GalleryController@images_data_update_save')->name('images_data_update_save');
		Route::post('images_sorting_save', 'cpanel\GalleryController@images_sorting_save')->name('images_sorting_save');
	});


	// INQUIRIES
	Route::group(['prefix' => '/inquiries'], function () {
		Route::get('', 'cpanel\InquiriesController@index')->name('cms.inquiries');
		Route::get('inquiries_delete', 'cpanel\InquiriesController@inquiries_delete')->name('cms.inquiries.delete');
		Route::get('inquiries_details', 'cpanel\InquiriesController@inquiries_details')->name('cms.inquiries.details');
		Route::get('export_inquiries', 'cpanel\InquiriesController@export_inquiries')->name('cms.iexport.inquiries');
	});


	// ACCOUNTS
	Route::group(['prefix' => '/accounts'], function () {
		Route::get('', 'cpanel\AccountsController@index')->name('cms.accounts');
		Route::post('account_add_form', 'cpanel\AccountsController@account_add_form')->name('account.add.form');
		Route::post('accounts_add_save', 'cpanel\AccountsController@accounts_add_save')->name('account.add.save');
		Route::get('account_data_fetch', 'cpanel\AccountsController@account_data_fetch')->name('account.data.fetch');
		Route::post('accounts_update_save', 'cpanel\AccountsController@accounts_update_save')->name('account.update.save');
		Route::post('accounts_cpassword_save', 'cpanel\AccountsController@accounts_cpassword_save')->name('account.cpassword.save');\
		Route::get('account_delete', 'cpanel\AccountsController@account_delete')->name('account.delete');
	});

	Route::get('/', 'Auth\LoginController@showLoginForm')->name('cpanel.login');
	Route::post('/', 'Auth\LoginController@login');
	Route::get('/logout', 'Auth\LoginController@logout')->name('cpanel.logout');

	// Registration Routes...
	Route::get('/register', 'Auth\LoginController@showRegistrationForm')->name('register');
	Route::post('/register', 'Auth\LoginController@register');

	// Password Reset Routes...
	Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
	Route::get('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
	
	Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

	Auth::routes();

});	



// FRONT END ROUTES
Route::get('/mission-vision', function () {
	return view('mission-vision');
});

Route::get('/core-values', function () {
	return view('core-values');
});

Route::get('/history', function () {
	return view('history');
});

Route::get('/falcon-hymn', function () {
	return view('falcon-hymn');
});

Route::get('/administration', function () {
	return view('administration');
});



Route::group(['prefix' => '/achievements'], function () {
	Route::get('', 'AchivementsController@achievements_all')->name('achievements.data');
	Route::get('/{id}', 'AchivementsController@achievements_details')->name('achievements.details');
	
});

Route::group(['prefix' => '/contact-us'], function () {
	Route::get('', 'ContactUsController@index')->name('contact.form');
	Route::post('contact_form_save', 'ContactUsController@contact_form_save')->name('contact.form.save');
	
});

Route::group(['prefix' => '/academic-calendar'], function () {
	Route::get('', 'ArticlesController@academic_calendar')->name('academic.calendar');
	Route::post('fetch_event_fullcalendar', 'ArticlesController@fetch_event_fullcalendar')->name('fetch_event_fullcalendar');
	Route::get('fetch_event_fullcalendar_details', 'ArticlesController@fetch_event_fullcalendar_details')->name('fetch_event_fullcalendar_details');
	
});

Route::group(['prefix' => '/news-and-announcements'], function () {
	Route::get('', 'ArticlesController@news_announcements_data')->name('article.newsannoucements');
	Route::get('/{type}', 'ArticlesController@articles_data_filter')->name('articles.data.filter');
	
});



Route::group(['prefix' => '/facilities'], function () {
	Route::get('', 'GalleriesController@facilities_gallery')->name('facilities.gallery');
	Route::get('/{id}', 'GalleriesController@fetch_facilities_details')->name('facilities.details');
});



Route::group(['prefix' => '/gallery'], function () {
	Route::get('', 'GalleriesController@gallery')->name('gallery.all');
	Route::get('/{id}', 'GalleriesController@fetch_gallery_details')->name('gallery.details');
});


Route::group(['prefix' => '/article'], function () {
	Route::get('/{id}', 'ArticlesController@fetch_article_data')->name('article.details');
});


Route::group(['prefix' => '/achievements'], function () {
	Route::get('/filter', 'AchivementsController@achievements_filter')->name('achievements_filter');
});


Route::group(['prefix' => '/'], function () {
	Route::get('', 'IndexPageController@index')->name('indexpage');

	Route::get('{level}', 'SchoolLevelController@school_level')->name('school.level');
	Route::post('{level}', 'SchoolLevelController@school_gallery_images')->name('school.level.gallery');
	
});