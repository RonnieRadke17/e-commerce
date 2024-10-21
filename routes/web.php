<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ErrorsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserEventController;

/* Route::get('/', function () { 
    return redirect()->route('products.index');
}); */

Route::resource('products', ProductController::class);

Route::get('/', [UserEventController::class, 'index'])->name('home');//ruta que muestra la pagina principal


//restablecimiento de contrasena
Route::controller(ResetPasswordController::class)->group(function () {
    Route::get('/password', 'showFormSendCode')->name('forgot-password');//form para envio de correo
    Route::get('/password/reset/{token}', 'showResetForm')->name('password.reset');//formulario para restablecer la contrasena
    Route::post('/password/send-passwod-code', 'sendPasswordCode')->name('password.send-password-code');//manda el correo
    Route::post('/password/reset-password', 'reset')->name('password.update');//restablece la contrasena

    Route::post('/password/send-code-password', 'reSendPasswordCode')->name('password.send-code');//manda el correo
    //ruta de ventana cuenta bloqueada

});

Route::view('acount/suspended', 'auth/passwords/message')->name('acount.suspended');


//ventana que muestra los errores comunes
Route::get('/error',[ErrorsController::class,'showWindowError'])->name('window.error');

//rutas del perfil

//falta grupo de rutas de registro y login
Route::get('/register',[RegisterController::class,'showRegistrationForm'])->name('register');
Route::post('/process-register', [RegisterController::class, 'processRegister'])->name('process-register');
Route::get('/email-verification',[RegisterController::class,'emailVerification'])->name('email-verification');
Route::post('/check-email-verification',[RegisterController::class,'checkEmailVerification'])->name('check-email-verification');
Route::post('/send-verification-code',[RegisterController::class,'sendVerificationCode'])->name('send-verification-code');
Route::post('/signup',[RegisterController::class,'register'] )->name('signup');//ruta que registra al usr

//Route::view('/login', 'auth/login')->name('login');//ruta que muestra la vista del login ya no se ocupa
Route::get('/login',[LoginController::class,'showLoginForm'])->name('login');//ruta que muestra la vista del login

Route::post('/signin',[LoginController::class,'login'] )->name('signin');//ruta que inicia sesion al usr 

Route::get('/logout',[LogoutController::class,'logout'] )->name('logout');//ruta que cierra sesion al usr


