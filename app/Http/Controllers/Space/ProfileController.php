<?php

namespace App\Http\Controllers\Front\Space\Profile;

use App\Http\Controllers\Controller;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password;

use App\Models\{Offer, User};

use App\Services\StripeService;

class ProfileController extends Controller
{
	/**
	 * Display dashboard page
	 *
	 * @return \Illuminate\View\View
	 */
	public function dashboard()
	{
		$user = Auth::guard('web')->user();

		if($user->hasRole(['adopter', 'breeder', 'professionnal_breeder', 'individual_breeder'])) {
			$profileCompletionPercentage = $user->profileCompletionPercentage();
			$offer = null;
		}
		else {
			$profileCompletionPercentage = null;
			$offer = Offer::findBySlug('annuaire-produits-et-services');
		}

		return view('front.space.profile.dashboard', compact('user', 'profileCompletionPercentage', 'offer'));
	}

	/**
	 * Display the profile page
	 *
	 * @return \Illuminate\View\View
	 */
	public function myProfile()
	{
		$user = Auth::guard('web')->user();
		return view('front.space.profile.my-profile', compact('user'));
	}

	/**
	 * Display the profile completion tunnel
	 *
	 * @return \Illuminate\View\View
	 */
	public function completeMyProfile($setActiveStep = null)
	{
		return view('front.space.profile.complete-my-profile', compact('setActiveStep'));
	}

	public function myOrders()
	{
		$orders = new Collection();
		$user = Auth::guard('web')->user();
		$stripe = new StripeService;

		$allCheckoutSessions = $stripe->retrieveCheckoutSessionsFromUser($user);

		if(!empty($allCheckoutSessions->data)) {
			$order = [];

			foreach($allCheckoutSessions->data as $index => $checkoutSession) {
				if($checkoutSession->payment_intent) {
					$paymentIntent = $stripe->retrievePaymentIntent($checkoutSession->payment_intent);

					if($paymentIntent->payment_method) {
						$paymentMethod = $stripe->retrievePaymentMethod($paymentIntent->payment_method);

						$invoice = $stripe->retrieveInvoiceFromCheckoutSession($checkoutSession->id);

						$order = [
							'created_at' => Carbon::createFromTimestamp($checkoutSession->created),
							'payment_method' => $paymentMethod->type,
							'payment_status' => $paymentIntent->status,
							'invoice' => $invoice,
						];

						$lineItems = $stripe->retrieveLineItemsFromCheckoutSession($checkoutSession->id);

						if(!empty($lineItems->data)) {
							foreach($lineItems->data as $lineItem) {
								$order['product'] = $lineItem->description;
								$order['price'] = $lineItem->amount_subtotal/100;
							}
						}

						$orders->push($order);
					}
				}
			}
		}

		return view('front.space.profile.my-orders', compact('orders'));
	}

	/**
	 * Display the settings page
	 *
	 * @return \Illuminate\View\View
	 */
	public function settings()
	{
		$user = Auth::guard('web')->user();

		return view('front.space.profile.settings', compact('user'));
	}

	/**
	 * Display the change password page
	 *
	 * @return \Illuminate\View\View
	 */
	public function changePassword()
	{
		return view('front.space.profile.change-password');
	}

	/**
	 * Update the new password
	 */
	public function updatePassword(Request $request): RedirectResponse
	{
		$rules = [
			'current_password' => ['required', 'current_password'],
			'new_password' => ['required', 'confirmed', Password::min(8)->mixedCase()->letters()->numbers()->symbols()->uncompromised()]
		];

		$messages = [
			'current_password.required' => __(':element is mandatory', ['element' => __('The current password')]),
			'current_password.current_password' => __('Current password is incorrect'),
			'new_password.required' => __(':element is mandatory', ['element' => __('The new password')]),
			'new_password.confirmed' => __('Both password don\'t match'),
			'new_password.min' => __('The password must contain at least :min characters', ['min' => 8])
		];

		$request->validate($rules, $messages);

		Auth::guard('web')->user()->update([
			'password' =>  Hash::make($request->new_password)
		]);

		return redirect(route('space.profile.settings', absolute: false))->with('success', __('Password updated successfully'));
	}

	/**
	 * Delete the account
	 */
	public function deleteAccount(Request $request): RedirectResponse
	{
		$rules = [
			'current_password' => ['required', 'current_password']
		];

		$messages = [
			'current_password.required' => __(':element is mandatory', ['element' => __('The current password')]),
			'current_password.current_password' => __('Current password is incorrect')
		];

		$request->validate($rules, $messages);

		$user = Auth::guard('web')->user();

		Auth::guard('web')->logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();

		$user->delete();

		return redirect()->route('home')->with('success', __('Your account has been successfully deleted'));
	}

	public function myNotifications()
	{
		return view('front.space.profile.my-notifications');
	}
}
