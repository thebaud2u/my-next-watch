<div class="hidden xlsm:flex xlsm:flex-row xlsm:items-center max-w-[1200px] text-xs xlsm:justify-between xlsm:gap-x-14 xlsm:text-sm xl:text-base leading-5 w-full" x-data="{showNotifications: false}">
	<div class="flex gap-x-4 items-center" @mouseover="showNotifications= false">
		{{-- Logo --}}
		<div class="shrink-0 flex items-center z-40 mr-4 h-[100px] w-auto">
			@php
				$route = route('home');
				$user = Auth::guard('web')->user();
				$isBreeder = (Auth::guard('web')->check() && Auth::guard('web')->user()->hasRole('recruiter'));
				$isPro = (Auth::guard('web')->check() && Auth::guard('web')->user()->hasRole('professionnal'));

				if($isBreeder) $route = route('home.breeder');
				elseif($isPro) $route = route('home.pro');
			@endphp

			<x-front.logo :link="true" :href="$route" :fill="Route::is('home.breeder') || request()->is('eleveurs/*') || $isBreeder  ? 'text-jobboard-violet' : (Route::is('home.pro') || $isPro ? 'text-jobboard-orange' : 'text-jobboard-deepblue')" />
		</div>
		
		@if(request()->is('eleveurs*') || request()->is('professionnels*'))
			@if(!Auth::guard('web')->check() || !Auth::guard('web')->user()->hasRole(['breeder', 'professionnal_breeder', 'individual_breeder', 'professionnal']))
				
				<x-front.header.nav-link :href="route('pages.quisommesnous')" 
					@mouseover="showBreedOrProArticleItems = false; showBreedOrProCatItems = false; showBreedOrProDogItems = false;" 
					:active="request()->routeIs('pages.quisommesnous')" 
					:activeColor="'text-jobboard-orange'" :textColor="'text-jobboard-cream'" :class="'group'">
					
					{{ __('About') }}

					<div class="relative w-full">
						<div class="absolute left-0 transform translate-x-[50%] w-full hidden group-hover:block">
							<svg class="transform -translate-x-[50%]" width="20" height="7" viewBox="0 0 20 7" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M10.2098 1.54392C9.29997 1.54392 8.47106 1.40901 7.71797 1.13921L7.72302 1.13921C6.96993 0.8694 6.3533 0.489672 5.88325 2.16541e-05L-1.7079e-07 1.95363C0.237554 2.31837 0.485216 2.65313 0.748041 2.95791C1.0513 3.31266 1.36467 3.62743 1.69826 3.90723C2.41092 4.55177 3.21961 5.10138 4.11423 5.55606C5.00884 6.01073 5.98433 6.36548 7.04069 6.6203C7.54612 6.74021 8.07683 6.83014 8.62269 6.90009C9.16856 6.96505 9.72454 7.00002 10.2906 7.00002C11.7463 7.00002 13.0604 6.81016 14.2381 6.43043C15.4157 6.0507 16.467 5.54107 17.392 4.89653C18.4281 4.18204 19.2974 3.30766 20 2.31337L14.4251 0.00501677C14.0662 0.339778 13.6871 0.61958 13.2929 0.839423C12.8987 1.05927 12.4185 1.22415 11.8524 1.34406C11.6048 1.40902 11.347 1.45898 11.074 1.49395C10.8011 1.52893 10.513 1.54392 10.2098 1.54392Z" fill="#FFA244"/>
							</svg>
						</div>
					</div>
				</x-front.header.nav-link>

			@endif
		@endif

		@if((request()->is('eleveurs*') || request()->is('professionnels*')) || (Auth::guard('web')->check() && Auth::guard('web')->user()->hasRole(['breeder', 'professionnal_breeder', 'individual_breeder', 'professionnal'])))
			<x-front.header.nav-link :href="route('post-search.dog-posts')" @mouseover="showBreedOrProArticleItems = false; showBreedOrProCatItems = false; showBreedOrProDogItems = true;" :active="request()->routeIs('post-search.dog-posts*')" :textColor="'text-jobboard-cream'" :activeColor="'#FF7E71'">
				{{ __('Dogs') }}

				<div class="relative w-full">
					<div class="absolute left-0 transform translate-x-[50%] w-full" x-show="showBreedOrProDogItems">
						<svg class="transform -translate-x-[50%]" width="20" height="7" viewBox="0 0 20 7" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M10.2098 1.54392C9.29997 1.54392 8.47106 1.40901 7.71797 1.13921L7.72302 1.13921C6.96993 0.8694 6.3533 0.489672 5.88325 2.16541e-05L-1.7079e-07 1.95363C0.237554 2.31837 0.485216 2.65313 0.748041 2.95791C1.0513 3.31266 1.36467 3.62743 1.69826 3.90723C2.41092 4.55177 3.21961 5.10138 4.11423 5.55606C5.00884 6.01073 5.98433 6.36548 7.04069 6.6203C7.54612 6.74021 8.07683 6.83014 8.62269 6.90009C9.16856 6.96505 9.72454 7.00002 10.2906 7.00002C11.7463 7.00002 13.0604 6.81016 14.2381 6.43043C15.4157 6.0507 16.467 5.54107 17.392 4.89653C18.4281 4.18204 19.2974 3.30766 20 2.31337L14.4251 0.00501677C14.0662 0.339778 13.6871 0.61958 13.2929 0.839423C12.8987 1.05927 12.4185 1.22415 11.8524 1.34406C11.6048 1.40902 11.347 1.45898 11.074 1.49395C10.8011 1.52893 10.513 1.54392 10.2098 1.54392Z" fill="#FF7E71"/>
						</svg>
					</div>
				</div>
			</x-front.header.nav-link>

			<x-front.header.nav-link :href="route('post-search.cat-posts')" @mouseover="showBreedOrProArticleItems = false; showBreedOrProDogItems = false; showBreedOrProCatItems = true;" :active="request()->routeIs('post-search.cat-posts*')" :textColor="'text-jobboard-cream'" :activeColor="'#3DD8AC'">
				{{ __('Cats') }}

				<div class="relative w-full">
					<div class="absolute left-0 transform translate-x-[50%] w-full" x-show="showBreedOrProCatItems">
						<svg class="transform -translate-x-[50%]" width="20" height="7" viewBox="0 0 20 7" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M10.2098 1.54392C9.29997 1.54392 8.47106 1.40901 7.71797 1.13921L7.72302 1.13921C6.96993 0.8694 6.3533 0.489672 5.88325 2.16541e-05L-1.7079e-07 1.95363C0.237554 2.31837 0.485216 2.65313 0.748041 2.95791C1.0513 3.31266 1.36467 3.62743 1.69826 3.90723C2.41092 4.55177 3.21961 5.10138 4.11423 5.55606C5.00884 6.01073 5.98433 6.36548 7.04069 6.6203C7.54612 6.74021 8.07683 6.83014 8.62269 6.90009C9.16856 6.96505 9.72454 7.00002 10.2906 7.00002C11.7463 7.00002 13.0604 6.81016 14.2381 6.43043C15.4157 6.0507 16.467 5.54107 17.392 4.89653C18.4281 4.18204 19.2974 3.30766 20 2.31337L14.4251 0.00501677C14.0662 0.339778 13.6871 0.61958 13.2929 0.839423C12.8987 1.05927 12.4185 1.22415 11.8524 1.34406C11.6048 1.40902 11.347 1.45898 11.074 1.49395C10.8011 1.52893 10.513 1.54392 10.2098 1.54392Z" fill="#3DD8AC"/>
						</svg>
					</div>
				</div>
			</x-front.header.nav-link>

			<x-front.header.nav-link :href="route('professionnal-activity-search.professionnal-activities')" @mouseover="showBreedOrProArticleItems = false; showBreedOrProDogItems = false; showBreedOrProCatItems = false;" :active="request()->routeIs('professionnal-activity-search.professionnal-activities*')" :activeColor="'#FFA244'" :textColor="'text-jobboard-cream'" :class="'group'">
				{{ __('Products & Services') }}

				<div class="relative w-full">
					<div class="absolute left-0 transform translate-x-[50%] w-full hidden group-hover:block">
						<svg class="transform -translate-x-[50%]" width="20" height="7" viewBox="0 0 20 7" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M10.2098 1.54392C9.29997 1.54392 8.47106 1.40901 7.71797 1.13921L7.72302 1.13921C6.96993 0.8694 6.3533 0.489672 5.88325 2.16541e-05L-1.7079e-07 1.95363C0.237554 2.31837 0.485216 2.65313 0.748041 2.95791C1.0513 3.31266 1.36467 3.62743 1.69826 3.90723C2.41092 4.55177 3.21961 5.10138 4.11423 5.55606C5.00884 6.01073 5.98433 6.36548 7.04069 6.6203C7.54612 6.74021 8.07683 6.83014 8.62269 6.90009C9.16856 6.96505 9.72454 7.00002 10.2906 7.00002C11.7463 7.00002 13.0604 6.81016 14.2381 6.43043C15.4157 6.0507 16.467 5.54107 17.392 4.89653C18.4281 4.18204 19.2974 3.30766 20 2.31337L14.4251 0.00501677C14.0662 0.339778 13.6871 0.61958 13.2929 0.839423C12.8987 1.05927 12.4185 1.22415 11.8524 1.34406C11.6048 1.40902 11.347 1.45898 11.074 1.49395C10.8011 1.52893 10.513 1.54392 10.2098 1.54392Z" fill="#FFA244"/>
						</svg>
					</div>
				</div>
			</x-front.header.nav-link>

			<x-front.header.nav-link :href="route('article.index')" @mouseover="showBreedOrProArticleItems = true;" :active="request()->routeIs('article.index')" :textColor="'text-jobboard-cream'" :activeColor="'#FFA244'">
				{{ __('Articles & advices') }}

				<div class="relative w-full">
					<div class="absolute left-0 transform translate-x-[50%] w-full" x-show="showBreedOrProArticleItems">
						<svg class="transform -translate-x-[50%]" width="20" height="7" viewBox="0 0 20 7" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M10.2098 1.54392C9.29997 1.54392 8.47106 1.40901 7.71797 1.13921L7.72302 1.13921C6.96993 0.8694 6.3533 0.489672 5.88325 2.16541e-05L-1.7079e-07 1.95363C0.237554 2.31837 0.485216 2.65313 0.748041 2.95791C1.0513 3.31266 1.36467 3.62743 1.69826 3.90723C2.41092 4.55177 3.21961 5.10138 4.11423 5.55606C5.00884 6.01073 5.98433 6.36548 7.04069 6.6203C7.54612 6.74021 8.07683 6.83014 8.62269 6.90009C9.16856 6.96505 9.72454 7.00002 10.2906 7.00002C11.7463 7.00002 13.0604 6.81016 14.2381 6.43043C15.4157 6.0507 16.467 5.54107 17.392 4.89653C18.4281 4.18204 19.2974 3.30766 20 2.31337L14.4251 0.00501677C14.0662 0.339778 13.6871 0.61958 13.2929 0.839423C12.8987 1.05927 12.4185 1.22415 11.8524 1.34406C11.6048 1.40902 11.347 1.45898 11.074 1.49395C10.8011 1.52893 10.513 1.54392 10.2098 1.54392Z" fill="#FFA244"/>
						</svg>
					</div>
				</div>
			</x-front.header.nav-link>

			<x-front.header.nav-link :href="Auth::guard('web')->check() && Auth::guard('web')->user()->hasRole('professionnal') ? route('home.pro') : route('home.offer')" @mouseover="showBreedOrProArticleItems = false;" :active="Auth::guard('web')->check() && Auth::guard('web')->user()->hasRole('professionnal') ? request()->routeIs('home.pro') : request()->routeIs('home.offer')" :activeColor="'#FFA244'" :textColor="'text-jobboard-cream'" :class="'group'">
				{{ __('Our offers') }}

				<div class="relative w-full">
					<div class="absolute left-0 transform translate-x-[50%] w-full hidden group-hover:block">
						<svg class="transform -translate-x-[50%]" width="20" height="7" viewBox="0 0 20 7" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M10.2098 1.54392C9.29997 1.54392 8.47106 1.40901 7.71797 1.13921L7.72302 1.13921C6.96993 0.8694 6.3533 0.489672 5.88325 2.16541e-05L-1.7079e-07 1.95363C0.237554 2.31837 0.485216 2.65313 0.748041 2.95791C1.0513 3.31266 1.36467 3.62743 1.69826 3.90723C2.41092 4.55177 3.21961 5.10138 4.11423 5.55606C5.00884 6.01073 5.98433 6.36548 7.04069 6.6203C7.54612 6.74021 8.07683 6.83014 8.62269 6.90009C9.16856 6.96505 9.72454 7.00002 10.2906 7.00002C11.7463 7.00002 13.0604 6.81016 14.2381 6.43043C15.4157 6.0507 16.467 5.54107 17.392 4.89653C18.4281 4.18204 19.2974 3.30766 20 2.31337L14.4251 0.00501677C14.0662 0.339778 13.6871 0.61958 13.2929 0.839423C12.8987 1.05927 12.4185 1.22415 11.8524 1.34406C11.6048 1.40902 11.347 1.45898 11.074 1.49395C10.8011 1.52893 10.513 1.54392 10.2098 1.54392Z" fill="#FFA244"/>
						</svg>
					</div>
				</div>
			</x-front.header.nav-link>
		@else
			<x-front.header.nav-link @mouseover="showDogItems = true; showCatItems = false;showArticleItems = false;" :href="route('post-search.dog-posts')" :active="request()->routeIs('post-search.dog-posts*') ||  request()->routeIs('post-search.post.compare-chien') || request()->routeIs('post-search.post.choise-breed-result-chien') || request()->routeIs('post-search.post.choise-breed-chien*')">
				{{ __('Dogs') }}
				<div class="relative w-full">
					<div class="absolute left-0 transform translate-x-[50%] w-full" x-show="showDogItems">
						<svg class="transform -translate-x-[50%]" width="20" height="7" viewBox="0 0 20 7" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M10.2098 1.54392C9.29997 1.54392 8.47106 1.40901 7.71797 1.13921L7.72302 1.13921C6.96993 0.8694 6.3533 0.489672 5.88325 2.16541e-05L-1.7079e-07 1.95363C0.237554 2.31837 0.485216 2.65313 0.748041 2.95791C1.0513 3.31266 1.36467 3.62743 1.69826 3.90723C2.41092 4.55177 3.21961 5.10138 4.11423 5.55606C5.00884 6.01073 5.98433 6.36548 7.04069 6.6203C7.54612 6.74021 8.07683 6.83014 8.62269 6.90009C9.16856 6.96505 9.72454 7.00002 10.2906 7.00002C11.7463 7.00002 13.0604 6.81016 14.2381 6.43043C15.4157 6.0507 16.467 5.54107 17.392 4.89653C18.4281 4.18204 19.2974 3.30766 20 2.31337L14.4251 0.00501677C14.0662 0.339778 13.6871 0.61958 13.2929 0.839423C12.8987 1.05927 12.4185 1.22415 11.8524 1.34406C11.6048 1.40902 11.347 1.45898 11.074 1.49395C10.8011 1.52893 10.513 1.54392 10.2098 1.54392Z" fill="#FF7E71"/>
						</svg>
					</div>
				</div>
			</x-front.header.nav-link>

			<x-front.header.nav-link @mouseover="showCatItems = true;showDogItems = false;showArticleItems = false;" :activeColor="'#3DD8AC'" :href="route('post-search.cat-posts')" :active="request()->routeIs('post-search.cat-posts*') ||  request()->routeIs('post-search.post.compare-chat')|| request()->routeIs('post-search.post.choise-breed-result-chat') || request()->routeIs('post-search.post.choise-breed-chat*')">
				{{ __('Cats') }}
				<div class="relative w-full">
					<div class="absolute left-0 transform translate-x-[50%] w-full" x-show="showCatItems">
						<svg class="transform -translate-x-[50%]" width="20" height="7" viewBox="0 0 20 7" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M10.2098 1.54392C9.29997 1.54392 8.47106 1.40901 7.71797 1.13921L7.72302 1.13921C6.96993 0.8694 6.3533 0.489672 5.88325 2.16541e-05L-1.7079e-07 1.95363C0.237554 2.31837 0.485216 2.65313 0.748041 2.95791C1.0513 3.31266 1.36467 3.62743 1.69826 3.90723C2.41092 4.55177 3.21961 5.10138 4.11423 5.55606C5.00884 6.01073 5.98433 6.36548 7.04069 6.6203C7.54612 6.74021 8.07683 6.83014 8.62269 6.90009C9.16856 6.96505 9.72454 7.00002 10.2906 7.00002C11.7463 7.00002 13.0604 6.81016 14.2381 6.43043C15.4157 6.0507 16.467 5.54107 17.392 4.89653C18.4281 4.18204 19.2974 3.30766 20 2.31337L14.4251 0.00501677C14.0662 0.339778 13.6871 0.61958 13.2929 0.839423C12.8987 1.05927 12.4185 1.22415 11.8524 1.34406C11.6048 1.40902 11.347 1.45898 11.074 1.49395C10.8011 1.52893 10.513 1.54392 10.2098 1.54392Z" fill="#3DD8AC"/>
						</svg>
					</div>
				</div>
			</x-front.header.nav-link>

			<x-front.header.nav-link :href="route('professionnal-activity-search.professionnal-activities')" @mouseover="showBreedOrProArticleItems = false; showBreedOrProDogItems = false; showBreedOrProCatItems = false;" :active="request()->routeIs('professionnal-activity-search.professionnal-activities*')" :activeColor="'#FFA244'" :class="'group'">
				{{ __('Products & Services') }}

				<div class="relative w-full">
					<div class="absolute left-0 transform translate-x-[50%] w-full hidden group-hover:block">
						<svg class="transform -translate-x-[50%]" width="20" height="7" viewBox="0 0 20 7" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M10.2098 1.54392C9.29997 1.54392 8.47106 1.40901 7.71797 1.13921L7.72302 1.13921C6.96993 0.8694 6.3533 0.489672 5.88325 2.16541e-05L-1.7079e-07 1.95363C0.237554 2.31837 0.485216 2.65313 0.748041 2.95791C1.0513 3.31266 1.36467 3.62743 1.69826 3.90723C2.41092 4.55177 3.21961 5.10138 4.11423 5.55606C5.00884 6.01073 5.98433 6.36548 7.04069 6.6203C7.54612 6.74021 8.07683 6.83014 8.62269 6.90009C9.16856 6.96505 9.72454 7.00002 10.2906 7.00002C11.7463 7.00002 13.0604 6.81016 14.2381 6.43043C15.4157 6.0507 16.467 5.54107 17.392 4.89653C18.4281 4.18204 19.2974 3.30766 20 2.31337L14.4251 0.00501677C14.0662 0.339778 13.6871 0.61958 13.2929 0.839423C12.8987 1.05927 12.4185 1.22415 11.8524 1.34406C11.6048 1.40902 11.347 1.45898 11.074 1.49395C10.8011 1.52893 10.513 1.54392 10.2098 1.54392Z" fill="#FFA244"/>
						</svg>
					</div>
				</div>
			</x-front.header.nav-link>

			<x-front.header.nav-link :href="route('article.index')" @mouseover="showDogItems = false; showCatItems = false; showArticleItems = true;" :active="request()->routeIs('article.index')" :activeColor="'#FFA244'">
				{{ __('Articles & advices') }}
				<div class="relative w-full">
					<div class="absolute left-0 transform translate-x-[50%] w-full" x-show="showArticleItems">
						<svg class="transform -translate-x-[50%]" width="20" height="7" viewBox="0 0 20 7" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M10.2098 1.54392C9.29997 1.54392 8.47106 1.40901 7.71797 1.13921L7.72302 1.13921C6.96993 0.8694 6.3533 0.489672 5.88325 2.16541e-05L-1.7079e-07 1.95363C0.237554 2.31837 0.485216 2.65313 0.748041 2.95791C1.0513 3.31266 1.36467 3.62743 1.69826 3.90723C2.41092 4.55177 3.21961 5.10138 4.11423 5.55606C5.00884 6.01073 5.98433 6.36548 7.04069 6.6203C7.54612 6.74021 8.07683 6.83014 8.62269 6.90009C9.16856 6.96505 9.72454 7.00002 10.2906 7.00002C11.7463 7.00002 13.0604 6.81016 14.2381 6.43043C15.4157 6.0507 16.467 5.54107 17.392 4.89653C18.4281 4.18204 19.2974 3.30766 20 2.31337L14.4251 0.00501677C14.0662 0.339778 13.6871 0.61958 13.2929 0.839423C12.8987 1.05927 12.4185 1.22415 11.8524 1.34406C11.6048 1.40902 11.347 1.45898 11.074 1.49395C10.8011 1.52893 10.513 1.54392 10.2098 1.54392Z" fill="#FFA244"/>
						</svg>
					</div>
				</div>
			</x-front.header.nav-link>
		@endif
	</div>

	<div class="flex justify-between items-center gap-x-5">
		@if(Auth::guard('web')->check())
			@if(Auth::guard('web')->user()->hasRole(['adopter', 'breeder', 'professionnal_breeder', 'individual_breeder', 'professionnal', 'admin']))
				@php
					$user = Auth::guard('web')->user();
					$notReadNotifications = $user->getNotReadNotifications();
					$isBreederOrPro = ($user && method_exists($user, 'hasRole') && $user->hasRole(['breeder', 'professionnal_breeder', 'individual_breeder', 'professionnal']));
					$isBreederOrProRoute = (request()->is('professionnels*') || request()->is('eleveurs*'));
					$svgColor = 'currentColor';
					$isBreeder = false;
					$isPro = false;
					if($isBreederOrPro) {
						if($user->hasRole('recruiter')) {
							$svgColor = '#C68CFF';
							$isBreeder = true;
						}
						elseif($user->hasRole('professionnal')) {
							$svgColor = '#FFA244';
							$isPro = true;
						}
						else {
							$svgColor = '#F7F6EF';
						}
					}
				@endphp

				<x-front.header.picto-link @mouseover="showNotifications = true" :active="request()->routeIs('space.profile.my-notifications')" :activeColor="$isPro || (request()->is('professionnels*')) ? 'text-jobboard-orange' : ($isBreeder || request()->is('eleveurs*') ? 'text-jobboard-violet' : 'text-jobboard-deepblue')" :textColor="$isBreederOrPro || $isBreederOrProRoute ? 'text-jobboard-cream' : 'text-jobboard-deepblue'" :class="'relative'">
					<svg width="23" height="27" viewBox="0 0 23 27" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M8.49936 22.988C8.49936 24.6491 9.85022 26 11.5114 26C13.1726 26 14.5235 24.6491 14.5235 22.988M21.7247 21.345L20.3647 19.3644C19.5341 18.1596 19.0869 16.7265 19.0869 15.257V12.1355C19.0869 8.64878 16.732 5.70975 13.5283 4.82439V3.02629C13.5283 1.90361 12.6247 1 11.502 1C10.3793 1 9.47573 1.90361 9.47573 3.02629V4.82439C6.272 5.70975 3.91713 8.64878 3.91713 12.1355V15.257C3.91713 16.7265 3.46988 18.1596 2.63929 19.3644L1.2793 21.345C0.850312 21.9657 1.29756 22.8145 2.05513 22.8145H20.9489C21.7065 22.8145 22.1446 21.9657 21.7247 21.345Z" stroke="{{ $svgColor }}" stroke-width="1.5" stroke-miterlimit="10"/>
					</svg>

					@if($notReadNotifications->isNotEmpty())
						<span class="absolute bottom-[33px] right-[36px] w-[10px] h-[10px] rounded-full bg-jobboard-coral"></span>
					@endif

					{{ __('Notifications') }}

					<div @mouseleave="showNotifications = false" x-show="showNotifications" class="absolute w-[500px] max-h-[885px] bg-white rounded-xl shadow-md top-[80px] flex">
						<livewire:front.space.profile.my-notifications 
							:showLink="true"
							:limit="true"
							:isMenu="true"
							:key="'notifications-header-component'" />
					</div>
				</x-front.header.picto-link>

				<x-front.header.picto-link @mouseover="showNotifications = false" :href="route('space.responses.my-messages')" :active="request()->routeIs('space.responses.my-messages')" :activeColor="$isPro || (request()->is('professionnels*')) ? 'text-jobboard-orange' : ($isBreeder || request()->is('eleveurs*') ? 'text-jobboard-violet' : 'text-jobboard-deepblue')" :textColor="$isBreederOrPro || $isBreederOrProRoute ? 'text-jobboard-cream' : 'text-jobboard-deepblue'" :class="'relative'">
					<svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M23.8587 19.837C25.0543 17.9239 25.75 15.6739 25.75 13.25C25.75 6.34783 20.1521 0.75 13.25 0.75C6.34779 0.75 0.75 6.34783 0.75 13.25C0.75 20.1522 6.34779 25.75 13.25 25.75C15.6739 25.75 17.9239 25.0543 19.8369 23.8587L25.75 25.75L23.8587 19.837Z" stroke="{{ $svgColor }}" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M8.35938 10.5327H18.142" stroke="{{ $svgColor }}" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M8.35938 15.9673H14.8811" stroke="{{ $svgColor }}" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>

					@if(Auth::guard('web')->user()->countUnreadMessages() > 0)
						<span class="absolute bottom-[33px] right-[29px] w-[10px] h-[10px] rounded-full bg-jobboard-coral"></span>
					@endif

					{{ __('Messaging') }}
				</x-front.header.picto-link>

				@if(Auth::guard('web')->user()->hasRole(['breeder', 'professionnal_breeder', 'individual_breeder', 'professionnal', 'adopter', 'admin']))
					<a href="{{route('space.profile.dashboard')}}" @mouseover="showNotifications = false" class="flex gap-x-2 items-center justify-center w-[190px] h-[50px] rounded-full font-bold text-sm hover:underline hover:underline-offset-4 @if($isBreeder) bg-jobboard-violet hover:bg-jobboard-violethover @elseif($isPro) bg-jobboard-orange hover:bg-jobboard-darkorange @else bg-jobboard-deepblue hover:bg-jobboard-deepbluehover text-jobboard-cream @endif">
						@if($user && $user->hasMedia('avatar'))
							<div class="w-[31px] h-[31px] rounded-full overflow-hidden">
								<img src="{{ $user->getFirstMedia('avatar')->getUrl() }}" alt="" class="object-cover w-[31px]" />
							</div>
						@else
							@if($user->hasRole(['breeder', 'professionnal_breeder', 'individual_breeder', 'professionnal', 'admin']))
								<svg width="23" height="26" viewBox="0 0 23 26" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M8.67803 16.825H14.3965C14.0083 13.7645 9.164 13.7645 8.67803 16.825Z" fill="#0E1954"/>
									<path d="M21.6347 5.49045L12.8641 0.370537C12.0207 -0.123512 10.9793 -0.123512 10.1359 0.370537L1.36534 5.49045C0.521968 5.9845 0 6.89459 0 7.88009V18.1199C0 19.1054 0.519396 20.0181 1.36534 20.5096L10.1359 25.6295C10.9793 26.1235 12.0207 26.1235 12.8641 25.6295L21.6347 20.5096C22.478 20.0155 23 19.1054 23 18.1199V7.88269C23 6.89719 22.4806 5.9845 21.6347 5.49305V5.49045ZM17.6955 19.3056H5.37652C5.32767 18.9858 5.30196 18.1823 5.30196 17.8391C5.30196 17.1786 5.40738 16.5468 5.61565 15.9409C5.82392 15.335 6.11962 14.7942 6.4976 14.3183C6.88586 13.8347 7.34097 13.4212 7.86294 13.078C8.12778 12.9038 8.40548 12.7504 8.69603 12.6178C7.85523 11.8455 7.32297 10.7352 7.32297 9.49745C7.32297 7.17022 9.19486 5.27723 11.4961 5.27723C13.7974 5.27723 15.6693 7.17022 15.6693 9.49745C15.6693 10.73 15.1422 11.8351 14.3065 12.6074C14.6305 12.7582 14.9365 12.9298 15.2116 13.13C15.7182 13.4993 16.1604 13.9205 16.5333 14.3963C16.9061 14.8722 17.1915 15.4078 17.3921 16.0059C17.5901 16.5858 17.6903 17.1968 17.6903 17.8391V19.3056H17.6955Z" fill="#0E1954"/>
									<path d="M11.4987 11.1174C12.3834 11.1174 13.1006 10.3921 13.1006 9.49745C13.1006 8.60277 12.3834 7.87749 11.4987 7.87749C10.614 7.87749 9.89681 8.60277 9.89681 9.49745C9.89681 10.3921 10.614 11.1174 11.4987 11.1174Z" fill="#0E1954"/>
								</svg>
							@else
								<svg width="23" height="26" viewBox="0 0 23 26" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M8.67803 16.825H14.3965C14.0083 13.7645 9.164 13.7645 8.67803 16.825Z" fill="#F7F6EF"/>
									<path d="M21.6347 5.49045L12.8641 0.370537C12.0207 -0.123512 10.9793 -0.123512 10.1359 0.370537L1.36534 5.49045C0.521968 5.9845 0 6.89459 0 7.88009V18.1199C0 19.1054 0.519396 20.0181 1.36534 20.5096L10.1359 25.6295C10.9793 26.1235 12.0207 26.1235 12.8641 25.6295L21.6347 20.5096C22.478 20.0155 23 19.1054 23 18.1199V7.88269C23 6.89719 22.4806 5.9845 21.6347 5.49305V5.49045ZM17.6955 19.3056H5.37652C5.32767 18.9858 5.30196 18.1823 5.30196 17.8391C5.30196 17.1786 5.40738 16.5468 5.61565 15.9409C5.82392 15.335 6.11962 14.7942 6.4976 14.3183C6.88586 13.8347 7.34097 13.4212 7.86294 13.078C8.12778 12.9038 8.40548 12.7504 8.69603 12.6178C7.85523 11.8455 7.32297 10.7352 7.32297 9.49745C7.32297 7.17022 9.19486 5.27723 11.4961 5.27723C13.7974 5.27723 15.6693 7.17022 15.6693 9.49745C15.6693 10.73 15.1422 11.8351 14.3065 12.6074C14.6305 12.7582 14.9365 12.9298 15.2116 13.13C15.7182 13.4993 16.1604 13.9205 16.5333 14.3963C16.9061 14.8722 17.1915 15.4078 17.3921 16.0059C17.5901 16.5858 17.6903 17.1968 17.6903 17.8391V19.3056H17.6955Z" fill="#F7F6EF"/>
									<path d="M11.4987 11.1174C12.3834 11.1174 13.1006 10.3921 13.1006 9.49745C13.1006 8.60277 12.3834 7.87749 11.4987 7.87749C10.614 7.87749 9.89681 8.60277 9.89681 9.49745C9.89681 10.3921 10.614 11.1174 11.4987 11.1174Z" fill="#F7F6EF"/>
								</svg>
							@endif
						@endif

						{{ __('My space') }}
						
						@if($user->hasRole(['breeder', 'professionnal_breeder', 'individual_breeder', 'professionnal', 'admin']))
							<svg width="10" height="12" viewBox="0 0 10 12" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M1.86426 0.75L7.3188 5.75L1.86426 10.75" stroke="#0E1954" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						@else
							<svg width="10" height="12" viewBox="0 0 10 12" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M1.86426 0.75L7.3188 5.75L1.86426 10.75" stroke="#F7F6EF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						@endif
						
					</a>
				@endif

			@endif
		@else
			@if(!Route::is('home.breeder') && !Route::is('home.pro'))
				<div>
					<x-front.header.header-button x-on:click="window.location.href='{{ route('home.breeder') }}'">
						{{ __('Breeders space') }}
					</x-front.header.header-button>
				</div>
			@endif
			
			<x-front.header.picto-link :href="route('newsletter.index')" :textColor="((request()->is('professionnels*') || request()->is('eleveurs*'))) ? 'text-jobboard-cream' : 'text-jobboard-deepblue'">
				<svg class="w-[28px] h-[27px] @if(request()->is('professionnels*')) text-jobboard-orange @elseif(request()->is('eleveurs*')) text-jobboard-violet @else text-jobboard-deepblue @endif" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M16.1115 13.3943C7.91089 16.6041 6.51764 4.80311 13.6001 3.75452C14.3363 3.64552 15.0939 3.67769 15.7977 3.92032C18.1734 4.73928 19.3093 7.38448 18.0825 9.92734C17.9238 10.2563 17.7156 10.5608 17.4438 10.8045C16.2814 11.8476 15.1687 11.1278 15.4578 9.58309L15.9756 6.50644C14.2045 5.65829 11.9585 6.86933 12.052 10.0569C12.0617 10.3869 12.1788 10.7132 12.4105 10.948C13.2397 11.7884 14.7962 11.1387 15.508 9.2842M22.9268 6.94514L26.9663 10.1306M26.9663 10.1306V26H1.03381V10.1306M26.9663 10.1306L16.9643 18.2684M1.03381 10.1306L5.0733 6.94514M1.03381 10.1306L11.0356 18.2684M26.8678 25.7674L14 16.3293L1.17074 25.7347M22.9268 13.4321V0.999989H5.07331V13.3592"
						stroke="currentColor" stroke-width="1.7" stroke-miterlimit="10" stroke-linecap="round" />
				</svg>

				{{ __('Newsletter') }}
			</x-front.header.picto-link>

			<x-front.header.picto-link :href="route('login')" :textColor="((request()->is('professionnels*') || request()->is('eleveurs*'))) ? 'text-jobboard-cream' : 'text-jobboard-deepblue'">
				{{-- SVG for login icon --}}
				@if(request()->is('professionnels*') || request()->is('eleveurs*'))
					<svg width="24" height="27" viewBox="0 0 24 27" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M9.17803 17.325H14.8965C14.5083 14.2645 9.664 14.2645 9.17803 17.325Z" fill="#C68CFF"/>
						<path d="M22.1347 5.99046L13.3641 0.870548C12.5207 0.376499 11.4793 0.376499 10.6359 0.870548L1.86534 5.99046C1.02197 6.48451 0.5 7.3946 0.5 8.3801V18.6199C0.5 19.6054 1.0194 20.5181 1.86534 21.0096L10.6359 26.1295C11.4793 26.6235 12.5207 26.6235 13.3641 26.1295L22.1347 21.0096C22.978 20.5155 23.5 19.6054 23.5 18.6199V8.3827C23.5 7.3972 22.9806 6.48451 22.1347 5.99306V5.99046ZM18.1955 19.8056H5.87652C5.82767 19.4858 5.80196 18.6823 5.80196 18.3391C5.80196 17.6786 5.90738 17.0468 6.11565 16.4409C6.32392 15.835 6.61962 15.2942 6.9976 14.8183C7.38586 14.3347 7.84097 13.9213 8.36294 13.578C8.62778 13.4038 8.90548 13.2504 9.19603 13.1178C8.35523 12.3455 7.82297 11.2352 7.82297 9.99746C7.82297 7.67023 9.69486 5.77724 11.9961 5.77724C14.2974 5.77724 16.1693 7.67023 16.1693 9.99746C16.1693 11.23 15.6422 12.3351 14.8065 13.1074C15.1305 13.2582 15.4365 13.4298 15.7116 13.63C16.2182 13.9993 16.6604 14.4205 17.0333 14.8964C17.4061 15.3722 17.6915 15.9079 17.8921 16.5059C18.0901 17.0858 18.1903 17.6968 18.1903 18.3391V19.8056H18.1955Z" fill="#C68CFF"/>
						<path d="M11.9987 11.6174C12.8834 11.6174 13.6006 10.8921 13.6006 9.99746C13.6006 9.10278 12.8834 8.3775 11.9987 8.3775C11.114 8.3775 10.3968 9.10278 10.3968 9.99746C10.3968 10.8921 11.114 11.6174 11.9987 11.6174Z" fill="#C68CFF"/>
					</svg>
				@else
					<svg class="w-[28px] h-[27px]" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path
							d="M14 15.423C16.6552 15.423 18.8076 13.2705 18.8076 10.6153C18.8076 7.96012 16.6552 5.80764 14 5.80764C11.3447 5.80764 9.19226 7.96012 9.19226 10.6153C9.19226 13.2705 11.3447 15.423 14 15.423Z"
							stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
						<path
							d="M5.78845 22.9231C6.64661 21.5145 7.8527 20.3502 9.29078 19.5425C10.7289 18.7346 12.3505 18.3103 14 18.3103C15.6494 18.3103 17.2711 18.7346 18.7092 19.5425C20.1473 20.3502 21.3533 21.5145 22.2116 22.9231"
							stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
						<path
							d="M14 26C20.9037 26 26.5 20.4037 26.5 13.5C26.5 6.59644 20.9037 1 14 1C7.09644 1 1.5 6.59644 1.5 13.5C1.5 20.4037 7.09644 26 14 26Z"
							stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
				@endif

				{{ __('Log in') }}
			</x-front.header.picto-link>
		@endif
	</div>
</div>
