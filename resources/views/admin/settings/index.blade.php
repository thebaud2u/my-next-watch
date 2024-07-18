@extends('admin.layouts.app')

@section('body')
	@include('admin.partials.messages')

	<h1 class="text-gray-700 text-3xl font-medium">{{ __('Settings') }}</h1>

	<div class="container mt-4">
		<div x-data="{ tab: 'tab1' }">
			<div class="mb-4 border-b border-gray-200 dark:border-gray-700">
				<ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#settingsTabs" role="tablist">
					<li class="mr-2" role="presentation">
						<button @click.prevent="tab = 'tab1'" class="inline-block p-4 border-b-2 rounded-t-lg" :class="{ 'text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-500 border-blue-600 dark:border-blue-500': tab == 'tab1'}" id="general-tab" data-tabs-target="#general" type="button" role="tab" aria-controls="general">
							{{ __('General settings') }}
						</button>
					</li>
				</ul>
			</div>

			<div id="settingsTabs">
				<div x-show="tab == 'tab1'" class="p-4 rounded-lg bg-white dark:bg-gray-800" id="general" role="tabpanel" aria-labelledby="faqs-tab">
					<livewire:admin.settings.general />
				</div>
			</div>
		</div>
	</div>
@endsection
