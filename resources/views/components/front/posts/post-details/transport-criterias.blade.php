@if($post->postType->slug == 'tractionnaire')
	@if($post->values_web['tractor_type'])
		<div class="flex inline-block gap-2">
			<svg width="24" height="23" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
				<path d="M3.93311 2.74438L3.93311 17.4111C3.93311 18.1474 4.58975 18.7444 5.39977 18.7444H18.5998C19.4098 18.7444 20.0664 18.1474 20.0664 17.4111V2.74438C20.0664 2.00801 19.4098 1.41105 18.5998 1.41105H5.39977C4.58975 1.41105 3.93311 2.00801 3.93311 2.74438Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M14.9337 18.7444V20.7444C14.9337 21.1126 15.2621 21.4111 15.667 21.4111H17.867C18.272 21.4111 18.6004 21.1126 18.6004 20.7444V18.7444" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M9.06645 18.7444V20.7444C9.06645 21.1126 8.7381 21.4111 8.33311 21.4111H6.13311C5.72813 21.4111 5.39978 21.1126 5.39978 20.7444V18.7444" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M1 6.74528V4.74528C1 4.37711 1.32835 4.07861 1.73333 4.07861H22.2667C22.6717 4.07861 23 4.37711 23 4.74528V6.74528" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M3.93311 12.0781H20.0664" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M17.1337 15.4114H15.667" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M6.86633 15.4114H8.333" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>

			<div class="flex flex-col">
				<div class="flex flex-row">
					{{ __('Tractor type') }} : {{ \App\Models\Criteria::find($post->values_web['tractor_type'])->name }}
				</div>
			</div>
		</div>
	@endif
@endif

