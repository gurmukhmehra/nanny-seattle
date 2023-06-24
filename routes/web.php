<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Admin\AdminController;
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

Route::get('/superadmin','App\Http\Controllers\Admin\IndexController@login');
Route::post('/superadmin','App\Http\Controllers\Admin\IndexController@Adminlogin');
Route::get('/superadmin/logout','App\Http\Controllers\Admin\IndexController@signOut');
Route::get('/superadmin/dashboard','App\Http\Controllers\Admin\IndexController@dashboard')->middleware('superadmin');
Route::get('/superadmin/profile','App\Http\Controllers\Admin\IndexController@profile')->middleware('superadmin');
Route::post('/superadmin/profile','App\Http\Controllers\Admin\IndexController@updateProfile')->middleware('superadmin');
Route::get('/superadmin/change-password','App\Http\Controllers\Admin\IndexController@changePassword')->middleware('superadmin');
Route::post('/superadmin/change-password','App\Http\Controllers\Admin\IndexController@UpdatePassword')->middleware('superadmin');
Route::get('/superadmin/general-setting','App\Http\Controllers\Admin\IndexController@generalSetting')->middleware('superadmin');
Route::post('/superadmin/general-setting','App\Http\Controllers\Admin\IndexController@SaveSetting')->middleware('superadmin');
Route::get('/superadmin/users-list','App\Http\Controllers\Admin\IndexController@usersList')->middleware('superadmin');
Route::get('/superadmin/upload-wp-users','App\Http\Controllers\Admin\IndexController@uploadWpUsers')->middleware('superadmin');
Route::post('/superadmin/upload-wp-users','App\Http\Controllers\Admin\IndexController@uploadUsers')->middleware('superadmin');
Route::get('/superadmin/user/view/{id}','App\Http\Controllers\Admin\IndexController@userView')->middleware('superadmin');

Route::get('/superadmin/memberships-list','App\Http\Controllers\Admin\UsersMembershipController@membershipsList')->middleware('superadmin');
Route::get('/superadmin/memberships/add','App\Http\Controllers\Admin\UsersMembershipController@AddMemberships')->middleware('superadmin');
Route::post('/superadmin/memberships/add','App\Http\Controllers\Admin\UsersMembershipController@SaveMemberships')->middleware('superadmin');
Route::get('/superadmin/memberships/{slug}','App\Http\Controllers\Admin\UsersMembershipController@editmembership')->middleware('superadmin');
Route::post('/superadmin/memberships/{slug}','App\Http\Controllers\Admin\UsersMembershipController@updateMembership')->middleware('superadmin');
Route::get('/superadmin/membership/reports','App\Http\Controllers\Admin\UsersMembershipController@membershipsReports')->middleware('superadmin');
Route::get('/superadmin/membership/report-filter','App\Http\Controllers\Admin\UsersMembershipController@membershipsReportFilter')->middleware('superadmin');

Route::get('/superadmin/payment-gateway/stripe','App\Http\Controllers\Admin\PaymentGatewayController@stripeSetting')->middleware('superadmin');
Route::post('/superadmin/payment-gateway/stripe','App\Http\Controllers\Admin\PaymentGatewayController@UpdteStripeSetting')->middleware('superadmin');
Route::get('/superadmin/jobs','App\Http\Controllers\Admin\JobsController@jobsList')->middleware('superadmin');
Route::get('/superadmin/jobs/add-job','App\Http\Controllers\Admin\JobsController@addJob')->middleware('superadmin');
Route::post('/superadmin/jobs/add-job','App\Http\Controllers\Admin\JobsController@saveJob')->middleware('superadmin');
Route::get('/superadmin/jobs/{slug}','App\Http\Controllers\Admin\JobsController@editJobs')->middleware('superadmin');
Route::post('/superadmin/jobs/{slug}','App\Http\Controllers\Admin\JobsController@updateJobs')->middleware('superadmin');
Route::get('/superadmin/job/update-job-status','App\Http\Controllers\Admin\JobsController@updatejobstatus')->middleware('superadmin');
Route::get('/superadmin/jobs/delete/{id}','App\Http\Controllers\Admin\JobsController@jobDelete')->middleware('superadmin');

Route::post('/stripeWebhooks','App\Http\Controllers\StripePaymentController@webhooks');
Route::get('/successURL','App\Http\Controllers\StripePaymentController@successURL');

Route::get('/superadmin/subscriptions','App\Http\Controllers\Admin\UsersMembershipController@UsersSubscriptions')->middleware('superadmin');
Route::get('/superadmin/subscriptions/view/{id}','App\Http\Controllers\Admin\UsersMembershipController@subscriptionView')->middleware('superadmin');
Route::get('/superadmin/membership/setting','App\Http\Controllers\Admin\PaymentGatewayController@membershipSetting')->middleware('superadmin');

Route::get('/superadmin/groups','App\Http\Controllers\Admin\IndexController@groups')->middleware('superadmin');
Route::get('/superadmin/groups/add','App\Http\Controllers\Admin\IndexController@AddGroup')->middleware('superadmin');
Route::post('/superadmin/groups/add','App\Http\Controllers\Admin\IndexController@SaveGroup')->middleware('superadmin');
Route::get('/superadmin/groups/{slug}','App\Http\Controllers\Admin\IndexController@editGroup')->middleware('superadmin');
Route::post('/superadmin/groups/{slug}','App\Http\Controllers\Admin\IndexController@updateGroup')->middleware('superadmin');
Route::get('/superadmin/ForgotPassword','App\Http\Controllers\Admin\IndexController@ForgotPassword');
Route::get('/superadmin/ResetPassword','App\Http\Controllers\Admin\IndexController@ResetPassword');
Route::post('/backgroundCheck','App\Http\Controllers\UsersController@backgroundCheck');
/****************************** Import wp data****************************/
Route::get('/superadmin/import-wp-memberships','App\Http\Controllers\Admin\UsersMembershipController@ImportWPMemberships')->middleware('superadmin');

