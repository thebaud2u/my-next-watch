<div class="flex flex-col items-center pt-8 pb-8 bg-annonces-lightblack w-full">
	<section class="flex flex-col items-start sm:flex-row sm:justify-between sm:flex-wrap w-full sm:gap-x-3 gap-y-6 lg:max-h-[180px] max-w-[1100px] sm:mx-auto sm:items-start">
		<div class="flex flex-col sm:items-center max-lg:pl-4 max-sm:w-full lg:items-start min-w-[240px] order-1">
			<x-front.logo :link="true" :mode="'light'" :width="240" />
		</div>

		<div class="sm:h-[152px] flex border border-transparent max-sm:border-b-[#FFFFFF1A] max-sm:w-full max-sm:max-w-[90%] sm:border-l-[#FFFFFF1A] order-3 max-sm:order-4"></div>
		<div class="sm:w-[200px] lg:w-auto lg:h-full order-4 max-sm:order-5">
			<ul class="list-none list-inside flex flex-col justify-center w-full lg:ml-0 max-lg:pl-4">
				<li class="list-none mb-4 sm:mb-8 text-sm font-bold">
					{{ __('Help') }}
				</li>
			</ul>
		</div>

		<div class="sm:h-[152px] flex border border-transparent max-sm:border-b-[#FFFFFF1A] max-sm:w-full max-sm:max-w-[90%] sm:border-l-[#FFFFFF1A] order-5 max-sm:order-6"></div>
		<div class="sm:w-[200px] lg:w-auto lg:h-full order-6 max-sm:order-7">
			<ul class="list-none list-inside flex flex-col justify-center w-full lg:ml-0 max-lg:pl-4">
				<li class="list-none mb-4 sm:mb-8 text-sm font-bold">
					{{__('About us')}}
				</li>

				<li class="mb-1">
					<a href="https://www.actu-transport-logistique.fr" target="_blank" class="inline-flex items-center whitespace-nowrap no-underline hover:underline hover:text-annonces-lightergray text-sm text-annonces-lightgray">
						{{__('Who we are')}} ?
					</a>
				</li>
			</ul>
		</div>

		<div class="sm:w-[200px] lg:w-auto lg:h-full max-sm:order-2 order-7 max-lg:pl-4">
			<ul class="list-none list-inside flex sm:flex-col max-sm:space-x-4 sm:space-y-6 justify-center w-full lg:ml-0 max-sm:text-center sm:text-left">
				<a href="#">
					<x-front.primary-button :class="'w-[159px] justify-center text-sm xl:text-sm'">
                        {{ __('Contact us') }}
                    </x-front.primary-button>
				</a>

				<li class="mb-1">
					<a href="https://www.actu-transport-logistique.fr" target="_blank">
						<button class="w-[159px] inline-flex items-center justify-center px-3 py-1.5 whitespace-nowrap rounded-full text-sm font-medium focus:outline-none focus:ring-0 transition ease-in-out duration-150 text-black bg-annonces-yellowfooter border-annonces-yellowfooter hover:bg-annonces-yellowfooter hover:border-annonces-yellowfooter uppercase">{{__('Shop')}} ?</button>
					</a>
				</li>
			</ul>
		</div>
	</section>
</div>