@if($post->postType->slug == 'vente-vehicule' || $post->postType->slug == 'achat-location-vehicule')
	@if($post->values_web['vehicule_type'])
		<div class="flex inline-block gap-2">
			<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
				<path d="M13.3973 13.3737L10.9889 15.7824L8.49851 15.5832L8.70026 18.0707L6.20987 17.8718L6.41414 20.3568L5.77113 20.9998L1.67609 20.3238L1 16.2287L8.62618 8.60254" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M9.14081 11.3477L4.95264 15.5358" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M16.4361 2.1655L19.8346 5.56394C21.3885 7.11787 21.3885 9.63344 19.8371 11.1845L16.6325 14.3891C16.02 15.0015 15.0249 15.0015 14.4129 14.3891L7.61094 7.58718C6.9985 6.97474 6.9985 5.97967 7.61094 5.36759L10.8152 2.16298C12.3666 0.611921 14.8822 0.611921 16.4361 2.1655Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M12.4485 5.18604L13.147 4.48748C13.9241 3.71035 15.1859 3.71033 15.963 4.48743L17.5127 6.03706C18.2899 6.81417 18.2899 8.07597 17.5128 8.8531L16.8143 9.55165L12.4485 5.18604Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>

			<div class="flex flex-col">
				<div class="flex flex-row">
					{{ __('Vehicule types') }} : {{ \App\Models\Criteria::find($post->values_web['vehicule_type'])->name }}
				</div>
			</div>
		</div>
	@endif

	@if($post->values_web['brand'])
		<div class="flex inline-block gap-2">
			<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
				<path d="M11 21C16.5228 21 21 16.5228 21 11C21 5.47715 16.5228 1 11 1C5.47715 1 1 5.47715 1 11C1 16.5228 5.47715 21 11 21Z" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10"/>
				<path d="M8.51211 10.3565C9.83283 10.3565 10.9035 9.28583 10.9035 7.96511C10.9035 6.64439 9.83283 5.57373 8.51211 5.57373C7.19139 5.57373 6.12073 6.64439 6.12073 7.96511C6.12073 9.28583 7.19139 10.3565 8.51211 10.3565Z" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10"/>
				<path d="M3.36792 17.4604L8.50584 13.0923L16.4479 19.386" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10"/>
				<path d="M20.78 13.0923L16.9699 9.76123L11 15.0688" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10"/>
			</svg>

			<div class="flex flex-col">
				<div class="flex flex-row">
					{{ __('Brand') }} : {{ nl2br(e($post->values_web['brand'])) }}
				</div>
			</div>
		</div>
	@endif

	@if($post->values_web['model'])
		<div class="flex inline-block gap-2">
			<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
				<path d="M13.3595 7.92311C13.7675 7.92311 14.1588 7.76102 14.4474 7.4725C14.7359 7.18399 14.898 6.79267 14.898 6.38465C14.898 5.97663 14.7359 5.58531 14.4474 5.2968C14.1588 5.00828 13.7675 4.84619 13.3595 4.84619C12.9515 4.84619 12.5602 5.00828 12.2716 5.2968C11.9831 5.58531 11.821 5.97663 11.821 6.38465C11.821 6.79267 11.9831 7.18399 12.2716 7.4725C12.5602 7.76102 12.9515 7.92311 13.3595 7.92311Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M7.20575 15.6151C7.40976 15.6151 7.60542 15.5341 7.74968 15.3898C7.89394 15.2456 7.97498 15.0499 7.97498 14.8459C7.97498 14.6419 7.89394 14.4462 7.74968 14.302C7.60542 14.1577 7.40976 14.0767 7.20575 14.0767C7.00174 14.0767 6.80608 14.1577 6.66183 14.302C6.51757 14.4462 6.43652 14.6419 6.43652 14.8459C6.43652 15.0499 6.51757 15.2456 6.66183 15.3898C6.80608 15.5341 7.00174 15.6151 7.20575 15.6151Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M7.20569 10.2307C7.61372 10.2307 8.00503 10.0686 8.29355 9.78012C8.58207 9.4916 8.74415 9.10029 8.74415 8.69227C8.74415 8.28424 8.58207 7.89293 8.29355 7.60441C8.00503 7.3159 7.61372 7.15381 7.20569 7.15381C6.79767 7.15381 6.40636 7.3159 6.11784 7.60441C5.82932 7.89293 5.66724 8.28424 5.66724 8.69227C5.66724 9.10029 5.82932 9.4916 6.11784 9.78012C6.40636 10.0686 6.79767 10.2307 7.20569 10.2307Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M14.9288 19.123C14.9116 18.8246 14.8079 18.5377 14.6303 18.2972C14.4527 18.0568 14.2089 17.8733 13.9288 17.7692C13.2329 17.5405 12.6415 17.0711 12.2608 16.4453C11.8801 15.8196 11.7351 15.0785 11.8519 14.3554C11.9688 13.6324 12.3397 12.9747 12.898 12.5006C13.4564 12.0265 14.1655 11.7672 14.898 11.7692H17.7749C18.2683 11.7706 18.7549 11.6533 19.1934 11.4272C19.632 11.201 20.0098 10.8728 20.2949 10.47C20.5799 10.0673 20.764 9.6019 20.8315 9.1131C20.899 8.6243 20.8479 8.12645 20.6826 7.66153C20.0707 5.93379 18.9957 4.40746 17.5751 3.2493C16.1544 2.09114 14.4428 1.3457 12.6273 1.09442C10.8117 0.843146 8.96194 1.0957 7.28016 1.82449C5.59838 2.55328 4.14926 3.73028 3.09111 5.22688C2.03296 6.72348 1.40648 8.48212 1.28014 10.3107C1.15379 12.1392 1.53243 13.9673 2.37469 15.5952C3.21694 17.2231 4.49041 18.5882 6.05597 19.5414C7.62153 20.4946 9.41894 20.9991 11.2518 21C12.157 21.0025 13.0581 20.8782 13.9288 20.6307C14.2485 20.5411 14.5255 20.3396 14.709 20.0628C14.8926 19.786 14.9706 19.4525 14.9288 19.123Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>

			<div class="flex flex-col">
				<div class="flex flex-row">
					{{ __('Model') }} : {{ nl2br(e($post->values_web['model'])) }}
				</div>
			</div>
		</div>
	@endif

	@if($post->postType->slug == 'vente-vehicule')
		@if($post->values_web['commissioning_year'])
			<div class="flex inline-block gap-2">
				<svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
					<path d="M6 1V4" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M14 1V4" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M1.5 8.08984H18.5" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M19 7.5V16C19 19 17.5 21 14 21H6C2.5 21 1 19 1 16V7.5C1 4.5 2.5 2.5 6 2.5H14C17.5 2.5 19 4.5 19 7.5Z" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M13.6947 12.7002H13.7037" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M13.6947 15.7002H13.7037" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M9.99548 12.7002H10.0045" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M9.99548 15.7002H10.0045" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M6.29431 12.7002H6.30329" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M6.29431 15.7002H6.30329" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>

				<div class="flex flex-col">
					<div class="flex flex-row">
						{{ __('Commissioning year') }} : {{ \Carbon\Carbon::parse($post->values_web['commissioning_year'])->format('d/m/Y') }}
					</div>
				</div>
			</div>
		@endif

		@if($post->values_web['mileage'])
			<div class="flex inline-block gap-2">
				<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
					<path d="M9.24902 10.6849C9.24902 9.89158 9.89197 9.24854 10.6851 9.24854C11.4783 9.24854 12.1212 9.89158 12.1212 10.6849C12.1212 11.4781 11.4783 12.1212 10.6851 12.1212C9.89197 12.1212 9.24902 11.4781 9.24902 10.6849Z" stroke="#262423" stroke-width="1.5" stroke-linejoin="round"/>
					<path d="M20.3697 10.6848C20.3697 16.0336 16.034 20.3697 10.6851 20.3697C5.33618 20.3697 1 16.0336 1 10.6848C1 5.33607 5.33618 1 10.6851 1C16.034 1 20.3697 5.33607 20.3697 10.6848Z" stroke="#262423" stroke-width="1.5" stroke-linejoin="round"/>
					<path d="M1 10.685H4.28299C4.28299 7.14944 7.14944 4.2832 10.6851 4.2832C14.2207 4.2832 17.0867 7.14944 17.0867 10.685H20.3697" stroke="#262423" stroke-width="1.5" stroke-linejoin="round"/>
					<path d="M14.4035 15.2402H6.99182" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M6.16092 6.16067L3.83813 3.83789" stroke="#262423" stroke-width="1.5" stroke-linejoin="round"/>
					<path d="M13.9853 8.44534C14.2782 8.15242 14.2781 7.67755 13.9852 7.38468C13.6923 7.0918 13.2174 7.09183 12.9246 7.38474L13.9853 8.44534ZM12.9246 7.38474L11.2578 9.05166L12.3186 10.1123L13.9853 8.44534L12.9246 7.38474Z" fill="#262423"/>
					<path d="M15.3864 5.98356L17.5337 3.83643" stroke="#262423" stroke-width="1.5" stroke-linejoin="round"/>
					<path d="M10.6851 4.28299V1" stroke="#262423" stroke-width="1.5" stroke-linejoin="round"/>
				</svg>

				<div class="flex flex-col">
					<div class="flex flex-row">
						{{ __('Mileage') }} : {{ nl2br(e($post->values_web['mileage'])) }}km
					</div>
				</div>
			</div>
		@endif
	@endif
