@extends('admin.layouts.app')

@section('body')
	<h1 class="text-gray-700 text-3xl font-medium mb-4">
		{{ __('Moderation') }}
	</h1>

	<div class="flex flex-row justify-end">
		<x-admin.moderations.history :moderation="$moderation" :smallButton="false" :history="$moderation->model->moderations" />
	</div>

	<div class="space-y-8">
		@include('components.admin.moderations.'.$type.'-form')
	
		<div class="w-full bg-white shadow-[0_0_20px_0_rgba(0,44,106,0.2)] px-6 py-10 mb-6 rounded-md">
			<div class="flex s:flex-row flex-col items-center max-s:space-y-5 justify-end mt-10">
				<x-front.secondary-button x-on:click.prevent="$dispatch('open-modal', 'deny-moderation');" class="mr-4">
					{{ __('Deny') }}
				</x-front.secondary-button>

				<form method="POST" action="{{ route('admin.moderations.decision') }}">
					@csrf

					<input type="hidden" name="moderation_id" value="{{ $moderation->id }}" />
					<input type="hidden" name="decision" value="validated" />

					<x-front.primary-button>
						{{ __('Validate') }}
					</x-front.primary-button>
				</form>
			</div>
		</div>
	</div>

	<x-front.modal name="deny-moderation" :class="'w-full max-w-2xl'" focusable>
		<form method="POST" action="{{ route('admin.moderations.decision') }}" x-data="moderationForm()">
			@csrf

			<input type="hidden" name="moderation_id" value="{{ $moderation->id }}" />
			<input type="hidden" name="decision" value="denied" />
				
			<section class="p-10 flex flex-col content-center gap-y-4">
				<div>
					<div class="flex flex-row">
						<x-front.input-label for="reason" :value="__('Reason')" />
					</div>

					<select id="reason" name="reason" x-model="selectedReason" @change="updateDescription()" class="border-gray-300 focus:border-jobboard-deepblue focus:ring-jobboard-deepblue rounded-md shadow-sm text-jobboard-deepblue placeholder:text-gray-400 mt-1 text-gray-400">
						@foreach($reasons as $value => $reason)
							<option value="{{ $value }}">{{ $reason['Title'] }}</option>
						@endforeach
					</select>
				</div>

				<div>
					<div class="flex flex-row">
						<x-front.input-label for="description" :value="__('Description')" />
					</div>

					<textarea id="description" name="description" x-model="description" placeholder="{{ __('Description') }}" class="border-gray-300 focus:border-primary-500 focus:ring-primary-500 rounded-md shadow-sm mt-1 block w-full text-gray-400"></textarea>
				</div>

				<div class="flex s:flex-row flex-col items-center max-s:space-y-5 justify-end mt-10">
					<x-front.secondary-button x-on:click.prevent="$dispatch('close');" class="mr-4">
						{{ __('Cancel') }}
					</x-front.secondary-button>

					<x-front.primary-button>
						{{ __('Deny') }}
					</x-front.primary-button>
				</div>
			</section>
		</form>

		<script>
			function moderationForm() {
				return {
					selectedReason: '',
					description: '',
					reasons: {!! json_encode($reasons) !!},

					updateDescription() {
						if(this.selectedReason && this.reasons[this.selectedReason]['Description']) this.description = this.reasons[this.selectedReason]['Description'];
						else this.description = '';
					}
				}
			}
		</script>
	</x-front.modal>
@endsection
