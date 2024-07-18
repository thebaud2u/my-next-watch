<x-app-layout>
	@push('seo')
		<title>{{ 'Mentions légales - '.env('APP_NAME').' JOB' }}</title>
		{{-- <meta name="description" content=""> --}}
		{{-- <meta name="keywords" content="" /> --}}
		{{-- <meta name="robots" content="max-snippet:-1"> --}}
	@endpush

	{{-- Script smartad Home --}}
	{{-- <x-slot name="scriptSmartad">
		<script type="application/javascript" src="https://ced.sascdn.com/tag/106/smart.js" async></script>
		<script type="application/javascript">
			var sas = sas || {};
			sas.cmd = sas.cmd || [];
			sas.cmd.push(function() {
				sas.setup({ networkid: 106, domain: "https://adapi.smartadserver.com", async: true });
			});
			sas.cmd.push(function() {
				sas.call("onecall", {
					siteId: 647689,
					pageId: 1909673,
					formats: [
						{ id: 117673 }
						,{ id: 95727 }
						,{ id: 92846 }
						,{ id: 940 }
						,{ id: 117672 }
						,{ id: 101098 }
						,{ id: 126712 }
						,{ id: 101483 }
						,{ id: 126835 }
						,{ id: 126834 }
					],
					target: ''
				});
			});
		</script>
	</x-slot> --}}

	{{--Banners smartad Home --}}
	{{-- <x-slot name="bannersSmartad">
		<div id="sas_117673"></div>

		<script type="application/javascript">
			sas.cmd.push(function() {
				sas.render("117673"); // Format : Giga bannière 1000x90
			});
		</script>

		<div id="sas_101098"></div>

		<script type="application/javascript">
			sas.cmd.push(function() {
				sas.render("101098"); // Format : WEB 1000*300 Haut 1000x300
			});
		</script>

		<div id="sas_101483"></div>

		<script type="application/javascript">
			sas.cmd.push(function() {
				sas.render("101483"); // Format : WEB 728*90 Haut 728x90
			});
		</script>

		<div id="sas_940"></div>

		<script type="application/javascript">
			sas.cmd.push(function() {
				sas.render("940"); // Format : NONBannière 468x60
			});
		</script>
	</x-slot> --}}

	{{ Breadcrumbs::render('pages-mentions') }}

	<div class="w-full sm:max-w-4xl mx-auto mb-6 sm:px-6 sm:py-4 sm:rounded-md sm:border sm:border-gray-200">
		<div class="flex flex-row flex-wrap my-6 mx-10">
			<h1 class="mb-4 leading-10 text-2xl text-left font-bold text-annonces-blue">
				Mentions légales
			</h1>
		</div>

		<div class="mx-10">
			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Éditeur</h2>
			<p class="mb-4">{{ env('APP_NAME') }} JOB est éditée par la société SUPPLY CHAIN MAGAZINE et la société GROUPE6TM :</p>
			<p class="mb-4">
				<span class="font-semibold">SUPPLY CHAIN MAGAZINE SAS</span> au capital de 50 000 € dont le siège social est situé au 23, rue Dupont des Loges à 57000 METZ, ci-après dénommée l'Editeur. Elle est immatriculée au RCS de Metz sous le numéro B 485 341 416, SIREN : 485 341 416
			</p>
			<p class="mb-4">
				<span class="font-semibold">GROUPE6TM SAS</span> au capital de 2.257.564 Euros, immatriculée au R.C.S de METZ sous le numéro SIREN 828 456 061 ayant son siège social 23 rue Dupont des Loges à METZ (57000)
			</p>

			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Direction de la publication</h2>
			<p class="mb-4">Directeur de la publication : Monsieur François Grandidier</p>

			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Hébergeur</h2>
			<p class="mb-4">Le site internet {{ env('APP_URL') }} est hébergé sur un serveur fourni par la société SdV - SAS au capital de 110 000 € - RCS Strasbourg B 340571728 - N° SIRET 340 571 728 00013 - NAF 6201Z </p>
			<p class="mb-4"><span class="font-semibold">SdV</span><br>
				15, rue de la Nuée Bleue<br>
				67000 Strasbourg<br>
				Tél. : +33 (0)3 88 75 80 50
			</p>

			<p class="mb-4">La société <a href="https://www.sdv.fr/" class="underline underline-offset-4 text-annonces-blue hover:opacity-80" target="_blank">SdV</a> peut être contactée par courriel à l’adresse suivante : <span class="text-annonces-blue"><a href="mailto:contact@sdv.fr">contact@sdv.fr</a></span>.</p>
			<p class="mb-4">La société <a href="https://www.supplychainmagazine.fr/" class="underline underline-offset-4 text-annonces-blue hover:opacity-80" target="_blank">SCM</a> peut être contactée par courriel à l’adresse suivante : <span class="text-annonces-blue"><a href="https://www.actu-transport-logistique.fr/contacts/contact" target="_blank">https://www.actu-transport-logistique.fr/contacts/contact</a></span>.</p>
		</div>
	</div>
</x-app-layout>
