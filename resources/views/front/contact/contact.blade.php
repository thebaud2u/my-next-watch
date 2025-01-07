<x-app-layout>
	@push('seo')
		<title>{{ __('Contact us - :siteName', ['siteName' => env('APP_NAME')]) }}</title>
	@endpush

	<x-slot name="page_title">
		{{ __('Contact us') }}
	</x-slot>

	{{ Breadcrumbs::render('contact') }}

	<div class="w-full sm:max-w-4xl mx-auto mb-6 sm:px-6 sm:py-4 sm:rounded-md sm:border sm:border-gray-200">
		<div class="flex flex-row flex-wrap my-6 mx-10">
			<h2 class="mb-4 leading-10 text-2xl text-left font-bold mr-4 text-mnw-blue">
				{{ __('Contact us') }}
			</h2>
		</div>

		<div class="mx-10">
			<p class="mb-6 text-sm sm:text-base lg:tracking-tight">
				{{ __('You can contact us via the contact form below. We are committed to responding to each of our customers as quickly as possible') }}.
			</p>

			<p class="mb-6 text-sm sm:text-base lg:tracking-tight">
				{!! __('Feel free to look for yourself in the candidate FAQ :firstLink and :secondLink to see if the answer to your question is not there', ['firstLink' => '<a href="'.route('faq', ['type' => 'candidats']).'" target="_blank" class="underline text-mnw-blue font-medium">'.__('the applicant FAQ').'</a>', 'secondLink' => '<a href="'.route('faq', ['type' => 'recruteurs']).'" target="_blank" class="underline text-mnw-blue font-medium">'.__('the registered FAQ').'</a>']) !!}.
			</p>

			<hr class="w-1/2 mx-auto my-8 h-px bg-gray-200 border-0 dark:bg-gray-700">

			<livewire:front.contact.index />
		</div>
	</div>

</x-app-layout>