@elseif($post->postType->slug == 'transaction-entreprise')
	@if($post->values_web['sector'])
		<div class="flex inline-block gap-2">
			<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
				<path d="M2.8613 4.99959C3.9662 4.99959 4.86213 4.10366 4.86213 2.99876C4.86213 1.89385 3.96414 1 2.8613 1C1.75847 1 0.860474 1.89592 0.860474 3.00083C0.860474 4.10573 1.7564 5.00165 2.8613 5.00165V4.99959Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M2.8613 12.9987C3.9662 12.9987 4.86213 12.1028 4.86213 10.9979C4.86213 9.89299 3.9662 8.99707 2.8613 8.99707C1.7564 8.99707 0.860474 9.89506 0.860474 11C0.860474 12.1049 1.7564 13.0008 2.8613 13.0008V12.9987Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M2.8613 20.9997C3.9662 20.9997 4.86213 20.1038 4.86213 18.9989C4.86213 17.894 3.9662 16.998 2.8613 16.998C1.7564 16.998 0.860474 17.894 0.860474 18.9989C0.860474 20.1038 1.7564 20.9997 2.8613 20.9997Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M7.52722 3.66699H20.8606" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M7.52722 11.666H20.8606" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M7.52722 19.665H20.8606" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>

			<div class="flex flex-col">
				<div class="flex flex-row">
					{{ __('Sector') }} : {{ \App\Models\Criteria::find($post->values_web['sector'])->name }}
				</div>
			</div>
		</div>
	@endif

	@if($post->values_web['activity_type'])
		<div class="flex inline-block gap-2">
			<svg width="24" height="23" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
				<path d="M10.2585 13.3029L1 12.5579V6.17204C1 6.00352 1.03322 5.83665 1.09775 5.68097C1.16228 5.5253 1.25686 5.38387 1.37609 5.26477C1.49532 5.14567 1.63685 5.05124 1.79259 4.98687C1.94834 4.92251 2.11524 4.88947 2.28377 4.88965H21.2049C21.5454 4.88965 21.8719 5.0249 22.1126 5.26566C22.3534 5.50641 22.4886 5.83294 22.4886 6.17342V12.5579L13.2301 13.3029" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10"/>
				<path d="M21.5444 13.9819V20.0874C21.5444 20.2559 21.5112 20.4228 21.4467 20.5784C21.3821 20.7341 21.2876 20.8756 21.1683 20.9947C21.0491 21.1138 20.9076 21.2082 20.7518 21.2725C20.5961 21.3369 20.4292 21.37 20.2606 21.3698H3.22395C3.05543 21.37 2.88852 21.3369 2.73278 21.2725C2.57703 21.2082 2.4355 21.1138 2.31627 20.9947C2.19705 20.8756 2.10247 20.7341 2.03793 20.5784C1.9734 20.4228 1.94019 20.2559 1.94019 20.0874V13.9819" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/>
				<path d="M13.2247 11.4995H10.2585V15.4759H13.2247V11.4995Z" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10"/>
				<path d="M7.68689 4.73299V2.39637C7.68671 2.26148 7.71314 2.12789 7.76468 2.00324C7.81621 1.87859 7.89183 1.76533 7.98721 1.66995C8.08259 1.57457 8.19585 1.49895 8.3205 1.44742C8.44515 1.39588 8.57875 1.36945 8.71363 1.36963H14.7696C14.9044 1.36945 15.0378 1.39584 15.1624 1.44729C15.287 1.49873 15.4002 1.57423 15.4955 1.66947C15.5909 1.7647 15.6665 1.87779 15.7182 2.00229C15.7698 2.12678 15.7963 2.26022 15.7963 2.39499V4.73161" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10"/>
			</svg>

			<div class="flex flex-col">
				<div class="flex flex-row">
					{{ __('Activity type') }} : {{ \App\Models\Criteria::find($post->values_web['activity_type'])->name }}
				</div>
			</div>
		</div>
	@endif
@elseif($post->postType->slug == 'offre-immobiliere')
	@if($post->values_web['good_type'])
		<div class="flex inline-block gap-2">
			<svg width="24" height="23" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
				<path d="M22.3331 11.7296L11.6666 1.36963L1 11.7296V12.628H3.40773V21.3696H8.77027V15.5546H14.5629V21.3696H19.9254V12.628H22.3331V11.7296Z" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10" stroke-linejoin="round"/>
			</svg>

			<div class="flex flex-col">
				<div class="flex flex-row">
					{{ __('Good type') }} : {{ \App\Models\Criteria::find($post->values_web['good_type'])->name }}
				</div>
			</div>
		</div>
	@endif
