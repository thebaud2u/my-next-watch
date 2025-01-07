<div>
	<div class="flex flex-col lg:min-h-[600px]" x-data="{component:'',filename:''}">
		<div class="mt-4">
			<div id="anchor" class="relative overflow-hidden w-fit mx-auto flex flex-row font-semibold">
				<div class="absolute top-4 w-full border-t-2 border-opacity-50 border-mnw-blue"></div>
				@foreach($steps as $k => $step)
					<div class="flex-none order-1 z-10 w-8 h-8 {{ ($k > 0) ? 'ml-6' : '' }}">
						@if(($k + 1) == $active)
							<span class="block w-full h-full flex items-center justify-center border-2 rounded-full bg-mnw-lightblue border-mnw-blue text-mnw-blue">{{ $k + 1 }}</span>
						@elseif(($k + 1) > $active)
							<span class="block w-full h-full flex items-center justify-center border-2 rounded-full bg-gray-200 border-white text-gray-400">{{ $k + 1 }}</span>
						@else
							<button class="block w-full h-full flex items-center justify-center border-2 rounded-full bg-mnw-blue border-white text-white" wire:click="goto({{ $k + 1 }})">{{ $k + 1 }}</button>
						@endif
					</div>
				@endforeach
			</div>
		</div>

		{{-- Flash message --}}
		@if($errors->any() || Session::has('error') || Session::has('success') || Session::has('warning') || Session::has('info'))
			<div class="py-5 px-4 lg:px-6" x-data="{}" x-ref="alert">
				@include('components.front.home.alert-message')
			</div>
		@endif

		@if($active == 1)
			<div>
				<div>
					<div class="flex flex-row">
						<x-front.input-label for="contact_choice" :value="__('Request type')" />
						<span class="text-mnw-red block ml-1"> *</span>
					</div>

					<select name="contact_choice" wire:model="contact_choice" required class="text-gray-400 mt-1 border border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm flex w-full break-words">
						<option class="w-full inline-block break-words" value="">{{ __('Choose a request type') }}</option>
						<option class="w-full inline-block break-words" value="1">{{ __('I have a specific request to modify ads to do with customer service (non-updatable criterias)') }}</option>
						<option class="w-full inline-block break-words" value="8">{{ __('I wish to multi-broadcast my post') }}</option>
						<option class="w-full inline-block break-words" value="2">{{ __('I have a technical problem with the platform') }}</option>
						<option class="w-full inline-block break-words" value="4">{{ __('I want to report a CV or an ad or a company') }}</option>
						<option class="w-full inline-block break-words" value="5">{{ __('I am an advertiser') }}</option>
						<option class="w-full inline-block break-words" value="6">{{ __('I would like more information') }}</option>
						<option class="w-full inline-block break-words" value="9">{{ __('I wish to have my daily CV download limit expanded on the CVthèque') }}</option>
						<option class="w-full inline-block break-words" value="7">{{ __('Other request') }}</option>
					</select>

					@error('contact_choice')
						<span class="error text-danger-700">
							{{ $message }}
						</span>
					@enderror
				</div>

				<div class="flex flex-row justify-end mt-12">
					<x-front.primary-button :class="'ml-4'" wire:click="submitFirstStep()">
						{{ __('Continue') }}
					</x-front.primary-button>
				</div>
			</div>
		@elseif($active == 2)
			<div>
				<div class="grid gap-x-20 gap-y-10 grid-cols-1 mt-5">
					<div>
						<x-front.input-label for="firstname" :value="__('Firstname')" :required="true" />

						<x-front.text-input type="text" id="firstname" name="firstname" wire:model="firstname" required :class="'mt-1 block w-full'" />

						@error('firstname')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<x-front.input-label for="lastname" :value="__('Lastname')" :required="true" />

						<x-front.text-input type="text" id="lastname" name="lastname" wire:model="lastname" required :class="'mt-1 block w-full'" />

						@error('lastname')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						<x-front.input-label for="phone" :value="__('Phone number')" :required="true" />

						<x-front.text-input type="text" id="phone" name="phone" wire:model="phone" required :class="'mt-1 block w-full'" />

						@error('phone')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					<div>
						@if($contact_choice == 5 || $contact_choice == 6 || $contact_choice == 7)
							<x-front.input-label for="email" :value="__('Email address')" :required="true" />
						@else
							<x-front.input-label for="email" :value="__('Email address of your :siteName account', ['siteName' => env('APP_NAME')])" :required="true" />
						@endif

						<x-front.text-input type="email" id="email" name="email" wire:model="email" required :class="'mt-1 block w-full'" />

						@error('email')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>

					@if($contact_choice == 4)
						<div>
							<x-front.input-label for="body" :value="__('Report type')" :required="true" />

							<div class="pr-5">
								<input type="radio" name="type_report" checked wire:model="type_report" value="recruteur" class="disabled:bg-gray-200 mr-2 checked:bg-vj-cyan checked:hover:bg-vj-cyan checked:active:bg-vj-cyan checked:focus:bg-vj-cyan focus:bg-vj-cyan focus:outline-none focus:ring-1 focus:ring-vj-cyan">
								<label for="offer_id">
									{{ __('A registered') }}
								</label>
							</div>

							<div class="pr-5">
								<input type="radio" name="type_report" wire:model="type_report" value="entreprise" class="disabled:bg-gray-200 mr-2 checked:bg-vj-cyan checked:hover:bg-vj-cyan checked:active:bg-vj-cyan checked:focus:bg-vj-cyan focus:bg-vj-cyan focus:outline-none focus:ring-1 focus:ring-vj-cyan">
								<label for="type_report">
									{{ __('A company') }}
								</label>
							</div>

							<div class="pr-5">
								<input type="radio" name="type_report" wire:model="type_report" value="annonce" class="disabled:bg-gray-200 mr-2 checked:bg-vj-cyan checked:hover:bg-vj-cyan checked:active:bg-vj-cyan checked:focus:bg-vj-cyan focus:bg-vj-cyan focus:outline-none focus:ring-1 focus:ring-vj-cyan">
								<label for="type_report">
									{{ __('A post') }}
								</label>
							</div>

							<div class="pr-5">
								<input type="radio" name="type_report" wire:model="type_report" value="candidat" class="disabled:bg-gray-200 mr-2 checked:bg-vj-cyan checked:hover:bg-vj-cyan checked:active:bg-vj-cyan checked:focus:bg-vj-cyan focus:bg-vj-cyan focus:outline-none focus:ring-1 focus:ring-vj-cyan">
								<label for="type_report">
									{{ __('An applicant') }}
								</label>
							</div>

							@error('type_report')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror
						</div>

						<div>
							<x-front.input-label for="reported" :value="__('Name of the person/ post/ company you wish to report')" :required="true" />

							<x-front.text-input type="text" id="reported" name="reported" wire:model="reported" required :class="'mt-1 block w-full'" />

							@error('reported')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror
						</div>
					@endif

					<div>
						@if($contact_choice == 1)
							<x-front.input-label for="body" :value="__('Please explain your post change request')" :required="true" />
						@elseif($contact_choice == 2)
							<x-front.input-label for="body" :value="__('Please explain your technical problem (with screenshots if possible)')" :required="true" />
						@elseif($contact_choice == 4)
							<x-front.input-label for="body" :value="__('Thank you to detail your report')" :required="true" />
						@elseif($contact_choice == 8)
							<x-front.input-label for="body" :value="__('Please specify which post you would like to broadcast')" :required="true" />
						@else
							<x-front.input-label for="body" :value="__('Please explain your request')" :required="true" />
						@endif

						<textarea name="body" wire:model.lazy="body" cols="30" rows="6" required class="border-gray-300 focus:border-mnw-blue focus:ring-mnw-blue rounded-md shadow-sm mt-1 block w-full text-gray-400"></textarea>

						@error('body')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror

						@if($contact_choice == 8)
							<div class="flex flex-row">
								<span class="text-sm text-gray-500">
									{{ __('Tell us for which geographical areas: city, department, region, country... Then close this window and normally publish your ad while waiting for the return of our customer service') }}
								</span>
							</div>
						@endif
					</div>

					@if($contact_choice == 2 || $contact_choice == 4)
						<div>
							<x-front.input-label for="file" :value="__('Attachment')" />

							<input type="file" id="file" name="file" wire:model="file" accept=".txt,.rtf,.pdf,.doc,.docx,.odt,.jpg,.jpeg,.png" class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-mnw-blue file:bg-mnw-blue hover:border-mnw-blue bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-mnw-blue file:px-3 file:py-[0.32rem] file:text-white file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-mnw-blue dark:file:bg-mnw-blue dark:file:text-neutral-100 dark:focus:border-primary" />

							@error('file')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror
						</div>
					@endif

					<div>
						<div class="flex flex-row" x-data="{checked: false}">
							<input type="checkbox" name="consent" value="true" x-model="checked" wire:model="consent" class="w-4 h-4 mt-2 text-mnw-blue bg-gray-100 border-gray-300 rounded focus:ring-0 focus:ring-offset-0 focus:outline-none cursor-pointer" />
							<x-front.input-label for="consent" x-on:click="checked = !checked" :value="__('By submitting this form, I accept that the information entered is used as part of the contact request')" :required="true" :class="'ml-2 cursor-pointer'"/>
						</div>

						<div class="flex flex-row">
							@error('consent')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror
						</div>
					</div>

					<div :class="'mt-2'">
						<x-front.input-label for="captcha" :value="__('Verification')" :required="true" />
						<div class="captcha my-2 flex flex-row items-end">
							<span>{!! $captcha_img !!}</span>

							<button type="button" id="reload" title="{{ __('Reload') }}" wire:click="refreshCaptcha" class="reload ml-4 text-gray-500 hover:text-mnw-blue">
								&#x21bb;
							</button>
						</div>

						<x-front.text-input id="captcha" name="captcha" wire:model="captcha" type="text" class="mt-1 block w-full s:w-1/2 lg:w-1/4" :value="''" required />

						@error('captcha')
							<span class="error text-danger-700">
								{{ $message }}
							</span>
						@enderror
					</div>
				</div>

				<div class="flex items-center justify-between mt-12">
					<x-front.secondary-button wire:click="back()">
						{{ __('Go back') }}
					</x-front.secondary-button>

					<x-front.primary-button wire:click="submitSecondStep()">
						{{ __('Send') }}
					</x-front.primary-button>
				</div>
			</div>
		@endif
	</div>
</div>
