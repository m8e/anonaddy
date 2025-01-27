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

Auth::routes(['verify' => true, 'register' => config('anonaddy.enable_registration')]);

Route::post('/login/2fa', 'Auth\TwoFactorAuthController@authenticateTwoFactor')->name('login.2fa')->middleware(['2fa', 'throttle', 'auth']);

Route::get('/login/backup-code', 'Auth\BackupCodeController@index')->name('login.backup_code.index');
Route::post('/login/backup-code', 'Auth\BackupCodeController@login')->name('login.backup_code.login');

Route::middleware(['auth', 'verified', '2fa'])->group(function () {
    Route::get('/', 'ShowAliasController@index')->name('aliases.index');

    Route::get('/recipients', 'ShowRecipientController@index')->name('recipients.index');
    Route::post('/recipients/email/resend', 'RecipientVerificationController@resend');

    Route::get('/domains', 'ShowDomainController@index')->name('domains.index');
    Route::get('/domains/{id}/recheck', 'DomainVerificationController@recheck');

    Route::get('/usernames', 'ShowAdditionalUsernameController@index')->name('usernames.index');

    Route::get('/deactivate/{alias}', 'DeactivateAliasController@deactivate')->name('deactivate');
});


Route::group([
    'middleware' => ['auth', '2fa'],
    'prefix' => 'settings'
], function () {
    Route::get('/', 'SettingController@show')->name('settings.show');
    Route::post('/account', 'SettingController@destroy')->name('account.destroy');

    Route::post('/default-recipient', 'DefaultRecipientController@update')->name('settings.default_recipient');
    Route::post('/edit-default-recipient', 'DefaultRecipientController@edit')->name('settings.edit_default_recipient');

    Route::post('/from-name', 'FromNameController@update')->name('settings.from_name');

    Route::post('/email-subject', 'EmailSubjectController@update')->name('settings.email_subject');

    Route::post('/banner-location', 'BannerLocationController@update')->name('settings.banner_location');

    Route::post('/password', 'PasswordController@update')->name('settings.password');

    Route::post('/2fa/enable', 'TwoFactorAuthController@store')->name('settings.2fa_enable');
    Route::post('/2fa/regenerate', 'TwoFactorAuthController@update')->name('settings.2fa_regenerate');
    Route::post('/2fa/disable', 'TwoFactorAuthController@destroy')->name('settings.2fa_disable');
});