@elseif($post->postType->slug == 'appel-offre')
	@if($post->values_web['market_spectrum'])
		<div class="flex inline-block gap-2">
			<svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
				<path d="M11 21.4111C16.5228 21.4111 21 16.934 21 11.4111C21 5.88829 16.5228 1.41113 11 1.41113C5.47715 1.41113 1 5.88829 1 11.4111C1 16.934 5.47715 21.4111 11 21.4111Z" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10"/>
				<path d="M5.34782 11.8459C6.47826 10.1676 10.7043 10.3937 11.4348 11.8459C12.3043 13.585 10.3043 13.0545 9.69565 15.3241C8.91304 18.2545 10.2609 19.6719 9.69565 19.6719C7.08695 19.6719 7.36521 17.2372 6.21739 15.3241C5.24347 13.7067 4.61739 12.9328 5.34782 11.8459Z" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10"/>
				<path d="M21 11.846C20.6869 11.846 14.913 9.85466 14.913 11.846C14.913 12.7155 13.7304 13.2286 14.0435 14.4547C14.4435 16.0025 16.6522 16.1329 16.6522 17.0634C16.6522 18.2547 14.6696 19.4373 16.6522 19.672" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10"/>
				<path d="M14.1913 1.93262C13.7739 3.68914 14.7653 4.74131 15.7826 5.7587C17 6.9761 16.5305 8.68914 17.5218 8.3674C19.0957 7.86305 20.1131 7.30653 20.1305 7.49783" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10"/>
				<path d="M1.86951 7.49815C3.8869 9.08076 6.21733 8.36772 7.0869 7.49815C8.12168 6.46337 11.0521 5.86337 10.5652 4.88946C9.69559 3.15033 6.53907 2.81989 7.0869 2.28076" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10"/>
			</svg>

			<div class="flex flex-col">
				<div class="flex flex-row">
					{{ __('Market spectrum') }} : {{ \App\Models\Criteria::find($post->values_web['market_spectrum'])->name }}
				</div>
			</div>
		</div>
	@endif

	@if($post->values_web['market_type'])
		<div class="flex inline-block gap-2">
			<svg width="26" height="23" viewBox="0 0 26 23" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
				<path d="M4.59961 14.0757C4.9011 16.3019 5.55495 18.466 6.53664 20.4867C6.62263 20.6754 6.74496 20.8454 6.89664 20.9869C7.04832 21.1284 7.22638 21.2386 7.42066 21.3112C7.61493 21.3839 7.82162 21.4176 8.02891 21.4104C8.2362 21.4032 8.44004 21.3552 8.6288 21.2692C8.81755 21.1832 8.98752 21.0609 9.12899 20.9092C9.27047 20.7575 9.38069 20.5795 9.45335 20.3852C9.52601 20.1909 9.55969 19.9842 9.55248 19.7769C9.54526 19.5696 9.49729 19.3658 9.4113 19.177C8.62211 17.5745 8.0576 15.8708 7.73373 14.1141" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10"/>
				<path d="M1 10.2466C0.999624 11.2506 1.39688 12.2139 2.10488 12.9257C2.81288 13.6376 3.77399 14.0401 4.77797 14.0452L8.52573 14.0644C9.95552 14.0745 11.3744 14.3146 12.7279 14.7755C15.6322 15.7768 18.3698 17.2081 20.8494 19.0216C20.9428 19.0829 21.0515 19.1167 21.1632 19.119C21.2748 19.1214 21.3849 19.0922 21.4807 19.0349C21.5766 18.9776 21.6544 18.8944 21.7051 18.795C21.7559 18.6955 21.7776 18.5837 21.7678 18.4725V2.05781C21.7776 1.94656 21.7559 1.83479 21.7051 1.73532C21.6544 1.63584 21.5766 1.55269 21.4807 1.49537C21.3849 1.43806 21.2748 1.40891 21.1632 1.41127C21.0515 1.41362 20.9428 1.44738 20.8494 1.50869C18.3834 3.31167 15.6624 4.73676 12.7759 5.73693C11.3874 6.211 9.92981 6.45131 8.46258 6.44805H4.79856C3.79112 6.44805 2.82494 6.84825 2.11257 7.56062C1.4002 8.27299 1 9.23916 1 10.2466Z" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10"/>
				<path d="M21.9834 7.55078C22.7047 7.55078 23.3964 7.8373 23.9064 8.34731C24.4164 8.85732 24.7029 9.54905 24.7029 10.2703C24.7029 10.9916 24.4164 11.6833 23.9064 12.1933C23.3964 12.7033 22.7047 12.9898 21.9834 12.9898" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10"/>
				<path d="M10.6605 6.43408V14.0751" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10"/>
			</svg>

			<div class="flex flex-col">
				<div class="flex flex-row">
					{{ __('Market type') }} : {{ \App\Models\Criteria::find($post->values_web['market_type'])->name }}
				</div>
			</div>
		</div>
	@endif

	@if($post->values_web['notice_type'])
		<div class="flex inline-block gap-2">
			<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
				<path d="M2.8613 4.99959C3.9662 4.99959 4.86213 4.10366 4.86213 2.99876C4.86213 1.89385 3.96414 1 2.8613 1C1.75847 1 0.860474 1.89592 0.860474 3.00083C0.860474 4.10573 1.7564 5.00165 2.8613 5.00165V4.99959Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M2.8613 12.9987C3.9662 12.9987 4.86213 12.1028 4.86213 10.9979C4.86213 9.89299 3.9662 8.99707 2.8613 8.99707C1.7564 8.99707 0.860474 9.89506 0.860474 11C0.860474 12.1049 1.7564 13.0008 2.8613 13.0008V12.9987Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M2.8613 20.9997C3.9662 20.9997 4.86213 20.1038 4.86213 18.9989C4.86213 17.894 3.9662 16.998 2.8613 16.998C1.7564 16.998 0.860474 17.894 0.860474 18.9989C0.860474 20.1038 1.7564 20.9997 2.8613 20.9997Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M7.52722 3.66699H20.8606" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M7.52722 11.666H20.8606" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M7.52722 19.665H20.8606" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>

			<div class="flex flex-col">
				<div class="flex flex-row">
					{{ __('Notice type') }} : {{ \App\Models\Criteria::find($post->values_web['notice_type'])->name }}
				</div>
			</div>
		</div>
	@endif

	@if($post->values_web['closing_date'])
		<div class="flex inline-block gap-2">
			<svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
				<path d="M6 1V4" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M14 1V4" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M1.5 8.08984H18.5" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M19 7.5V16C19 19 17.5 21 14 21H6C2.5 21 1 19 1 16V7.5C1 4.5 2.5 2.5 6 2.5H14C17.5 2.5 19 4.5 19 7.5Z" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M13.6947 12.7002H13.7037" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M13.6947 15.7002H13.7037" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M9.99548 12.7002H10.0045" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M9.99548 15.7002H10.0045" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M6.29431 12.7002H6.30329" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M6.29431 15.7002H6.30329" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>

			<div class="flex flex-col">
				<div class="flex flex-row">
					{{ __('Closing date') }} : {{ \Carbon\Carbon::parse($post->values_web['closing_date'])->format('d/m/Y') }}
				</div>
			</div>
		</div>
	@endif
