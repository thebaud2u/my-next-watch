<x-app-layout>
	@push('seo')
		<title>{{ __('Rates and subscriptions').' - '.env('APP_NAME').' JOB' }}</title>
	@endpush

	<x-slot name="mainTitle">
		<h1 class="mb-1 text-base lg:text-xl font-bold text-white">{{ __('Rates and subscriptions') }}</h1>
	</x-slot>

	<div class="max-w-[1280px]">
		{!! $html !!}

		@if($id == 29)
			<h2 class="font-lg font-bold text-center mb-5 mt-5">Offre TÉMAvet Studio pour votre page Marque Employeur +</h2>

			<div class="mt-4 flex flex-row flex-wrap justify-between mb-8">
				<div class="flex flex-col content-center flex-wrap h-[400px] rounded-md shadow-md w-[185px]">
					<h2 class="text-center text-lg text-white h-[120px] mt-3 p-8 rounded-t-md bg-[#b2d8e4] w-full">TÉMAvetStudio 1 média</h2>

					<div class="flex flex-col content-center justify-between flex-1">
						<div class="mt-3">
							<p class="text-center text-sm">Podcast</p>
						</div>

						<div class="flex flex-col flex-wrap content-center justify-center items-center pb-6">
							<p class="text-center font-semibold">450,00€ HT</p>
							<p class="text-center">540,00€ TTC</p>
						</div>
					</div>
				</div>

				<div class="flex flex-col content-center flex-wrap h-[400px] rounded-md shadow-md w-[185px]">
					<h2 class="text-center text-lg text-white h-[120px] mt-3 p-8 rounded-t-md flex-2 bg-[#88dcec] w-full">TÉMAvetStudio 2 médias</h2>

					<div class="flex flex-col content-center justify-between flex-1">
						<div class="mt-3">
							<p class="text-center text-sm">Podcast</p>
							<p class="text-center text-sm">Vidéo 1 (institutionnelle)</p>
						</div>

						<div class="flex flex-col flex-wrap content-center justify-center items-center pb-6">
							<p class="text-center font-semibold">2300,00€ HT</p>
							<p class="text-center">2760,00€ TTC</p>
						</div>
					</div>
				</div>
				<div class="flex flex-col content-center flex-wrap h-[400px] rounded-md shadow-md w-[185px]">
					<h2 class="text-center text-lg text-white h-[120px] mt-3 p-8 rounded-t-md bg-[#51b8cc] w-full">TÉMAvetStudio 4 médias</h2>

					<div class="flex flex-col content-center justify-between flex-1">
						<div class="mt-3">
							<p class="text-center text-sm">Podcast</p>
							<p class="text-center text-sm">Vidéo 1 (institutionnelle)</p>
							<p class="text-center text-sm">Vidéo 2 (interview)</p>
							<p class="text-center text-sm">Vidéo 3 (fun)</p>
							<p class="text-center text-sm">Shooting photo</p>
						</div>

						<div class="flex flex-col flex-wrap content-center justify-center items-center pb-6">
							<p class="text-center font-semibold">3850,00€ HT</p>
							<p class="text-center">4620,00€ TTC</p>
						</div>
					</div>
				</div>

				<div class="flex flex-col content-center flex-wrap h-[400px] rounded-md shadow-md w-[185px]">
					<h2 class="text-center text-lg text-white h-[120px] mt-3 p-8 rounded-t-md bg-[#037498] w-full">TÉMAvetStudio "Sur Mesure"</h2>

					<div class="flex flex-col content-center justify-between flex-1">
						<div class="mt-3">
							<p class="text-center text-sm">Offre à définir selon vos besoins</p>
						</div>

						<div class="flex flex-col flex-wrap content-center justify-center items-center pb-6">
							<p class="text-center font-semibold">Sur devis</p>
						</div>
					</div>
				</div>

				<div class="flex flex-row w-full justify-center mt-6">
					<button x-data="" x-on:click.prevent="window.location.href='{{ route('companies.show', ['company' => \App\Models\Company::find(1737955)]) }}';" class="inline-flex items-center px-3 py-1.5 whitespace-nowrap bg-annonces-blue hover:bg-annonces-blue border-2 border-annonces-blue hover:border-annonces-blue rounded-md text-sm xl:text-base text-white font-medium focus:outline-none focus:ring-0 transition ease-in-out duration-150">
						Visualisez les réalisations Dr Patounes sur la page Condévet
					</button>
				</div>

				<table class="w-full mt-4 table-fixed border rounded-md">
					<caption class="caption-top text-lg font-bold mb-3 mt-4">
						Options
					</caption>

					<tbody>
						<tr>
							<td class="font-semibold p-4 border md:text-md text-sm">Rurale : <span class="font-normal text-sm md:block hidden">si vous souhaitez intégrer des plans de rurale à votre vidéo</span></td>
							<td class="text-center border md:text-md text-sm">350,00 € HT</td>
							<td class="text-center border md:text-md text-sm">420,00 € TTC</td>
						</tr>

						<tr>
							<td class="font-semibold p-4 border md:text-md text-sm">Plan de la région : <span class="font-normal text-sm md:block hidden">si vous souhaitez intégrer des plans mettant en valeur la région dans laquelle vous travaillez</span></td>
							<td class="text-center border md:text-md text-sm">150,00 € HT</td>
							<td class="text-center border md:text-md text-sm">180,00 € TTC</td>
						</tr>
					</tbody>
				</table>

				<div class="flex flex-row justify-end w-full mt-4">
					<p class="text-md text-right">
						Frais de déplacement en supplément : <a href="#" class="font-bold underline" x-data="" x-on:click.prevent="$dispatch('open-modal', 'tarifs')">voir les tarifs</a>
					</p>

					<x-front.modal name="tarifs" focusable>
						<table class="w-full table-fixed border rounded-md">
							<caption class="caption-top text-lg font-bold mb-3">
								Frais de déplacement
							</caption>

							<tbody>
								<tr>
									<td class="text-center border md:text-md text-sm"></td>
									<td class="text-center border md:text-md text-sm">Hors Juillet/Août</td>
									<td class="text-center border md:text-md text-sm">Juillet/Août</td>
								</tr>
								<tr>
									<td class="text-center border md:text-md text-sm">France métropolitaine</td>
									<td class="text-center border md:text-md text-sm">450,00 € TTC</td>
									<td class="text-center border md:text-md text-sm">550,00 € TTC</td>
								</tr>
								<tr>
									<td class="text-center border md:text-md text-sm">Corse</td>
									<td class="text-center border md:text-md text-sm">550,00 € TTC</td>
									<td class="text-center border md:text-md text-sm">650,00 € TTC</td>
								</tr>
							</tbody>
						</table>
					</x-front.modal>
				</div>
			</div>
		@endif
	</div>
</x-app-layout>
