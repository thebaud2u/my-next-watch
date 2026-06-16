<div class="min-h-screen">
	@if($user->hasRole('applicant'))
		<div class="bg-jobboard-cream w-full flex flex-col justify-center items-center gap-y-4 s:gap-y-12 h-[174px] s:h-[261px] text-jobboard-deepblue">
			<h2 class="text-[25px] sm:text-[30px] lg:text-[40px] font-bold text-center mt-4 lg:mt-8">
				{{ __('Complete my profile') }}
			</h2>

			<div id="anchor" class="flex justify-between items-center font-bold w-[323px] s:w-[438px]">
				@for ($i = 1; $i <= $totalSteps; $i++)
					@if($i == 1)
						<div class="flex flex-col items-center gap-y-4 w-[108px] cursor-pointer" wire:click="goto(1)">
							@if($active == 1)
								<svg class="w-[54px] sm:w-[62px]" viewBox="0 0 62 70" fill="none" xmlns="http://www.w3.org/2000/svg" class="z-10">
									<path d="M27.8203 1.8457C29.6627 0.788427 31.9124 0.722349 33.8057 1.64746L34.1797 1.8457L34.1807 1.84668L57.3193 15.0781V15.0869L57.8252 15.375C59.7941 16.4957 61 18.5748 61 20.8164V47.8496C61 49.9485 59.9358 51.9038 58.1816 53.0703L57.8232 53.292L34.1807 66.8125L34.1797 66.8135C32.3373 67.8708 30.0876 67.9368 28.1943 67.0117L27.8203 66.8135L27.8193 66.8125L4.17676 53.292L4.1748 53.291L3.81543 53.0703C2.06023 51.9104 1 49.9514 1 47.8496V20.8096C1 18.5708 2.21118 16.4953 4.17871 15.3662L4.17773 15.3652L27.8193 1.84668L27.8203 1.8457Z" stroke="#0E1954" stroke-width="2"/>
									<path d="M28.0796 27.08V24.756H33.3436V45H30.7676V27.08H28.0796Z" fill="#0E1954"/>
								</svg>
							@else
								<svg class="w-[54px] sm:w-[62px]" viewBox="0 0 62 70" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M27.8203 1.8457C29.6627 0.788427 31.9124 0.722349 33.8057 1.64746L34.1797 1.8457L34.1807 1.84668L57.3193 15.0781V15.0869L57.8252 15.375C59.7941 16.4957 61 18.5748 61 20.8164V47.8496C61 49.9485 59.9358 51.9038 58.1816 53.0703L57.8232 53.292L34.1807 66.8125L34.1797 66.8135C32.3373 67.8708 30.0876 67.9368 28.1943 67.0117L27.8203 66.8135L27.8193 66.8125L4.17676 53.292L4.1748 53.291L3.81543 53.0703C2.06023 51.9104 1 49.9514 1 47.8496V20.8096C1 18.5708 2.21118 16.4953 4.17871 15.3662L4.17773 15.3652L27.8193 1.84668L27.8203 1.8457Z" stroke="#0E1954" stroke-width="2"/>
									<path d="M36.2391 24.5814C34.6609 23.7822 32.8787 23.3333 31 23.3333C24.4725 23.3333 19.1904 28.7199 19.1904 35.3764C19.1904 42.0329 24.4725 47.4194 31 47.4194C37.5274 47.4194 42.8095 42.0329 42.8095 35.3764C42.8095 33.8327 42.5196 32.3547 42.0043 30.9971M25.632 35.3764L29.9264 39.7556L42.8095 23.3333" stroke="#0E1954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							@endif

							{{ __('My project') }}
						</div>
					@else
						<div class="flex flex-col items-center gap-y-4 w-[108px] @if($active != 2) text-jobboard-greige @else text-jobboard-deepblue cursor-pointer @endif">
							<svg class="w-[54px] sm:w-[62px]" viewBox="0 0 62 70" fill="none" xmlns="http://www.w3.org/2000/svg" class="z-10">
								<path d="M27.8203 1.8457C29.6627 0.788427 31.9124 0.722349 33.8057 1.64746L34.1797 1.8457L34.1807 1.84668L57.3193 15.0781V15.0869L57.8252 15.375C59.7941 16.4957 61 18.5748 61 20.8164V47.8496C61 49.9485 59.9358 51.9038 58.1816 53.0703L57.8232 53.292L34.1807 66.8125L34.1797 66.8135C32.3373 67.8708 30.0876 67.9368 28.1943 67.0117L27.8203 66.8135L27.8193 66.8125L4.17676 53.292L4.1748 53.291L3.81543 53.0703C2.06023 51.9104 1 49.9514 1 47.8496V20.8096C1 18.5708 2.21118 16.4953 4.17871 15.3662L4.17773 15.3652L27.8193 1.84668L27.8203 1.8457Z" stroke="currentColor" stroke-width="2"/>
								<path d="M24.9359 29.852C25.0665 28.1347 25.7292 26.7907 26.9239 25.82C28.1185 24.8493 29.6679 24.364 31.5719 24.364C32.8412 24.364 33.9332 24.5973 34.8479 25.064C35.7812 25.512 36.4812 26.128 36.9479 26.912C37.4332 27.696 37.6759 28.5827 37.6759 29.572C37.6759 30.7293 37.3399 31.728 36.6679 32.568C36.0145 33.408 35.1559 33.9493 34.0919 34.192V34.332C35.3052 34.6307 36.2665 35.2187 36.9759 36.096C37.6852 36.9733 38.0399 38.1213 38.0399 39.54C38.0399 40.604 37.7972 41.5653 37.3119 42.424C36.8265 43.264 36.0985 43.9267 35.1279 44.412C34.1572 44.8973 32.9905 45.14 31.6279 45.14C29.6492 45.14 28.0252 44.6267 26.7559 43.6C25.4865 42.5547 24.7772 41.08 24.6279 39.176H27.0919C27.2225 40.296 27.6799 41.2107 28.4639 41.92C29.2479 42.6293 30.2932 42.984 31.5999 42.984C32.9065 42.984 33.8959 42.648 34.5679 41.976C35.2585 41.2853 35.6039 40.3987 35.6039 39.316C35.6039 37.916 35.1372 36.908 34.2039 36.292C33.2705 35.676 31.8612 35.368 29.9759 35.368H29.3319V33.24H30.0039C31.7212 33.2213 33.0185 32.9413 33.8959 32.4C34.7732 31.84 35.2119 30.9813 35.2119 29.824C35.2119 28.8347 34.8852 28.0413 34.2319 27.444C33.5972 26.8467 32.6825 26.548 31.4879 26.548C30.3305 26.548 29.3972 26.8467 28.6879 27.444C27.9785 28.0413 27.5585 28.844 27.4279 29.852H24.9359Z" fill="currentColor"/>
							</svg>

							{{ __('Informations') }}
						</div>
					@endif
				@endfor
			</div>

			<div class="relative">
				<div class="absolute w-[30px] s:w-[70px] border-t-2 @if($active < 2) border-jobboard-greige @else border-jobboard-deepblue @endif -top-[89px] s:-top-[124px] -left-[70px] s:-left-[117px]">
				</div>

				<div class="absolute w-[30px] s:w-[70px] border-t-2 @if($active != 2) border-jobboard-greige @else border-jobboard-deepblue @endif -top-[89px] s:-top-[124px] left-[38px] s:left-[48px]">
				</div>
			</div>
		</div>
	@elseif($user->hasRole('recruiter'))
		<div class="bg-jobboard-cream w-full flex flex-col justify-center items-center gap-y-4 s:gap-y-12 h-[174px] s:h-[261px] text-jobboard-deepblue">
			<h2 class="text-[25px] sm:text-[30px] lg:text-[40px] font-bold text-center mt-4 lg:mt-8">{{ __('Complete my profile') }}</h2>
			<div id="anchor" class="flex justify-between items-center font-bold w-[323px] s:w-[438px]">
				@for ($i = 1; $i <= $totalSteps; $i++)
					@if($i == 1)
						<div class="flex flex-col items-center gap-y-4 w-[108px] cursor-pointer" wire:click="goto(2)">
							@if($active == 1)
								<svg class="w-[54px] sm:w-[62px]" viewBox="0 0 62 70" fill="none" xmlns="http://www.w3.org/2000/svg" class="z-10">
									<path d="M27.8203 1.8457C29.6627 0.788427 31.9124 0.722349 33.8057 1.64746L34.1797 1.8457L34.1807 1.84668L57.3193 15.0781V15.0869L57.8252 15.375C59.7941 16.4957 61 18.5748 61 20.8164V47.8496C61 49.9485 59.9358 51.9038 58.1816 53.0703L57.8232 53.292L34.1807 66.8125L34.1797 66.8135C32.3373 67.8708 30.0876 67.9368 28.1943 67.0117L27.8203 66.8135L27.8193 66.8125L4.17676 53.292L4.1748 53.291L3.81543 53.0703C2.06023 51.9104 1 49.9514 1 47.8496V20.8096C1 18.5708 2.21118 16.4953 4.17871 15.3662L4.17773 15.3652L27.8193 1.84668L27.8203 1.8457Z" stroke="#0E1954" stroke-width="2"/>
									<path d="M28.0796 27.08V24.756H33.3436V45H30.7676V27.08H28.0796Z" fill="#0E1954"/>
								</svg>
							@else
								<svg class="w-[54px] sm:w-[62px]" viewBox="0 0 62 70" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M27.8203 1.8457C29.6627 0.788427 31.9124 0.722349 33.8057 1.64746L34.1797 1.8457L34.1807 1.84668L57.3193 15.0781V15.0869L57.8252 15.375C59.7941 16.4957 61 18.5748 61 20.8164V47.8496C61 49.9485 59.9358 51.9038 58.1816 53.0703L57.8232 53.292L34.1807 66.8125L34.1797 66.8135C32.3373 67.8708 30.0876 67.9368 28.1943 67.0117L27.8203 66.8135L27.8193 66.8125L4.17676 53.292L4.1748 53.291L3.81543 53.0703C2.06023 51.9104 1 49.9514 1 47.8496V20.8096C1 18.5708 2.21118 16.4953 4.17871 15.3662L4.17773 15.3652L27.8193 1.84668L27.8203 1.8457Z" stroke="#0E1954" stroke-width="2"/>
									<path d="M36.2391 24.5814C34.6609 23.7822 32.8787 23.3333 31 23.3333C24.4725 23.3333 19.1904 28.7199 19.1904 35.3764C19.1904 42.0329 24.4725 47.4194 31 47.4194C37.5274 47.4194 42.8095 42.0329 42.8095 35.3764C42.8095 33.8327 42.5196 32.3547 42.0043 30.9971M25.632 35.3764L29.9264 39.7556L42.8095 23.3333" stroke="#0E1954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							@endif

							{{ __('Informations') }}
						</div>
					@else
						<div class="flex flex-col items-center gap-y-4 w-[108px] @if($active == 2) text-jobboard-greige @else text-jobboard-deepblue cursor-pointer @endif" @if($active == 4) wire:click="goto(3)" @endif>
							@if($active < 2)
								<svg class="w-[54px] sm:w-[62px]" viewBox="0 0 62 70" fill="none" xmlns="http://www.w3.org/2000/svg" class="z-10">
									<path d="M27.8203 1.8457C29.6627 0.788427 31.9124 0.722349 33.8057 1.64746L34.1797 1.8457L34.1807 1.84668L57.3193 15.0781V15.0869L57.8252 15.375C59.7941 16.4957 61 18.5748 61 20.8164V47.8496C61 49.9485 59.9358 51.9038 58.1816 53.0703L57.8232 53.292L34.1807 66.8125L34.1797 66.8135C32.3373 67.8708 30.0876 67.9368 28.1943 67.0117L27.8203 66.8135L27.8193 66.8125L4.17676 53.292L4.1748 53.291L3.81543 53.0703C2.06023 51.9104 1 49.9514 1 47.8496V20.8096C1 18.5708 2.21118 16.4953 4.17871 15.3662L4.17773 15.3652L27.8193 1.84668L27.8203 1.8457Z" stroke="currentColor" stroke-width="2"/>
									<path d="M24.8753 42.956C27.2459 41.052 29.1033 39.4933 30.4473 38.28C31.7913 37.048 32.9206 35.7693 33.8353 34.444C34.7686 33.1 35.2353 31.784 35.2353 30.496C35.2353 29.2827 34.9366 28.3307 34.3393 27.64C33.7606 26.9307 32.8179 26.576 31.5113 26.576C30.2419 26.576 29.2526 26.9773 28.5433 27.78C27.8526 28.564 27.4793 29.6187 27.4233 30.944H24.9593C25.0339 28.8533 25.6686 27.2387 26.8633 26.1C28.0579 24.9613 29.5979 24.392 31.4833 24.392C33.4059 24.392 34.9273 24.924 36.0473 25.988C37.1859 27.052 37.7553 28.5173 37.7553 30.384C37.7553 31.9333 37.2886 33.4453 36.3553 34.92C35.4406 36.376 34.3953 37.664 33.2193 38.784C32.0433 39.8853 30.5406 41.1733 28.7113 42.648H38.3433V44.776H24.8753V42.956Z" fill="currentColor"/>
								</svg>
							@else
								<svg class="w-[54px] sm:w-[62px]" viewBox="0 0 62 70" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M27.8203 1.8457C29.6627 0.788427 31.9124 0.722349 33.8057 1.64746L34.1797 1.8457L34.1807 1.84668L57.3193 15.0781V15.0869L57.8252 15.375C59.7941 16.4957 61 18.5748 61 20.8164V47.8496C61 49.9485 59.9358 51.9038 58.1816 53.0703L57.8232 53.292L34.1807 66.8125L34.1797 66.8135C32.3373 67.8708 30.0876 67.9368 28.1943 67.0117L27.8203 66.8135L27.8193 66.8125L4.17676 53.292L4.1748 53.291L3.81543 53.0703C2.06023 51.9104 1 49.9514 1 47.8496V20.8096C1 18.5708 2.21118 16.4953 4.17871 15.3662L4.17773 15.3652L27.8193 1.84668L27.8203 1.8457Z" stroke="#0E1954" stroke-width="2"/>
									<path d="M36.2391 24.5814C34.6609 23.7822 32.8787 23.3333 31 23.3333C24.4725 23.3333 19.1904 28.7199 19.1904 35.3764C19.1904 42.0329 24.4725 47.4194 31 47.4194C37.5274 47.4194 42.8095 42.0329 42.8095 35.3764C42.8095 33.8327 42.5196 32.3547 42.0043 30.9971M25.632 35.3764L29.9264 39.7556L42.8095 23.3333" stroke="#0E1954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							@endif

							{{ __('Supporting documents') }}
						</div>
					@endif
				@endfor
			</div>

			<div class="relative">
				<div class="absolute w-[30px] s:w-[70px] border-t-2 @if($active < 2) border-jobboard-greige @else border-jobboard-deepblue @endif -top-[89px] s:-top-[124px] -left-[70px] s:-left-[117px]">
				</div>

				<div class="absolute w-[30px] s:w-[70px] border-t-2 @if($active != 2) border-jobboard-greige @else border-jobboard-deepblue @endif -top-[89px] s:-top-[124px] left-[38px] s:left-[48px]">
				</div>
			</div>
		</div>
	@endif

	<div class="w-full mx-auto max-w-[840px] bg-white px-4 lmd:px-0 py-10 mb-6 rounded-md text-jobboard-deepblue">
		<div class="mt-4">
			@if($user->hasRole('applicant'))
				@if($active == 1)
					<div class="flex flex-row max-sm:items-start max-sm:space-y-4 sm:flex-row sm:justify-between">
						<x-front.space-title>
							{{ __('My home') }}
						</x-front.space-title>
					</div>

					<div class="flex mt-4 gap-y-4 max-lmd:gap-x-4 flex-wrap justify-center lmd:justify-between">
						<div class="w-full max-w-[360px] s:max-w-[270px]">
							<input type="radio" name="placeConfiguration" value="house_with_garden" id="houseWithGarden" wire:model="placeConfiguration" class="peer hidden" />
							<label for="houseWithGarden" class="block cursor-pointer border border-jobboard-greige rounded-xl hover:bg-jobboard-cream peer-checked:bg-jobboard-cream peer-checked:border-jobboard-cream max-s:w-[360px]">
								<div>
									<h3 class="flex flex-row gap-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium lowercase h-[85px] s:h-[144px]">
										<svg width="69" height="47" viewBox="0 0 69 47" fill="none" xmlns="http://www.w3.org/2000/svg">
											<circle cx="8" cy="24" r="8" fill="#FFA244"/>
											<ellipse cx="43.5" cy="7" rx="4.5" ry="5" fill="#FFA244"/>
											<ellipse cx="23.5" cy="32" rx="4.5" ry="5" fill="#FFA244"/>
											<path d="M26.6302 20.7125C26.704 20.4 26.7285 20.0625 26.7285 19.725C26.7285 17.2 25.0692 15.0625 22.7706 14.3875C23.0042 13.8 23.1148 13.1625 23.1148 12.4875C23.1148 9.40002 20.6564 6.90002 17.645 6.90002C14.6089 6.90002 12.1506 9.40002 12.1506 12.4875C12.1506 13.1625 12.2612 13.7875 12.4702 14.375C10.1839 15.05 8.5 17.2 8.5 19.725C8.5 21.5 9.32354 23.1 10.6142 24.1125C9.32354 25.1375 8.5 26.725 8.5 28.5125C8.5 31.5875 10.9583 34.0875 13.9944 34.0875C15.3956 34.0875 16.6617 33.5625 17.6204 32.6875C18.5914 33.5625 19.8698 34.0875 21.2464 34.0875C21.9471 34.0875 22.6231 33.95 23.25 33.7M17.6246 32.687V46M30.1579 16.6375C29.6662 15.8125 29.3958 14.85 29.3958 13.825C29.3958 11.3 31.0798 9.15 33.366 8.475C33.1571 7.8875 33.0464 7.2625 33.0464 6.5875C33.0464 3.5 35.5048 1 38.5408 1C41.5523 1 44.0106 3.5 44.0106 6.5875C44.0106 7.2625 43.9 7.9 43.6664 8.4875C45.6823 9.075 47.1941 10.7875 47.5506 12.9M33.3906 12.901H57.3594L67.5 24.5305M33.3906 12.901L42.9167 23.9132L43.5312 24.5305H67.5M33.3906 12.901L23.25 24.6235V46H43.5312V27.25M67.5 24.5305L67.5 46H42.9167M29.7031 45.9999V37.2259C29.7031 35.1549 31.3541 33.4759 33.3906 33.4759C35.4271 33.4759 37.0781 35.1549 37.0781 37.2259V45.9999M50.2917 12.9V8.5H55.2083V12.9M35.5417 24.75C35.5417 26.1307 34.441 27.25 33.0833 27.25C31.7256 27.25 30.625 26.1307 30.625 24.75C30.625 23.3693 31.7256 22.25 33.0833 22.25C34.441 22.25 35.5417 23.3693 35.5417 24.75Z" stroke="#0E1954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>

										{{ __('A house with garden') }}
									</h3>
								</div>
							</label>
						</div>
					</div>
				@elseif($active == 2)
					<div class="flex flex-row max-sm:items-start max-sm:space-y-4 sm:flex-row sm:justify-between">
						<x-front.space-title>
							{{ __('My contact info') }}
						</x-front.space-title>
					</div>

					<div class="flex flex-col gap-y-4 mt-4">
						<div class="w-[250px]">
							<div class="flex flex-row mb-2 pl-4">
								<x-front.input-label for="avatar" :value="__('My avatar')" />
							</div>

							<livewire:uppy
								:user="$user"
								:maxMedias="1"
								:class="\App\Models\User::class"
								:modelId="$user->id"
								:collection="'avatar'"
								:gridClass="'w-full max-w-[250px]'"
								:aspectRatio="'aspect-square'"
								:objectFit="'object-cover'"
								:wire:key="'avatar'" />
						</div>

						<div>
							<div class="flex flex-row pl-4">
								<x-front.input-label for="phone" :value="__('Phone')" />
							</div>

							<x-front.text-input name="phone" id="phone" wire:model="phone" placeholder="{{ __('Phone number') }}" :class="'mt-1 block bg-white focus:border-jobboard-deepblue focus:ring-jobboard-deepblue w-full'" />

							@error('phone')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror
						</div>

						<div class="w-full">
							<livewire:address
								:address="$address"
								:streetRequired="false"
								:zipCodeRequired="false"
								:showZipCode="true"
								:cityRequired="false"
								:additionnal_1="false"
								:additionnal_2="false"
								:key="'component-address'" />
						</div>
					</div>
				@endif
			@elseif($user->hasRole('recruiter'))
				@if($active == 1)
					<div class="flex flex-col gap-y-4 max-w-[540px] mx-auto">
						<div wire:ignore wire:key="avatar-uploader-component" class="w-[250px]">
							<div class="flex flex-row">
								<x-front.input-label for="avatar" :value="__('My avatar')" />
							</div>

							<livewire:uppy
								:user="$user"
								:maxMedias="1"
								:class="\App\Models\User::class"
								:modelId="$user->id"
								:collection="'avatar'"
								:gridClass="'w-full max-w-[250px]'"
								:aspectRatio="'aspect-square'"
								:objectFit="'object-cover'"
								:wire:key="'avatar'" />
						</div>

						<div class="w-full flex flex-col gap-4">
							<div class="flex flex-col gap-y-1 w-full flex-1">
								<x-front.input-label for="siret" :value="__('Siret number')" :required="true" :class="'pl-4'"/>

								<x-front.text-input name="siret" id="siret" wire:model="siret" placeholder="{{ __('My SIRET number of 14 figures') }}" :class="'mt-1 block bg-white'" />

								@error('siret')
									<span class="error text-danger-700">
										{{ $message }}
									</span>
								@enderror
							</div>

							<div class="flex flex-col gap-y-1 w-full flex-1">
								<x-front.input-label for="companyName" :value="__('Company name or business name')" :required="true" :class="'pl-4'"/>

								<x-front.text-input name="companyName" id="companyName" wire:model="companyName" placeholder="{{ __('Company name') }}" :class="'mt-1 block bg-white'" />

								@error('companyName')
									<span class="error text-danger-700">
										{{ $message }}
									</span>
								@enderror
							</div>
						</div>

						<div class="w-full">
							<div class="flex flex-col gap-y-1">
								<x-front.input-label for="phone" :value="__('Phone')" :required="true" :class="'pl-4'"/>

								<x-front.text-input name="phone" id="phone" wire:model="phone" placeholder="{{ __('Phone number') }}" :class="'mt-1 block bg-white'" />

								@error('phone')
									<span class="error text-danger-700">
										{{ $message }}
									</span>
								@enderror
							</div>
						</div>

						<div class="w-full">
							<livewire:address
								:address="$address"
								:streetRequired="true"
								:zipCodeRequired="true"
								:showZipCode="true"
								:cityRequired="true"
								:additionnal_1="false"
								:additionnal_2="false"
								:key="'component-address'" />
						</div>
					</div>
				@elseif($active == 2)
					<div class="flex flex-col gap-y-4 max-w-[540px] mx-auto">
						<div>
							<div class="flex flex-col gap-2">
								<h3 class="text-jobboard-deepblue font-bold text-[18px]">{{ __('Proof of SIREN') }} </h3>

								<x-front.input-label for="sirenDocument" :value="__('SIREN')" :required="true" :class="'pl-4'"/>

								<div>
									<x-front.primary-button type="button" onclick="document.getElementById('sirenDocument').click()">
										{{ __('Choose File') }}
									</x-front.primary-button>

									<input type="file" id="sirenDocument" name="sirenDocument" class="hidden" wire:model="sirenDocument" />
								</div>
							</div>

							@error('sirenDocument')
								<span class="error text-danger-700">
									{{ $message }}
								</span>
							@enderror

							@if($sirenDocument)
								<div class="flex flex-row">
									<x-front.input-label for="sirenDocument" :value="__('Selected file :')" />
								</div>

								<ul class="mt-2 pl-4 space-y-2 text-sm text-gray-400">
									<li class="flex items-center justify-between text-sm text-jobboard-deepblue">
										<div class="flex items-center gap-x-2">
											•

											<div>
												<p class="font-medium truncate max-w-[200px]">{{ $sirenDocument->getClientOriginalName() }}</p>
												<p class="text-xs text-gray-500">
													{{ number_format($sirenDocument->getSize() / 1024, 2) }} KB
												</p>

												<button wire:click="removeSirenFile" class="text-red-600 text-xs">
													{{ __('Delete') }}
												</button>
											</div>
										</div>
									</li>
								</ul>
							@endif
						</div>
					</div>
				@endif
			@endif
		</div>

		<hr class="w-full h-px border border-jobboard-deepblue my-8">

		<div class="flex s:flex-row flex-col items-center max-s:space-y-5 justify-between mt-10">
			<div class="flex gap-x-4 text-sm font-bold">
				@if($active > 1)
					<div wire:click="previous" class="flex gap-x-2 items-center cursor-pointer">
						<svg width="8" height="11" viewBox="0 0 8 11" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M6.5166 1.5L2.15296 5.5L6.5166 9.5" stroke="#0E1954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>

						{{ __('Previous') }}
					</div>
				@endif

				<a href="{{ route('space.profile.dashboard') }}">
					<div class="flex gap-x-2 items-center cursor-pointer">
						<svg class="shrink-0" width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M8.00391 14C11.8699 14 15.0039 11.0899 15.0039 7.5C15.0039 3.91015 11.8699 0.999999 8.00391 0.999999C4.13791 1 1.00391 3.91015 1.00391 7.5C1.00391 11.0899 4.13791 14 8.00391 14Z" stroke="#0E1954" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M5.75195 9.59183L10.2574 5.4082" stroke="#0E1954" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M5.75195 5.4082L10.2574 9.59183" stroke="#0E1954" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>

						{{ __('Cancel') }}
					</div>
				</a>
			</div>

			<x-front.primary-button wire:click="submitForm">
				@if($active < $totalSteps)
					{{ __('Next') }}

					<svg class="ml-2" width="10" height="13" viewBox="0 0 10 13" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1.85938 1.5L7.31392 6.5L1.85938 11.5" stroke="#F7F6EF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				@elseif($active == $totalSteps)
					{{ __('Validate my profile') }}
				@endif
			</x-front.primary-button>
		</div>
	</div>

	<script>
		document.addEventListener('livewire:init', () => {
			// S'exécute après chaque traitement de message Livewire
			Livewire.hook('request', ({ respond }) => {
				respond(() => {
					// On attend que le DOM soit mis à jour, puis on scrolle
					const anchor = document.getElementById('anchor');
					if (anchor) {
						anchor.scrollIntoView({ behavior: 'smooth', block: 'start' });
					}
				});
			});
		});
	</script>
</div>