@endif

@if($post->postType->slug == 'transaction-entreprise')
	@if($post->values_web['revenue'])
		<div class="flex inline-block gap-2">
			<svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
				<path d="M11 21.3696C16.5228 21.3696 21 16.8925 21 11.3696C21 5.84678 16.5228 1.36963 11 1.36963C5.47715 1.36963 1 5.84678 1 11.3696C1 16.8925 5.47715 21.3696 11 21.3696Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M15.4769 7.69293C13.4465 5.66173 10.1545 5.66173 8.12405 7.69213C6.09365 9.72253 6.09285 13.0153 8.12405 15.0457C10.1545 17.0769 13.4465 17.0769 15.4769 15.0457" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M5.80005 10.1694H13" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M5.80005 12.5698H13" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>

			<div class="flex flex-col">
				<div class="flex flex-row">
					{{ __('Revenue') }} : {{ $post->values_web['revenue'] }}€
				</div>
			</div>
		</div>
	@endif

	@if($post->values_web['workforce'])
		<div class="flex inline-block gap-2">
			<svg width="24" height="23" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
				<path d="M10.4672 13.5293C9.41624 14.2557 8.59378 15.2837 8.11858 16.4901L1 16.4947V14.8453C1 12.4648 2.92817 10.5366 5.30404 10.5366H6.37323C7.56122 10.5366 8.63954 11.0163 9.41624 11.7976C9.89144 12.2775 10.2615 12.8667 10.4672 13.5293Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M5.83759 8.55601C4.62886 8.55601 3.64905 7.5762 3.64905 6.36748V5.44537C3.64905 4.23665 4.62886 3.25684 5.83759 3.25684C7.04632 3.25684 8.02612 4.23665 8.02612 5.44537V6.36759C8.02612 7.57632 7.04632 8.55601 5.83759 8.55601Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M15.2104 1.36963H14.7413C13.0446 1.36963 11.6692 2.74505 11.6692 4.44172V6.30418C11.6692 8.00085 13.0446 9.37627 14.7413 9.37627H15.2104C16.9071 9.37627 18.2825 8.00085 18.2825 6.30418V4.44172C18.2825 2.74505 16.9071 1.36963 15.2104 1.36963Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M22.2876 18.875V21.3651L7.66626 21.3698V18.875C7.66626 18.0343 7.8262 17.2255 8.11858 16.4899C8.59377 15.2836 9.41623 14.2556 10.4672 13.529C11.5181 12.798 12.7929 12.373 14.1681 12.373H15.781C17.1563 12.373 18.4311 12.798 19.482 13.529C19.8064 13.7529 20.1079 14.0042 20.3821 14.2783C21.008 14.9043 21.5061 15.6537 21.8351 16.4944C22.1276 17.2301 22.2874 18.0341 22.2874 18.8749L22.2876 18.875Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>

			<div class="flex flex-col">
				<div class="flex flex-row">
					{{ __('Workforce') }} : {{ $post->values_web['workforce'] }}
				</div>
			</div>
		</div>
	@endif

	@if($post->values_web['recovery_date'])
		<div class="flex inline-block gap-2">
			<svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
				<path d="M6 1V4" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M14 1V4" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M1.5 8.08984H18.5" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M19 7.5V16C19 19 17.5 21 14 21H6C2.5 21 1 19 1 16V7.5C1 4.5 2.5 2.5 6 2.5H14C17.5 2.5 19 4.5 19 7.5Z" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M13.6947 12.7002H13.7037" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M13.6947 15.7002H13.7037" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M9.99548 12.7002H10.0045" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M9.99548 15.7002H10.0045" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M6.29431 12.7002H6.30329" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M6.29431 15.7002H6.30329" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>

			<div class="flex flex-col">
				<div class="flex flex-row">
					{{ __('Date of the desired recovery') }} : {{ \Carbon\Carbon::parse($post->values_web['recovery_date'])->format('d/m/Y') }}
				</div>
			</div>
		</div>
	@endif

	@if($post->values_web['support'])
		<div class="flex inline-block gap-2">
			<svg width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
				<path d="M5.00635 10.6208L12.315 3.31215C14.9024 0.724727 19.0994 0.724727 21.6902 3.31215C24.2776 5.89957 24.2776 10.0966 21.6902 12.6874L14.3815 19.996L5.00635 10.6208Z" fill="white" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M2.94309 12.6841L4.11583 13.8569V11.5148L9.1865 6.44408C9.61998 6.01061 10.3223 6.01061 10.7558 6.44408L13.5448 9.23312C14.6604 10.3487 16.3708 10.5033 17.6511 9.69684C17.9804 9.4885 18.0106 9.01134 17.7351 8.7358L13.2827 4.28342L12.3149 3.31566H12.3183C9.73087 0.721514 5.53387 0.721514 2.94309 3.3123C0.352305 5.89972 0.352305 10.0967 2.94309 12.6841Z" fill="white" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M5.90017 9.72705L5.00634 10.6209L4.1125 11.5147C3.46396 12.1633 3.46396 13.2117 4.1125 13.8568C4.76104 14.5054 5.80945 14.5054 6.45462 13.8568C5.80608 14.5054 5.80608 15.5538 6.45462 16.199C7.10316 16.8475 8.15157 16.8475 8.79674 16.199C8.14821 16.8475 8.14821 17.8959 8.79674 18.5411C9.44528 19.1896 10.4937 19.1896 11.1389 18.5411C10.4903 19.1896 10.4903 20.238 11.1389 20.8832C11.7874 21.5317 12.8358 21.5317 13.481 20.8832L14.3748 19.9894L15.2687 19.0955" fill="white"/>
				<path d="M5.90017 9.72705L5.00634 10.6209L4.1125 11.5147C3.46396 12.1633 3.46396 13.2117 4.1125 13.8568C4.76104 14.5054 5.80945 14.5054 6.45462 13.8568M6.45462 13.8568L7.34846 12.963M6.45462 13.8568C5.80608 14.5054 5.80608 15.5538 6.45462 16.199C7.10316 16.8475 8.15157 16.8475 8.79674 16.199M8.79674 16.199L9.69058 15.3051M8.79674 16.199C8.14821 16.8475 8.14821 17.8959 8.79674 18.5411C9.44528 19.1896 10.4937 19.1896 11.1389 18.5411M11.1389 18.5411L12.0327 17.6472M11.1389 18.5411C10.4903 19.1896 10.4903 20.238 11.1389 20.8832C11.7874 21.5317 12.8358 21.5317 13.481 20.8832L14.3748 19.9894L15.2687 19.0955" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M9.96947 10.3452L7.35181 12.9629L8.24564 12.069" fill="white"/>
				<path d="M9.96947 10.3452L7.35181 12.9629L8.24564 12.069" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M12.3115 12.6875L9.69385 15.3052L10.5877 14.4147" fill="white"/>
				<path d="M12.3115 12.6875L9.69385 15.3052L10.5877 14.4147" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M14.6571 15.0327L12.0394 17.6504L12.9299 16.7565" fill="white"/>
				<path d="M14.6571 15.0327L12.0394 17.6504L12.9299 16.7565" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>

			<div class="flex flex-col">
				<div class="flex flex-row">
					{{ __('Possible support') }} : {{ __($post->values_web['support']) }}
				</div>
			</div>
		</div>
	@endif

	@if($post->values_web['support_description'])
		<div class="flex inline-block gap-2">
			<svg width="20" height="23" viewBox="0 0 20 23" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
				<path d="M6.23218 18.7228L1.57837 19.0383L1.89387 14.3845L14.9088 1.36963L19.2471 5.70793L6.23218 18.7228Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M1.89392 14.3843L6.23223 18.7226" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M12.4286 3.8501L16.7669 8.1884" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M18.64 21.3696H1" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>

			<div class="flex flex-col">
				<div class="flex flex-row">
					{{ __('Possible support') }} : {{ nl2br(e($post->values_web['support_description'])) }}
				</div>
			</div>
		</div>
	@endif
