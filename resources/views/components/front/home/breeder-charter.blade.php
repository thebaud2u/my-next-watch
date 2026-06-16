<div class="flex flex-col sm:flex-row w-full @if(auth()->check() && auth()->user()->hasRole(['breeder', 'professionnal_breeder', 'individual_breeder', 'admin']) && Route::is('home.breeder')) mt-10 @endif">
	<div class="flex-1 bg-jobboard-deepblue px-2 py-8 md:py-16">
		<div class="flex flex-col items-center">
			<h3 class="text-white max-w-[230px] font-semibold text-center text-[25px] md:text-[28px] mb-8">
				{{ __('The breeders-online charter') }}
			</h3>
			<div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8 max-md:px-4 max-sm:self-start">
				<div class="flex flex-row md:flex-col items-center max-md:gap-x-4 md:gap-y-4">
					<svg class="shrink-0 w-[35px] md:w-[84px]" viewBox="0 0 84 93" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path
							d="M37.5156 2.19238C40.201 0.651727 43.4991 0.603485 46.2227 2.04785L46.4844 2.19238L46.4854 2.19336L78.0137 20.2178V20.2295L78.5186 20.5176C81.2967 22.0983 82.9998 25.0313 83 28.1953V64.8135C83 67.9742 81.291 70.9013 78.5176 72.4932L46.4854 90.8066L46.4844 90.8076C43.799 92.3483 40.5009 92.3965 37.7773 90.9521L37.5156 90.8076L37.5146 90.8066L5.48242 72.4932L5.48145 72.4922L5.22363 72.3398C2.59794 70.7276 1 67.8788 1 64.8135V28.1865C1 25.0252 2.71011 22.0975 5.48438 20.5059L5.4834 20.5049L37.5146 2.19336L37.5156 2.19238Z"
							stroke="#C68CFF" stroke-width="2" />
						<path
							d="M49.0982 32.6582C46.96 31.5964 44.5455 31 42 31C33.1564 31 26 38.1564 26 47C26 55.8436 33.1564 63 42 63C50.8437 63 58 55.8436 58 47C58 44.9491 57.6073 42.9855 56.9091 41.1818M34.7273 47L40.5455 52.8182L58 31"
							stroke="#C68CFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
					<div class="flex flex-row md:flex-col text-white text-md">
						<p class="md:text-center max-w-[255px]"><strong>Conformité légale et engagement</strong> envers
							l'adoptant</p>
					</div>
				</div>
				<div class="flex flex-row md:flex-col items-center max-md:gap-x-4 md:gap-y-4">
					<svg class="shrink-0 w-[35px] md:w-[84px]" viewBox="0 0 84 93" fill="none"
						xmlns="http://www.w3.org/2000/svg">
						<path
							d="M37.5156 2.19238C40.201 0.651727 43.4991 0.603485 46.2227 2.04785L46.4844 2.19238L46.4854 2.19336L78.0137 20.2178V20.2295L78.5186 20.5176C81.2967 22.0983 82.9998 25.0313 83 28.1953V64.8135C83 67.9742 81.291 70.9013 78.5176 72.4932L46.4854 90.8066L46.4844 90.8076C43.799 92.3483 40.5009 92.3965 37.7773 90.9521L37.5156 90.8076L37.5146 90.8066L5.48242 72.4932L5.48145 72.4922L5.22363 72.3398C2.59794 70.7276 1 67.8788 1 64.8135V28.1865C1 25.0252 2.71011 22.0975 5.48438 20.5059L5.4834 20.5049L37.5146 2.19336L37.5156 2.19238Z"
							stroke="#C68CFF" stroke-width="2" />
						<path
							d="M49.0982 32.6582C46.96 31.5964 44.5455 31 42 31C33.1564 31 26 38.1564 26 47C26 55.8436 33.1564 63 42 63C50.8437 63 58 55.8436 58 47C58 44.9491 57.6073 42.9855 56.9091 41.1818M34.7273 47L40.5455 52.8182L58 31"
							stroke="#C68CFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
					<div class="flex flex-row md:flex-col text-white text-md">
						<p class="font-semibold md:text-center mr-1">Bien-être animal</p>
					</div>
				</div>
				<div class="flex flex-row md:flex-col items-center max-md:gap-x-4 md:gap-y-4">
					<svg class="shrink-0 w-[35px] md:w-[84px]" viewBox="0 0 84 93" fill="none"
						xmlns="http://www.w3.org/2000/svg">
						<path
							d="M37.5156 2.19238C40.201 0.651727 43.4991 0.603485 46.2227 2.04785L46.4844 2.19238L46.4854 2.19336L78.0137 20.2178V20.2295L78.5186 20.5176C81.2967 22.0983 82.9998 25.0313 83 28.1953V64.8135C83 67.9742 81.291 70.9013 78.5176 72.4932L46.4854 90.8066L46.4844 90.8076C43.799 92.3483 40.5009 92.3965 37.7773 90.9521L37.5156 90.8076L37.5146 90.8066L5.48242 72.4932L5.48145 72.4922L5.22363 72.3398C2.59794 70.7276 1 67.8788 1 64.8135V28.1865C1 25.0252 2.71011 22.0975 5.48438 20.5059L5.4834 20.5049L37.5146 2.19336L37.5156 2.19238Z"
							stroke="#C68CFF" stroke-width="2" />
						<path
							d="M49.0982 32.6582C46.96 31.5964 44.5455 31 42 31C33.1564 31 26 38.1564 26 47C26 55.8436 33.1564 63 42 63C50.8437 63 58 55.8436 58 47C58 44.9491 57.6073 42.9855 56.9091 41.1818M34.7273 47L40.5455 52.8182L58 31"
							stroke="#C68CFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
					<div class="flex flex-row md:flex-col text-white text-md">
						<p class="md:text-center max-w-[140px]"><strong>Responsabilité</strong> et fin de carrière</p>
					</div>
				</div>
				<div class="flex flex-row md:flex-col items-center max-md:gap-x-4 md:gap-y-4">
					<svg class="shrink-0 w-[35px] md:w-[84px]" viewBox="0 0 84 93" fill="none"
						xmlns="http://www.w3.org/2000/svg">
						<path
							d="M37.5156 2.19238C40.201 0.651727 43.4991 0.603485 46.2227 2.04785L46.4844 2.19238L46.4854 2.19336L78.0137 20.2178V20.2295L78.5186 20.5176C81.2967 22.0983 82.9998 25.0313 83 28.1953V64.8135C83 67.9742 81.291 70.9013 78.5176 72.4932L46.4854 90.8066L46.4844 90.8076C43.799 92.3483 40.5009 92.3965 37.7773 90.9521L37.5156 90.8076L37.5146 90.8066L5.48242 72.4932L5.48145 72.4922L5.22363 72.3398C2.59794 70.7276 1 67.8788 1 64.8135V28.1865C1 25.0252 2.71011 22.0975 5.48438 20.5059L5.4834 20.5049L37.5146 2.19336L37.5156 2.19238Z"
							stroke="#C68CFF" stroke-width="2" />
						<path
							d="M49.0982 32.6582C46.96 31.5964 44.5455 31 42 31C33.1564 31 26 38.1564 26 47C26 55.8436 33.1564 63 42 63C50.8437 63 58 55.8436 58 47C58 44.9491 57.6073 42.9855 56.9091 41.1818M34.7273 47L40.5455 52.8182L58 31"
							stroke="#C68CFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
					<div class="flex flex-row md:flex-col text-white text-md">
						<p class="md:text-center max-w-[190px]"><strong>Reproduction éthique</strong> et encadrée</p>
					</div>
				</div>
			</div>
			<div class="flex justify-center mt-8 md:mt-12">
				<a href="{{ route('pages.quisommesnous') }}">
					<button
						class="bg-jobboard-deepblue hover:bg-jobboard-cream border border-jobboard-cream rounded-full text-jobboard-cream hover:text-jobboard-deepblue font-semibold text-sm py-4 px-8">{{ __('Discover us') }}</button>
				</a>
			</div>
		</div>
	</div>
	<div class="flex-1 bg-jobboard-orange px-2 py-8 md:py-16">
		<div class="flex flex-col items-center">
			<h3 class="text-jobboard-deepblue max-w-[285px] font-semibold text-center text-[25px] md:text-[28px] mb-8">
				{{ __('Be part of our community') }}
			</h3>
			<div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8 max-md:px-4 max-sm:self-start">
				<div class="flex flex-row md:flex-col items-center max-md:gap-x-4 md:gap-y-4">
					<svg class="shrink-0 w-[35px] md:w-[84px]" viewBox="0 0 84 93" fill="none"
						xmlns="http://www.w3.org/2000/svg">
						<path
							d="M37.5156 2.19238C40.201 0.651727 43.4991 0.603485 46.2227 2.04785L46.4844 2.19238L46.4854 2.19336L78.0137 20.2178V20.2295L78.5186 20.5176C81.2967 22.0983 82.9998 25.0313 83 28.1953V64.8135C83 67.9742 81.291 70.9013 78.5176 72.4932L46.4854 90.8066L46.4844 90.8076C43.799 92.3483 40.5009 92.3965 37.7773 90.9521L37.5156 90.8076L37.5146 90.8066L5.48242 72.4932L5.48145 72.4922L5.22363 72.3398C2.59794 70.7276 1 67.8788 1 64.8135V28.1865C1 25.0252 2.71011 22.0975 5.48438 20.5059L5.4834 20.5049L37.5146 2.19336L37.5156 2.19238Z"
							stroke="#0E1954" stroke-width="2" />
						<path
							d="M33.637 44.7499L40.5467 29C41.9211 29 43.2392 29.5531 44.2111 30.5377C45.1829 31.5222 45.7289 32.8576 45.7289 34.25V41.2499H55.5061C56.0068 41.2442 56.5029 41.3488 56.9598 41.5566C57.4167 41.7643 57.8236 42.0702 58.1522 42.4531C58.4808 42.8359 58.7234 43.2866 58.863 43.7738C59.0026 44.2611 59.036 44.7733 58.9609 45.2749L56.5771 61.0248C56.4521 61.8594 56.0337 62.6201 55.3988 63.1668C54.7639 63.7135 53.9554 64.0093 53.1222 63.9998H33.637M33.637 44.7499V63.9998M33.637 44.7499H28.4548C27.5385 44.7499 26.6598 45.1186 26.0119 45.775C25.364 46.4314 25 47.3216 25 48.2499V60.4998C25 61.4281 25.364 62.3183 26.0119 62.9747C26.6598 63.631 27.5385 63.9998 28.4548 63.9998H33.637"
							stroke="#0E1954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
					</svg>


					<div class="flex flex-row md:flex-col text-jobboard-deepblue text-md">
						<p class="md:text-center max-w-[230px]"><strong>Bénéficiez d’avantages</strong> et promotions
							exclusifs</p>
					</div>
				</div>
				<div class="flex flex-row md:flex-col items-center max-md:gap-x-4 md:gap-y-4">
					<svg class="shrink-0 w-[35px] md:w-[84px]" viewBox="0 0 84 93" fill="none"
						xmlns="http://www.w3.org/2000/svg">
						<path
							d="M37.5156 2.19238C40.201 0.651727 43.4991 0.603485 46.2227 2.04785L46.4844 2.19238L46.4854 2.19336L78.0137 20.2178V20.2295L78.5186 20.5176C81.2967 22.0983 82.9998 25.0313 83 28.1953V64.8135C83 67.9742 81.291 70.9013 78.5176 72.4932L46.4854 90.8066L46.4844 90.8076C43.799 92.3483 40.5009 92.3965 37.7773 90.9521L37.5156 90.8076L37.5146 90.8066L5.48242 72.4932L5.48145 72.4922L5.22363 72.3398C2.59794 70.7276 1 67.8788 1 64.8135V28.1865C1 25.0252 2.71011 22.0975 5.48438 20.5059L5.4834 20.5049L37.5146 2.19336L37.5156 2.19238Z"
							stroke="#0E1954" stroke-width="2" />
						<path
							d="M37.9559 59.9036C37.9559 62.1628 39.7765 64 42.0153 64C44.2542 64 46.0748 62.1628 46.0748 59.9036M55.7802 57.6692L53.9473 54.9755C52.8279 53.337 52.2251 51.3881 52.2251 49.3896V45.1442C52.2251 40.4023 49.0514 36.4053 44.7336 35.2012V32.7558C44.7336 31.2289 43.5157 30 42.0026 30C40.4896 30 39.2717 31.2289 39.2717 32.7558V35.2012C34.9539 36.4053 31.7802 40.4023 31.7802 45.1442V49.3896C31.7802 51.3881 31.1774 53.337 30.058 54.9755L28.2251 57.6692C27.6469 58.5133 28.2497 59.6678 29.2707 59.6678H54.7346C55.7556 59.6678 56.3461 58.5133 55.7802 57.6692Z"
							stroke="#0E1954" stroke-width="2" stroke-miterlimit="10" />
					</svg>

					<div class="flex flex-row md:flex-col text-jobboard-deepblue text-md">
						<p class="md:text-center max-w-[270px]"><strong>Gérez vos annonces, vos demandes</strong> et
							vos rendez-vous</p>
					</div>
				</div>
				<div class="flex flex-row md:flex-col items-center max-md:gap-x-4 md:gap-y-4">
					<svg class="shrink-0 w-[35px] md:w-[84px]" viewBox="0 0 84 93" fill="none"
						xmlns="http://www.w3.org/2000/svg">
						<path
							d="M37.5156 2.19238C40.201 0.651727 43.4991 0.603485 46.2227 2.04785L46.4844 2.19238L46.4854 2.19336L78.0137 20.2178V20.2295L78.5186 20.5176C81.2967 22.0983 82.9998 25.0313 83 28.1953V64.8135C83 67.9742 81.291 70.9013 78.5176 72.4932L46.4854 90.8066L46.4844 90.8076C43.799 92.3483 40.5009 92.3965 37.7773 90.9521L37.5156 90.8076L37.5146 90.8066L5.48242 72.4932L5.48145 72.4922L5.22363 72.3398C2.59794 70.7276 1 67.8788 1 64.8135V28.1865C1 25.0252 2.71011 22.0975 5.48438 20.5059L5.4834 20.5049L37.5146 2.19336L37.5156 2.19238Z"
							stroke="#0E1954" stroke-width="2" />
						<path
							d="M35.3917 49.628H32.3946L26.472 55.3594H25.7295V49.6305H23.9228C22.8796 49.6272 21.8803 49.2097 21.1447 48.4697C20.4091 47.7297 19.9974 46.7277 20 45.6842V32.9464C19.9987 32.4294 20.0992 31.9173 20.2958 31.4392C20.4923 30.9611 20.7811 30.5264 21.1456 30.16C21.5101 29.7935 21.9432 29.5025 22.4201 29.3034C22.8971 29.1044 23.4085 29.0013 23.9253 29H40.7896C41.8328 29.0033 42.8321 29.4208 43.5677 30.1608C44.3033 30.9009 44.715 31.9028 44.7124 32.9464V35.7365M50.6029 59.2711H42.2178C41.7002 59.2708 41.1877 59.1683 40.7098 58.9696C40.2318 58.7708 39.7978 58.4797 39.4324 58.1129C39.0671 57.7461 38.7777 57.3108 38.5809 56.8319C38.384 56.353 38.2835 55.84 38.2851 55.3222V42.5869C38.2838 42.07 38.3843 41.5579 38.5809 41.0798C38.7774 40.6017 39.0662 40.167 39.4307 39.8005C39.7952 39.4341 40.2283 39.143 40.7052 38.944C41.1822 38.745 41.6936 38.6419 42.2104 38.6406H59.0747C59.5915 38.6419 60.1029 38.745 60.5799 38.944C61.0568 39.143 61.4899 39.4341 61.8544 39.8005C62.2189 40.167 62.5077 40.6017 62.7042 41.0798C62.9008 41.5579 63.0013 42.07 63 42.5869V55.3222C63.0016 55.8394 62.9013 56.3518 62.7049 56.8302C62.5085 57.3086 62.2198 57.7435 61.8553 58.1103C61.4907 58.477 61.0576 58.7682 60.5805 58.9674C60.1033 59.1666 59.5917 59.2698 59.0747 59.2711H57.2581V65H56.5156L50.6029 59.2711Z"
							stroke="#0E1954" stroke-width="2" stroke-miterlimit="10" stroke-linejoin="round" />
					</svg>

					<div class="flex flex-row md:flex-col text-jobboard-deepblue text-md">
						<p class="md:text-center max-w-[280px]"><strong>Bénéficiez d'une visibilité</strong> auprès de
							nos communautés d'adoptants</p>
					</div>
				</div>
				<div class="flex flex-row md:flex-col items-center max-md:gap-x-4 md:gap-y-4">
					<svg class="shrink-0 w-[35px] md:w-[84px]" viewBox="0 0 84 93" fill="none"
						xmlns="http://www.w3.org/2000/svg">
						<path
							d="M37.5156 2.19238C40.201 0.651727 43.4991 0.603485 46.2227 2.04785L46.4844 2.19238L46.4854 2.19336L78.0137 20.2178V20.2295L78.5186 20.5176C81.2967 22.0983 82.9998 25.0313 83 28.1953V64.8135C83 67.9742 81.291 70.9013 78.5176 72.4932L46.4854 90.8066L46.4844 90.8076C43.799 92.3483 40.5009 92.3965 37.7773 90.9521L37.5156 90.8076L37.5146 90.8066L5.48242 72.4932L5.48145 72.4922L5.22363 72.3398C2.59794 70.7276 1 67.8788 1 64.8135V28.1865C1 25.0252 2.71011 22.0975 5.48438 20.5059L5.4834 20.5049L37.5146 2.19336L37.5156 2.19238Z"
							stroke="#0E1954" stroke-width="2" />
						<path
							d="M52.7059 31.3043H56V66H28V31.3043H31.2941M34.5882 42.8696H49.4118M34.5882 51.1304H49.4118M37.8824 28H46.1176C47.9294 28 49.4118 29.487 49.4118 31.3043V34.6087H34.5882V31.3043C34.5882 29.487 36.0706 28 37.8824 28Z"
							stroke="#0E1954" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
					</svg>

					<div class="flex flex-row md:flex-col text-jobboard-deepblue text-md">
						<p class="md:text-center max-w-[200px]"><strong>Accédez aux conseils</strong> de nos experts</p>
					</div>
				</div>
			</div>
			<div class="flex justify-center mt-8 md:mt-12">
				<a href="{{ route('register', ['role' => 'eleveur']) }}">
					<button class="bg-jobboard-orange hover:bg-jobboard-deepblue border border-jobboard-deepbluehover rounded-full text-jobboard-deepbluehover hover:text-jobboard-cream font-semibold text-sm py-4 px-8">{{ __("I'm signing up") }}</button>
				</a>
			</div>
		</div>
	</div>
</div>
