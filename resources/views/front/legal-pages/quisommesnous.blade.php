<x-app-layout>
	@push('seo')
		<title>Qui sommes-nous ? Eleveurs-online.com</title>

		<meta name="keywords" content="">
		<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
		<link rel="canonical" href="{{ Request::url() }}" />
	@endpush

	<main>
		<section class="hero bg-jobboard-cream">
			<div
				class="conteneur"
				style="background:no-repeat  url('{{ asset('/storage/qsn_banner.png')}}') center center;">
				<div class="flex flex-col gap-4 lg:gap-12 items-center justify-center z-10 lg:w-[600px]">
					<h1><strong>Leader du référencement et de la mise en relation</strong><br>
						entre éleveurs et particuliers</h1>
					<div class="flex flex-col md:flex-row gap-4 lg:gap-6 justify-center">
						<a href="{{route('home')}}" class="btn-primary border-jobboard-deepblue">Je veux adopter un animal</a>
						<a href="{{route('home.breeder')}}" class="btn-eleveurs">Je suis éleveur</a>
					</div>
				</div>
				<div class="absolute hidden lg:block top-8 -right-[18%] z-0 w-[344px] h-[100px]">
					<img src="{{ asset('/storage/arc_green.svg') }}" alt=" " class="object-cover xl:w-full"
						 loading="lazy"/>
				</div>

				<div class="absolute hidden lg:block -bottom-[64px] -left-[18%] z-0 w-[385px] h-[148px]">
					<img src="{{ asset('/storage/arc_coral.svg') }}" alt=" " class="object-cover xl:w-full"
						 loading="lazy"/>
				</div>
			</div>

		</section>

		<section id="histoire" class="bg-white p-8 lg:p-16">
			<div class="conteneur">
				<div class="text-2xl text-jobboard-deepblue">
					Depuis 2005, {{env('APP_NAME') }} s’est imposé comme l’un des leaders du référencement et de la mise
					en relation entre <strong>éleveurs canins et félins et particuliers</strong> à la recherche de
					chiots ou chatons. En tant que premier réseau animalier de France, notre plateforme offre
					aux&nbsp;éleveurs une visibilité forte et qualifiée, tout en garantissant aux familles qui adoptent
					une totale transparence et sécurité dans leur démarche d’acquisition.
				</div>

                <div class="flex flex-col lg:flex-row gap-8 lg:gap-16">
                    <div class="lg:w-2/5 mx-auto">
                        <img src="{{ asset('/storage/qsn_story_visual.png') }}" alt="{{env('APP_NAME') }}"
                             class="object-cover xl:w-full" loading="lazy"/>
                    </div>
                    <div class="w-full lg:w-3/5">
                        <h1 class="mb-4 text-jobboard-deepbluem text-[25px] md:text-[32px] lg:text-[40px]">Notre histoire</h1>
                        <p class="mb-4 text-jobboard-deepblue">Créé par un éleveur passionné, Stephan Lubineau
                            (1972-2024), {{env('APP_NAME')}} figure parmi les premières plateformes spécialisées dédiées
                            aux entreprises canins et félins. Forte de plus de vingt ans d’expérience, notre communauté
                            regroupe aujourd’hui plusieurs milliers d’annonces vérifiées et actualisées, couvrant toutes
                            les races reconnues par les principaux organismes cynophiles et félins.</p>
                        <p class="mb-4 text-jobboard-deepblue">{{env('APP_NAME')}} fait partie du groupe de presse
                            professionnelle Buena Media Plus / 1Health (Europa Group), éditeur spécialisé dans les
                            animaux
                            de compagnie ( le magazine 30&nbsp;Millions d’amis, Peuple&nbsp;Animal, Petmarket, Lignées, L’Essentiel,
                            Veterinay
                            Focus,…). Grâce au soutien de cette expertise éditoriale, nous enrichissons nos contenus de
                            conseils vétérinaires, d’articles spécialisés et de ressources fiables, afin d’accompagner
                            au
                            mieux éleveurs et adoptants.</p>
                    </div>
                </div>

				@php
					$logos = [
						['nom' => '1Health' , 'logo' => '/storage/qsn_logo-1health.svg', 'url' =>'https://1health.fr/' ],
						['nom' => 'Buena Media Plus' , 'logo' => '/storage/qsn_logo-buenamediaplus.png', 'url' =>'https://1health.fr/' ],
						['nom' => 'Europa Group' , 'logo' => '/storage/qsn_logo-europa-group.png', 'url' =>'https://www.europa-group.com/' ],
						['nom' => 'Peuple Animal' , 'logo' => '/storage/qsn_logo-peuple-animal.svg', 'url' =>'https://www.peuple-animal.com/' ],
						['nom' => 'Petmarket' , 'logo' => '/storage/qsn_logo-petmarket.png', 'url' =>'https://petmarketmagazine.com/' ],
						['nom' => 'Le Point Vétérinaire' , 'logo' => '/storage/qsn_logo-lepointveterinaire.svg', 'url' =>'https://www.lepointveterinaire.fr/' ],
						['nom' => 'Lignées' , 'logo' => '/storage/qsn_logo-lignees.png', 'url' =>'https://lignees.com/' ],
						['nom' => 'L\'Essentiel' , 'logo' => '/storage/qsn_logo-lessentiel.png', 'url' =>'https://lessentielvet.com/' ],
					];
				@endphp

				<div
					class="flex flex-row justify-center lg:justify-between items-center flex-wrap lg:flex-nowrap gap-8  w-full">
					@foreach ($logos as $logo)
						<a class="logo flex flex-col items-center justify-center w-[130px] h-[42px]" target="_blank" href="{{ $logo['url'] }}" title="Découvrez {{ $logo['nom'] }}">
							<img src="{{ asset($logo['logo']) }}" alt="{{ $logo['nom'] }}" loading="lazy"/>
						</a>
					@endforeach
				</div>

			</div>
		</section>

		<section id="charte" class="bg-jobboard-deepblue p-8 lg:p-16">
			<div class="conteneur">
				<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-8">

					<div class="bg-jobboard-violet rounded-xl p-6 lg:p-12 flex flex-col justify-center h-full gap-2 xl:gap-4">
						<div class="text-center lg:text-left">
							<img src="{{ asset('/storage/eol-logo-e.png') }}" alt="{{env('APP_NAME')}}" loading="lazy" class="mx-auto lg:mx-0"/>
						</div>
						<h2 class="text-jobboard-deepblue mb-0 text-center lg:text-left">Notre Charte Qualité</h2>
						<p class="text-jobboard-deepblue">
							Afin de garantir le bien-être des animaux et la satisfaction des adoptants,
							<strong>tous les éleveurs référencés sur {{env('APP_NAME')}} s’engagent à respecter</strong>
							les grands principes suivants&nbsp;:
						</p>
						<p class="text-jobboard-deepblue hidden lg:block">
							<svg width="35" height="18" viewBox="0 0 35 18" fill="none"
								 xmlns="http://www.w3.org/2000/svg">
								<path d="M26.5 16.5615L34 9.06152L26.5 1.56152" stroke="#0E1954" stroke-width="2"
									  stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M34 9.06152H1" stroke="#0E1954" stroke-width="2" stroke-linecap="round"
									  stroke-linejoin="round"/>
							</svg>
						</p>
					</div>

					<div
						class="lg:col-span-2 grid grid-cols-1 gap-4 lg:gap-8 lg:grid-cols-2 grid-flow-dense auto-rows-min">
						<div class="bg-white rounded-xl p-4 lg:p-8 row-span-2">
							<p class="text-xl xl:text-2xl text-jobboard-deepblue"><strong>Garantir l’identification des animaux,
									leur traçabilité,</strong> le respect des obligations réglementaires de cession.</p>
						</div>

						<div class="bg-white rounded-xl p-4 lg:p-8">
							<p class="text-xl xl:text-2xl text-jobboard-deepblue"><strong>Assurer une fin de carrière
									paisible</strong> aux reproducteurs/trices.</p>
						</div>
						<div class="bg-white rounded-xl p-4 lg:p-8">
							<p class="text-xl xl:text-2xl text-jobboard-deepblue"><strong>Offrir aux animaux un cadre de vie sûr et
									confortable</strong> et un suivi vétérinaire régulier</p>
						</div>

						<div class="bg-white rounded-xl p-4 lg:p-8">
							<p class="text-xl xl:text-2xl text-jobboard-deepblue"><strong>S’engager à accompagner
									les&nbsp;adoptants</strong> dans leurs démarches et suivre les chiots/chatons dans
								leur évolution.</p>
						</div>

						<div class="bg-white rounded-xl p-4 lg:p-8">
							<p class="text-xl xl:text-2xl text-jobboard-deepblue"><strong>Avoir des pratiques de reproduction et de
									sélection</strong> conformes aux exigences du bien être animal</p>
						</div>

					</div>

				</div>
			</div>
		</section>

		<section id="confiance" class="bg-jobboard-cream p-8 lg:p-16">
			<div class="conteneur">
				<h2 class="text-jobboard-deepblue text-center">Pourquoi nous faire confiance&nbsp;?</h2>
				@php
					$confiance = [
						['titre' => 'Rigueur et transparence' , 'texte' => 'Nous vérifions l’identité et les documents de chaque éleveur pour garantir la fiabilité de chaque annonce et assurer le respect des obligations légales. Vérifications de l’identité, du numéro de SIRET, du certificat ACACED, du numéro de portée et du numéro d’identification.', 'icone' =>'fill-jobboard-coral','color' => '#FC6D5E' ],
						['titre' => 'Indépendance totale' , 'texte' => 'Par l’indépendance professionnelle de nos actionnaires qui n’ont aucun lien avec les acteurs du marché, nous restons entièrement libres dans nos choix éditoriaux pour vous offrir une information objective de qualité.', 'icone' =>'fill-jobboard-green' ,'color' => '#67BF85' ],
						['titre' => 'Public qualifié et&nbsp;ciblé' , 'texte' => 'Parce que notre référencement optimisé attire des visiteurs réellement intéressés par l’adoption d’un chien ou d’un chat de race, ce qui maximise les chances de réussite pour chaque projet d’adoption.', 'icone' =>'fill-jobboard-orange' , 'color' => '#FDAB12' ],
						['titre' => 'Contenu d\'expert' , 'texte' => 'Grâce à notre appartenance au groupe de presse professionnelle 1health, nous bénéficions d’un réseau d’experts en cynotechnie, felinotechnie, comportement et santé animale, qui enrichissent nos fiches conseils, nos articles et nos guides de bonnes pratiques.', 'icone' =>'fill-jobboard-violet' ,'color' => '#C68CFF' ],
					];
				@endphp

				<div
					class="grid grid-cols-1 lg:grid-cols-2 gap-8 w-full lg:justify-between ">
					@foreach ($confiance as $c)
						<div class="bg-white rounded-xl p-8 lg:p-16">

							<div class="flex flex-col s:flex-row items-center gap-4 mb-4">
								<svg width="63" height="70" viewBox="0 0 63 70" fill="none"
									 xmlns="http://www.w3.org/2000/svg">
									<path
										d="M59.2601 14.7327L35.2363 0.994274C32.9262 -0.331425 30.0738 -0.331425 27.7637 0.994274L3.73985 14.7327C1.42974 16.0584 0 18.5005 0 21.1449V48.6218C0 51.2662 1.42269 53.7152 3.73985 55.034L27.7637 68.7724C30.0738 70.0981 32.9262 70.0981 35.2363 68.7724L59.2601 55.034C61.5703 53.7083 63 51.2662 63 48.6218V21.1519C63 18.5075 61.5773 16.0584 59.2601 14.7397V14.7327Z"
										fill="{{ $c['color'] }}"/>
									<path
										d="M36.8236 24.5811C35.22 23.7819 33.4091 23.333 31.5 23.333C24.8673 23.333 19.5 28.7195 19.5 35.376C19.5 42.0325 24.8673 47.419 31.5 47.419C38.1327 47.419 43.5 42.0325 43.5 35.376C43.5 33.8323 43.2055 32.3543 42.6818 30.9967M26.0455 35.376L30.4091 39.7553L43.5 23.333"
										stroke="#0E1954" stroke-width="2" stroke-linecap="round"
										stroke-linejoin="round"/>
								</svg>

								<h3 class="text-2xl font-bold text-jobboard-deepblue text-center s:text-left"> {!! $c['titre'] !!}</h3>
							</div>
							<p class="text-jobboard-deepblue">{{ $c['texte'] }}</p>

						</div>
					@endforeach
				</div>


			</div>
		</section>

		<section id="engagements" class="bg-jobboard-deepblue p-8 lg:p-16">
			<div class="conteneur">
				<h2 class="text-white text-center">Nos engagements</h2>

				@php
					$engagements = [
						['titre' => 'Un service client à&nbsp;taille&nbsp;humaine' ,
						 'texte' => 'Nos équipes sont à l’écoute des éleveurs pour les accompagner dans la création d’annonces et répondre aux questions réglementaires, tout en guidant les adoptants pas à pas.',
						 'color' => 'bg-jobboard-coral',
						 'image'=>'/storage/qsn_engagement_client.png'],
						['titre' => 'L’éthique avant&nbsp;tout' ,
						 'texte' => 'Nous promouvons un entreprise responsable, respectueux du bien-être animal, de la génétique et de la santé, du plus jeune âge jusqu’à la retraite de chaque reproducteur. Et ce, pour offrir des animaux équilibrés et en bonne santé.',
						 'color' => 'bg-jobboard-orange',
						 'image'=>'/storage/qsn_engagement_ethique.png' ],
						['titre' => 'La durabilité' ,
						 'texte' => 'Nous encourageons les éleveurs à adopter des pratiques respectueuses de l’environnement et du cycle de vie des animaux, de la naissance jusqu’à la fin de leur carrière.',
						 'color' => 'bg-jobboard-violet',
						 'image'=>'/storage/qsn_engagement_durabilite.png'],
					];
				@endphp

				<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mx-auto">
					@foreach ($engagements as $engag)
						<div class="bg-white rounded-xl flex flex-col s:flex-row lg:flex-col">
							<div
								class="{{ $engag['color'] }} relative h-[130px] s:h-full lg:h-[200px] rounded-t-xl rounded-b-none s:rounded-l-xl s:rounded-r-none lg:rounded-t-xl lg:rounded-b-none w-full s:w-2/5 lg:w-full">
								<img src="{{ asset($engag['image']) }}" alt=" " loading="lazy"
									 class="absolute bottom-0 left-1/2 -translate-x-1/2 max-h-[145px] lg:max-h-none"/>
							</div>
							<div class="p-8 w-full s:w-3/5 lg:w-full">
								<h3 class="text-2xl font-bold text-jobboard-deepblue">{!! $engag['titre'] !!}</h3>
								<p class="text-jobboard-deepblue">{!! $engag['texte'] !!}</p>
							</div>
						</div>
					@endforeach
				</div>

			</div>
		</section>

		<section class="bg-white p-8 lg:p-16">
			<div class="conteneur">

				<p class="text-2xl text-jobboard-deepblue"><strong>En choisissant {{env('APP_NAME')}}, vous rejoignez une
						communauté engagée, où l’expertise professionnelle, la transparence et le respect du bien-être
						animal sont au cœur de notre démarche.</strong></p>
				<p class="text-2xl text-jobboard-deepblue"><strong>Cher éleveur,</strong> découvrez dès maintenant les
					services, les avantages et les garanties de proposer vos animaux sur notre plateforme.</p>
				<p class="text-2xl text-jobboard-deepblue"><strong>Cher adoptant,</strong> découvrez les annonces
					d’entreprises canins et félins et faites confiance à un réseau éprouvé pour trouver votre
					futur compagnon.</p>
			</div>
		</section>
		@include('components.front.nl', ['bgcolor' => 'bg-jobboard-coral'])
	</main>
	<aside>
		@include('components.front.cta-post')
		<x-front.footer-partner-sitemap/>
	</aside>

	@if (session('gtm'))
		<script>
			window.dataLayer = window.dataLayer || [];
			window.dataLayer.push(@json(session('gtm')));
		</script>
	@endif
</x-app-layout>
