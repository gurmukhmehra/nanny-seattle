<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\Admin\UsersMembershipController;
use App\Http\Controllers\ParentsController;
use App\Http\Controllers\CareProviderController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\ContactPageController;
use App\Http\Controllers\HelpsController;
use App\Http\Controllers\SiteSEOController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/families-parents/annual/plan', [UsersController::class, 'annualPackages']);
Route::get('/buy-plan/{slug}', [UsersController::class, 'planDetails']);

Route::get('/care-provider/annual/plan', [UsersController::class, 'careProviderAnnualPlans']);
Route::get('/buy-care-provider-plan/{slug}', [UsersController::class, 'planDetails']);

Route::get('/agencies/annual/plan', [UsersController::class, 'AgenciesAnnualPackages']);
Route::get('/buy-agencies-plan/{slug}', [UsersController::class, 'planDetails']);

Route::get('/care-provider-jobs', [JobsController::class, 'jobs']);
Route::post('/register', [UsersController::class, 'register']);
Route::post('/registerFreeCareProvider', [UsersController::class, 'registerFreeCareProvider']);

Route::post('/login',[UsersController::class, 'login']);
Route::post('/logout', [UsersController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/create-checkout-session', [UsersController::class, 'getSession']);

Route::get('/stripe/response',[UsersController::class, 'stripeResponse']);

Route::get('/sessionId','App\Http\Controllers\Admin\UsersMembershipController@sessionId');

//Route::post('/Webhooks',[StripePaymentController::class, 'webhooks']);

Route::get('/userPlan/{userid}', [UsersController::class, 'userPlan']);
Route::post('/user/updateBasicInfo', [UsersController::class, 'updateBasicInfo']);
Route::post('/user/updatePassword', [UsersController::class, 'updatePassword']);
Route::post('/user/updateSocailLinks', [UsersController::class, 'updateSocailLinks']);
Route::post('/user/upload/profileImage', [UsersController::class, 'updateProfileImage']);
Route::post('/user/upload/profileCoverImage', [UsersController::class, 'profileCoverImage']);
Route::get('/careProviders/list/', [UsersController::class, 'careProvidersList']);
Route::post('/friendRequestSend', [UsersController::class, 'friendRequestSend']);
Route::get('/friendsRequests', [UsersController::class, 'friendsRequests']);
Route::post('/friendRequestConfirm', [UsersController::class, 'friendRequestConfirm']);
Route::post('/friendRequestCancel', [UsersController::class, 'friendRequestCancel']);
Route::get('/friendsList', [UsersController::class, 'friendsList']);
Route::get('/checkFriendRequest', [UsersController::class, 'checkFriendRequest']);
Route::post('/userCancelSubscription', [UsersController::class, 'userCancelSubscription']);

Route::post('/parentBioSave', [ParentsController::class, 'parentBioSave']);
Route::get('/parentBioDetail', [ParentsController::class, 'parentBioDetail']);
Route::post('/parentAvailability', [ParentsController::class, 'parentAvailability']);
Route::get('/getfamilyparentAvailability', [ParentsController::class, 'getfamilyparentAvailability']);

Route::post('/careProviderBioSave', [CareProviderController::class, 'careProviderBioSave']);
Route::get('/careProivderBioDetail', [CareProviderController::class, 'careProivderBioDetail']);
Route::post('/careProviderAvailability', [CareProviderController::class, 'careProviderAvailability']);
Route::get('/careProivderAvailability', [CareProviderController::class, 'careProivderAvailability']);

Route::get('/memberProfile/{username}', [UsersController::class, 'friendProfileView']);
Route::get('/GetMemberAbout/{username}', [UsersController::class, 'GetMemberAbout']);
Route::get('/memberfriendsList/{username}', [UsersController::class, 'memberfriendsList']);
Route::get('/groups', [UsersController::class, 'AllGroups']);
Route::post('/joinGroup', [UsersController::class, 'joinGroup']);
Route::get('/MemberGroupList', [UsersController::class, 'MemberGroupList']);
Route::post('/chats', [ChatController::class, 'UsersChats']);
Route::post('/GroupChats', [ChatController::class, 'GroupChats']);
Route::post('/ChatMessages', [ChatController::class, 'ChatMessages']);
Route::post('/getChatMessageWithFriend', [ChatController::class, 'getChatMessageWithFriend']);
Route::post('/getGroupChatMessage', [ChatController::class, 'getGroupChatMessage']);
Route::post('/GroupChatMessages', [ChatController::class, 'GroupChatMessages']);
Route::get('/groupInfo/{slug}', [UsersController::class, 'GroupInfo']);
Route::post('/groupPostShare', [UsersController::class, 'groupPostShare']);
Route::get('/MemberGroups', [UsersController::class, 'MemberGroups']);
Route::post('/PostShare', [UsersController::class, 'PostShare']);
Route::get('/GetUserPosts', [UsersController::class, 'GetUserPosts']);
Route::post('/UserPostLike', [UsersController::class, 'UserPostLike']);
Route::post('/PostLikeTotal', [UsersController::class, 'PostLikeTotal']);
Route::get('/postsLikes', [UsersController::class, 'postsLikes']);
Route::post('/UserPostComment', [UsersController::class, 'UserPostComment']);
Route::get('/postsComments', [UsersController::class, 'postsComments']);
Route::post('/DeletePostComment', [UsersController::class, 'DeletePostComment']);
Route::post('/GroupPostLike', [UsersController::class, 'GroupPostLike']);
Route::post('/UserGroupPostComment', [UsersController::class, 'UserGroupPostComment']);
Route::get('/GetUserGroupPosts', [UsersController::class, 'GetUserGroupPosts']);

Route::post('/sendPrivateMessage', [UsersController::class, 'sendPrivateMessage']);
Route::get('/get-private-messages', [UsersController::class, 'PrivateMessageList']);
Route::post('/GetMembersThreadsMessages', [UsersController::class, 'GetMembersThreadsMessages']);
Route::post('/PrivateMessageSendToUser', [UsersController::class, 'PrivateMessageSendToUser']);
Route::post('/forgotPassword', [UsersController::class, 'forgotPassword']);
Route::post('/ChangePassword', [UsersController::class, 'ChangePassword']);

Route::post('/SumbitReview', [UsersController::class, 'SumbitReview']);
Route::get('/MemberReviewList/{memberUsername}', [UsersController::class, 'MemberReviewList']);
Route::get('/GetMyReviewList', [UsersController::class, 'GetMyReviewList']);
Route::post('/GetReviewToUsername', [UsersController::class, 'GetReviewToUsername']);

Route::get('/MemberTypeDetail', [UsersController::class, 'MemberTypeDetail']);
Route::post('/SendfriendRequest', [UsersController::class, 'SendfriendRequest']);
Route::post('/UnFriend', [UsersController::class, 'UnFriend']);
Route::post('/CheckMemberAlradyFriend', [UsersController::class, 'CheckMemberAlradyFriend']);
Route::get('/GetMemberPrivateMessages/{memberUsername}', [UsersController::class, 'GetMemberPrivateMessages']);

Route::post('/SaveApplyJob', [JobsController::class, 'SaveApplyJob']);
Route::post('/ContactUsEnqury', [ContactPageController::class, 'ContactUsEnqury']);
Route::post('/helpFind', [HelpsController::class, 'helpFind']);
Route::get('/helpsList', [HelpsController::class, 'helpsList']);

Route::post('/SaveLastMinuteGroupTextForm', [UsersController::class, 'SaveLastMinuteGroupTextForm']);
Route::get('/CheckMemberPlan', [UsersController::class, 'CheckMemberPlan']);
Route::get('/NannyContract/plan', [UsersController::class, 'NannyContractPlan']);
Route::get('/NannyShareContract/plan', [UsersController::class, 'NannyShareContractPlan']);
Route::post('/registerSave', [UsersController::class, 'registerSave']);
Route::get('/memberBasicDetail', [UsersController::class, 'memberBasicDetail']);
Route::get('/myfriendsRequests', [UsersController::class, 'myfriendsRequests']);
Route::get('/newPrivateMessage', [UsersController::class, 'newPrivateMessage']);
Route::get('/MyFriendRequestNotification', [UsersController::class, 'MyFriendRequestNotification']);
Route::get('/MyNotificatios', [UsersController::class, 'MyNotificatios']);
Route::get('/purchaseMembership', [UsersController::class, 'purchaseMembership']);
Route::post('/Verified-Care-Provider-Submission-Form', [UsersController::class, 'VerifiedCareProviderSubmissionForm']);
Route::post('/SaveFamiliesParentsConcierge', [UsersController::class, 'SaveFamiliesParentsConcierge']);
Route::get('/payment-gateway',[StripePaymentController::class, 'paymentGateway']);
Route::post('/subscriberSave', [CareProviderController::class, 'subscriberSave']);
Route::get('/notification-list', [UsersController::class, 'notificationList']);
/************************* SEO API ************************************/
Route::get('/get-seo-page', [SiteSEOController::class, 'GetSEOPage']);
/************************* End SEO API ********************************/
Route::post('/stripe-checkout', [UsersController::class, 'stripeCheckout']);