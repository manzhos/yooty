<?php

use App\Http\Controllers\AssistanceController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaintController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PagesController;
use App\Http\Controllers\SetNotificationController;
use App\Http\Controllers\Admin\DashboardController;

use App\Notifications\beMyCoach;

use App\Http\Controllers\Auth\SocialController;

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

/* Cache routes */
Route::middleware('cache.headers:public;max_age=0;etag')->group(function () {
    //
});

//// Main page
Route::get('/', [PagesController::class, 'index']);

//Route::get('/profile', [HomeController::class, 'index'])->name('profile');
//Route::get('/home', [HomeController::class, 'home'])->name('home');



//// Authentication routes
Auth::routes();


//// Messages routes
Route::get('/messages', [MessageController::class, 'index'])->name('messages');
Route::get('/messages/edit/{id}', [MessageController::class, 'edit'])->name('messages.edit');
Route::get('/messages/delimage', [MessageController::class, 'delimage'])->name('del.messageimage');
Route::post('/messages/update/{id}', [MessageController::class, 'update'])->name('messages.update');
Route::get('/messages/show/{id}', [MessageController::class, 'show'])->name('messages.show');
Route::post('/messages/store', [MessageController::class, 'store'])->name('messages.store');

//Create
Route::get('/message/create', [MessageController::class,'create'])->name('message.create');
Route::post('/message/create-2', [MessageController::class,'create2'])->name('messages.create-2');
Route::post('/message/create-3', [MessageController::class,'create3'])->name('messages.create-3');

//Search
Route::get('/message/search', [MessageController::class,'search'])->name('search-messages');

// Message (announce) create successfull route
Route::get('/message/successful',[PagesController::class,'successful'])->name('messages.successful');

// Message delete
Route::get('/message/delete',[MessageController::class,'destroy'])->name('message.delete');


//// Social login routes // facebook, twitter, linkedin, google
Route::get('/social-auth/{provider}', [SocialController::class, 'redirectToProvider'])->name('auth.social');
Route::get('/social-auth/{provider}/callback', [SocialController::class, 'handleProviderCallback'])->name('auth.social.callback');


////User Profile
//Route::resource('/users', [UserController::class, '']);
Route::get('/profile', [UserController::class, 'profile']);
Route::get('/profile/info', [UserController::class, 'info'])->name('profiles.info');
Route::get('/profile/minibio', [UserController::class, 'minibio'])->name('profiles.minibio');

Route::get('/profile/skills', [UserController::class, 'skills'])->name('profiles.skills');
Route::post('/profile/prof', [UserController::class, 'prof'])->name('prof');
Route::post('/profile/addskill', [UserController::class, 'addskill'])->name('add.skill');
Route::post('/profile/delskill', [UserController::class, 'delskill'])->name('del.skill');
Route::post('profile/edittariffs', [UserController::class, 'edittariffs'])->name('edit.tariffs');

Route::get('/profile/change-avatar', [UserController::class, 'change_avatar'])->name('profiles.change-avatar');
Route::post('change-avatar', [UserController::class, 'update_avatar']);
Route::post('change-avatar-mob', [UserController::class, 'update_avatar_mob']);
Route::get('/profile/instructor', [UserController::class, 'instructor'])->name('profiles.instructor');
Route::get('/profile/subscription', [UserController::class, 'subscription'])->name('profiles.subscription');
Route::get('/profile/subscription-request', [UserController::class, 'subscription_request'])->name('profiles.subscription-request');
Route::get('/profile/notice-left', [UserController::class, 'notice_left'])->name('profiles.notice-left');
Route::get('/profile/notice-receive', [UserController::class, 'notice_receive'])->name('profiles.notice-receive');
Route::get('/profile/payment-detail', [UserController::class, 'payment_detail'])->name('profiles.payment-detail');
Route::get('/profile/payment-history', [UserController::class, 'payment_history'])->name('profiles.payment-history');

Route::get('/profile/change-pass', [UserController::class, 'change_pass'])->name('profiles.change-pass');
Route::put('/profile/change-userpass/{id}', [UserController::class, 'change_userpass'])->name('change-userpass');

Route::get('/profile/notification', [SetNotificationController::class, 'notification'])->name('profile.notification');
Route::get('/profile/faq', [UserController::class, 'faq'])->name('profiles.faq');
Route::get('/profile/privacy-policy', [UserController::class, 'privacy_policy'])->name('profiles.privacy-policy');

Route::post('userupdate', [UserController::class, 'update'])->name('users.update');
Route::post('update_minibio', [UserController::class, 'update_minibio'])->name('profiles.update-minibio');

//mob
Route::get('/profile/compte', [UserController::class, 'compte'])->name('profiles.mob.compte');



//Public Profile
Route::get('/profile/publicprofile/{id}', [UserController::class, 'publicprofile'])->name('profiles.publicprofile');



// Demandes routes
Route::get('/demandes', [DemandeController::class, 'index']);


