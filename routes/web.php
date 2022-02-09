<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes(['register' => false]);
Route::get('logout', 'Auth\LoginController@logout');
Route::get('/admin', 'HomeController@index')->middleware('auth')->name('home');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    Route::resource('destination', DestinationController::class)->except(['create', 'show']);
    Route::get('destination/list', 'DestinationController@getListDestination')->name('destination.datatable');
    Route::get('destination/{id}/change-status/{status}', 'DestinationController@change');

    Route::resource('type-of-tour', TypeOfTourController::class)->except(['create', 'show']);
    Route::group(['prefix' => 'type-of-tour'], function () {
        Route::get('list', 'TypeOfTourController@getListType')->name('type.list');
        Route::get('{id}/change-status/{status}', 'TypeOfTourController@change');
    });

    Route::resource('user', UserController::class)->middleware('manager-role')->except(['show']);
    Route::group(['prefix' => 'user', 'middleware'=>['auth', 'manager-role']], function () {
        Route::get('list', 'UserController@getListUser')->name('user.list');
        Route::get('change-password', 'UserController@changePassword')->name('user.change-password');
        Route::get('change/{id}', 'UserController@change')->name('user.change'); // change password
    });

    Route::resource('contact', ContactController::class)->only(['index', 'edit']);
    Route::get('contact/list', 'ContactController@getListContact')->name('contact.list');

    Route::resource('tour', TourController::class)->except(['show']);
    Route::group(['prefix' => 'tour'], function () {
        Route::get('detail/{id}', 'TourController@show')->name('tour.detail');
        Route::get('list', 'TourController@getListTour')->name('tour.list');
        Route::get('{id}/change-status/{status}', 'TourController@changeStatus');
        Route::get('{id}/change-attractive/{status}', 'TourController@changeAttractive');
    });

    Route::resource('tour/gallery', GalleryController::class)->only(['store', 'destroy']);
    Route::get('tour/{id}/gallery', 'GalleryController@index')->name('tour.gallery');

    Route::resource('tour/itinerary', ItineraryController::class)->except(['index', 'create','show']);
    Route::get('tour/{tour_id}/itinerary', 'ItineraryController@index')->name('tour.itinerary');
    Route::get('tour/{id}/itinerary/list', 'ItineraryController@getListItinerary');

    Route::resource('tour/itinerary/place', placeItineraryController::class)->except(['index', 'create','show']);
    Route::get('tour/{tour_id}/itinerary/{id}/place', 'PlaceItineraryController@index');
    Route::get('tour/{tour_id}/itinerary/{id}/place/list', 'PlaceItineraryController@getListPlace');

    Route::resource('tour/faqs', FaqsController::class)->except(['index', 'create','show']);
    Route::get('tour/{tour_id}/faqs', 'FaqsController@index')->name('tour.faqs');
    Route::get('tour/{tour_id}/faqs/list', 'FaqsController@getListFaqs')->name('faqs.list');

    Route::group(['prefix' => 'tour'], function () {
        Route::get('{tour_id}/review/', 'ReviewController@index')->name('tour.review');
        Route::get('{tour_id}/review/list', 'ReviewController@getListReview');
        Route::get('review/{id}/edit', 'ReviewController@edit')->name('review.edit');
        Route::get('{tour_id}/review/change-status/{id}/{status}', 'ReviewController@changeStatus')->name('review.changeStatus'); //change status review
    });

    Route::resource('booking', BookingController::class)->only(['index', 'edit', 'update']);
    Route::get('booking/list', 'BookingController@getListBooking')->name('booking.list');
});
// route client
Route::group(['namespace' => 'Client'], function () {
    Route::get('home', 'HomepageController@main')->name('client.home');
    Route::get('', 'HomepageController@main');
    Route::get('search-tour', 'HomepageController@search')->name('homepage.search');

    Route::get('list-tour', 'TourController@listTour');
    Route::get('list-tour/{destination_slug}', 'TourController@destinationTour');
    Route::get('tour/filter', 'TourController@filter')->name('tour.filter');
    Route::get('tour/{duration}-{slug}', 'TourController@tourDetail');
    Route::post('tour/review/{duration}-{slug}', 'TourController@storeReview')->name('client.review.store');

    Route::get('booking', 'BookingController@main')->name('client.booking');
    Route::post('booking-now', 'BookingController@booking')->name('booking.now');
    Route::post('change-booking', 'BookingController@changeBooking')->name('booking.change');
    Route::post('booking/complete', 'BookingController@completeBooking')->name('booking.complete');
    Route::get('booking/thank-you', 'BookingController@thankyou')->name('booking.thankyou');

    Route::get('contact', 'ContactController@main')->name('client.contact');
    Route::post('contact/store', 'ContactController@store')->name(('contact.store'));
});