@elseif($post->postType->slug == 'offre-immobiliere')
	@if($post->values_web['characteristics'])
		<div class="flex inline-block gap-2">
			<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
				<path d="M2.8613 4.99959C3.9662 4.99959 4.86213 4.10366 4.86213 2.99876C4.86213 1.89385 3.96414 1 2.8613 1C1.75847 1 0.860474 1.89592 0.860474 3.00083C0.860474 4.10573 1.7564 5.00165 2.8613 5.00165V4.99959Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M2.8613 12.9987C3.9662 12.9987 4.86213 12.1028 4.86213 10.9979C4.86213 9.89299 3.9662 8.99707 2.8613 8.99707C1.7564 8.99707 0.860474 9.89506 0.860474 11C0.860474 12.1049 1.7564 13.0008 2.8613 13.0008V12.9987Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M2.8613 20.9997C3.9662 20.9997 4.86213 20.1038 4.86213 18.9989C4.86213 17.894 3.9662 16.998 2.8613 16.998C1.7564 16.998 0.860474 17.894 0.860474 18.9989C0.860474 20.1038 1.7564 20.9997 2.8613 20.9997Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M7.52722 3.66699H20.8606" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M7.52722 11.666H20.8606" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M7.52722 19.665H20.8606" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>

			<div class="flex flex-col">
				<div class="flex flex-row">
					{{ __((count($post->values_web['characteristics']) > 1)? 'Characteristics' : 'Characteristic') }} :
				</div>

				<span class="ml-4">
					@foreach($post->values_web['characteristics'] as $characteristic)
						<div class="flex flex-row">
							- {{ \App\Models\Criteria::find($characteristic)->name }}
						</div>
					@endforeach
				</span>
			</div>
		</div>
	@endif

	@if($post->values_web['surface'])
		<div class="flex inline-block gap-2">
			<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
				<path d="M20.3152 1.36963H1V20.6848H20.3152V1.36963Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M13.1443 13.2461L15.3872 15.4891L13.1443 17.7321" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M14.7304 15.4891H6.15332C6.15332 15.285 6.15332 15.1356 6.15332 15.1356V6.45557" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M3.9104 8.04137L6.15343 5.79834L8.39639 8.04137" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>

			<div class="flex flex-col">
				<div class="flex flex-row">
					{{ __('Surface') }} : {{ $post->values_web['surface'] }}m²
				</div>
			</div>
		</div>
	@endif

	@if($post->values_web['floors'])
		<div class="flex inline-block gap-2">
			<svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
				<path d="M1 21.4106V16.4791H5.93151V11.5476H10.863V6.61608H15.7945V1.68457H20.726V21.4106H1Z" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10"/>
			</svg>

			<div class="flex flex-col">
				<div class="flex flex-row">
					{{ __('Number of floors') }} : {{ $post->values_web['floors'] }}
				</div>
			</div>
		</div>
	@endif

	@if($post->values_web['parking'])
		<div class="flex inline-block gap-2">
			<svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
				<path d="M7.1333 5.77979H12.6408C14.1195 5.77979 15.3202 7.22748 15.3202 9.01044C15.3202 10.7934 14.1195 12.2411 12.6408 12.2411H7.1333V5.77979Z" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10"/>
				<path d="M6.3834 17.7793C6.38341 18.1935 6.7192 18.5293 7.13342 18.5293C7.54763 18.5293 7.88341 18.1935 7.8834 17.7793L6.3834 17.7793ZM7.8834 17.7793L7.8833 11.6391L6.3833 11.6392L6.3834 17.7793L7.8834 17.7793Z" fill="#262423"/>
				<path d="M17 1.41064H5C2.79086 1.41064 1 3.20151 1 5.41064V17.4106C1 19.6198 2.79086 21.4106 5 21.4106H17C19.2091 21.4106 21 19.6198 21 17.4106V5.41064C21 3.20151 19.2091 1.41064 17 1.41064Z" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10"/>
			</svg>

			<div class="flex flex-col">
				<div class="flex flex-row">
					{{ __('Number of parking spaces') }} : {{ $post->values_web['parking'] }}
				</div>
			</div>
		</div>
	@endif

	@if($post->values_web['construction_year'])
		<div class="flex inline-block gap-2">
			<svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
				<path d="M6 1V4" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M14 1V4" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M1.5 8.08984H18.5" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M19 7.5V16C19 19 17.5 21 14 21H6C2.5 21 1 19 1 16V7.5C1 4.5 2.5 2.5 6 2.5H14C17.5 2.5 19 4.5 19 7.5Z" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M13.6947 12.7002H13.7037" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M13.6947 15.7002H13.7037" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M9.99548 12.7002H10.0045" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M9.99548 15.7002H10.0045" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M6.29431 12.7002H6.30329" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M6.29431 15.7002H6.30329" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>

			<div class="flex flex-col">
				<div class="flex flex-row">
					{{ __('Construction year') }} : {{ \Carbon\Carbon::parse($post->values_web['construction_year'])->format('d/m/Y') }}
				</div>
			</div>
		</div>
	@endif

	@if($post->values_web['energy_class'])
		<div class="flex inline-block gap-2">
			<svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
				<path d="M12.7158 4.79639L6.5238 12.7174H10.1191L9.27977 18.0261L15.4745 10.1042H11.8783L12.7158 4.79639Z" stroke="#262423" stroke-width="1.5" stroke-linejoin="round"/>
				<path d="M10.9987 21.4106C16.5061 21.4106 20.9974 16.9184 20.9974 11.4092C20.9974 5.9 16.5061 1.41064 10.9987 1.41064C5.49137 1.41064 1 5.90275 1 11.4092C1 16.9156 5.49137 21.4106 10.9987 21.4106Z" stroke="#262423" stroke-width="1.5" stroke-linejoin="round"/>
			</svg>

			<div class="flex flex-col">
				<div class="flex flex-row">
					{{ __('Energy class') }} : {{ \App\Models\Criteria::find($post->values_web['energy_class'])->name }}
				</div>
			</div>
		</div>
	@endif

	@if($post->values_web['ges'])
		<div class="flex inline-block gap-2">
			<svg width="33" height="23" viewBox="0 0 33 23" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
				<path d="M13.3588 14.9106C13.1214 15.9106 12.5607 16.4106 11.5 16.4106C10 16.4106 9.5 15.4106 9.5 13.4106C9.5 11.4106 10 10.4106 11.5 10.4106C12.5606 10.4106 13.1213 10.9106 13.3587 11.9106" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M19.5 13.4106C19.5 15.4106 19 16.4106 17.5 16.4106C16 16.4106 15.5 15.4106 15.5 13.4106C15.5 11.4106 16 10.4106 17.5 10.4106C19 10.4106 19.5 11.4106 19.5 13.4106Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M21.5 14.9106C21.5 14.3584 21.9477 13.9106 22.5 13.9106C23.0523 13.9106 23.5 14.3584 23.5 14.9106V14.9964C23.5 15.2616 23.3946 15.516 23.2071 15.7036L21.5 17.4106H23.5" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M26 21.4106C29.3137 21.4106 32 18.7244 32 15.4106C32 12.0969 29.3137 9.41064 26 9.41064C25.8308 9.41064 25.6644 9.42222 25.4987 9.43593C25.4987 9.42736 25.5 9.41914 25.5 9.41064C25.5 4.99236 21.9183 1.41064 17.5 1.41064C14.0845 1.41064 11.177 3.555 10.0295 6.56764C9.53564 6.46529 9.02429 6.41064 8.5 6.41064C4.35786 6.41064 1 9.7685 1 13.9106C1 18.0528 4.35786 21.4106 8.5 21.4106H26Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>

			<div class="flex flex-col">
				<div class="flex flex-row">
					{{ __('GES') }} : {{ \App\Models\Criteria::find($post->values_web['ges'])->name }}
				</div>
			</div>
		</div>
	@endif
