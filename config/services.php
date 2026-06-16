<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Mailgun, Postmark, AWS and more. This file provides the de facto
	| location for this type of information, allowing packages to have
	| a conventional file to locate the various service credentials.
	|
	*/

	'mailgun' => [
		'domain' => env('MAILGUN_DOMAIN'),
		'secret' => env('MAILGUN_SECRET'),
		'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
		'scheme' => 'https',
	],

	'postmark' => [
		'token' => env('POSTMARK_TOKEN'),
	],

	'ses' => [
		'key' => env('AWS_ACCESS_KEY_ID'),
		'secret' => env('AWS_SECRET_ACCESS_KEY'),
		'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
	],

	'azure' => [
		'client_id' => env('AZURE_CLIENT_ID', ''),
		'client_secret' => env('AZURE_CLIENT_SECRET', ''),
		'redirect' => env('AZURE_REDIRECT_URI', ''),
		'tenant' => env('AZURE_TENANT_ID', ''),
		//'proxy' => env('PROXY', '')  // optionally
	],

	'sso' => [
		'client_id' => env('SSO_CLIENT_ID', ''),
		'client_secret' => hash('sha256', str_pad(env('SSO_CLIENT_SECRET', ''), 64)),
		'redirect' => env('SSO_REDIRECT', ''),
	],
	'brevo' => [
		'key' => env('BREVO_KEY'),
	],
	'stripe' => [
		'secret' => env('STRIPE_SECRET'),
		'webhook_secret' => env('STRIPE_WEBHOOK_SECRET'),
	],
	'figo' => [
		'funnel_token' => env('FIGO_FUNNEL_TOKEN'),
		'funnel_encryption_key' => env('FIGO_ENCRYPTION_KEY'),
		'funnel_encryption_debug_key' => env('FIGO_ENCRYPTION_DEBUG_KEY'),
	],
	'breeder-gpt' => [
		'token' => env('BREEDER_GPT_TOKEN'),
	],
];
