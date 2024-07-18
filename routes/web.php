<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ { TempController, UploadController };
use App\Http\Controllers\Auth\RegisteredUserController;
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
Route::controller(App\Http\Controllers\Front\Posts\PostController::class)->group(function () {
	Route::get('/posts/{thematic:slug?}/{postType:slug?}/{search:uuid?}', 'index')->name('posts');
	Route::get('/post/{post:slug}', 'show')->name('show-post');

	Route::middleware(['auth:web'])->group(function () {
		Route::put('/post/{post:slug}/contact', 'contact')->name('contact-announcer');
	});
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
	Route::controller(RegisteredUserController::class)->group(function () {
		Route::get('/sso/redirect', 'ssoRedirect')->name('login'); // SSO redirect
		Route::get('/sso/callback', 'ssoCallback'); // SSO callback
	});
});

Route::get('/register', [RegisteredUserController::class, 'registerRole'])->name('register.role');

Route::middleware(['auth:web'])->group(function () {
	Route::post('logout', [RegisteredUserController::class, 'logout'])->name('logout'); // Full logout (app + SSO)

	Route::controller(RegisteredUserController::class)->name('register.role.')->group(function () { // 'register.role.*'
		Route::get('/register/role', 'registerRole')->name('registered');
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
	// Authentification auto (user)
	Route::get('/login/{user}', function(User $user) {
		Auth::login($user);
		activity('user')
			->performedOn($user)
			->causedBy($user)
			->event('login')
			->log('User #:subject.id (:subject.email) logged in');
		return redirect()->route('home');
	})->name('login.user');

	// Authentification auto au B.O. (admin)
	Route::get('/adminlogin/{admin}', function(\App\Models\Admin $admin) {
		Auth::guard('admin')->login($admin);
		activity('admin')
			->performedOn($admin)
			->causedBy($admin)
			->event('login')
			->log('Admin #:subject.id (:subject.email) logged in');
		return redirect()->route('admin.dashboard');
	});

	Route::controller(TempController::class)->group(function () {
		Route::get('/test', 'test');
	});
}

Route::controller(TempController::class)->group(function () {
	Route::get('/script/{code}', 'script');
});

/** Tarifs (S-Boutik data) */
Route::controller(CmsContentController::class)->prefix('/rates')->name('rates.')->group(function () {
	/** compositionId (par défaut, 26 : tous les tarifs)
	 *  27 : Annonces
	 *  28 : Témathèques
	 *  29 : Pages entreprises
	 */
	/** @todo  Autres contenus Drupal, mise en cache, gestion de la synchronisation... */
	Route::get('/{compositionId?}', 'rates')->name('index');
});
Route::get('/ratesraw/{compositionId?}', [CmsContentController::class, 'ratesRaw'])->name('rates.raw'); // (Temp)

/** Set cookie (S-Boutik) */
Route::get('/sboutik/setcookie', [CmsContentController::class, 'setcookie']);