@elseif($post->postType->slug == 'tractionnaire')
	@if($post->values_web['remuneration'])
		<div class="flex inline-block gap-2">
			<svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
				<path d="M11 21.3696C16.5228 21.3696 21 16.8925 21 11.3696C21 5.84678 16.5228 1.36963 11 1.36963C5.47715 1.36963 1 5.84678 1 11.3696C1 16.8925 5.47715 21.3696 11 21.3696Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M15.4769 7.69293C13.4465 5.66173 10.1545 5.66173 8.12405 7.69213C6.09365 9.72253 6.09285 13.0153 8.12405 15.0457C10.1545 17.0769 13.4465 17.0769 15.4769 15.0457" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M5.80005 10.1694H13" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M5.80005 12.5698H13" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>

			<div class="flex flex-col">
				<div class="flex flex-row">
					{{ __('Proposed or desired remuneration') }} : {{ $post->values_web['remuneration'] }}
				</div>
			</div>
		</div>
	@endif

	@if($post->values_web['desired_profile'])
		<div class="flex inline-block gap-2">
			<svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
				<path d="M11 21.4111C16.5228 21.4111 21 16.934 21 11.4111C21 5.88829 16.5228 1.41113 11 1.41113C5.47715 1.41113 1 5.88829 1 11.4111C1 16.934 5.47715 21.4111 11 21.4111Z" stroke="#262423" stroke-width="1.5"/>
				<path d="M11.0001 10.5939C12.5676 10.5939 13.839 9.38415 13.839 7.89118C13.839 6.39821 12.5676 5.18848 11.0001 5.18848C9.43248 5.18848 8.16113 6.39821 8.16113 7.89118C8.16113 9.38415 9.43248 10.5939 11.0001 10.5939Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M15.8768 17.0868C15.8768 14.9949 13.6909 13.303 11 13.303C8.30924 13.303 6.12329 14.9949 6.12329 17.0868" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>

			<div class="flex flex-col">
				<div class="flex flex-row">
					{{ __('Desired profile') }} : {{ nl2br(e($post->values_web['desired_profile'])) }}
				</div>
			</div>
		</div>
	@endif
