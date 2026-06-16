@extends('admin.layouts.app')

@section('body')
	<h1 class="text-gray-700 text-3xl font-medium mb-4">
		{{ __('Faqs') }}
	</h1>

	<div class="container mt-4">
		<div x-data="{ tab: 'tab1' }">
			<div class="mb-4 border-b border-gray-200 dark:border-gray-700">
				<ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
					<li class="mr-2" role="presentation">
						<button @click.prevent="tab = 'tab1'" id="faqs-tab" data-tabs-target="#faqs" type="button" role="tab" aria-controls="faqs" class="inline-block p-4 border-b-2 rounded-t-lg" :class="{ 'text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-500 border-blue-600 dark:border-blue-500': tab == 'tab1'}">
							{{ __('Faqs') }}
						</button>
					</li>

					<li class="mr-2" role="presentation">
						<button @click.prevent="tab = 'tab2'" id="faq-rubriques-tab" data-tabs-target="#faq-rubriques" type="button" role="tab" aria-controls="faq-rubriques" class="inline-block p-4 border-b-2 rounded-t-lg" :class="{ 'text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-500 border-blue-600 dark:border-blue-500': tab == 'tab2'}">
							{{ __('Faq rubriques') }}
						</button>
					</li>

					<li class="mr-2" role="presentation">
						<button @click.prevent="tab = 'tab3'" id="faq-questions-tab" data-tabs-target="#faq-questions" type="button" role="tab" aria-controls="faq-questions" class="inline-block p-4 border-b-2 rounded-t-lg" :class="{ 'text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-500 border-blue-600 dark:border-blue-500': tab == 'tab2'}">
							{{ __('Faq questions') }}
						</button>
					</li>
				</ul>
			</div>

			<div id="myTabContent">
				<div x-show="tab == 'tab1'" class="p-4 rounded-lg bg-white dark:bg-gray-800" id="faqs" role="tabpanel" aria-labelledby="faqs-tab">
					<livewire:admin.faqs.faqs />
				</div>

				<div x-show="tab == 'tab2'" class="p-4 rounded-lg bg-white dark:bg-gray-800" id="faq-rubriques" role="tabpanel" aria-labelledby="faq-rubriques-tab">
					<livewire:admin.faqs.faq-rubriques />
				</div>

				<div x-show="tab == 'tab3'" class="p-4 rounded-lg bg-white dark:bg-gray-800" id="faq-questions" role="tabpanel" aria-labelledby="faq-questions-tab">
					<livewire:admin.faqs.faq-questions />
				</div>
			</div>
		</div>
	</div>
@endsection
