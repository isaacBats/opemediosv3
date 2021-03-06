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
use App\Mail\Blocknews;
use App\Multiple;
use App\Newsletter;
use App\NewsletterConfig;
use Illuminate\Support\Facades\Mail;

const NO_ENVIADO = 0;
const ENVIADO = 1;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::group(['prefix' => 'newsletter', 'middleware' => ['auth',]], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('nuevo', 'NewsletterController@showForm')->name('newsletter.create');
    Route::post('nuevo', 'NewsletterController@create')->name('newsletter.create');
    Route::get('editar/{id}', 'NewsletterController@edit')->name('newsletter.edit');
    Route::post('editar/{id}', 'NewsletterController@update')->name('newsletter.update');
    Route::post('borrar/{id}', 'NewsletterController@delete')->name('newsletter.delete');
    
    Route::get('configuracion', 'NewsletterController@config')->name('newsletter.config');
    Route::post('configuracion', 'NewsletterController@configUpdate')->name('newsletter.config');
    Route::post('configuracion/update/banner', 'NewsletterController@configUpdateBanner')->name('newsletter.config.banner');

    Route::get('enviar-mail/{id}', 'NewsletterController@sendMail')->name('newsletter.sendmail');
    Route::get('vista-previa/{id}', 'NewsletterController@preview')->name('newsletter.preview');
    
    Route::post('seccion/{id}', 'NewsletterDataController@update')->name('newsletter.data.update');
    Route::post('seccion/delete/{id}', 'NewsletterDataController@delete')->name('newsletter.data.delete');
});