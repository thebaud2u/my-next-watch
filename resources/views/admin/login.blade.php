@extends('admin.layouts.app')

@section('body')
	<div class="flex flex-col items-center">
		<h1 class="text-gray-700 text-3xl font-medium">{{ __('Login') }}</h1>

		<form id="login-form" action="{{ route('admin.authenticate') }}" method="POST">
			<div class="grid gap-x-20 gap-y-5 grid-cols-1 mt-5 ">

				@csrf

				<div>
					<x-input-label for="email" :value="__('Email')" :required="true" />

					<x-text-input type="text" id="email" name="email" required :class="'mt-1 block'" />
				</div>

				<div>
					<x-input-label for="password" :value="__('Password')" :required="true" />

					<x-text-input type="password" id="password" name="password" required :class="'mt-1 block'" />
				</div>

				<div>
					<x-primary-button>
						{{ __('Connect') }}
					</x-primary-button>
				</div>
			</div>
		</form>
	</div>
@endsection
