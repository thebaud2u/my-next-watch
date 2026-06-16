<div class="p-4">
	<div class="w-full bg-white px-6 pt-6 pb-10 mb-6">
		@if($user->hasRole('recruiter'))
			<div class="flex flex-row w-full justify-end items-center gap-x-2 text-jobboard-deepblue mb-4">
				@if($user->awaitingModeration())
					{{ __('Status : :status', ['status' => __('waiting validation')]) }}

					<div class="w-2 h-2 rounded-full bg-jobboard-orange"></div>
				@elseif($user->lastModeration)
					{{ __('Status : :status', ['status' => __($user->lastModeration->state->inHuman())]) }}

					@if($user->lastModeration->state->value == 'validated')
						<div class="w-2 h-2 rounded-full bg-jobboard-green"></div>
					@elseif($user->lastModeration->state->value == 'denied')
						<div class="w-2 h-2 rounded-full bg-jobboard-coralhover"></div>
					@elseif($user->lastModeration->state->value == 'waiting')
						<div class="w-2 h-2 rounded-full bg-jobboard-deepblue"></div>
					@endif
				@endif
			</div>
		@endif

		<div class="flex flex-col max-sm:items-start max-sm:space-y-4 sm:justify-between">
			<div class="p-6 border border-jobboard-greige rounded-md text-jobboard-deepblue mb-8 flex flex-row justify-between gap-4 w-full max-lg:flex-wrap">
				@if($avatar = $user->getFirstMedia('avatar'))
					<img src="{{ $avatar->getAvailableUrl(['optimized']) }}" title="{{ $user->name }}" class="inline-block object-cover w-[100px] h-[100px] rounded-full" />
				@else
					<svg width="72" height="80" viewBox="0 0 72 80" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-none">
						<path d="M27.1691 51.764H45.0724C43.8569 42.348 28.6905 42.348 27.1691 51.764Z" fill="#DDDBD2" />
						<path
							d="M67.7335 16.892L40.2746 1.14C37.6342 -0.38 34.3739 -0.38 31.7335 1.14L4.2746 16.892C1.63417 18.412 0 21.212 0 24.244V55.748C0 58.78 1.62612 61.588 4.2746 63.1L31.7335 78.852C34.3739 80.372 37.6342 80.372 40.2746 78.852L67.7335 63.1C70.3739 61.58 72.008 58.78 72.008 55.748V24.252C72.008 21.22 70.3819 18.412 67.7335 16.9V16.892ZM55.4007 59.396H16.8327C16.6798 58.412 16.5993 55.94 16.5993 54.884C16.5993 52.852 16.9293 50.908 17.5814 49.044C18.2335 47.18 19.1592 45.516 20.3426 44.052C21.5581 42.564 22.983 41.292 24.6172 40.236C25.4463 39.7 26.3157 39.228 27.2254 38.82C24.593 36.444 22.9267 33.028 22.9267 29.22C22.9267 22.06 28.7871 16.236 35.992 16.236C43.1968 16.236 49.0572 22.06 49.0572 29.22C49.0572 33.012 47.407 36.412 44.7907 38.788C45.805 39.252 46.763 39.78 47.6243 40.396C49.2102 41.532 50.5948 42.828 51.7621 44.292C52.9293 45.756 53.8229 47.404 54.4508 49.244C55.0707 51.028 55.3846 52.908 55.3846 54.884V59.396H55.4007Z"
							fill="#DDDBD2" />
						<path
							d="M36 34.204C38.7698 34.204 41.0152 31.9726 41.0152 29.22C41.0152 26.4674 38.7698 24.236 36 24.236C33.2302 24.236 30.9848 26.4674 30.9848 29.22C30.9848 31.9726 33.2302 34.204 36 34.204Z"
							fill="#DDDBD2" />
					</svg>
				@endif

				<div class="flex flex-col w-full">
					<h2 class="text-jobboard-deepblue text-[25px] md:text-[40px] font-bold">
						{{ $user->name }}
					</h2>

					<div class="w-full flex flex-col md:flex-row gap-y-1 md:justify-between max-md:text-sm">
						<div class="flex gap-x-1 items-center font-[500]">
							<svg width="24" height="18" viewBox="0 0 24 18" fill="none"
								xmlns="http://www.w3.org/2000/svg" class="flex-none">
								<path
									d="M22.0513 1.5H1.96433C1.43606 1.5 1.00781 1.91973 1.00781 2.4375V15.5625C1.00781 16.0803 1.43606 16.5 1.96433 16.5H22.0513C22.5796 16.5 23.0078 16.0803 23.0078 15.5625V2.4375C23.0078 1.91973 22.5796 1.5 22.0513 1.5Z"
									stroke="#0E1954" stroke-width="1.5" stroke-linecap="round"
									stroke-linejoin="round" />
								<path d="M22.7307 16.2281L14.3994 8.0625" stroke="#0E1954" stroke-width="1.5"
									stroke-linecap="round" stroke-linejoin="round" />
								<path d="M9.61642 8.0625L1.28516 16.2281" stroke="#0E1954" stroke-width="1.5"
									stroke-linecap="round" stroke-linejoin="round" />
								<path
									d="M1.96387 1.5L11.3856 9.4125C11.7396 9.7125 12.2752 9.7125 12.6291 9.4125L22.0508 1.5H1.96387Z"
									stroke="#0E1954" stroke-width="1.5" stroke-linecap="round"
									stroke-linejoin="round" />
							</svg>

							{{ $user->email }}
						</div>

						<div class="flex gap-x-1 items-center font-[500]">
							<svg width="12" height="18" viewBox="0 0 12 18" fill="none"
								xmlns="http://www.w3.org/2000/svg">
								<path
									d="M9.74371 1.5H2.63129C1.83391 1.5 1.1875 2.12164 1.1875 2.88847V15.1115C1.1875 15.8784 1.83391 16.5 2.63129 16.5H9.74371C10.5411 16.5 11.1875 15.8784 11.1875 15.1115V2.88847C11.1875 2.12164 10.5411 1.5 9.74371 1.5Z"
									stroke="#0E1954" stroke-width="1.5" stroke-miterlimit="10" />
								<path d="M1.1875 4.14038H11.1875" stroke="#0E1954" stroke-width="1.5"
									stroke-miterlimit="10" />
								<path d="M1.1875 13.363H11.1875" stroke="#0E1954" stroke-width="1.5"
									stroke-miterlimit="10" />
								<path d="M5.28027 14.9265H7.0924" stroke="#0E1954" stroke-width="1.5"
									stroke-miterlimit="10" />
							</svg>

							@if(isset($user->phone))
								{{ $user->phone }}
							@else
								<span class="text-jobboard-greige">{{ __('Not provided') }}</span>
							@endif
						</div>

						<div class="flex gap-x-1 items-center font-[500]">
							<svg width="15" height="18" viewBox="0 0 15 18" fill="none"
								xmlns="http://www.w3.org/2000/svg">
								<path
									d="M13.3125 7.36957C13.3125 11.9348 7.3125 16.5 7.3125 16.5C7.3125 16.5 1.3125 11.9348 1.3125 7.36957C1.3125 4.12826 3.99917 1.5 7.3125 1.5C10.6258 1.5 13.3125 4.12826 13.3125 7.36957Z"
									stroke="#0E1954" stroke-width="1.5" stroke-linecap="round"
									stroke-linejoin="round" />
								<path
									d="M7.31217 9.97838C8.78493 9.97838 9.97884 8.81042 9.97884 7.36968C9.97884 5.92894 8.78493 4.76099 7.31217 4.76099C5.83941 4.76099 4.64551 5.92894 4.64551 7.36968C4.64551 8.81042 5.83941 9.97838 7.31217 9.97838Z"
									stroke="#0E1954" stroke-width="1.5" stroke-linecap="round"
									stroke-linejoin="round" />
							</svg>

							@if($user->address && $user->address->city)
								{{ $user->address->city->name }}
							@else
								<span class="text-jobboard-greige">{{ __('Not provided') }}</span>
							@endif
						</div>
					</div>
				</div>

				@if($user->hasRole(['adopter', 'breeder', 'professionnal_breeder', 'individual_breeder']))
					<div>
						@if($user->hasRole('applicant'))
							<a href="{{ route('space.profile.complete-my-profile', ['active' => 3]) }}">
						@elseif($user->hasRole('recruiter'))
							<a href="{{ route('space.profile.complete-my-profile') }}">
						@endif
							<div class="flex flex-row justify-end cursor-pointer font-bold text-jobboard-deepblue text-sm items-center gap-x-1">
								<svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path
										d="M7.26201 2.37054L2.39156 2.37054C2.02249 2.37054 1.66855 2.50668 1.40758 2.74901C1.14661 2.99134 1 3.32 1 3.66271L1 12.7078C1 13.0505 1.14661 13.3792 1.40758 13.6215C1.66855 13.8639 2.0225 14 2.39156 14L12.1325 14C12.5015 14 12.8555 13.8639 13.1164 13.6215C13.3774 13.3792 13.524 13.0505 13.524 12.7078L13.524 8.18527M12.4804 1.40142C12.7572 1.1444 13.1326 0.999999 13.524 0.999999C13.9155 0.999999 14.2909 1.1444 14.5677 1.40142C14.8445 1.65845 15 2.00705 15 2.37054C15 2.73403 14.8445 3.08264 14.5677 3.33966L7.95779 9.47743L5.17468 10.1235L5.87046 7.53919L12.4804 1.40142Z"
										stroke="#0E1954" stroke-width="1.5" stroke-linecap="round"
										stroke-linejoin="round" />
								</svg>

								{{ __('Update') }}
							</div>
						</a>
					</div>
				@endif
			</div>

			@if($user->hasRole('applicant'))
				<div class="p-6 border border-jobboard-greige rounded-md text-jobboard-deepblue mb-8 w-full">
					<div class="flex justify-between items-center">
						<h2 class="text-[28px] font-bold">{{ __('My house') }}</h2>

						<div>
							<a href="{{ route('space.profile.complete-my-profile', ['active' => 1]) }}">
								<div
									class="flex flex-row justify-end cursor-pointer font-bold text-jobboard-deepblue text-sm items-center gap-x-1">
									<svg width="16" height="15" viewBox="0 0 16 15" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path
											d="M7.26201 2.37054L2.39156 2.37054C2.02249 2.37054 1.66855 2.50668 1.40758 2.74901C1.14661 2.99134 1 3.32 1 3.66271L1 12.7078C1 13.0505 1.14661 13.3792 1.40758 13.6215C1.66855 13.8639 2.0225 14 2.39156 14L12.1325 14C12.5015 14 12.8555 13.8639 13.1164 13.6215C13.3774 13.3792 13.524 13.0505 13.524 12.7078L13.524 8.18527M12.4804 1.40142C12.7572 1.1444 13.1326 0.999999 13.524 0.999999C13.9155 0.999999 14.2909 1.1444 14.5677 1.40142C14.8445 1.65845 15 2.00705 15 2.37054C15 2.73403 14.8445 3.08264 14.5677 3.33966L7.95779 9.47743L5.17468 10.1235L5.87046 7.53919L12.4804 1.40142Z"
											stroke="#0E1954" stroke-width="1.5" stroke-linecap="round"
											stroke-linejoin="round" />
									</svg>

									{{ __('Update') }}
								</div>
							</a>
						</div>
					</div>
					<hr class="my-4">
					<div class="w-full mb-8">
						<x-front.space-subtitle>
							{{ __('I\'m interested by :') }}
						</x-front.space-subtitle>

						<div class="flex mt-4 gap-4 flex-wrap">
							<div class="w-full max-w-[360px] s:w-[268px]">
								@if($interestedIn == 'dogs')
									<label for="interested_in_dogs"
										class="block border rounded-xl bg-jobboard-cream border-jobboard-cream">
										<div>
											<h3
												class="h-[85px] s:h-[184px] flex flex-row gap-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center">
												<svg width="48" height="47" viewBox="0 0 48 47"
													fill="none" xmlns="http://www.w3.org/2000/svg">
													<circle cx="9" cy="37" r="8" fill="#FF7E71" />
													<ellipse cx="35.5" cy="8" rx="4.5"
														ry="5" fill="#FF7E71" />
													<path
														d="M34.4217 4.15137C34.4217 4.15137 35.401 6.63682 35.1165 11.8384C35.0675 12.7345 33.2167 12.5414 31.4848 12.0403C29.8629 11.5713 28.3655 10.8672 27.9987 9.53282C27.5085 7.74931 27.6374 4.78708 28.2232 3.34128M37.8833 18.5299C37.6487 15.8259 37.8833 15.0224 38.8471 14.6682C39.8109 14.3139 41.8729 15.0578 44.4775 13.6407C45.9993 12.8129 46.5051 10.9963 46.9108 9.83854C47.1865 9.05052 46.803 8.18525 46.0338 7.84974L41.9886 6.06071C41.9886 6.06071 41.3638 4.68113 40.29 3.32142C39.1117 1.82927 37.2975 0.978346 35.3877 1.00042C29.9474 1.06333 28.1421 2.33254 26.7848 6.12361C26.0967 7.7758 25.5253 9.60236 25.0451 11.2843C24.5382 13.0601 24.1402 15.6703 22.664 17.4295C18.9822 21.8133 8.29614 27.4408 7.94487 38.3627C7.94487 43.8898 11.7911 46 11.7911 46H27.2895C27.7575 46 28.1065 45.5751 28.0176 45.1182C27.6141 43.0499 26.3668 41.5787 24.2047 41.5787H20.5185C20.5185 41.5787 25.0039 36.3308 24.0446 32.021C23.6111 30.0753 22.156 28.9738 21.1499 28.7145M28.9936 26.7521C29.555 30.5443 31.1468 41.2101 31.5615 43.1857C32.0672 45.5972 33.6869 45.9989 33.6869 45.9989H39.0194C39.464 45.9989 39.8053 45.6148 39.7564 45.1756C39.6152 43.9218 38.9705 41.6781 36.158 41.6781L35.3777 27.8845C35.3777 27.8845 36.3259 26.6892 37.1908 24.994C38.1312 23.1498 38.129 21.3563 37.8844 18.5288M5.29252 37.2149C3.38718 35.2514 2.53012 32.2274 1.92539 30.498C1.69306 30.9063 1.46629 31.5354 1.28731 32.3102C-0.228949 38.9001 4.45213 45.3201 10.7162 45.8996L11.79 45.9989M30.2375 35.0285C27.8442 37.8594 25.6076 40.9463 23.8623 41.5776"
														stroke="#0E1954" stroke-width="2" stroke-linecap="round"
														stroke-linejoin="round" />
												</svg>

												{{ __('dogs') }}
											</h3>
										</div>
									</label>
								@elseif($interestedIn == 'cats')
									<label for="interested_in_cats"
										class="block border rounded-xl bg-jobboard-cream border-jobboard-cream">
										<div>
											<h3
												class="h-[85px] s:h-[184px] flex flex-row gap-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center">
												<svg width="43" height="46" viewBox="0 0 43 46"
													fill="none" xmlns="http://www.w3.org/2000/svg">
													<circle cx="8" cy="38" r="8" fill="#3DD8AC" />
													<ellipse cx="34.5" cy="9" rx="4.5"
														ry="5" fill="#3DD8AC" />
													<path
														d="M24.228 40.6197C24.228 40.6197 27.6264 40.0409 28.3541 34.6554C28.7216 32.1248 27.3086 29.5423 27.3086 29.5423M13.2396 44.3372H30.0073C30.3696 44.3372 30.6636 44.042 30.6636 43.6783V43.2106C30.6636 41.7858 29.5021 40.6197 28.0829 40.6197H24.229M28.2724 32.341L30.8365 42.6712C31.0797 43.6502 31.9555 44.3372 32.9596 44.3372H36.8663C37.2286 44.3372 37.5226 44.042 37.5226 43.6783V42.902C37.5226 41.6413 36.5051 40.6197 35.2494 40.6197L34.1583 30.489C34.1583 30.489 36.7742 27.3141 37.444 23.6995C37.9822 20.7917 36.4543 18.7339 37.2545 16.3852C37.6872 15.1163 38.9325 15.1994 39.9884 14.4927C41.0443 13.786 41.9387 11.4186 40.682 10.6069C39.6251 9.92413 39.507 6.72737 37.8984 5.91986C36.2897 5.11236 35.6366 4.79122 35.6366 4.79122C35.6873 2.72206 34.9275 1 34.9275 1C34.9275 1 31.7454 2.67321 28.9711 6.16097C28.2506 7.06617 27.554 8.3403 27.262 9.53025C26.7372 12.0079 27.496 16.9527 24.4226 18.1686C10.4426 23.6975 9.53064 30.4308 10.9002 40.1645M10.9002 40.1635C13.9632 40.1635 16.8948 40.2841 18.0521 40.5553C19.5107 40.8972 19.961 41.7068 19.9662 42.479C19.9703 43.2543 19.5221 43.9921 17.7923 44.1782C16.8721 44.2769 14.5108 44.3382 12.6134 44.3382C6.47896 44.3382 4.95312 43.6793 4.95312 42.0965C4.95312 40.5137 9.46232 39.3602 10.5016 36.4242"
														stroke="#0E1954" stroke-width="2" stroke-linecap="round"
														stroke-linejoin="round" />
												</svg>

												{{ __('cats') }}
											</h3>
										</div>
									</label>
								@elseif($interestedIn == 'both')
									<label for="interested_in_both"
										class="block border rounded-xl bg-jobboard-cream border-jobboard-cream">
										<div>
											<h3
												class="h-[85px] s:h-[184px] flex flex-row gap-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center">
												<svg width="103" height="47" viewBox="0 0 103 47"
													fill="none" xmlns="http://www.w3.org/2000/svg">
													<circle cx="9.03906" cy="37" r="8" fill="#FF7E71" />
													<ellipse cx="35.5391" cy="8" rx="4.5"
														ry="5" fill="#FF7E71" />
													<path
														d="M34.4607 4.15137C34.4607 4.15137 35.4401 6.63682 35.1555 11.8384C35.1066 12.7345 33.2557 12.5414 31.5238 12.0403C29.9019 11.5713 28.4046 10.8672 28.0377 9.53282C27.5475 7.74931 27.6765 4.78708 28.2623 3.34128M37.9224 18.5299C37.6878 15.8259 37.9224 15.0224 38.8861 14.6682C39.8499 14.3139 41.912 15.0578 44.5166 13.6407C46.0384 12.8129 46.5442 10.9963 46.9499 9.83854C47.2256 9.05052 46.8421 8.18525 46.0728 7.84974L42.0276 6.06071C42.0276 6.06071 41.4029 4.68113 40.329 3.32142C39.1507 1.82927 37.3365 0.978346 35.4268 1.00042C29.9864 1.06333 28.1811 2.33254 26.8238 6.12361C26.1357 7.7758 25.5644 9.60236 25.0841 11.2843C24.5772 13.0601 24.1793 15.6703 22.703 17.4295C19.0213 21.8133 8.33521 27.4408 7.98393 38.3627C7.98393 43.8898 11.8302 46 11.8302 46H27.3285C27.7965 46 28.1456 45.5751 28.0566 45.1182C27.6531 43.0499 26.4059 41.5787 24.2437 41.5787H20.5576C20.5576 41.5787 25.043 36.3308 24.0837 32.021C23.6501 30.0753 22.195 28.9738 21.189 28.7145M29.0327 26.7521C29.594 30.5443 31.1859 41.2101 31.6005 43.1857C32.1063 45.5972 33.726 45.9989 33.726 45.9989H39.0584C39.5031 45.9989 39.8444 45.6148 39.7955 45.1756C39.6543 43.9218 39.0095 41.6781 36.1971 41.6781L35.4167 27.8845C35.4167 27.8845 36.365 26.6892 37.2298 24.994C38.1703 23.1498 38.168 21.3563 37.9235 18.5288M5.33158 37.2149C3.42625 35.2514 2.56918 32.2274 1.96445 30.498C1.73212 30.9063 1.50535 31.5354 1.32638 32.3102C-0.189887 38.9001 4.49119 45.3201 10.7552 45.8996L11.8291 45.9989M30.2766 35.0285C27.8832 37.8594 25.6466 40.9463 23.9014 41.5776"
														stroke="#0E1954" stroke-width="2" stroke-linecap="round"
														stroke-linejoin="round" />
													<circle cx="8" cy="8" r="8"
														transform="matrix(-1 0 0 1 102.961 29)" fill="#3DD8AC" />
													<ellipse cx="4.5" cy="5" rx="4.5"
														ry="5" transform="matrix(-1 0 0 1 72.9609 3)"
														fill="#3DD8AC" />
													<path
														d="M79.1075 40.6197C79.1075 40.6197 75.709 40.0409 74.9813 34.6554C74.6138 32.1248 76.0268 29.5423 76.0268 29.5423M90.0958 44.3372H73.3281C72.9658 44.3372 72.6718 44.042 72.6718 43.6783V43.2106C72.6718 41.7858 73.8333 40.6197 75.2525 40.6197H79.1065M75.0631 32.341L72.499 42.6712C72.2557 43.6502 71.38 44.3372 70.3758 44.3372H66.4691C66.1068 44.3372 65.8128 44.042 65.8128 43.6783V42.902C65.8128 41.6413 66.8304 40.6197 68.0861 40.6197L69.1771 30.489C69.1771 30.489 66.5612 27.3141 65.8915 23.6995C65.3532 20.7917 66.8811 18.7339 66.0809 16.3852C65.6482 15.1163 64.4029 15.1994 63.347 14.4927C62.2912 13.786 61.3968 11.4186 62.6535 10.6069C63.7104 9.92413 63.8284 6.72737 65.4371 5.91986C67.0457 5.11236 67.6989 4.79122 67.6989 4.79122C67.6482 2.72206 68.408 1 68.408 1C68.408 1 71.5901 2.67321 74.3643 6.16097C75.0848 7.06617 75.7815 8.3403 76.0734 9.53025C76.5982 12.0079 75.8395 16.9527 78.9129 18.1686C92.8928 23.6975 93.8048 30.4308 92.4353 40.1645M92.4353 40.1635C89.3722 40.1635 86.4406 40.2841 85.2833 40.5553C83.8247 40.8972 83.3745 41.7068 83.3693 42.479C83.3651 43.2543 83.8134 43.9921 85.5431 44.1782C86.4634 44.2769 88.8246 44.3382 90.7221 44.3382C96.8565 44.3382 98.3823 43.6793 98.3823 42.0965C98.3823 40.5137 93.8731 39.3602 92.8338 36.4242"
														stroke="#0E1954" stroke-width="2" stroke-linecap="round"
														stroke-linejoin="round" />
												</svg>

												{{ __('dogs & cats') }}
											</h3>
										</div>
									</label>
								@endif
							</div>
						</div>
					</div>
					@if($placeConfiguration != '')
						<div class="w-full mb-8">
							<x-front.space-subtitle>
								{{ __('My home') }}
							</x-front.space-subtitle>

							<div class="flex mt-4 gap-4 flex-wrap">
								@if($placeConfiguration == 'house_with_garden')
									<div class="w-full max-w-[360px] s:max-w-[270px]">
										<label for="houseWithGarden"
											class="block border rounded-xl bg-jobboard-cream border-jobboard-cream">
											<div>
												<h3
													class="flex flex-row gap-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center lowercase h-[85px] s:h-[184px]">
													<svg width="69" height="47" viewBox="0 0 69 47"
														fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="8" cy="24" r="8" fill="#FFA244" />
														<ellipse cx="43.5" cy="7" rx="4.5"
															ry="5" fill="#FFA244" />
														<ellipse cx="23.5" cy="32" rx="4.5"
															ry="5" fill="#FFA244" />
														<path
															d="M26.6302 20.7125C26.704 20.4 26.7285 20.0625 26.7285 19.725C26.7285 17.2 25.0692 15.0625 22.7706 14.3875C23.0042 13.8 23.1148 13.1625 23.1148 12.4875C23.1148 9.40002 20.6564 6.90002 17.645 6.90002C14.6089 6.90002 12.1506 9.40002 12.1506 12.4875C12.1506 13.1625 12.2612 13.7875 12.4702 14.375C10.1839 15.05 8.5 17.2 8.5 19.725C8.5 21.5 9.32354 23.1 10.6142 24.1125C9.32354 25.1375 8.5 26.725 8.5 28.5125C8.5 31.5875 10.9583 34.0875 13.9944 34.0875C15.3956 34.0875 16.6617 33.5625 17.6204 32.6875C18.5914 33.5625 19.8698 34.0875 21.2464 34.0875C21.9471 34.0875 22.6231 33.95 23.25 33.7M17.6246 32.687V46M30.1579 16.6375C29.6662 15.8125 29.3958 14.85 29.3958 13.825C29.3958 11.3 31.0798 9.15 33.366 8.475C33.1571 7.8875 33.0464 7.2625 33.0464 6.5875C33.0464 3.5 35.5048 1 38.5408 1C41.5523 1 44.0106 3.5 44.0106 6.5875C44.0106 7.2625 43.9 7.9 43.6664 8.4875C45.6823 9.075 47.1941 10.7875 47.5506 12.9M33.3906 12.901H57.3594L67.5 24.5305M33.3906 12.901L42.9167 23.9132L43.5312 24.5305H67.5M33.3906 12.901L23.25 24.6235V46H43.5312V27.25M67.5 24.5305L67.5 46H42.9167M29.7031 45.9999V37.2259C29.7031 35.1549 31.3541 33.4759 33.3906 33.4759C35.4271 33.4759 37.0781 35.1549 37.0781 37.2259V45.9999M50.2917 12.9V8.5H55.2083V12.9M35.5417 24.75C35.5417 26.1307 34.441 27.25 33.0833 27.25C31.7256 27.25 30.625 26.1307 30.625 24.75C30.625 23.3693 31.7256 22.25 33.0833 22.25C34.441 22.25 35.5417 23.3693 35.5417 24.75Z"
															stroke="#0E1954" stroke-width="2" stroke-linecap="round"
															stroke-linejoin="round" />
													</svg>

													{{ __('A house with garden') }}
												</h3>
											</div>
										</label>
									</div>
								@elseif($placeConfiguration == 'house_without_garden')
									<div class="w-full max-w-[360px] s:max-w-[270px]">
										<label for="houseWithoutGarden"
											class="block border rounded-xl bg-jobboard-cream border-jobboard-cream">
											<div>
												<h3
													class="flex flex-row gap-4 s:flex-col items-center max-s:pl-4 s:justify-center text-center text-base font-medium lowercase h-[85px] s:h-[184px]">
													<svg width="60" height="50" viewBox="0 0 60 50"
														fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="14" cy="34" r="8" fill="#FFA244" />
														<ellipse cx="40.5" cy="5" rx="4.5"
															ry="5" fill="#FFA244" />
														<path
															d="M56.1935 23.3687V48.0625C56.1935 48.5781 55.7725 49 55.258 49H26.258M26.258 49V24.625M26.258 49L26.258 23.3687M26.258 49H4.74193C4.22742 49 3.80645 48.5781 3.80645 48.0625V24.625M41.3659 4H17.6049C17.3675 4 17.139 4.09188 16.9665 4.25688L1.29173 19.2569C0.682547 19.8398 1.09098 20.875 1.9301 20.875H23.3562C23.597 20.875 23.8285 20.7805 24.0017 20.6112L40.7276 4.26231C41.0834 3.9145 41.6483 3.9145 42.0041 4.26231L59 20.8748M35.6129 45.25V31.1875C35.6129 30.6698 36.0318 30.25 36.5484 30.25H45.9032C46.4198 30.25 46.8387 30.6698 46.8387 31.1875V45.25M12.2258 30.25H17.8387C18.3553 30.25 18.7742 30.6698 18.7742 31.1875V36.8125C18.7742 37.3303 18.3553 37.75 17.8387 37.75H12.2258C11.7091 37.75 11.2903 37.3303 11.2903 36.8125V31.1875C11.2903 30.6698 11.7091 30.25 12.2258 30.25Z"
															stroke="#0E1954" stroke-width="2" stroke-linecap="round"
															stroke-linejoin="round" />
													</svg>

													{{ __('A house without garden') }}
												</h3>
											</div>
										</label>
									</div>
								@elseif($placeConfiguration == 'flat')
									<div class="w-full max-w-[360px] s:max-w-[270px]">
										<label for="flat"
											class="block border rounded-xl bg-jobboard-cream border-jobboard-cream">
											<div>
												<h3
													class="flex flex-row gap-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium lowercase h-[85px] s:h-[184px]">
													<svg width="47" height="48" viewBox="0 0 47 48"
														fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="23.5" cy="40" r="8" fill="#FFA244" />
														<ellipse cx="33" cy="18" rx="4.5"
															ry="5" fill="#FFA244" />
														<path
															d="M26.4348 30.3478V32.3043M20.5652 30.3478V32.3043M20.5652 46V36.2174H26.4348V46M14.6957 30.3478V32.3043M32.3043 30.3478V32.3043M26.4348 22.5217V24.4783M20.5652 22.5217V24.4783M14.6957 22.5217V24.4783M32.3043 22.5217V24.4783M26.4348 14.6957V16.6522M20.5652 14.6957V16.6522M14.6957 14.6957V16.6522M32.3043 14.6957V16.6522M26.4348 6.86956V8.82609M20.5652 6.86956V8.82609M14.6957 6.86956V8.82609M32.3043 6.86956V8.82609M14.6957 38.1739V40.1304M32.3043 38.1739V40.1304M38.1739 46V1H8.82609V46M1 46H46"
															stroke="#0E1954" stroke-width="2" stroke-linecap="round"
															stroke-linejoin="round" />
													</svg>

													{{ __('A flat') }}
												</h3>
											</div>
										</label>
									</div>
								@endif
							</div>
						</div>
					@endif
					@if(!empty($householdComposition))
						<div class="w-full mb-8">
							<x-front.space-subtitle>
								{{ __('My household composition') }}
							</x-front.space-subtitle>

							<div class="flex mt-4 gap-4 flex-wrap">
								@foreach($householdComposition as $householdCompositionEntry)
									@if($householdCompositionEntry == 'young_children')
										<div class="w-full max-w-[360px] s:max-w-[268px]">
											<label for="youngChildren"
												class="block border rounded-xl bg-jobboard-cream border-jobboard-cream">
												<div>
													<h3
														class="flex flex-row gap-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px] s:h-[184px]">
														<svg width="40" height="47" viewBox="0 0 40 47"
															fill="none" xmlns="http://www.w3.org/2000/svg">
															<circle cx="8.75" cy="37" r="8"
																fill="#FFA244" />
															<ellipse cx="35.25" cy="8" rx="4.5"
																ry="5" fill="#FFA244" />
															<path
																d="M28.0106 25.2646V21.0865L37.579 13.5013C38.6914 12.6204 38.9557 11.015 38.1825 9.81172C37.3343 8.49545 35.5792 8.16638 34.3297 9.09043L28.8164 13.1656C26.6078 14.7976 23.9457 15.6784 21.2152 15.6784H21.0357C18.3052 15.6784 15.6464 14.7976 13.4345 13.1656L7.9212 9.09043C6.67173 8.16638 4.91334 8.49545 4.0684 9.81172C3.29523 11.015 3.55621 12.6171 4.67193 13.5013L14.2403 21.0865V25.2646M28.0106 25.2646V29.7353M28.0106 25.2646H14.2436V29.7719M14.2436 29.7719L18.5498 33.6276M14.2436 29.7719L11.2129 34.8874C10.1755 36.6358 10.2244 38.8396 11.3369 40.5414L14.0707 44.7196C14.9352 46.0392 16.6871 46.3982 17.9822 45.5173C19.2806 44.6365 19.6297 42.8515 18.7652 41.5319L16.1944 37.6031L18.5498 33.6276M18.5498 33.6276H23.7239L28.0106 29.7353M28.0106 29.7353L31.0641 34.8841C32.1015 36.6325 32.0526 38.8362 30.9401 40.5381L28.2063 44.7163C27.3418 46.0359 25.5899 46.3948 24.2948 45.514C22.9964 44.6332 22.6473 42.8482 23.5118 41.5286L26.0825 37.5997L23.7271 33.6243M26.7644 7.00966C26.7644 10.3287 24.2405 13.0193 21.1271 13.0193C18.0137 13.0193 15.4898 10.3287 15.4898 7.00966C15.4898 3.69061 18.0137 1 21.1271 1C24.2405 1 26.7644 3.69061 26.7644 7.00966Z"
																stroke="#0E1954" stroke-width="2"
																stroke-linecap="round" stroke-linejoin="round" />
														</svg>

														<span
															class="s:hidden">{{ __('Young children (From 0 to 4 years old)') }}</span>
														<span
															class="max-s:hidden">{{ __('Young children') }}<br>{{ __('(from 0 to 4 years old)') }}</span>
													</h3>
												</div>
											</label>
										</div>
									@endif

									@if($householdCompositionEntry == 'children')
										<div class="w-full max-w-[360px] s:max-w-[268px]">
											<label for="children"
												class="block border rounded-xl bg-jobboard-cream border-jobboard-cream">
												<div>
													<h3
														class="flex flex-row gap-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px] s:h-[184px]">
														<svg width="43" height="47" viewBox="0 0 43 47"
															fill="none" xmlns="http://www.w3.org/2000/svg">
															<circle cx="8" cy="8" r="8"
																transform="matrix(1 0 0 -1 12.75 19)"
																fill="#FFA244" />
															<ellipse cx="4.5" cy="5" rx="4.5"
																ry="5" transform="matrix(1 0 0 -1 33.75 19)"
																fill="#FFA244" />
															<path
																d="M13.3536 46L12.8785 34.1305V23.4802L2.36361 14.5386C1.23304 13.5779 1.04661 11.8905 1.93664 10.6987C2.81464 9.52206 4.44435 9.23627 5.66512 10.045L12.0517 14.2771C13.6904 15.3625 15.6057 15.9432 17.5662 15.9432H22.1156C24.061 15.9432 25.9673 15.3717 27.6 14.2984L34.0888 10.0328C35.3066 9.23019 36.9333 9.51902 37.8083 10.6926L37.8143 10.6987C38.7043 11.8905 38.5149 13.5779 37.3873 14.5386L26.8724 23.4802V34.1305L25.838 46M19.5868 35.7085V44.8325M24.6774 6.2689C24.6774 9.17883 22.5262 11.5378 19.8725 11.5378C17.2188 11.5378 15.0675 9.17883 15.0675 6.2689C15.0675 3.35897 17.2188 1 19.8725 1C22.5262 1 24.6774 3.35897 24.6774 6.2689Z"
																stroke="#0E1954" stroke-width="2"
																stroke-linecap="round" stroke-linejoin="round" />
														</svg>

														<span
															class="s:hidden">{{ __('Children (from 5 to 12 years old)') }}</span>
														<span
															class="max-s:hidden">{{ __('Children') }}<br>{{ __('(from 5 to 12 years old)') }}</span>
													</h3>
												</div>
											</label>
										</div>
									@endif

									@if($householdCompositionEntry == 'teenagers')
										<div class="w-full max-w-[360px] s:max-w-[268px]">
											<label for="teenagers"
												class="block border rounded-xl bg-jobboard-cream border-jobboard-cream">
												<div>
													<h3
														class="flex flex-row gap-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px] s:h-[184px]">
														<svg width="26" height="48" viewBox="0 0 26 48"
															fill="none" xmlns="http://www.w3.org/2000/svg">
															<circle cx="12" cy="8" r="8"
																fill="#FFA244" />
															<ellipse cx="5.5" cy="32" rx="4.5"
																ry="5" fill="#FFA244" />
															<path
																d="M6.00125 34.0752H5.18696C3.08113 34.0752 1.375 32.4121 1.375 30.3603V24.2925C1.375 20.2005 4.7813 16.8802 8.98102 16.8802H16.769C20.9687 16.8802 24.375 20.1976 24.375 24.2925V30.3632C24.375 32.415 22.6689 34.0781 20.563 34.0781H19.5012M6.29952 24.6549V37.0039L6.97064 47M19.4445 24.6549V37.0039L18.7764 47M12.8735 38.2286V47M18.1619 7.568C18.1619 10.6431 15.7942 13.136 12.8735 13.136C9.9528 13.136 7.58509 10.6431 7.58509 7.568C7.58509 4.49288 9.9528 2 12.8735 2C15.7942 2 18.1619 4.49288 18.1619 7.568Z"
																stroke="#0E1954" stroke-width="2"
																stroke-linecap="round" stroke-linejoin="round" />
														</svg>

														<span
															class="s:hidden">{{ __('Teenagers (+ than 12 years old)') }}</span>
														<span
															class="max-s:hidden">{{ __('Teenagers') }}<br>{{ __('(+ than 12 years old)') }}</span>
													</h3>
												</div>
											</label>
										</div>
									@endif

									@if($householdCompositionEntry == 'adult')
										<div class="w-full max-w-[360px] s:max-w-[268px]">
											<label for="adult"
												class="block border rounded-xl bg-jobboard-cream border-jobboard-cream">
												<div>
													<h3
														class="flex flex-row s:flex-col items-center max-s:pl-4 s:justify-center gap-4 text-base font-medium text-center h-[85px] s:h-[184px]">
														<svg width="62" height="47" viewBox="0 0 62 47"
															fill="none" xmlns="http://www.w3.org/2000/svg">
															<circle cx="9.375" cy="16" r="8"
																fill="#FFA244" />
															<ellipse cx="35.875" cy="11" rx="4.5"
																ry="5" fill="#FFA244" />
															<ellipse cx="51.875" cy="16" rx="4.5"
																ry="5" fill="#FFA244" />
															<path
																d="M10.9078 36.5647V46M5.24619 20.7554V33.4229L5.97268 46M16.5694 20.7554V33.4229L15.8429 46M33.246 36.5647V46M37.7578 46L38.2663 36.5647H41.28L37.2442 19.7601M28.7318 46L28.2257 36.5647H25.2121L29.2478 19.7601M4.98817 31.6836H4.28422C2.47051 31.6836 1 30.2183 1 28.4112V19.7776C1 16.289 3.81827 13.464 7.29539 13.464H14.678C17.5364 13.464 20.034 15.3943 20.7655 18.164L22.9524 26.4658L25.1244 18.2746C25.8759 15.437 28.4437 13.464 31.3822 13.464H34.932C37.9131 13.464 40.4959 15.5174 41.1547 18.4129L42.8081 25.6716C43.2816 27.7527 41.776 29.7332 39.6767 29.884M36.0192 11.2522H37.8955C38.136 11.2522 38.3014 11.0084 38.2062 10.7872C37.8204 9.89494 37.5974 8.93985 37.5473 7.96464C37.4972 6.9995 37.4371 5.93884 37.402 5.66488C37.124 3.46062 35.3704 1.76156 33.246 1.76156C31.1217 1.76156 29.3681 3.46062 29.09 5.66488C29.0549 5.93884 28.9948 6.9995 28.9447 7.96464C28.8946 8.93733 28.6692 9.89243 28.2859 10.7872C28.1907 11.0084 28.356 11.2522 28.5965 11.2522H30.4728M55.1709 44.2306L55.8223 37.462H58.1996L56.0051 21.155M50.6467 37.462V44.2306M44.0331 15.5149C44.2035 15.3716 44.3763 15.2359 44.5592 15.1052C45.6314 14.3412 46.8764 13.8737 48.1716 13.6952M57.4005 30.5627H58.3299C59.9607 30.5627 61.2108 29.1124 60.9703 27.4938C60.5645 24.7391 60.1261 21.7507 60.0033 20.871C59.6225 18.1138 58.41 16.3041 56.7241 15.1052C55.6544 14.3437 54.4144 13.8762 53.1192 13.6952M54.6774 9.75168C54.6949 9.90751 54.7025 10.0684 54.7025 10.2292C54.7025 12.6471 52.8862 14.6051 50.6467 14.6051C48.4071 14.6051 46.5883 12.6471 46.5883 10.2292C46.5883 10.0734 46.5959 9.91756 46.6134 9.76424M15.1014 6.28066C15.1014 8.77372 13.2238 10.7947 10.9078 10.7947C8.59173 10.7947 6.7142 8.77372 6.7142 6.28066C6.7142 3.78761 8.59173 1.76659 10.9078 1.76659C13.2238 1.76659 15.1014 3.78761 15.1014 6.28066ZM53.1292 4.44085H53.1493C53.237 4.18448 53.2846 3.9055 53.2846 3.61897C53.2846 2.17376 52.1046 1 50.6492 1C49.1937 1 48.0113 2.17376 48.0113 3.61897C48.0113 3.89796 48.0563 4.16689 48.139 4.41823H48.149C46.666 5.09685 45.8042 6.77329 46.2401 8.44219C46.438 9.20124 46.5883 9.78184 46.5883 9.78184L50.6441 7.04725L54.7 9.76424L55.0457 8.51005C55.5066 6.82859 54.6423 5.1245 53.1292 4.43834V4.44085Z"
																stroke="#0E1954" stroke-width="2"
																stroke-linecap="round" stroke-linejoin="round" />
														</svg>

														<span
															class="s:hidden">{{ __('Partner, spouse, adult') }}</span>
														<span
															class="max-s:hidden">{{ __('Partner,') }}<br>{{ __('spouse, adult') }}</span>
													</h3>
												</div>
											</label>
										</div>
									@endif
								@endforeach
							</div>
						</div>
					@endif
					@if(!empty($homeAnimals))
						<div class="w-full">
							<x-front.space-subtitle>
								{{ __('Animals in my home') }}
							</x-front.space-subtitle>

							<div class="flex mt-4 gap-4 flex-wrap">
								@foreach($homeAnimals as $homeAnimalsEntry)
									@if($homeAnimalsEntry == 'dogs')
										<div class="w-full max-w-[360px] s:max-w-[268px]">
											<label for="dogs"
												class="block border rounded-xl  bg-jobboard-cream border-jobboard-cream">
												<div>
													<h3
														class="flex flex-row gap-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px] s:h-[184px]">
														<svg width="49" height="47" viewBox="0 0 49 47"
															fill="none" xmlns="http://www.w3.org/2000/svg">
															<circle cx="9.1875" cy="38" r="8"
																fill="#FF7E71" />
															<ellipse cx="35.6875" cy="9" rx="4.5"
																ry="5" fill="#FF7E71" />
															<path
																d="M34.9842 4.15137C34.9842 4.15137 35.9635 6.63682 35.679 11.8384C35.63 12.7345 33.7792 12.5414 32.0473 12.0403C30.4254 11.5713 28.928 10.8672 28.5612 9.53282C28.071 7.74931 28.1999 4.78708 28.7857 3.34128M38.4458 18.5299C38.2112 15.8259 38.4458 15.0224 39.4096 14.6682C40.3734 14.3139 42.4354 15.0578 45.04 13.6407C46.5618 12.8129 47.0676 10.9963 47.4734 9.83854C47.749 9.05053 47.3655 8.18525 46.5963 7.84974L42.551 6.06071C42.551 6.06071 41.9263 4.68113 40.8525 3.32142C39.6741 1.82927 37.86 0.978346 35.9502 1.00042C30.5099 1.06333 28.7046 2.33254 27.3473 6.12361C26.6592 7.7758 26.0878 9.60236 25.6076 11.2843C25.1007 13.0601 24.7027 15.6703 23.2265 17.4295C19.5447 21.8133 8.85864 27.4408 8.50737 38.3627C8.50737 43.8898 12.3536 46 12.3536 46H27.852C28.32 46 28.669 45.5751 28.5801 45.1182C28.1766 43.0499 26.9293 41.5787 24.7672 41.5787H21.081C21.081 41.5787 25.5664 36.3308 24.6071 32.021C24.1736 30.0753 22.7185 28.9738 21.7124 28.7145M29.5561 26.7521C30.1175 30.5443 31.7093 41.2101 32.124 43.1857C32.6297 45.5972 34.2494 45.9989 34.2494 45.9989H39.5819C40.0265 45.9989 40.3678 45.6148 40.3189 45.1756C40.1777 43.9218 39.533 41.6781 36.7205 41.6781L35.9402 27.8845C35.9402 27.8845 36.8884 26.6892 37.7533 24.994C38.6937 23.1498 38.6915 21.3563 38.4469 18.5288M5.85502 37.2149C3.94968 35.2514 3.09262 32.2274 2.48789 30.498C2.25556 30.9063 2.02879 31.5354 1.84981 32.3102C0.333551 38.9001 5.01463 45.3201 11.2787 45.8996L12.3525 45.9989M30.8 35.0285C28.4067 37.8594 26.1701 40.9463 24.4248 41.5776"
																stroke="#0E1954" stroke-width="2"
																stroke-linecap="round" stroke-linejoin="round" />
														</svg>

														{{ __('Dog(s)') }}
													</h3>
												</div>
											</label>
										</div>
									@endif

									@if($homeAnimalsEntry == 'cats')
										<div class="w-full max-w-[360px] s:max-w-[268px]">
											<label for="cats"
												class="block border rounded-xl bg-jobboard-cream border-jobboard-cream">
												<div>
													<h3
														class="flex flex-row gap-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px] s:h-[184px]">
														<svg width="43" height="46" viewBox="0 0 43 46"
															fill="none" xmlns="http://www.w3.org/2000/svg">
															<circle cx="8.47656" cy="38" r="8"
																fill="#3DD8AC" />
															<ellipse cx="34.9766" cy="9" rx="4.5"
																ry="5" fill="#3DD8AC" />
															<path
																d="M24.7045 40.6197C24.7045 40.6197 28.103 40.0409 28.8307 34.6554C29.1982 32.1248 27.7852 29.5423 27.7852 29.5423M13.7162 44.3372H30.4839C30.8462 44.3372 31.1402 44.042 31.1402 43.6783V43.2106C31.1402 41.7858 29.9787 40.6197 28.5595 40.6197H24.7056M28.7489 32.341L31.313 42.6712C31.5563 43.6502 32.4321 44.3372 33.4362 44.3372H37.3429C37.7052 44.3372 37.9992 44.042 37.9992 43.6783V42.902C37.9992 41.6413 36.9816 40.6197 35.726 40.6197L34.6349 30.489C34.6349 30.489 37.2508 27.3141 37.9205 23.6995C38.4588 20.7917 36.9309 18.7339 37.7311 16.3852C38.1638 15.1163 39.4091 15.1994 40.465 14.4927C41.5208 13.786 42.4152 11.4186 41.1585 10.6069C40.1016 9.92413 39.9836 6.72737 38.375 5.91986C36.7663 5.11236 36.1131 4.79122 36.1131 4.79122C36.1638 2.72206 35.404 1 35.404 1C35.404 1 32.2219 2.67321 29.4477 6.16097C28.7272 7.06617 28.0305 8.3403 27.7386 9.53025C27.2138 12.0079 27.9726 16.9527 24.8991 18.1686C10.9192 23.6975 10.0072 30.4308 11.3767 40.1645M11.3767 40.1635C14.4398 40.1635 17.3714 40.2841 18.5287 40.5553C19.9873 40.8972 20.4376 41.7068 20.4427 42.479C20.4469 43.2543 19.9986 43.9921 18.2689 44.1782C17.3486 44.2769 14.9874 44.3382 13.0899 44.3382C6.95553 44.3382 5.42969 43.6793 5.42969 42.0965C5.42969 40.5137 9.93888 39.3602 10.9782 36.4242"
																stroke="#0E1954" stroke-width="2"
																stroke-linecap="round" stroke-linejoin="round" />
														</svg>

														{{ __('Cat(s)') }}
													</h3>
												</div>
											</label>
										</div>
									@endif

									@if($homeAnimalsEntry == 'others')
										<div class="w-full max-w-[360px] s:max-w-[268px]">
											<label for="others"
												class="block border rounded-xl bg-jobboard-cream border-jobboard-cream">
												<div>
													<h3
														class="flex flex-row gap-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px] s:h-[184px]">
														<svg width="119" height="48" viewBox="0 0 119 48"
															fill="none" xmlns="http://www.w3.org/2000/svg">
															<circle cx="37.7726" cy="40" r="8"
																fill="#FFA244" />
															<circle cx="12.7726" cy="11" r="8"
																fill="#FFA244" />
															<circle cx="105.773" cy="32" r="8"
																fill="#FFA244" />
															<ellipse cx="64.2726" cy="11" rx="4.5"
																ry="5" fill="#FFA244" />
															<path
																d="M12.9964 20.4347C15.0519 22.8802 14.8486 27.3776 12.3814 31.6264C9.40285 36.7564 1.67126 37.046 1.67126 37.046C1.67126 37.046 6.44003 21.2941 7.30724 18.9097C8.17445 16.5253 10.7037 15.1521 13.088 15.8753M23.9403 16.1597C25.2673 14.6295 24.7386 10.6433 21.6816 9.86682C21.2244 6.32645 16.8448 5.67038 14.6122 6.69986C11.9399 7.93175 10.4559 5.31006 10.4559 5.31006M23.9403 16.1589C22.7861 14.0912 20.1339 15.3056 20.1339 15.3056C20.1339 15.3056 21.9119 21.4703 20.5675 26.3638C18.8322 32.6786 12.2749 31.8044 12.2749 31.8044M13.0148 35.8394V41.69M7.10658 35.8394H23.4867M13.259 31.8436C14.2196 34.0954 14.7143 35.8054 14.7143 35.8054M7.30811 18.9097C9.93067 10.8457 11.2646 7.94222 14.6131 6.69899M4.1996 36.7424L2.7688 40.7626C2.56377 41.3393 3.23206 41.8619 3.8864 41.6359L5.14009 41.2032C6.17743 40.8446 6.97397 40.11 7.31248 39.1983L8.5592 35.8386"
																stroke="#0E1954" stroke-width="2"
																stroke-linecap="round" stroke-linejoin="round" />
															<path
																d="M64.9825 25.2439C66.6899 29.4968 66.4964 32.1169 64.8201 34.4478C63.1439 36.7777 62.2085 37.6194 62.9181 39.496C63.6277 41.3727 64.8083 40.5881 66.6899 41.8831C67.6017 42.5112 67.8823 43.45 67.9533 44.5647C68.0027 45.3417 67.3942 46 66.619 46H60.9838M60.9838 46H43.315M60.9838 46V45.6763C60.9838 43.5676 59.2807 41.8583 57.1797 41.8583H55.3745C57.3088 40.6291 58.4055 37.9755 57.6958 34.4802C57.0443 31.2676 53.3961 28.7662 49.1049 29.3381M43.315 46C36.6734 46 34.8294 43.1522 34.6359 40.1748C34.4424 37.1975 36.6541 36.809 36.6541 36.809C36.6541 36.809 38.5324 36.8791 39.1808 39.155M43.315 46C43.315 46 38.9303 43.4112 38.9303 36.3568C38.9303 29.3025 44.8192 23.7719 52.3424 22.1187M62.5515 24.5748C63.7955 25.3119 65.7609 25.4112 67.9275 24.6439C70.0876 23.8788 71.023 22.6129 71.4283 21.7022C71.6896 21.1151 71.6864 20.445 71.4348 19.8547C70.5768 17.8442 67.9834 12.4572 63.4385 11.814C62.1085 11.6263 60.9548 11.7881 59.9656 12.1421C59.7871 10.8849 58.5592 4.04856 49.4888 4.04856C49.4888 4.04856 46.7674 11.5356 55.7787 15.4647H55.7798C55.6895 16.2104 56.0411 21.3072 52.3413 22.1198M52.1553 4.26871C52.0671 3.70216 51.8768 2.00899 52.5531 1C53.3735 1 61.787 1 63.1514 11.2356"
																stroke="#0E1954" stroke-width="2"
																stroke-linecap="round" stroke-linejoin="round" />
															<path
																d="M104.536 33.3973C101.206 34.0632 102.626 37.3381 102.626 37.3381C102.626 37.3381 109.289 38.9028 110.574 32.3033M94.5321 28.4801C95.8227 30.4614 99.0722 33.8985 105.882 33.3371C112.018 32.8315 115.398 29.6525 117.02 27.4725C117.897 26.2948 117.813 24.6473 116.807 23.5795C114.85 21.5023 110.912 18.38 104.915 18.38C98.2719 18.38 93.8216 22.0707 93.8216 22.0707C93.8216 22.0707 89.6855 13.951 81.8613 15.968C81.8613 15.968 80.9385 19.6352 82.7316 22.5388C84.5238 25.4423 80.2306 30.8345 82.5839 36.0001C82.5839 36.0001 90.27 36.0001 94.8058 28.8785M111.903 31.7236C107.254 30.1285 107.559 24.8313 109.644 22.8804M111.45 19.752C110.054 15.2053 108.157 9.15935 99.8112 9.51499C99.4098 9.53243 99.0135 9.64051 98.6656 9.84362C96.9744 10.833 98.9281 12.2956 97.1073 14.066C95.0907 16.0264 94.5675 18.5526 97.1073 20.1181M106.043 18.38C106.043 18.38 105.927 15.1975 103.422 13.0104M91.7229 26.7429C89.8556 27.3835 87.3028 30.091 81.9088 31.4525M83.0717 23.3206C83.0717 23.3206 84.0809 22.4324 89.6933 23.3206"
																stroke="#0E1954" stroke-width="2"
																stroke-linecap="round" stroke-linejoin="round" />
														</svg>

														{{ __('Others') }}
													</h3>
												</div>
											</label>
										</div>
									@endif

									@if($homeAnimalsEntry == 'none')
										<div class="w-full max-w-[360px] s:max-w-[268px]">
											<label for="none"
												class="block border rounded-xl bg-jobboard-cream border-jobboard-cream">
												<div>
													<h3
														class="flex flex-row gap-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px] s:h-[184px]">
														<svg width="48" height="47" viewBox="0 0 48 47"
															fill="none" xmlns="http://www.w3.org/2000/svg">
															<circle cx="24.499" cy="25" r="8"
																fill="#FFA244" />
															<path
																d="M16.8832 30.7409L31.3649 16.2591M16.8832 16.2591L31.3649 30.7409M46.624 23.5C46.624 35.9264 36.5504 46 24.124 46C11.6976 46 1.62402 35.9264 1.62402 23.5C1.62402 11.0736 11.6976 1 24.124 1C36.5504 1 46.624 11.0736 46.624 23.5Z"
																stroke="#0E1954" stroke-width="2"
																stroke-linecap="round" stroke-linejoin="round" />
														</svg>

														{{ __('None') }}
													</h3>
												</div>
											</label>
										</div>
									@endif
								@endforeach
							</div>
						</div>
					@endif
				</div>

				<div class="p-6 border border-jobboard-greige rounded-md text-jobboard-deepblue w-full">
					<div class="flex justify-between items-center">
						<h2 class="text-[28px] font-bold">{{ __('My project') }}</h2>

						<div>
							<a href="{{ route('space.profile.complete-my-profile', ['active' => 2]) }}">
								<div
									class="flex flex-row justify-end cursor-pointer font-bold text-jobboard-deepblue text-sm items-center gap-x-1">
									<svg width="16" height="15" viewBox="0 0 16 15" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path
											d="M7.26201 2.37054L2.39156 2.37054C2.02249 2.37054 1.66855 2.50668 1.40758 2.74901C1.14661 2.99134 1 3.32 1 3.66271L1 12.7078C1 13.0505 1.14661 13.3792 1.40758 13.6215C1.66855 13.8639 2.0225 14 2.39156 14L12.1325 14C12.5015 14 12.8555 13.8639 13.1164 13.6215C13.3774 13.3792 13.524 13.0505 13.524 12.7078L13.524 8.18527M12.4804 1.40142C12.7572 1.1444 13.1326 0.999999 13.524 0.999999C13.9155 0.999999 14.2909 1.1444 14.5677 1.40142C14.8445 1.65845 15 2.00705 15 2.37054C15 2.73403 14.8445 3.08264 14.5677 3.33966L7.95779 9.47743L5.17468 10.1235L5.87046 7.53919L12.4804 1.40142Z"
											stroke="#0E1954" stroke-width="1.5" stroke-linecap="round"
											stroke-linejoin="round" />
									</svg>

									{{ __('Update') }}
								</div>
							</a>
						</div>
					</div>

					<hr class="my-4">

					@if($adoptionProject != '')
						<div class="w-full mb-8">
							<x-front.space-subtitle>
								{{ __('My adoption project') }}
							</x-front.space-subtitle>

							<div class="flex mt-4 gap-4 flex-wrap">
								@if($adoptionProject == 'looking_for_dog')
									<div class="w-full max-w-[360px] s:max-w-[268px]">
										<label for="lookingForDog"
											class="block border rounded-xl bg-jobboard-cream border-jobboard-cream">
											<div>
												<h3
													class="flex flex-row gap-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px] s:h-[184px]">
													<svg width="50" height="47" viewBox="0 0 50 47"
														fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="13" cy="39" r="8" fill="#FF7E71" />
														<ellipse cx="39.5" cy="10" rx="4.5"
															ry="5" fill="#FF7E71" />
														<path
															d="M36.4217 4.15137C36.4217 4.15137 37.401 6.63682 37.1165 11.8384C37.0675 12.7345 35.2167 12.5414 33.4848 12.0403C31.8629 11.5713 30.3655 10.8672 29.9987 9.53282C29.5085 7.74931 29.6374 4.78708 30.2232 3.34128M39.8833 18.5299C39.6487 15.8259 39.8833 15.0224 40.8471 14.6682C41.8109 14.3139 43.8729 15.0578 46.4775 13.6407C47.9993 12.8129 48.5051 10.9963 48.9108 9.83854C49.1865 9.05052 48.803 8.18525 48.0338 7.84974L43.9886 6.06071C43.9886 6.06071 43.3638 4.68113 42.29 3.32142C41.1117 1.82927 39.2975 0.978346 37.3877 1.00042C31.9474 1.06333 30.1421 2.33254 28.7848 6.12361C28.0967 7.7758 27.5253 9.60236 27.0451 11.2843C26.5382 13.0601 26.1402 15.6703 24.664 17.4295C20.9822 21.8133 10.2961 27.4408 9.94487 38.3627C9.94487 43.8898 13.7911 46 13.7911 46H29.2895C29.7575 46 30.1065 45.5751 30.0176 45.1182C29.6141 43.0499 28.3668 41.5787 26.2047 41.5787H22.5185C22.5185 41.5787 27.0039 36.3308 26.0446 32.021C25.6111 30.0753 24.156 28.9738 23.1499 28.7145M30.9936 26.7521C31.555 30.5443 33.1468 41.2101 33.5615 43.1857C34.0672 45.5972 35.6869 45.9989 35.6869 45.9989H41.0194C41.464 45.9989 41.8053 45.6148 41.7564 45.1756C41.6152 43.9218 40.9705 41.6781 38.158 41.6781L37.3777 27.8845C37.3777 27.8845 38.3259 26.6892 39.1908 24.994C40.1312 23.1498 40.129 21.3563 39.8844 18.5288M7.29252 37.2149C5.38718 35.2514 4.53012 32.2274 3.92539 30.498C3.69306 30.9063 3.46629 31.5354 3.28731 32.3102C1.77105 38.9001 6.45213 45.3201 12.7162 45.8996L13.79 45.9989M32.2375 35.0285C29.8442 37.8594 27.6076 40.9463 25.8623 41.5776"
															stroke="#0E1954" stroke-width="2" stroke-linecap="round"
															stroke-linejoin="round" />
														<path
															d="M13.5 33C16.8152 33 19.9946 31.683 22.3388 29.3388C24.683 26.9946 26 23.8152 26 20.5C26 17.1848 24.683 14.0054 22.3388 11.6612C19.9946 9.31696 16.8152 8 13.5 8C10.1848 8 7.00537 9.31696 4.66117 11.6612C2.31696 14.0054 1 17.1848 1 20.5C1 23.8152 2.31696 26.9946 4.66117 29.3388C7.00537 31.683 10.1848 33 13.5 33Z"
															fill="white" stroke="#0E1954" stroke-width="2"
															stroke-linecap="round" stroke-linejoin="round" />
														<path
															d="M12.5385 24.3463C13.8135 24.3463 15.0364 23.8398 15.938 22.9382C16.8396 22.0366 17.3462 20.8137 17.3462 19.5386C17.3462 18.2636 16.8396 17.0407 15.938 16.1391C15.0364 15.2375 13.8135 14.731 12.5385 14.731C11.2634 14.731 10.0405 15.2375 9.13891 16.1391C8.2373 17.0407 7.73077 18.2636 7.73077 19.5386C7.73077 20.8137 8.2373 22.0366 9.13891 22.9382C10.0405 23.8398 11.2634 24.3463 12.5385 24.3463Z"
															fill="white" stroke="#0E1954" stroke-width="2"
															stroke-linecap="round" stroke-linejoin="round" />
														<path d="M19.2692 26.2693L15.9423 22.9424" stroke="#0E1954"
															stroke-width="2" stroke-linecap="round"
															stroke-linejoin="round" />
													</svg>

													{{ __('Looking for a dog') }}
												</h3>
											</div>
										</label>
									</div>
								@elseif($adoptionProject == 'thinking_about_dog')
									<div class="w-full max-w-[360px] s:max-w-[268px]">
										<label for="thinkingAboutDog"
											class="block border rounded-xl bg-jobboard-cream border-jobboard-cream">
											<div>
												<h3
													class="flex flex-row gap-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px] s:h-[184px]">
													<svg width="51" height="47" viewBox="0 0 51 47"
														fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="13.2861" cy="39" r="8" fill="#FF7E71" />
														<ellipse cx="39.7861" cy="10" rx="4.5"
															ry="5" fill="#FF7E71" />
														<path
															d="M36.7078 4.15137C36.7078 4.15137 37.6872 6.63682 37.4026 11.8384C37.3537 12.7345 35.5028 12.5414 33.7709 12.0403C32.149 11.5713 30.6517 10.8672 30.2848 9.53282C29.7946 7.74931 29.9235 4.78708 30.5094 3.34128M40.1694 18.5299C39.9349 15.8259 40.1694 15.0224 41.1332 14.6682C42.097 14.3139 44.1591 15.0578 46.7636 13.6407C48.2854 12.8129 48.7912 10.9963 49.197 9.83854C49.4727 9.05052 49.0892 8.18525 48.3199 7.84974L44.2747 6.06071C44.2747 6.06071 43.6499 4.68113 42.5761 3.32142C41.3978 1.82927 39.5836 0.978346 37.6738 1.00042C32.2335 1.06333 30.4282 2.33254 29.0709 6.12361C28.3828 7.7758 27.8114 9.60236 27.3312 11.2843C26.8243 13.0601 26.4263 15.6703 24.9501 17.4295C21.2684 21.8133 10.5823 27.4408 10.231 38.3627C10.231 43.8898 14.0772 46 14.0772 46H29.5756C30.0436 46 30.3926 45.5751 30.3037 45.1182C29.9002 43.0499 28.6529 41.5787 26.4908 41.5787H22.8047C22.8047 41.5787 27.2901 36.3308 26.3307 32.021C25.8972 30.0753 24.4421 28.9738 23.4361 28.7145M31.2797 26.7521C31.8411 30.5443 33.433 41.2101 33.8476 43.1857C34.3534 45.5972 35.973 45.9989 35.973 45.9989H41.3055C41.7502 45.9989 42.0914 45.6148 42.0425 45.1756C41.9014 43.9218 41.2566 41.6781 38.4442 41.6781L37.6638 27.8845C37.6638 27.8845 38.612 26.6892 39.4769 24.994C40.4173 23.1498 40.4151 21.3563 40.1705 18.5288M7.57865 37.2149C5.67332 35.2514 4.81625 32.2274 4.21152 30.498C3.97919 30.9063 3.75242 31.5354 3.57345 32.3102C2.05718 38.9001 6.73826 45.3201 13.0023 45.8996L14.0761 45.9989M32.5236 35.0285C30.1303 37.8594 27.8937 40.9463 26.1484 41.5776"
															stroke="#0E1954" stroke-width="2" stroke-linecap="round"
															stroke-linejoin="round" />
														<path
															d="M13.5 33C16.8152 33 19.9946 31.683 22.3388 29.3388C24.683 26.9946 26 23.8152 26 20.5C26 17.1848 24.683 14.0054 22.3388 11.6612C19.9946 9.31696 16.8152 8 13.5 8C10.1848 8 7.00537 9.31696 4.66117 11.6612C2.31696 14.0054 1 17.1848 1 20.5C1 23.8152 2.31696 26.9946 4.66117 29.3388C7.00537 31.683 10.1848 33 13.5 33Z"
															fill="white" stroke="#0E1954" stroke-width="2"
															stroke-linecap="round" stroke-linejoin="round" />
														<path
															d="M13.4193 14.4482C14.5287 14.4482 15.4193 14.7522 16.0913 15.3602C16.774 15.9576 17.1153 16.7842 17.1153 17.8402C17.1153 18.8856 16.7793 19.6856 16.1073 20.2402C15.4353 20.7842 14.5447 21.0562 13.4353 21.0562L13.3713 22.2882H11.4033L11.3233 19.5682H12.0433C12.9713 19.5682 13.686 19.4456 14.1873 19.2002C14.6887 18.9549 14.9393 18.5069 14.9393 17.8562C14.9393 17.3869 14.8007 17.0136 14.5233 16.7362C14.2567 16.4589 13.8887 16.3202 13.4193 16.3202C12.9287 16.3202 12.5447 16.4536 12.2673 16.7202C12.0007 16.9869 11.8673 17.3549 11.8673 17.8242H9.75533C9.74467 17.1736 9.88333 16.5922 10.1713 16.0802C10.4593 15.5682 10.8807 15.1682 11.4353 14.8802C12.0007 14.5922 12.662 14.4482 13.4193 14.4482ZM12.3793 26.1122C11.974 26.1122 11.638 25.9896 11.3713 25.7442C11.1153 25.4882 10.9873 25.1736 10.9873 24.8002C10.9873 24.4269 11.1153 24.1176 11.3713 23.8722C11.638 23.6162 11.974 23.4882 12.3793 23.4882C12.774 23.4882 13.0993 23.6162 13.3553 23.8722C13.6113 24.1176 13.7393 24.4269 13.7393 24.8002C13.7393 25.1736 13.6113 25.4882 13.3553 25.7442C13.0993 25.9896 12.774 26.1122 12.3793 26.1122Z"
															fill="#0E1954" />
													</svg>

													{{ __('I\'m thinking about adopting a dog') }}
												</h3>
											</div>
										</label>
									</div>
								@elseif($adoptionProject == 'looking_for_cat')
									<div class="w-full max-w-[360px] s:max-w-[268px]">
										<label for="lookingForCat"
											class="block border rounded-xl bg-jobboard-cream border-jobboard-cream">
											<div>
												<h3
													class="flex flex-row gap-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px] s:h-[184px]">
													<svg width="49" height="47" viewBox="0 0 49 47"
														fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="16.5361" cy="39" r="8" fill="#3DD8AC" />
														<ellipse cx="43.0361" cy="10" rx="4.5"
															ry="5" fill="#3DD8AC" />
														<path
															d="M30.3893 40.6197C30.3893 40.6197 33.7878 40.0409 34.5155 34.6554C34.883 32.1248 33.47 29.5423 33.47 29.5423M19.401 44.3372H36.1687C36.531 44.3372 36.825 44.042 36.825 43.6783V43.2106C36.825 41.7858 35.6635 40.6197 34.2443 40.6197H30.3904M34.4337 32.341L36.9979 42.6712C37.2411 43.6502 38.1169 44.3372 39.121 44.3372H43.0277C43.39 44.3372 43.684 44.042 43.684 43.6783V42.902C43.684 41.6413 42.6664 40.6197 41.4108 40.6197L40.3197 30.489C40.3197 30.489 42.9356 27.3141 43.6053 23.6995C44.1436 20.7917 42.6157 18.7339 43.4159 16.3852C43.8486 15.1163 45.0939 15.1994 46.1498 14.4927C47.2057 13.786 48.1 11.4186 46.8433 10.6069C45.7864 9.92413 45.6684 6.72737 44.0598 5.91986C42.4511 5.11236 41.7979 4.79122 41.7979 4.79122C41.8487 2.72206 41.0888 1 41.0888 1C41.0888 1 37.9067 2.67321 35.1325 6.16097C34.412 7.06617 33.7153 8.3403 33.4234 9.53025C32.8986 12.0079 33.6574 16.9527 30.584 18.1686C16.604 23.6975 15.692 30.4308 17.0615 40.1645M17.0615 40.1635C20.1246 40.1635 23.0562 40.2841 24.2135 40.5553C25.6721 40.8972 26.1224 41.7068 26.1276 42.479C26.1317 43.2543 25.6835 43.9921 23.9537 44.1782C23.0334 44.2769 20.6722 44.3382 18.7747 44.3382C12.6403 44.3382 11.1145 43.6793 11.1145 42.0965C11.1145 40.5137 15.6237 39.3602 16.663 36.4242"
															stroke="#0E1954" stroke-width="2" stroke-linecap="round"
															stroke-linejoin="round" />
														<path
															d="M13.7861 33C17.1013 33 20.2808 31.683 22.625 29.3388C24.9692 26.9946 26.2861 23.8152 26.2861 20.5C26.2861 17.1848 24.9692 14.0054 22.625 11.6612C20.2808 9.31696 17.1013 8 13.7861 8C10.4709 8 7.2915 9.31696 4.9473 11.6612C2.60309 14.0054 1.28613 17.1848 1.28613 20.5C1.28613 23.8152 2.60309 26.9946 4.9473 29.3388C7.2915 31.683 10.4709 33 13.7861 33Z"
															fill="white" stroke="#0E1954" stroke-width="2"
															stroke-linecap="round" stroke-linejoin="round" />
														<path
															d="M12.8245 24.3463C14.0996 24.3463 15.3225 23.8398 16.2241 22.9382C17.1257 22.0366 17.6322 20.8137 17.6322 19.5386C17.6322 18.2636 17.1257 17.0407 16.2241 16.1391C15.3225 15.2375 14.0996 14.731 12.8245 14.731C11.5495 14.731 10.3266 15.2375 9.42499 16.1391C8.52337 17.0407 8.01685 18.2636 8.01685 19.5386C8.01685 20.8137 8.52337 22.0366 9.42499 22.9382C10.3266 23.8398 11.5495 24.3463 12.8245 24.3463Z"
															fill="white" stroke="#0E1954" stroke-width="2"
															stroke-linecap="round" stroke-linejoin="round" />
														<path d="M19.5553 26.2693L16.2284 22.9424" stroke="#0E1954"
															stroke-width="2" stroke-linecap="round"
															stroke-linejoin="round" />
													</svg>

													{{ __('Looking for a cat') }}
												</h3>
											</div>
										</label>
									</div>
								@elseif($adoptionProject == 'thinking_about_cat')
									<div class="w-full max-w-[360px] s:max-w-[268px]">
										<label for="thinkingAboutCat"
											class="block border rounded-xl bg-jobboard-cream border-jobboard-cream">
											<div>
												<h3
													class="flex flex-row gap-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px] s:h-[184px]">
													<svg width="49" height="47" viewBox="0 0 49 47"
														fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="17.0723" cy="39" r="8" fill="#3DD8AC" />
														<ellipse cx="43.5723" cy="10" rx="4.5"
															ry="5" fill="#3DD8AC" />
														<path
															d="M30.9255 40.6197C30.9255 40.6197 34.3239 40.0409 35.0517 34.6554C35.4191 32.1248 34.0061 29.5423 34.0061 29.5423M19.9372 44.3372H36.7048C37.0671 44.3372 37.3611 44.042 37.3611 43.6783V43.2106C37.3611 41.7858 36.1997 40.6197 34.7804 40.6197H30.9265M34.9699 32.341L37.534 42.6712C37.7772 43.6502 38.653 44.3372 39.6571 44.3372H43.5638C43.9262 44.3372 44.2201 44.042 44.2201 43.6783V42.902C44.2201 41.6413 43.2026 40.6197 41.9469 40.6197L40.8558 30.489C40.8558 30.489 43.4717 27.3141 44.1415 23.6995C44.6798 20.7917 43.1518 18.7339 43.952 16.3852C44.3847 15.1163 45.63 15.1994 46.6859 14.4927C47.7418 13.786 48.6362 11.4186 47.3795 10.6069C46.3226 9.92413 46.2046 6.72737 44.5959 5.91986C42.9873 5.11236 42.3341 4.79122 42.3341 4.79122C42.3848 2.72206 41.625 1 41.625 1C41.625 1 38.4429 2.67321 35.6686 6.16097C34.9481 7.06617 34.2515 8.3403 33.9596 9.53025C33.4347 12.0079 34.1935 16.9527 31.1201 18.1686C17.1401 23.6975 16.2281 30.4308 17.5977 40.1645M17.5977 40.1635C20.6607 40.1635 23.5923 40.2841 24.7497 40.5553C26.2082 40.8972 26.6585 41.7068 26.6637 42.479C26.6678 43.2543 26.2196 43.9921 24.4898 44.1782C23.5696 44.2769 21.2083 44.3382 19.3109 44.3382C13.1765 44.3382 11.6506 43.6793 11.6506 42.0965C11.6506 40.5137 16.1598 39.3602 17.1991 36.4242"
															stroke="#0E1954" stroke-width="2" stroke-linecap="round"
															stroke-linejoin="round" />
														<path
															d="M14.0361 33C17.3513 33 20.5308 31.683 22.875 29.3388C25.2192 26.9946 26.5361 23.8152 26.5361 20.5C26.5361 17.1848 25.2192 14.0054 22.875 11.6612C20.5308 9.31696 17.3513 8 14.0361 8C10.7209 8 7.5415 9.31696 5.1973 11.6612C2.85309 14.0054 1.53613 17.1848 1.53613 20.5C1.53613 23.8152 2.85309 26.9946 5.1973 29.3388C7.5415 31.683 10.7209 33 14.0361 33Z"
															fill="white" stroke="#0E1954" stroke-width="2"
															stroke-linecap="round" stroke-linejoin="round" />
														<path
															d="M13.9555 14.4482C15.0648 14.4482 15.9555 14.7522 16.6275 15.3602C17.3101 15.9576 17.6515 16.7842 17.6515 17.8402C17.6515 18.8856 17.3155 19.6856 16.6435 20.2402C15.9715 20.7842 15.0808 21.0562 13.9715 21.0562L13.9075 22.2882H11.9395L11.8595 19.5682H12.5795C13.5075 19.5682 14.2221 19.4456 14.7235 19.2002C15.2248 18.9549 15.4755 18.5069 15.4755 17.8562C15.4755 17.3869 15.3368 17.0136 15.0595 16.7362C14.7928 16.4589 14.4248 16.3202 13.9555 16.3202C13.4648 16.3202 13.0808 16.4536 12.8035 16.7202C12.5368 16.9869 12.4035 17.3549 12.4035 17.8242H10.2915C10.2808 17.1736 10.4195 16.5922 10.7075 16.0802C10.9955 15.5682 11.4168 15.1682 11.9715 14.8802C12.5368 14.5922 13.1981 14.4482 13.9555 14.4482ZM12.9155 26.1122C12.5101 26.1122 12.1741 25.9896 11.9075 25.7442C11.6515 25.4882 11.5235 25.1736 11.5235 24.8002C11.5235 24.4269 11.6515 24.1176 11.9075 23.8722C12.1741 23.6162 12.5101 23.4882 12.9155 23.4882C13.3101 23.4882 13.6355 23.6162 13.8915 23.8722C14.1475 24.1176 14.2755 24.4269 14.2755 24.8002C14.2755 25.1736 14.1475 25.4882 13.8915 25.7442C13.6355 25.9896 13.3101 26.1122 12.9155 26.1122Z"
															fill="#0E1954" />
													</svg>

													{{ __('I\'m thinking about adopting a cat') }}
												</h3>
											</div>
										</label>
									</div>
								@elseif($adoptionProject == 'none')
									<div class="w-full max-w-[360px] s:max-w-[268px]">
										<label for="none"
											class="block border rounded-xl bg-jobboard-cream border-jobboard-cream">
											<div>
												<h3
													class="flex flex-row gap-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px] s:h-[184px]">
													<svg width="48" height="47" viewBox="0 0 48 47"
														fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="23.5723" cy="23.5" r="8" fill="#FFA244" />
														<path
															d="M16.3314 30.7409L30.8131 16.2591M16.3314 16.2591L30.8131 30.7409M46.0723 23.5C46.0723 35.9264 35.9987 46 23.5723 46C11.1459 46 1.07227 35.9264 1.07227 23.5C1.07227 11.0736 11.1459 1 23.5723 1C35.9987 1 46.0723 11.0736 46.0723 23.5Z"
															stroke="#0E1954" stroke-width="2" stroke-linecap="round"
															stroke-linejoin="round" />
													</svg>

													{{ __('No adoption plans') }}
												</h3>
											</div>
										</label>
									</div>
								@endif
							</div>
						</div>
					@endif

					@if(!empty($animalExperience))
						<div>
							<x-front.space-subtitle>
								{{ __('My experience with animals') }}
							</x-front.space-subtitle>

							<div class="flex mt-4 gap-4 flex-wrap">
								@if($animalExperience == 'expert')
									<div class="w-full max-w-[360px] s:max-w-[270px]">
										<label for="expert"
											class="block border rounded-xl bg-jobboard-cream border-jobboard-cream">
											<div>
												<h3
													class="flex flex-row gap-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px] s:h-[184px]">
													<svg width="47" height="47" viewBox="0 0 47 47"
														fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="10.5" cy="13" r="8"
															transform="rotate(90 10.5 13)" fill="#FFA244" />
														<ellipse cx="30.5" cy="41.5" rx="4.5"
															ry="5" transform="rotate(90 30.5 41.5)"
															fill="#FFA244" />
														<path
															d="M23.5 28.3913C15.4 28.3913 8.82611 21.8174 8.82611 13.7174V4.91304C8.82611 2.76087 10.587 1 12.7392 1H34.2609C36.4131 1 38.1739 2.76087 38.1739 4.91304V13.7174C38.1739 21.8174 31.6 28.3913 23.5 28.3913Z"
															stroke="#0E1954" stroke-width="2" stroke-linecap="round"
															stroke-linejoin="round" />
														<path
															d="M8.82609 6.86963H2.95652C1.88043 6.86963 1 7.75006 1 8.82615V12.7392C1 18.1392 5.38261 22.5218 10.7826 22.5218H11.8"
															stroke="#0E1954" stroke-width="2" stroke-linecap="round"
															stroke-linejoin="round" />
														<path
															d="M38.1739 6.86963H44.0435C45.1196 6.86963 46 7.75006 46 8.82615V12.7392C46 18.1392 41.6174 22.5218 36.2174 22.5218H35.2"
															stroke="#0E1954" stroke-width="2" stroke-linecap="round"
															stroke-linejoin="round" />
														<path
															d="M34.2609 45.9999H12.7391L13.9522 41.1282C14.3826 39.3869 15.9478 38.1738 17.7478 38.1738H29.2522C31.0522 38.1738 32.6174 39.3869 33.0478 41.1282L34.2609 45.9999Z"
															stroke="#0E1954" stroke-width="2" stroke-linecap="round"
															stroke-linejoin="round" />
														<path d="M23.5 28.3911V38.1737" stroke="#0E1954"
															stroke-width="2" stroke-linecap="round"
															stroke-linejoin="round" />
													</svg>

													{{ __('Expert') }}
												</h3>
											</div>
										</label>
									</div>
								@elseif($animalExperience == 'experienced')
									<div class="w-full max-w-[360px] s:max-w-[270px]">
										<label for="experienced"
											class="block border rounded-xl bg-jobboard-cream border-jobboard-cream">
											<div>
												<h3
													class="flex flex-row gap-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px] s:h-[184px]">
													<svg width="49" height="50" viewBox="0 0 49 50"
														fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="36.5" cy="8" r="8"
															transform="rotate(180 36.5 8)" fill="#FFA244" />
														<ellipse cx="8" cy="28" rx="4.5"
															ry="5" transform="rotate(180 8 28)"
															fill="#FFA244" />
														<path
															d="M38.892 4H10.1124C9.36381 4 8.67761 4.40047 8.3033 5.05386L1.27475 17.5316C0.858862 18.2693 0.921245 19.1756 1.42031 19.8501L22.8387 48.178C23.6704 49.274 25.3132 49.274 26.145 48.178L47.5633 19.8501C48.0624 19.1756 48.1248 18.2482 47.7089 17.5316L40.6803 5.05386C40.306 4.40047 39.6198 4 38.8712 4H38.892Z"
															stroke="#0E1954" stroke-width="2" stroke-linecap="round"
															stroke-linejoin="round" />
														<path d="M9.15588 4.23193L24.5022 18.7331L39.8486 4.23193"
															stroke="#0E1954" stroke-width="2" stroke-linecap="round"
															stroke-linejoin="round" />
														<path d="M48 18.7539H1.02527" stroke="#0E1954"
															stroke-width="2" stroke-linecap="round"
															stroke-linejoin="round" />
													</svg>

													{{ __('Experienced') }}
												</h3>
											</div>
										</label>
									</div>
								@elseif($animalExperience == 'beginner')
									<div class="w-full max-w-[360px] s:max-w-[270px]">
										<label for="beginner"
											class="block border rounded-xl bg-jobboard-cream border-jobboard-cream">
											<div>
												<h3
													class="flex flex-row gap-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center h-[85px] s:h-[184px]">
													<svg width="45" height="47" viewBox="0 0 45 47"
														fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="33.5" cy="39" r="8"
															transform="rotate(-90 33.5 39)" fill="#FFA244" />
														<ellipse cx="13.5" cy="10.5" rx="4.5"
															ry="5" transform="rotate(-90 13.5 10.5)"
															fill="#FFA244" />
														<path
															d="M21.6504 3.25977C22.0172 2.6698 22.8451 2.63324 23.2695 3.14941L23.3496 3.25977L28.7598 11.9619C29.1211 12.543 29.6687 12.9801 30.3086 13.2061L30.5879 13.29L40.5361 15.7471C41.2107 15.9137 41.5017 16.6897 41.1416 17.2529L41.0605 17.3623L34.457 25.1973C34.016 25.7206 33.769 26.3763 33.752 27.0547L33.7588 27.3467L34.4961 37.5664C34.5461 38.2594 33.8979 38.7758 33.251 38.6074L33.1221 38.5645L23.6299 34.7051C22.996 34.4473 22.296 34.4151 21.6455 34.6084L21.3701 34.7051L11.8779 38.5645C11.2342 38.8262 10.5426 38.3695 10.5029 37.7021L10.5039 37.5664L11.2412 27.3467C11.2905 26.6639 11.1048 25.9877 10.7197 25.4287L10.543 25.1973L3.93945 17.3623C3.49175 16.8312 3.71201 16.0323 4.33398 15.7881L4.46387 15.7471L14.4121 13.29C15.0763 13.1259 15.6616 12.7407 16.0742 12.2021L16.2402 11.9619L21.6504 3.25977Z"
															stroke="#0E1954" stroke-width="2" />
													</svg>

													{{ __('Beginner') }}
												</h3>
											</div>
										</label>
									</div>
								@endif
							</div>
						</div>
					@endif
				</div>
			@elseif($user->hasRole('recruiter'))
				<div class="p-6 border border-jobboard-greige rounded-md text-jobboard-deepblue mb-8 w-full">
					<div class="flex flex-col gap-4">
						<div class="w-full">
							<div class="flex flex-row justify-between items-start">
								<x-front.space-subtitle>
									{{ __('I\'m raising :') }}
								</x-front.space-subtitle>

								<a href="{{ route('space.profile.complete-my-profile', ['active' => 1]) }}">
									<div
										class="flex flex-row justify-end cursor-pointer font-bold text-jobboard-deepblue text-sm items-center gap-x-1">
										<svg width="16" height="15" viewBox="0 0 16 15" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path
												d="M7.26201 2.37054L2.39156 2.37054C2.02249 2.37054 1.66855 2.50668 1.40758 2.74901C1.14661 2.99134 1 3.32 1 3.66271L1 12.7078C1 13.0505 1.14661 13.3792 1.40758 13.6215C1.66855 13.8639 2.0225 14 2.39156 14L12.1325 14C12.5015 14 12.8555 13.8639 13.1164 13.6215C13.3774 13.3792 13.524 13.0505 13.524 12.7078L13.524 8.18527M12.4804 1.40142C12.7572 1.1444 13.1326 0.999999 13.524 0.999999C13.9155 0.999999 14.2909 1.1444 14.5677 1.40142C14.8445 1.65845 15 2.00705 15 2.37054C15 2.73403 14.8445 3.08264 14.5677 3.33966L7.95779 9.47743L5.17468 10.1235L5.87046 7.53919L12.4804 1.40142Z"
												stroke="#0E1954" stroke-width="1.5" stroke-linecap="round"
												stroke-linejoin="round" />
										</svg>

										{{ __('Update') }}
									</div>
								</a>
							</div>

							<div class="flex mt-4 gap-4 flex-wrap">
								<div class="w-full max-w-[360px] s:w-[268px]">
									@if($interestedIn == 'dogs')
										<label for="interested_in_dogs" class="block border rounded-xl bg-jobboard-cream border-jobboard-cream">
											<div>
												<h3 class="h-[85px] s:h-[184px] flex flex-row gap-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center">
													<svg width="48" height="47" viewBox="0 0 48 47"
														fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="9" cy="37" r="8" fill="#FF7E71" />
														<ellipse cx="35.5" cy="8" rx="4.5"
															ry="5" fill="#FF7E71" />
														<path
															d="M34.4217 4.15137C34.4217 4.15137 35.401 6.63682 35.1165 11.8384C35.0675 12.7345 33.2167 12.5414 31.4848 12.0403C29.8629 11.5713 28.3655 10.8672 27.9987 9.53282C27.5085 7.74931 27.6374 4.78708 28.2232 3.34128M37.8833 18.5299C37.6487 15.8259 37.8833 15.0224 38.8471 14.6682C39.8109 14.3139 41.8729 15.0578 44.4775 13.6407C45.9993 12.8129 46.5051 10.9963 46.9108 9.83854C47.1865 9.05052 46.803 8.18525 46.0338 7.84974L41.9886 6.06071C41.9886 6.06071 41.3638 4.68113 40.29 3.32142C39.1117 1.82927 37.2975 0.978346 35.3877 1.00042C29.9474 1.06333 28.1421 2.33254 26.7848 6.12361C26.0967 7.7758 25.5253 9.60236 25.0451 11.2843C24.5382 13.0601 24.1402 15.6703 22.664 17.4295C18.9822 21.8133 8.29614 27.4408 7.94487 38.3627C7.94487 43.8898 11.7911 46 11.7911 46H27.2895C27.7575 46 28.1065 45.5751 28.0176 45.1182C27.6141 43.0499 26.3668 41.5787 24.2047 41.5787H20.5185C20.5185 41.5787 25.0039 36.3308 24.0446 32.021C23.6111 30.0753 22.156 28.9738 21.1499 28.7145M28.9936 26.7521C29.555 30.5443 31.1468 41.2101 31.5615 43.1857C32.0672 45.5972 33.6869 45.9989 33.6869 45.9989H39.0194C39.464 45.9989 39.8053 45.6148 39.7564 45.1756C39.6152 43.9218 38.9705 41.6781 36.158 41.6781L35.3777 27.8845C35.3777 27.8845 36.3259 26.6892 37.1908 24.994C38.1312 23.1498 38.129 21.3563 37.8844 18.5288M5.29252 37.2149C3.38718 35.2514 2.53012 32.2274 1.92539 30.498C1.69306 30.9063 1.46629 31.5354 1.28731 32.3102C-0.228949 38.9001 4.45213 45.3201 10.7162 45.8996L11.79 45.9989M30.2375 35.0285C27.8442 37.8594 25.6076 40.9463 23.8623 41.5776"
															stroke="#0E1954" stroke-width="2" stroke-linecap="round"
															stroke-linejoin="round" />
													</svg>

													{{ __('dogs') }}
												</h3>
											</div>
										</label>
									@elseif($interestedIn == 'cats')
										<label for="interested_in_cats" class="block border rounded-xl bg-jobboard-cream border-jobboard-cream">
											<div>
												<h3 class="h-[85px] s:h-[184px] flex flex-row gap-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center">
													<svg width="43" height="46" viewBox="0 0 43 46" fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="8" cy="38" r="8" fill="#3DD8AC" />
														<ellipse cx="34.5" cy="9" rx="4.5"
															ry="5" fill="#3DD8AC" />
														<path
															d="M24.228 40.6197C24.228 40.6197 27.6264 40.0409 28.3541 34.6554C28.7216 32.1248 27.3086 29.5423 27.3086 29.5423M13.2396 44.3372H30.0073C30.3696 44.3372 30.6636 44.042 30.6636 43.6783V43.2106C30.6636 41.7858 29.5021 40.6197 28.0829 40.6197H24.229M28.2724 32.341L30.8365 42.6712C31.0797 43.6502 31.9555 44.3372 32.9596 44.3372H36.8663C37.2286 44.3372 37.5226 44.042 37.5226 43.6783V42.902C37.5226 41.6413 36.5051 40.6197 35.2494 40.6197L34.1583 30.489C34.1583 30.489 36.7742 27.3141 37.444 23.6995C37.9822 20.7917 36.4543 18.7339 37.2545 16.3852C37.6872 15.1163 38.9325 15.1994 39.9884 14.4927C41.0443 13.786 41.9387 11.4186 40.682 10.6069C39.6251 9.92413 39.507 6.72737 37.8984 5.91986C36.2897 5.11236 35.6366 4.79122 35.6366 4.79122C35.6873 2.72206 34.9275 1 34.9275 1C34.9275 1 31.7454 2.67321 28.9711 6.16097C28.2506 7.06617 27.554 8.3403 27.262 9.53025C26.7372 12.0079 27.496 16.9527 24.4226 18.1686C10.4426 23.6975 9.53064 30.4308 10.9002 40.1645M10.9002 40.1635C13.9632 40.1635 16.8948 40.2841 18.0521 40.5553C19.5107 40.8972 19.961 41.7068 19.9662 42.479C19.9703 43.2543 19.5221 43.9921 17.7923 44.1782C16.8721 44.2769 14.5108 44.3382 12.6134 44.3382C6.47896 44.3382 4.95312 43.6793 4.95312 42.0965C4.95312 40.5137 9.46232 39.3602 10.5016 36.4242"
															stroke="#0E1954" stroke-width="2" stroke-linecap="round"
															stroke-linejoin="round" />
													</svg>

													{{ __('cats') }}
												</h3>
											</div>
										</label>
									@elseif($interestedIn == 'both')
										<label for="interested_in_both" class="block border rounded-xl bg-jobboard-cream border-jobboard-cream">
											<div>
												<h3 class="h-[85px] s:h-[184px] flex flex-row gap-4 s:flex-col items-center max-s:pl-4 s:justify-center text-base font-medium text-center">
													<svg width="103" height="47" viewBox="0 0 103 47"
														fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="9.03906" cy="37" r="8" fill="#FF7E71" />
														<ellipse cx="35.5391" cy="8" rx="4.5"
															ry="5" fill="#FF7E71" />
														<path
															d="M34.4607 4.15137C34.4607 4.15137 35.4401 6.63682 35.1555 11.8384C35.1066 12.7345 33.2557 12.5414 31.5238 12.0403C29.9019 11.5713 28.4046 10.8672 28.0377 9.53282C27.5475 7.74931 27.6765 4.78708 28.2623 3.34128M37.9224 18.5299C37.6878 15.8259 37.9224 15.0224 38.8861 14.6682C39.8499 14.3139 41.912 15.0578 44.5166 13.6407C46.0384 12.8129 46.5442 10.9963 46.9499 9.83854C47.2256 9.05052 46.8421 8.18525 46.0728 7.84974L42.0276 6.06071C42.0276 6.06071 41.4029 4.68113 40.329 3.32142C39.1507 1.82927 37.3365 0.978346 35.4268 1.00042C29.9864 1.06333 28.1811 2.33254 26.8238 6.12361C26.1357 7.7758 25.5644 9.60236 25.0841 11.2843C24.5772 13.0601 24.1793 15.6703 22.703 17.4295C19.0213 21.8133 8.33521 27.4408 7.98393 38.3627C7.98393 43.8898 11.8302 46 11.8302 46H27.3285C27.7965 46 28.1456 45.5751 28.0566 45.1182C27.6531 43.0499 26.4059 41.5787 24.2437 41.5787H20.5576C20.5576 41.5787 25.043 36.3308 24.0837 32.021C23.6501 30.0753 22.195 28.9738 21.189 28.7145M29.0327 26.7521C29.594 30.5443 31.1859 41.2101 31.6005 43.1857C32.1063 45.5972 33.726 45.9989 33.726 45.9989H39.0584C39.5031 45.9989 39.8444 45.6148 39.7955 45.1756C39.6543 43.9218 39.0095 41.6781 36.1971 41.6781L35.4167 27.8845C35.4167 27.8845 36.365 26.6892 37.2298 24.994C38.1703 23.1498 38.168 21.3563 37.9235 18.5288M5.33158 37.2149C3.42625 35.2514 2.56918 32.2274 1.96445 30.498C1.73212 30.9063 1.50535 31.5354 1.32638 32.3102C-0.189887 38.9001 4.49119 45.3201 10.7552 45.8996L11.8291 45.9989M30.2766 35.0285C27.8832 37.8594 25.6466 40.9463 23.9014 41.5776"
															stroke="#0E1954" stroke-width="2" stroke-linecap="round"
															stroke-linejoin="round" />
														<circle cx="8" cy="8" r="8"
															transform="matrix(-1 0 0 1 102.961 29)" fill="#3DD8AC" />
														<ellipse cx="4.5" cy="5" rx="4.5"
															ry="5" transform="matrix(-1 0 0 1 72.9609 3)"
															fill="#3DD8AC" />
														<path
															d="M79.1075 40.6197C79.1075 40.6197 75.709 40.0409 74.9813 34.6554C74.6138 32.1248 76.0268 29.5423 76.0268 29.5423M90.0958 44.3372H73.3281C72.9658 44.3372 72.6718 44.042 72.6718 43.6783V43.2106C72.6718 41.7858 73.8333 40.6197 75.2525 40.6197H79.1065M75.0631 32.341L72.499 42.6712C72.2557 43.6502 71.38 44.3372 70.3758 44.3372H66.4691C66.1068 44.3372 65.8128 44.042 65.8128 43.6783V42.902C65.8128 41.6413 66.8304 40.6197 68.0861 40.6197L69.1771 30.489C69.1771 30.489 66.5612 27.3141 65.8915 23.6995C65.3532 20.7917 66.8811 18.7339 66.0809 16.3852C65.6482 15.1163 64.4029 15.1994 63.347 14.4927C62.2912 13.786 61.3968 11.4186 62.6535 10.6069C63.7104 9.92413 63.8284 6.72737 65.4371 5.91986C67.0457 5.11236 67.6989 4.79122 67.6989 4.79122C67.6482 2.72206 68.408 1 68.408 1C68.408 1 71.5901 2.67321 74.3643 6.16097C75.0848 7.06617 75.7815 8.3403 76.0734 9.53025C76.5982 12.0079 75.8395 16.9527 78.9129 18.1686C92.8928 23.6975 93.8048 30.4308 92.4353 40.1645M92.4353 40.1635C89.3722 40.1635 86.4406 40.2841 85.2833 40.5553C83.8247 40.8972 83.3745 41.7068 83.3693 42.479C83.3651 43.2543 83.8134 43.9921 85.5431 44.1782C86.4634 44.2769 88.8246 44.3382 90.7221 44.3382C96.8565 44.3382 98.3823 43.6793 98.3823 42.0965C98.3823 40.5137 93.8731 39.3602 92.8338 36.4242"
															stroke="#0E1954" stroke-width="2" stroke-linecap="round"
															stroke-linejoin="round" />
													</svg>

													{{ __('dogs & cats') }}
												</h3>
											</div>
										</label>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>

				@if($user->hasRole('professionnal_breeder'))
					<div class="p-6 border border-jobboard-greige rounded-md text-jobboard-deepblue mb-8 w-full">
						<div class="flex flex-col gap-4">
							<div class="w-full flex justify-between">
								<div class="flex flex-col gap-2">
									<h2 class="text-jobboard-deepblue text-[25px] md:text-[40px] font-bold">
										{{ $companyName }}
									</h2>

									<p>
										{{ __('Siret') }} : {{ $siret }}
									</p>
								</div>

								<a href="{{ route('space.profile.complete-my-profile', ['active' => 2]) }}">
									<div
										class="flex flex-row justify-end cursor-pointer font-bold text-jobboard-deepblue text-sm items-center gap-x-1">
										<svg width="16" height="15" viewBox="0 0 16 15" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path
												d="M7.26201 2.37054L2.39156 2.37054C2.02249 2.37054 1.66855 2.50668 1.40758 2.74901C1.14661 2.99134 1 3.32 1 3.66271L1 12.7078C1 13.0505 1.14661 13.3792 1.40758 13.6215C1.66855 13.8639 2.0225 14 2.39156 14L12.1325 14C12.5015 14 12.8555 13.8639 13.1164 13.6215C13.3774 13.3792 13.524 13.0505 13.524 12.7078L13.524 8.18527M12.4804 1.40142C12.7572 1.1444 13.1326 0.999999 13.524 0.999999C13.9155 0.999999 14.2909 1.1444 14.5677 1.40142C14.8445 1.65845 15 2.00705 15 2.37054C15 2.73403 14.8445 3.08264 14.5677 3.33966L7.95779 9.47743L5.17468 10.1235L5.87046 7.53919L12.4804 1.40142Z"
												stroke="#0E1954" stroke-width="1.5" stroke-linecap="round"
												stroke-linejoin="round" />
										</svg>

										{{ __('Update') }}
									</div>
								</a>
							</div>

							<hr class="my-4">

							<div class="flex flex-row gap-y-4 justify-between items-center flex-wrap">
								<div class="flex gap-2 items-center flex-wrap">
									{{ __('I am') }} :

									<div class="flex py-2 px-4 rounded-xl border-jobboard-orange bg-jobboard-orange font-bold s:text-base text-sm">
										{{ __('professionnal_breeder') }}
									</div>
								</div>

								<p class="font-medium text-sm">
									{{ __('I closed my business.') }}

									<a href="{{ route('contact') }}" class="underline">
										{{ __('Switch to private breeder.') }}
									</a>
								</p>
							</div>
						</div>
					</div>
				@endif
			@endif
		</div>
	</div>
</div>
