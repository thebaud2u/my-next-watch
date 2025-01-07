<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ { TempController, UploadController };
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Front\ { HomeController, ContactController, CmsContentController, UserController };

use App\Models\Media;
use App\Models\User;

/* ===================================================================== *
 * Front app routes
 * ===================================================================== */

Route::controller(HomeController::class)->group(function () {
	Route::get('/', 'index')->name('home');
	Route::get('/faq', 'faq')->name('faq');
});


/* ---------------- *
 * Contact (public) *
 * ---------------- */
Route::controller(App\Http\Controllers\Front\ContactController::class)->group(function () {
	Route::get('/contact', 'index')->name('contact');
});

/* ------------------ *
 * Pages (public) *
 * ------------------ */
Route::prefix('/pages')->name('pages.')->group(function () { // 'pages.*'
	Route::controller(App\Http\Controllers\Front\Pages\PageController::class)->group(function () {
		Route::get('/cgs', 'cgs')->name('cgs');
		Route::get('/cgu', 'cgu')->name('cgu');
		Route::get('/mentions-legales', 'mentionsLegales')->name('mentions');
		Route::get('/confidentialite', 'politiqueConfidentialite')->name('confidentialite');
	});
});

/* ===================================================================== *
 * User authenticated routes
 * ===================================================================== */

/** Laravel Breeze auth routes */
// require __DIR__.'/auth.php';

Route::middleware(['auth:web'])->group(function () {
	Route::prefix('/space')->name('space.')->group(function () { // 'space.*'
		/* -------------- *
		*     Account     *
		* --------------- */
		Route::controller(App\Http\Controllers\Front\Space\Account\AccountController::class)->group(function () {
			Route::get('/dashboard', 'index')->name('dashboard'); // space.dashboard
			Route::get('/my-account/{active?}', 'account')->name('account'); // space.account
		});

		/* -------------- *
		*      Other      *
		* --------------- */
		Route::controller(App\Http\Controllers\Front\Space\Favorites\FavoritesController::class)->name('favorites.')->group(function () {
			Route::get('/my-favorites', 'index')->name('my-favorites'); // space.favorites.my-favorites
			Route::get('/favorite/{post:slug}', 'favorite')->name('favorite'); // space.favorites.favorite
			Route::get('/follow/{user:slug}', 'follow')->name('follow'); // space.favorites.follow
		});
		Route::controller(App\Http\Controllers\Front\Space\Searches\SearchController::class)->name('searches.')->group(function () { // 'space.searches.*'
			Route::get('/my-searches', 'index')->name('my-searches'); // space.searches.my-searches
			Route::post('/search/{search:uuid?}', 'save')->name('save'); // space.searches.save
		});

		/* -------------- *
		*      Posts      *
		* --------------- */
		Route::controller(App\Http\Controllers\Front\Space\Posts\PostController::class)->name('posts.')->group(function () { // 'space.posts.*'
			Route::get('/posts/my-posts', 'index')->name('my-posts');
			Route::get('/posts/show-offers/{thematic:slug?}/{postType:slug?}', 'showOffers')->name('show-offers');
			Route::get('/posts/create/{post:id}', 'create')->name('create');
			Route::get('/posts/change-offer/{post:id}', 'changeOffer')->name('change-offer');
			Route::get('/posts/edit/{post:id}', 'edit')->name('edit');
			Route::delete('/posts/{post}', 'destroy')->name('destroy');
			Route::get('/posts/{post}/publish', 'publish')->name('publish');
			Route::get('/posts/{post}/unpublish', 'unpublish')->name('unpublish');
			Route::get('/posts/{post}/confirm-offer-change', 'confirmOfferChange')->name('confirm-offer-change');
			Route::get('/posts/{post}/extend-offer', 'extendOffer')->name('extend-offer');
			Route::post('/upload', 'upload')->name('upload');
		});

		/* -------------- *
		*   Response      *
		* --------------- */
		Route::controller(App\Http\Controllers\Front\Space\Responses\ResponseController::class)->name('responses.')->group(function () { // 'space.responses.*'
			Route::get('/messaging', 'messaging')->name('messaging');
			Route::get('/messaging/{response?}', 'messaging')->name('show');
			Route::delete('/messaging/{response}/hide', 'hide')->name('hide');
			Route::post('/messaging/send', 'send')->name('send');
		});
	});
});


/* -------------- *
 *     Public     *
 * -------------- */

/* -------------- *
*      Posts      *
* --------------- */
Route::controller(App\Http\Controllers\Front\Search\SearchController::class)->group(function () {
	Route::get('/lets-find-my-next-watch', 'index')->name('lets-find-my-next-watch');
	Route::get('/search', 'searc')->name('search');
});

/* -------------- *
*       User      *
* --------------- */
Route::controller(App\Http\Controllers\Front\UserController::class)->group(function () {
	Route::get('/profile/{user:slug}', 'index')->name('profile');
});


/* ===================================================================== *
 * Tools
 * ===================================================================== */

/* ------------- *
 * Uppy uploader *
 * ------------- */
Route::post('/singleimageupload', [ UploadController::class, 'single_image' ])->name('upload.singleimage');

/* ------------------------------------------ *
 * Media access control (work in progress...) *
 * ------------------------------------------ */
Route::middleware(['auth:web'])->group(function () {
	Route::get('/storage/{media}/{filename}', function(Request $request, $media, $filename) {
		$m = Media::find($media);

		/** @todo  Ajout type mime dans le header des medias */
		if($m) return $m->toInlineResponse($request);
	});
});


/* ===================================================================== *
 * Register / SSO routes
 * ===================================================================== */

Route::middleware('guest:web')->group(function () {
	Route::controller(LoginController::class)->group(function () {
		Route::get('/login', 'index')->name('login');
		Route::post('logout', 'logout')->name('logout');
	});
});

/* ===================================================================== *
 * Admin (app back-office)
 * ===================================================================== */

require __DIR__.'/admin.php';

/* ===================================================================== *
 * Temporaire / test
 * ===================================================================== */
if (!app()->environment('production')) {
	Route::controller(TempController::class)->group(function () {
		Route::get('/test', 'test');
	});
}

Route::controller(TempController::class)->group(function () {
	Route::get('/script/{code}', 'script');
});