////Testimonials
Route::get('/profile/testimonial', [UserController::class, 'testimonial'])->name('profiles.testimonial');

Route::get('/testimonial/create',[TestimonialController::class, 'create'])->name('testimonial.create');
Route::post('/testimonial/store',[TestimonialController::class, 'store'])->name('testimonial.store');
Route::get('/testimonial/index',[TestimonialController::class, 'index'])->name('testimonial.index');
Route::get('/testimonial/index-popup',[TestimonialController::class, 'indexpopup'])->name('testimonial.index-popup');

Route::get('/profile/review', [TestimonialController::class, 'review'])->name('profiles.reviews');



////Teacher - Coach
Route::get('/coach', [CoachController::class, 'search'])->name('searchcoach');
Route::post('/coach/list', [CoachController::class, 'list'])->name('coachlist');
Route::post('/coach/apply', [CoachController::class, 'apply'])->name('apply.coach');
Route::post('/coach/reapply', [CoachController::class, 'reapply'])->name('reapply.coach');



//// Conversations routes
Route::get('/conversations', [ConversationController::class, 'messagelist'])->middleware('cache.headers:private,max-age=60;etag')->name('messagelist-conv');
Route::get('/conversation', [ConversationController::class, 'conversation'])->name('conversation');
Route::get('/closechat',[ConversationController::class, 'closechat'])->name('closechat');
Route::post('/sendmessage',[ConversationController::class, 'sendmessage'])->name('sendmessage');
Route::post('/searchconversation', [ConversationController::class, 'searchconversation'])->name('searchconversation');


//Comments routes
Route::post('messages/comments', [CommentController::class, 'addComment'])->name('add.comment');
Route::get('/comment/delete', [CommentController::class, 'delComment'])->name('del.comment');
Route::post('/comment/edit', [CommentController::class, 'editComment'])->name('edit.comment');
Route::get('/getcomments', [CommentController::class, 'getComments'])->name('getcomments');
Route::get('/getimages', [CommentController::class, 'getImages'])->name('getimages');


//Uploads routes
Route::post('messages/upload', [UploadController::class, 'fileUpload'])->name('file.upload');



//// Assistance routes
Route::post('assistance/apply/{id}',[AssistanceController::class, 'apply'])->name('assistance.apply');
Route::post('assistance/select/{message}', [AssistanceController::class, 'select'])->name('selectassistant');
Route::post('assistance/delete/{message}', [AssistanceController::class, 'deleteassistance'])->name('deleteassistance');
Route::post('assistance/noassistant/{message}', [AssistanceController::class, 'noassistant'])->name('noassistant');
Route::post('assistance/yesassistant/{message}', [AssistanceController::class, 'yesassistant'])->name('yesassistant');



////Stripe routes
Route::get('/payment', [PaymentController::class, 'index']);
Route::post('/charge', [PaymentController::class, 'charge'])->name('stripe.charge');
Route::post('/stripesave', [PaymentController::class, 'save'])->name('stripe.save');
Route::post('/stripetestpay', [PaymentController::class, 'testpay'])->name('stripe.testpay');

//Subscriptions routes
Route::get('/payment',[PaymentController::class, 'payment']);
Route::post('/subscribe',[PaymentController::class, 'subscribe']);




//// Route for cache clear
Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    //Artisan::call('backup:clean');
    return "CACHE CLEANED.";
});



//// Notification routes
Route::get('/bemycoach', [beMyCoach::class, 'toBroadcast'])->name('bemycoach');
Route::get('/readytocoach', [CoachController::class, 'readytocoach'])->name('readytocoach');
Route::post('/notcoach', [CoachController::class, 'notcoach'])->name('notcoach');

Route::get('/signaler', [TestimonialController::class, 'signaler'])->name('signaler');


//// Paint routes
Route::get('/paint',[PaintController::class, 'paint'])->name('paint');


//// Admin routes

Route::group( [ 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth'] ], function (){
    Route::get('/', [DashboardController::class, 'dashboard'])->name('admin.index');
    Route::get('/users', [DashboardController::class, 'users'])->name('admin.users');
    Route::get('/delusers', [DashboardController::class, 'delusers'])->name('admin.delusers');
    Route::get('/cleardb', [DashboardController::class, 'clearDB'])->name('admin.cleardb');
    Route::post('/setroleuser', [DashboardController::class, 'setroleuser'])->name('admin.setroleuser');
    Route::post('/setroleadmin', [DashboardController::class, 'setroleadmin'])->name('admin.setroleadmin');
    Route::post('/blockuser', [DashboardController::class, 'blockuser'])->name('admin.blockuser');
    Route::post('/unblockuser', [DashboardController::class, 'unblockuser'])->name('admin.unblockuser');

    Route::get('/chatmessages', [DashboardController::class, 'chatmessages'])->name('admin.chatmessages');
    Route::get('/chatcomments', [DashboardController::class, 'chatcomments'])->name('admin.chatcomments');

    Route::get('/adminconversations', [DashboardController::class, 'adminconversations'])->name('admin.conversations');

} );
