<?php
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\CloudeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OffersWithAjaxController;
use App\Http\Controllers\Relations\RelationsController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\VideoEventController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {
    return 'welcome';
});
Route::namespace('Front')->group(function (){
    Route::get('users',[UserController::class,'showAdminName']);
//    Route::get('userss',[UserController::class,'showAdminNames'])->middleware('auth');
});
Route::group(['middleware'=>'auth'],function (){
    Route::get('userss',[UserController::class,'showAdminNames']);
});
Route::group([],function (){
    Route::get('first',[FirstController::class,'showString']);
    Route::get('about',[FirstController::class,'about']);
});

Route::resource('res',(ResourceController::class));
//to creat new method in the ready controller
Route::get('rs/o',('App\Http\Controllers\Front\ResourceController@ff'))->name('res.o');


Route::get('/us/{app?}',[FirstController::class,'index'])->name('us.index');

Auth::routes(['verify'=>true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes(['verify'=>true]);


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/redirect/(service)', [SocialController::class, 'redirect'])->name('redirect');
Route::get('/callback/(service)', [SocialController::class, 'callback'])->name('callback');
//$d = (['middleware' => 'auth:web'] or ['middleware' => 'auth:auth:admin_first_session']) ? true : false;

Route::group(['middleware' => 'auth:web'],function (){
    Route::group(
        [
            'prefix' => LaravelLocalization::setLocale(),
            'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
        ],

        function (){
            /// event listener
            Route::get('youtube',[VideoEventController::class,'index'])->middleware('auth');
            Route::group(['prefix'=>'offers'],function (){
            ///////////offers
            Route::get('form',[CloudeController::class,'index']);
            Route::get('show',[CloudeController::class,'show']);
            Route::post('form',[CloudeController::class,'store'])->name('offers.store');
            Route::get('editForm/{offer_id}',[CloudeController::class,'showEditForm']);
            Route::post('update/{offer_id}',[CloudeController::class,'update'])->name('offers.update');
            Route::get('delete/{offer_id}',[CloudeController::class,'delete'])->name('offers.delete');

            //////////


            // offers with Ajax
            Route::get('formwithajax',[OffersWithAjaxController::class,'index']);
            Route::get('showAll',[OffersWithAjaxController::class,'show'])->name('ajax.offers.showAll');
            Route::post('store',[OffersWithAjaxController::class,'store'])->name('ajax.offers.store');
            Route::get('editformwithajax/{offer_id}',[OffersWithAjaxController::class,'showEditFormajax'])->name('offers.edit.form'); //
            Route::post('update',[OffersWithAjaxController::class,'update'])->name('offers.update');
            Route::post('delete',[OffersWithAjaxController::class,'delete'])->name('ajax.offers.delete');
            });

        });
});

Route::group(

        [
            'prefix' => LaravelLocalization::setLocale(),
            'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
        ],
        function () {
            Route::get('adults',[CustomAuthController::class,'Adult'])->middleware('auth:site','CheckAge');
            Route::get('site',[CustomAuthController::class,'Site'])->middleware('auth');
            Route::get('/adminss',[CustomAuthController::class,'Admin'])->name('admin')->middleware('auth:admin_first_session');
            Route::get('admin/loginform',[CustomAuthController::class,'AdminLoginForm']);
            Route::post('admin/login',[CustomAuthController::class,'AdminLogin'])->name('save.admin.login');
            Route::get('/dashboard', function () {
                return 'not adults';
            })->name('not.adult');

});

############### Begin OneToOne Relations ##############
Route::group(

    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () {

        Route::get('has_one',[RelationsController::class,'hasOneRelation']);
        Route::get('has_one_reverse',[RelationsController::class,'hasOneRelationReverse']);
    });
############### End OneToOne Relations ################
################ Begin OneToMany Relations ##############
Route::group(

    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () {

        Route::get('has_many',[RelationsController::class,'hasManyRelations']);
        Route::get('hospitals',[RelationsController::class,'hospitals']);
        Route::get('deleteHospital/{hospital_id}',[RelationsController::class,'deleteHospital'])->name('hospital.delete');
        Route::get('hospitals/{hospital_id}',[RelationsController::class,'hospitalsById'])->name('hospitals.hospitals');
        Route::get('doctors/{hospital_id}',[RelationsController::class,'doctors'])->name('hospitals.doctors');
        Route::get('hospitals_have_doctors',[RelationsController::class,'hospitalsHaveDoctors']);
        Route::get('hospitals_do_not_have_doctors',[RelationsController::class,'hospitalsDonthaveDoctors']);
        Route::get('hospitals_has_male_doctors',[RelationsController::class,'hospitalsMaleDoctors']);


    });
############### End OneToMany Relations ################

################ Start ManyToMany Relations ################
Route::get('doctors_services',[RelationsController::class,'getDoctorsServices']);
Route::get('services_doctors',[RelationsController::class,'getServicesDoctors']);
Route::get('show/doctor_services/{doctor_id}',[RelationsController::class,'showDoctorServices'])->name('show.doctor.services');
Route::post('save/doctor_services',[RelationsController::class,'save'])->name('save_services_to_doctor');
################ End ManyToMany Relations ################

################ Start has one through Relations ################
Route::get('has_one_through',[RelationsController::class,'getPatientDoctor']);
Route::get('has_many_through',[RelationsController::class,'getDoctorCountries']);
################ End has one through Relations ################

############### Start Accessors & Mutators ######################
Route::get('accessors',[CloudeController::class,'gerDoctorsGender']);
############### End Accessors & Mutators ######################