@endif

@if($post->postType->slug == 'achat-location-vehicule')
	<div class="flex inline-block gap-2">
		<svg width="19" height="23" viewBox="0 0 19 23" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
			<path d="M17.3636 9.55145C17.3636 15.0787 9.18182 21.3696 9.18182 21.3696C9.18182 21.3696 1 15.0787 1 9.55145C1 4.02417 4.66364 1.36963 9.18182 1.36963C13.7 1.36963 17.3636 4.02417 17.3636 9.55145Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M9.18165 12.2786C11.19 12.2786 12.818 10.6505 12.818 8.64222C12.818 6.63391 11.19 5.00586 9.18165 5.00586C7.17334 5.00586 5.54529 6.63391 5.54529 8.64222C5.54529 10.6505 7.17334 12.2786 9.18165 12.2786Z" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>

		@php
			$address = $post->addresses->first();
			if($address->city || $address->custom_city) {
				$street = $address->street ? $address->street.',' : '';
				$city = $address->city ? $address->city->name : $address->custom_city;
				$code = $address->city->zip_code ? $address->city->zip_code : (($address->custom_city && $address->custom_postcode) ? $address->custom_postcode : '');

				$startingAddress = $street.' '.$city.', '.$code.', '.$address->country->name;
			}
			elseif($address->department) $startingAddress = $address->department->name.' ('.$address->department->code.')';
			elseif($address->region) $startingAddress = $address->region->name;
			elseif($address->country) $startingAddress = $address->country->name;
			else $startingAddress = __('Unknown location');
		@endphp

		<div class="flex flex-col">
			<div class="flex flex-row">
				{{ __('Starting address') }} : {{ $startingAddress }}
			</div>
		</div>
	</div>

	<div class="flex inline-block gap-2">
		<svg width="18" height="23" viewBox="0 0 18 23" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
			<path d="M1 1.37061V21.3699" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M7.66638 13.962V10.377" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M1 12.4804C1 12.4804 4.51098 10.8286 7.66642 10.3767C8.17751 10.3019 8.67379 10.2582 9.14785 10.2582C11.0885 10.2582 11.37 10.9397 11.37 11.7397C11.37 13.0952 7.66642 12.6656 7.66642 13.9618C7.66642 15.1618 9.05896 15.4432 10.6293 15.4432C13.1625 15.4432 16.555 13.9618 16.555 13.9618V5.07324C16.555 5.07324 13.7773 6.28801 11.37 6.51023" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M1 3.59177C1 3.59177 5.72575 1.36963 9.14785 1.36963C11.0885 1.36963 11.37 2.05109 11.37 2.8518V11.7396" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>

		@php
			$address = $post->addresses()->latest('id')->first();
			if($address->city || $address->custom_city) {
				$street = $address->street ? $address->street.',' : '';
				$city = $address->city ? $address->city->name : $address->custom_city;
				$code = $address->city->zip_code ? $address->city->zip_code : (($address->custom_city && $address->custom_postcode) ? $address->custom_postcode : '');

				$returnAddress = $street.' '.$city.', '.$code.', '.$address->country->name;
			}
			elseif($address->department) $returnAddress = $address->department->name.' ('.$address->department->code.')';
			elseif($address->region) $returnAddress = $address->region->name;
			elseif($address->country) $returnAddress = $address->country->name;
			else $returnAddress = __('Unknown location');
		@endphp

		<div class="flex flex-col">
			<div class="flex flex-row">
				{{ __('Return address') }} : {{ $returnAddress }}
			</div>
		</div>
	</div>
@endif

@if($post->postType->slug == 'achat-location-vehicule')
	@if($post->availabilities->isNotEmpty())
		<div class="flex inline-block gap-2">
			<svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4 s:w-5 s:h-5 mr-1 drop-shadow-lg">
				<path d="M6 1V4" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M14 1V4" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M1.5 8.08984H18.5" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M19 7.5V16C19 19 17.5 21 14 21H6C2.5 21 1 19 1 16V7.5C1 4.5 2.5 2.5 6 2.5H14C17.5 2.5 19 4.5 19 7.5Z" stroke="#262423" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M13.6947 12.7002H13.7037" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M13.6947 15.7002H13.7037" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M9.99548 12.7002H10.0045" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M9.99548 15.7002H10.0045" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M6.29431 12.7002H6.30329" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M6.29431 15.7002H6.30329" stroke="#262423" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>

			<livewire:front.space.posts.availabilities
				:post="$post"
				:bigComponentTitle="false"
				:wire:key="'availabilities-'.$post->id" />
		</div>
	@endif
@endif