Route::get('/superadmin/import-data','App\Http\Controllers\Admin\UsersMembershipController@ImportData')->middleware('superadmin');
Route::get('/superadmin/importData','App\Http\Controllers\Admin\UsersMembershipController@ImportedData')->middleware('superadmin');

Route::get('/superadmin/get-wp-member-profile-images','App\Http\Controllers\Admin\UsersMembershipController@GetWpMemberProfileImages')->middleware('superadmin');

Route::get('/superadmin/helps/add','App\Http\Controllers\Admin\HelpsController@HelpAdd')->middleware('superadmin');
Route::post('/superadmin/helps/add','App\Http\Controllers\Admin\HelpsController@SaveHelpAdd')->middleware('superadmin');
Route::get('/superadmin/helps/','App\Http\Controllers\Admin\HelpsController@helps')->middleware('superadmin');
Route::get('/superadmin/helps/{slug}','App\Http\Controllers\Admin\HelpsController@viewHelp')->middleware('superadmin');
Route::post('/superadmin/helps/{slug}','App\Http\Controllers\Admin\HelpsController@updateHelp')->middleware('superadmin');
Route::get('/superadmin/help/categories','App\Http\Controllers\Admin\HelpsController@categories')->middleware('superadmin');
Route::get('/superadmin/help/categories/add','App\Http\Controllers\Admin\HelpsController@addCategories')->middleware('superadmin');
Route::post('/superadmin/help/categories/add','App\Http\Controllers\Admin\HelpsController@SaveCategories')->middleware('superadmin');

Route::get('/superadmin/add-user','App\Http\Controllers\Admin\IndexController@addUser')->middleware('superadmin');
Route::post('/superadmin/add-user','App\Http\Controllers\Admin\IndexController@SaveNewUser')->middleware('superadmin');

Route::get('/superadmin/memberships-emails','App\Http\Controllers\Admin\TestEmailController@membershipsEmails')->middleware('superadmin');
Route::get('/superadmin/send-test-memberships-email','App\Http\Controllers\Admin\TestEmailController@SendTestMembershipsEmails')->middleware('superadmin');
Route::get('/superadmin/ninja-emails','App\Http\Controllers\Admin\TestEmailController@ninjaEmails')->middleware('superadmin');
Route::get('/superadmin/send-test-ninja-email','App\Http\Controllers\Admin\TestEmailController@SendTestNinjaEmails')->middleware('superadmin');

Route::get('/superadmin/reminders-emails','App\Http\Controllers\Admin\TestEmailController@remindersEmails')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm2','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm2')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm3','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm3')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm4','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm4')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm5','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm5')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm6','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm6')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm7','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm7')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm8','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm8')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm9','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm9')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm10','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm10')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm11','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm11')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm12','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm12')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm13','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm13')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm14','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm14')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm15','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm15')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm16','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm16')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm17','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm17')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm18','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm18')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm19','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm19')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm20','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm20')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm21','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm21')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm22','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm22')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm23','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm23')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm24','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm24')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm25','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm25')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm26','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm26')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm27','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm27')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm28','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm28')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm29','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm29')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm30','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm30')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm31','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm31')->middleware('superadmin');
Route::get('/superadmin/test-reminders-firstForm32','App\Http\Controllers\Admin\TestEmailController@SendTestRemindersfirstForm32')->middleware('superadmin');

Route::get('superadmin/seo','App\Http\Controllers\Admin\SEOController@seoList')->middleware('superadmin');
Route::get('superadmin/add-seo','App\Http\Controllers\Admin\SEOController@addseo')->middleware('superadmin');
Route::post('superadmin/add-seo','App\Http\Controllers\Admin\SEOController@SaveSeo')->middleware('superadmin');
Route::get('superadmin/seo/edit/{id}','App\Http\Controllers\Admin\SEOController@Editseo')->middleware('superadmin');
Route::post('superadmin/seo/update-seo','App\Http\Controllers\Admin\SEOController@UpdateSeo')->middleware('superadmin');

Route::get('/superadmin/transactions','App\Http\Controllers\Admin\UsersMembershipController@transactions')->middleware('superadmin');
Route::get('/superadmin/transaction/add-new','App\Http\Controllers\Admin\UsersMembershipController@AddNewTransaction')->middleware('superadmin');
Route::get('/superadmin/findUsername','App\Http\Controllers\Admin\UsersMembershipController@findUsername')->middleware('superadmin');
Route::post('/superadmin/transaction/add-new','App\Http\Controllers\Admin\UsersMembershipController@saveManualTransaction')->middleware('superadmin');
Route::get('/superadmin/transaction/edit/{id}','App\Http\Controllers\Admin\UsersMembershipController@EditTransaction')->middleware('superadmin');
Route::post('/superadmin/transaction/update','App\Http\Controllers\Admin\UsersMembershipController@updateManualTransaction')->middleware('superadmin');
Route::get('/superadmin/transaction/delete/{id}','App\Http\Controllers\Admin\UsersMembershipController@deleteTransaction')->middleware('superadmin');
/**************************************************************************/

Route::get('{any}', function () { 
    return view('app'); 
})->where('any', '.*'); 

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

