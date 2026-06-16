<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Carbon;

use App\Models\Contact;

class ContactController extends Controller
{
	public function index(): View
	{
		return view('front.contact');
	}

	public function submit(Request $request): RedirectResponse
	{
		$rules = [
			'object' => ['required'],
			'firstname' => ['required'],
			'lastname' => ['required'],
			'phone' => ['required', 'phone:BE,FR'],
			'email' => ['required', 'email'],
			'message' => ['required'],
			'file' => ['nullable', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png', 'max:12288'],
			'consent' => ['required'],
			'captcha' => ['required', 'captcha']
		];

		$messages = [
			'object.required' => __('Select an object'),
			'firstname.required' => __(':element is mandatory', ['element' => __('Your firstname')]),
			'lastname.required' => __(':element is mandatory', ['element' => __('Your firstname')]),
			'phone.required' => __(':element is mandatory', ['element' => __('Your phone number')]),
			'phone.phone' => __('Your phone number format is invalid'),
			'email.required' => __(':element is mandatory', ['element' => __('Your email')]),
			'email.email' => __(':element is expected', ['element' => __('An email')]),
			'message.required' => __(':element is mandatory', ['element' => __('The details of your request')]),
			'file.file' => __(':element is expected', ['element' => __('A file')]),
			'file.mimes' => __(':element of the following format is expected : :format', ['element' => __('A file'), 'format' => 'pdf, doc, docx, jpg, jpeg, png']),
			'file.max' => __(':size maximum', ['size' => '12mo']),
			'consent.required' => __('You must accept the conditions'),
			'captcha.required' => __(':element is mandatory', ['element' => __('The captcha')])
		];

		$this->validate($request, $rules, $messages);

		$newContact = new Contact;
		$newContact->object = $request->object;
		$newContact->firstname = $request->firstname;
		$newContact->lastname = $request->lastname;
		$newContact->email = $request->email;
		$newContact->phone = $request->phone;
		$newContact->message = $request->message;

		if($request->file) $newContact->file = $request->file->store('contact', 'public');

		$newContact->save();

		return redirect()->route('home')->with('success', __('Your request has been sent, thank you for contacting us'));
	}
}
