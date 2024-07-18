<x-app-layout>
	@push('seo')
		<title>{{ 'Conditions générales de services - '.env('APP_NAME').' JOB' }}</title>
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

	{{ Breadcrumbs::render('pages-cgs') }}

	<div class="w-full sm:max-w-4xl mx-auto mb-6 sm:px-6 sm:py-4 sm:rounded-md sm:border sm:border-gray-200">
		<div class="flex flex-row flex-wrap my-6 mx-10">
			<h1 class="mb-4 leading-10 text-2xl text-left font-bold text-annonces-blue">
				Conditions générales de services
			</h1>
		</div>

		<div class="mx-10">
			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Préambule</h2>
			<p class="mb-4">SUPPLY CHAIN MAGAZINE et GROUPE6TM développent et exploitent une plateforme dédiée aux actualités emploi, à la valorisation, promotion et à la mise en relation entre professionnels des écosystèmes du transport et de la logistique.</p>
			<p class="mb-4">Dans le cadre de l’exploitation de ladite plateforme SUPPLY CHAIN MAGAZINE propose différentes prestations afin de répondre aux besoins des professionnels du secteur notamment en termes de visibilité, référencement, promotions et recherches de collaborateurs par diffusions d’annonces.</p>
			<p class="mb-4">Les présentes Conditions Générales de Services ont pour objet de définir les conditions et modalités selon lesquelles les sociétés SUPPLY CHAIN MAGAZINE, SAS au capital social de 50.000 €, enregistrée auprès du Registre du Commerce et des Sociétés de Metz sous le numéro Metz B B 485 341 416, SIREN : 485 341 416, dont le siège social est situé 23 rue Dupont des Loges à Metz, et SUPPLY CHAIN MAGAZINE SAS au capital de 2.257.564 Euros, immatriculée au R.C.S de METZ sous le numéro 828 456 061 ayant son siège social 23 rue Dupont des Loges à METZ (57000) représentées par leur gérant en exercice dûment habilité aux fins des présentes fournissent leurs services à leurs clients professionnels domiciliés en France ou à l’étranger (Ci-après : « Clients »).</p>
			<p class="mb-4">SUPPLY CHAIN MAGAZINE et le Client sont dénommés individuellement « <span class="font-semibold">une Partie</span> » et conjointement « <span class="font-semibold">les Parties</span> ».</p>

			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Article 1 : Définitions</h2>
			<p class="mb-4">Cet article définit les termes essentiels contenus dans les présentes Conditions Générales de Services :</p>
			<p class="mb-4">« <span class="font-semibold">Annonces</span> » : Désignent les annonces de recrutement générées par les Clients dans les conditions prévues aux présentes Conditions Générales de Services ;</p>
			<p class="mb-4">« <span class="font-semibold">Commande</span> » : Désigne la commande passée par le client auprès de SUPPLY CHAIN MAGAZINE par le biais de la Plateforme et correspondant à l’une des offres proposées par SUPPLY CHAIN MAGAZINE ;</p>
			<p class="mb-4">« <span class="font-semibold">Contenu promotionnel</span> » ou « <span class="font-semibold">Contenu</span> » : Désigne tout élément (notamment Annonces, textes, photographie, vidéo, infographie, post, podcast) destiné à promouvoir directement ou indirectement les services et offres de recrutement du Client, fournis par ce dernier ou créés par SUPPLY CHAIN MAGAZINE conformément aux Conditions Générales de Services ;</p>
			<p class="mb-4">« <span class="font-semibold">Contenu promotionnel audiovisuel</span> » : Désigne spécifiquement les contenus tels que les podcasts, photographies et vidéos, fournis par le Client ou créés par SUPPLY CHAIN MAGAZINE qui peuvent faire l’objet d’une cession de droits ;</p>
			<p class="mb-4">« <span class="font-semibold">CV-Thèques</span> » : Désignent les bases de données accessibles sur la Plateforme permettant de présenter les curriculums vitæ des Utilisateurs en recherche d’opportunités professionnelles et ayant consenti à la diffusion de leurs profils dans la CVthèque ;</p>
			<p class="mb-4">« <span class="font-semibold">Droits de propriété intellectuelle</span> » ou « <span class="font-semibold">Droits</span> » : Désignent tous droits de propriété ou d’utilisation exclusif, notamment, et sans que cela soit limitatif, les droits d’auteur, droits des marques, droits voisins et tous droits y afférents, droits de modèles, droits de conception, droits de publicité, droits à des informations confidentielles, droits moraux et patrimoniaux, ainsi que tous autres droits existant où que ce soit dans le monde, qu’ils soient ou non déposés, en ce compris les demandes, renouvellements ou extensions desdits droits, et de tous droits ou formes de protection similaires ou équivalents ;</p>
			<p class="mb-4">« <span class="font-semibold">Plateforme</span> » : Désigne la plateforme éditée par SUPPLY CHAIN MAGAZINE accessible à l’adresse URL suivante : <a href="{{ route('home') }}" class="underline underline-offset-4 text-annonces-blue hover:opacity-80"><a href="{{ route('home') }}" class="underline underline-offset-4 text-annonces-blue hover:opacity-80">{{ env('APP_URL') }}</a></a> et dédiée aux professionnels de l’artisanat et des métiers de bouche ;</p>
			<p class="mb-4">« <span class="font-semibold">Prestations</span> » : Désignent les différentes prestations proposées par SUPPLY CHAIN MAGAZINE telles que décrites à l’article 3 des présentes Conditions Générales de Services comprenant notamment la diffusion d’annonces sur la Plateforme, l’accès aux différentes CV-Thèques, ainsi que la création, diffusion et le référencement des Contenus promotionnels,</p>
			<p class="mb-4">« <span class="font-semibold">Utilisateur</span> » : Désigne toute personne physique naviguant ou usant des fonctionnalités proposées sur la Plateforme.</p>

			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Article 2 : Acceptation des Conditions Générales de Services</h2>
			<p class="mb-4">Les présentes Conditions Générales de Services sont consultables sur la Plateforme.</p>
			<p class="mb-4">En conséquence, le Client qui prend contact avec SUPPLY CHAIN MAGAZINE et GROUPE6TM est réputé avoir pris connaissance et accepté expressément les présentes Conditions Générales de Services.</p>
			<p class="mb-4">Ces Conditions Générales de Services font échec à toute clause contraire, imprimée ou non, proposée par le Client ou prise comme base de rédaction de sa Commande, dès lors qu’elle n’a pas été acceptée expressément et explicitement par SUPPLY CHAIN MAGAZINE et GROUPE6TM.</p>
			<p class="mb-4">En signant un devis, en signant un contrat ou en bénéficiant des services ou des Prestations proposées par SUPPLY CHAIN MAGAZINE et GROUPE6TM, le Client déclare avoir pris connaissance des présentes Conditions Générales de Services et accepte toutes les dispositions et règles établies ci-après sans aucune réserve. </p>

			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Article 3 : Les prestations proposées par SUPPLY CHAIN MAGAZINE</h2>
			<p class="mb-4">SUPPLY CHAIN MAGAZINE et GROUPE6TM, en fonction des demandes du Client, peuvent être chargés d’assurer différentes prestations ci-après exposées : </p>

			<h3 class="mb-4 text-xl font-semibold">3.1 Diffusion d’annonces relatives au recrutement</h3>
			<p class="mb-4">Le Client à la recherche d’un salarié ou d’un collaborateur professionnel des métiers de l’artisanat et plus spécifiquement les métiers de bouche a la possibilité de diffuser une annonce personnalisée par le biais de la Plateforme.</p>
			<p class="mb-4">À ce titre, plusieurs offres et options sont proposées par SUPPLY CHAIN MAGAZINE et GROUPE6TM afin de répondre aux besoins et exigences du Client. </p>
			<p class="mb-4">Le détail de ces propositions sont indiquées dans le tableau présenté ci-dessous :
				<a href="{{ route('rates.index') }}" class="underline underline-offset-4 text-annonces-blue hover:opacity-80">{{ route('rates.index') }}</a>
			</p>
			<p class="mb-4">En tout état de cause et quelle que soit l’offre choisie, il est entendu et compris que SUPPLY CHAIN MAGAZINE et GROUPE6TM disposent d’un droit de regard sur l’Annonce et ses différents éléments, (notamment mais pas exclusivement logo, visuel, présentations ou textes) lors de la diffusion sur la Plateforme. </p>
			<p class="mb-4">À ce titre, le Client comprend et accepte que son Annonce puisse être modifiée par les équipes de SUPPLY CHAIN MAGAZINE et GROUPE6TM afin de respecter les dispositions légales et réglementaires en vigueur. </p>
			<p class="mb-4">Dans l’éventualité où l’Annonce violerait les dispositions légales ou réglementaires en vigueur, les Conditions Générales d’Utilisation de la Plateforme et/ou les standards de qualité de SUPPLY CHAIN MAGAZINE et GROUPE6TM, ces derniers disposent de la faculté discrétionnaire de refuser sa diffusion ou de procéder à la suppression de l’Annonce effectivement publiée sans justification ni préavis. </p>
			<p class="mb-4">Dans une telle hypothèse, le Client sera notifié de la décision de SUPPLY CHAIN MAGAZINE et GROUPE6TM et disposera de la faculté de procéder à la diffusion d’une nouvelle Annonce. </p>

			<h3 class="mb-4 text-xl font-semibold">3.2. Accès à la CV-Thèque</h3>
			<p class="mb-4">Le Client détient également la possibilité d’accéder à la base de données relatives aux curriculums vitæ des Utilisateurs de la Plateforme, en recherches d’opportunités professionnelles et qui ont consenti à la diffusion publique de leur profil.</p>
			<p class="mb-4">Afin de proposer une CV-Thèque qui reflètent les recherches d’emploi actuelles des Utilisateurs, SUPPLY CHAIN MAGAZINE et GROUPE6TM mettent en place un système de retrait des curriculums vitæ si l’Utilisateur ne s’est pas connecté sur la Plateforme pendant une durée d’un (1) mois et demi. </p>
			<p class="mb-4">Le descriptif des offres proposées par SUPPLY CHAIN MAGAZINE pour accéder à la CV-thèque sont précisées dans le tableau ci-après :
				<a href="{{ route('rates.index') }}" class="underline underline-offset-4 text-annonces-blue hover:opacity-80">{{ route('rates.index') }}</a>
			</p>
			<p class="mb-4">Il est entendu et compris par le Client que SUPPLY CHAIN MAGAZINE et GROUPE6TM ne garantissent aucunement la véracité des informations mentionnées au sein des curriculums vitæ diffusés sur la Plateforme par les Utilisateurs. </p>
			<p class="mb-4">Conformément aux Conditions Générales d’utilisation de la Plateforme, il appartient à chaque Utilisateur de renseigner des informations exactes et mises à jour régulièrement. Néanmoins, SUPPLY CHAIN MAGAZINE et GROUPE6TM n’exercent aucun contrôle à ce titre et ne sont pas susceptibles d’engager leur responsabilité en cas d’informations tronquées, mensongères ou erronées. </p>
			<p class="mb-4">SUPPLY CHAIN MAGAZINE et GROUPE6TM invitent donc le Client, dans le cadre de son processus de recrutement, à solliciter les justificatifs des informations mentionnées au sein de la CV-Thèque. </p>
			<p class="mb-4">Dans l’éventualité où un Utilisateur ou client constaterait ou aurait connaissance d’un profil mensonger ou ne disposant pas de la capacité pour exercer, il est invité à en informer immédiatement SUPPLY CHAIN MAGAZINE via le formulaire de contact à l’adresse suivante : <a href="{{ route('contact') }}" class="underline underline-offset-4 text-annonces-blue hover:opacity-80">{{ route('contact') }}</a></p>

			<h3 class="mb-4 text-xl font-semibold">3.3. Diffusion et référencement de Contenus promotionnels</h3>
			<p class="mb-4">Chaque Client qui souhaite mettre en avant son activité professionnelle a également la possibilité de souscrire à une offre proposée par SUPPLY CHAIN MAGAZINE et GROUPE6TM afin de référencer son entreprise sur la Plateforme et de diffuser plusieurs Contenus promotionnels afin de promouvoir sa marque employeur.</p>
			<p class="mb-4">Afin que le Client puisse adapter cette communication à ses besoins, SUPPLY CHAIN MAGAZINE et GROUPE6TM proposent différentes options décrites dans le tableau ci-dessous :
				<a href="{{ route('rates.index') }}" class="underline underline-offset-4 text-annonces-blue hover:opacity-80">{{ route('rates.index') }}</a>
			</p>
			<p class="mb-4">En tout état de cause, en cas de souscription à l’une de ses offres, le Client garantit formellement SUPPLY CHAIN MAGAZINE que les Contenus diffusés sur la Plateforme ne contiennent pas d’éléments faux, inexacts, trompeurs, incomplets, diffamatoires, obscènes, pornographiques, indécents, harcelants, discriminants, menaçants, nuisibles ou abusifs ou portant atteinte aux droits des tiers.</p>
			<p class="mb-4">En tout état de cause, SUPPLY CHAIN MAGAZINE et GROUPE6TM disposent d’un droit de regard sur la qualité des Contenus et médias ainsi que des différents éléments qui les composent, lors de leur diffusion sur la Plateforme.</p>
			<p class="mb-4">Dans l’éventualité où ces Contenus ne respecteraient pas les dispositions légales en vigueur, les standards de qualité de SUPPLY CHAIN MAGAZINE et/ou les Conditions Générales d’Utilisation de la Plateforme, SUPPLY CHAIN MAGAZINE et GROUPE6TM disposent de la faculté discrétionnaire de refuser leur diffusion ou de procéder à leur suppression sans justification ni préavis.</p>
			<p class="mb-4">Dans une telle hypothèse, le Client serait notifié par SUPPLY CHAIN MAGAZINE et bénéficierait de la possibilité de procéder à une nouvelle diffusion de médias ou contenus promotionnels.</p>

			<h3 class="mb-4 text-xl font-semibold">3.4. Création de Contenus promotionnels audiovisuels – {{ env('APP_NAME').' JOB' }}</h3>
			<p class="mb-4">Dans l’hypothèse où le Client souscrirait à l’offre intitulée « Marque Employeur + » afin d’héberger et diffuser des Contenus promotionnels audiovisuels sur la Plateforme et sur ses propres réseaux sociaux, il a également la possibilité de bénéficier des services de création de Contenus promotionnels audiovisuels et publicitaires à destination des professionnels du transport et de la logistique proposés par SUPPLY CHAIN MAGAZINE et GROUPE6TM.</p>
			<p class="mb-4">Ainsi, le Client consent expressément à ce que les prestations de création de Contenus promotionnels audiovisuels soit effectuées par SUPPLY CHAIN MAGAZINE et GROUPE6TM par tout tiers mandaté par elle à cet effet.</p>
			<p class="mb-4">Les différentes offres de services de création de Contenus promotionnels audiovisuels proposées au Client, peuvent faire l’objet d’une demande et d’un devis spécifique ou correspondre aux offres suivantes :
				<a href="{{ route('rates.index') }}" class="underline underline-offset-4 text-annonces-blue hover:opacity-80">{{ route('rates.index') }}</a>
			</p>
			<p class="mb-4">Sitôt la Commande relative à la création de Contenus promotionnels audiovisuels effectuée par le Client, il sera contacté sous sept (7) jours ouvrés par SUPPLY CHAIN MAGAZINE et GROUPE6TM afin qu’il puisse détailler ses exigences concernant les contenus audiovisuels.</p>
			<p class="mb-4">SUPPLY CHAIN MAGAZINE et GROUPE6TM s’engagent à déployer leurs meilleurs efforts pour fixer rapidement un entretien avec le Client afin de pouvoir recueillir ses différentes exigences relativement aux contenus audiovisuels souhaités. </p>
			<p class="mb-4">Il est entendu et compris que la prestation de création des Contenus audiovisuels dépend notamment des informations transmises par le Client lors des échanges avec SUPPLY CHAIN MAGAZINE et GROUPE6TM, qui lui indiquera le planning indicatif pour la réalisation des différentes créations.</p>
			<p class="mb-4">À la suite de cet entretien préalable, le Client ainsi que SUPPLY CHAIN MAGAZINE et GROUPE6TM conviendront d’une date pour le tournage et/ou enregistrement. </p>
			<p class="mb-4">SUPPLY CHAIN MAGAZINE et GROUPE6TM rendra directement et régulièrement compte au Client des différentes étapes de la conception des Contenus promotionnels audiovisuels et s’efforceront de prendre en comptes les idées et/ou remarques qui pourraient être formulées par le Client à cet égard.</p>
			<p class="mb-4">Sauf indication contraire, les livrables correspondants aux créations réalisées seront transmis au Client dans les trente (30) jours ouvrés suivants la date du tournage et/ou de l’enregistrement.</p>
			<p class="mb-4">À compter de la date de transmission des livrables, le Client dispose d’un délai de huit (8) jours pour accepter définitivement les contenus promotionnels audiovisuels.</p>
			<p class="mb-4">À l’issue de ce délai, le silence du Client vaut acceptation des livrables correspondants aux Contenus promotionnels audiovisuels proposés par SUPPLY CHAIN MAGAZINE et GROUPE6TM.</p>
			<p class="mb-4">Une fois que le Client a accepté la livraison des contenus promotionnels audiovisuels, toute modification de ceux-ci qui pourrait être demandée par le Client fera nécessairement l’objet d’une facturation complémentaire et distincte.</p>
			<p class="mb-4">Par ailleurs, dans l’éventualité où la demande du Client entraînerait des modifications significatives et aboutirait à un remaniement profond du projet initial, SUPPLY CHAIN MAGAZINE et GROUPE6TM se réserve le droit de facturer toute prestation engagée à ce stade et réviser le devis initialement accepté par le Client.</p>
			<p class="mb-4">En tout état de cause, à l’issue de trois (3) propositions, les Parties devront se réunir afin de décider de la poursuite de leur collaboration.</p>
			<p class="mb-4">En tout état de cause, en cas d’interruption des travaux en cours, la rémunération initialement convenue et acceptée par le Client restera due à SUPPLY CHAIN MAGAZINE et GROUPE6TM ce que le Client comprend et accepte.</p>

			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Article 4 : Conditions financières</h2>
			<p class="mb-4">Les prix correspondants à la Commande, y compris les éventuels frais de déplacement, sont indiquées en euros en HT et TTC dans les tableaux indiqués à l’article 3 des présentes.</p>
			<p class="mb-4">Les prix en TTC incluent en particulier la taxe sur la valeur ajoutée (TVA) aux taux en vigueur à la date de la passation de Commande. Ainsi, toute modification du taux applicable peut impacter le prix des Prestations à compter de la date d’entrée en vigueur du nouveau taux.</p>
			<p class="mb-4">En tout état de cause, il est précisé que les prix mentionnés par SUPPLY CHAIN MAGAZINE et GROUPE6TM ne visent que la fourniture des Prestations de services décrites au sein des tableaux de l’article 3 des présentes, à l’exclusion de toute autre prestation.</p>
			<p class="mb-4">Dans l’hypothèse où le Client demanderait à bénéficier d’une prestation spécifique ou d’une prestation complémentaire, un nouveau devis ou un devis correctif serait alors établi par SUPPLY CHAIN MAGAZINE et GROUPE6TM.</p>
			<p class="mb-4">En cas de défaut d’accord du Client sur ledit devis complémentaire, il est entendu que SUPPLY CHAIN MAGAZINE et GROUPE6TM n’effectuera que les Prestations prévues initialement et arrêtées entre les Parties lors de la passation de la Commande.</p>
			<p class="mb-4">Sauf indication contraire, le paiement s’effectue par carte bancaire ou par virement bancaire lors de la passation de la Commande.</p>
			<p class="mb-4">Toute réclamation relative à une facture ou à une prestation devra être transmise par écrit, au siège social de SUPPLY CHAIN MAGAZINE et GROUPE6TM ou via le formulaire de contact à l’adresse suivante : <a href="{{ route('contact') }}" class="underline underline-offset-4 text-annonces-blue hover:opacity-80">{{ route('contact') }}</a></p>
			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Article 5 : Garanties du Client</h2>
			<p class="mb-4">Il est entendu que les déclarations, engagements et garanties du Client présentes au présent article des Conditions Générales de Services constituent des stipulations substantielles et impératives.</p>
			<p class="mb-4">En cas de désaccord avec un seul de ces engagements, le Client s’interdit de passer Commande auprès de SUPPLY CHAIN MAGAZINE et GROUPE6TM par le biais de la Plateforme.</p>
			<h3 class="mb-4 text-xl font-semibold">5.1. Engagements du Client, auteur des Annonces et Contenus promotionnels diffusés sur la Plateforme</h3>
			<p class="mb-4">Tout Client déclare et garantie formellement SUPPLY CHAIN MAGAZINE et GROUPE6TM être titulaire de l’ensemble des Droits sur les Annonces et/ou Contenus promotionnels téléversés sur la Plateforme.</p>
			<p class="mb-4">Il déclare et garantit qu’il n’a utilisé aucun fragment d’œuvre préexistantes, non tombées dans le domaine public pour la conception de ses Annonces ou Contenus promotionnels, audiovisuels ou non, diffusés sur la Plateforme.</p>
			<p class="mb-4">Le Client garantit être l’auteur des apports intellectuels qui ont conduit à la réalisation des Annonces et Contenus promotionnels téléversés sur la Plateforme et garantit qu’ils ne portent aucunement atteinte aux droits des tiers (violation de la vie privée, violation des droits d’auteurs, contrefaçons, concurrence déloyale et parasitaire, violation des droits voisins notamment de l’artiste interprète, violation du droit à l’image, dénigrement etc.).</p>
			<p class="mb-4">Le Client garantit en outre SUPPLY CHAIN MAGAZINE et GROUPE6TM que les Contenus ne contiennent pas d’éléments faux, inexactes, trompeurs, incomplets, diffamatoires, obscènes, pornographiques, indécents, harcelants, menaçants, nuisibles ou abusifs.</p>
			<p class="mb-4">À ce titre, le Client garantit SUPPLY CHAIN MAGAZINE et GROUPE6TM contre tout recours ou actions que pourraient former toute personne physique ou morale, à un titre quelconque, à cette occasion.</p>
			<p class="mb-4">Sont notamment mais pas exclusivement visés les violations ayant pour fondements les violations susmentionnées et ou les recours ou actions en contrefaçon, ainsi que les recours ou actions fondés sur la concurrence déloyale et parasitaire.</p>
			<h3 class="mb-4 text-xl font-semibold">5.2. Engagements du Client qui n’est pas l’auteur des Annonces et Contenus promotionnels diffusés sur la Plateforme</h3>
			<p class="mb-4">Dans l’éventualité où le Client ne serait pas l’auteur des Contenus promotionnels diffusés sur la Plateforme, il lui appartient impérativement, avant toute passation d’une Commande, de vérifier qu’il détient une cession de Droits lui permettant de reproduire et diffuser le Contenu promotionnel et/ou de prendre attache avec le créateur ou le titulaire desdits Droits sur le Contenu promotionnel afin d’obtenir une cession de droits lui permettant de disposer des droits de représentation, reproduction, adaptation, diffusion dudit Contenu.</p>
			<p class="mb-4">Il en est de même s’agissant des personnes et des tiers qui apparaissent sur le Contenu promotionnel, il appartient au Client de recueillir leur consentement exprès, écrit et préalable afin de pouvoir capter leurs voix et/ou leurs images en vue d’une diffusion sur la Plateforme et sur les réseaux sociaux.</p>
			<p class="mb-4">Ici encore, le Client garantit SUPPLY CHAIN MAGAZINE et GROUPE6TM contre tout recours ou actions que pourraient former toute personne physique ou morale, à un titre quelconque, à cette occasion violation de la vie privée, violation des attributs de la personnalités, violation des droits d’auteurs, contrefaçons, concurrence déloyale et parasitaire, violation des droits voisins notamment de l’artiste interprète, violation de tout autre droit tels que le droit à l’image, dénigrement etc.</p>
			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Article 6 : Garanties de {{ env('APP_NAME').' JOB' }} et SUPPLY CHAIN MAGAZINE et GROUPE6TM</h2>
			<p class="mb-4">SUPPLY CHAIN MAGAZINE et GROUPE6TM s’engage à apporter tout le soin et les diligences nécessaires à la fourniture d’un service de qualité conformément aux usages de la profession et aux règles de l’art.</p>
			<p class="mb-4">La responsabilité de SUPPLY CHAIN MAGAZINE et GROUPE6TM au titre des présentes est appréciée au regard d’une obligation de moyens et ne peut être recherchée qu’en cas de préjudice direct et démontré par le Client découlant d’une inexécution des dispositions des présentes Conditions Générales de Services.</p>
			<p class="mb-4">Quoi qu’il en soit, il est entendu que SUPPLY CHAIN MAGAZINE et GROUPE6TM n’est aucunement responsable du succès ou de l’échec des Annonces et/ou Contenus promotionnels et/ou audiovisuels, créés ou diffusés sur la Plateforme.</p>
			<p class="mb-4">En effet, toute réclamation portant sur les retombées commerciales ou le succès dans la recherche de collaborateurs, ne pourra en aucun cas être pris en compte, ce que le Client comprend et accepte expressément.</p>
			<p class="mb-4">Par ailleurs, si SUPPLY CHAIN MAGAZINE et GROUPE6TM déploie ses meilleurs efforts pour proposer une Plateforme fonctionnelle, SUPPLY CHAIN MAGAZINE et GROUPE6TM ne peut garantir un fonctionnement parfait et continue de celle-ci, ce que le Client comprend et accepte.</p>
			<p class="mb-4">Ainsi SUPPLY CHAIN MAGAZINE et GROUPE6TM ne saurait être tenu pour responsable de l’indisponibilité temporaire de la Plateforme, notamment en cas de :</p>
			<ul class="mb-4 list-disc list-inside">
				<li>Maintenance évolutive et/ou corrective de la Plateforme ;</li>
				<li>Survenance d’un évènement imprévisible, insurmontable et extérieur ;</li>
				<li>Défaillance du réseau ou des connexions internet.</li>
			</ul>

			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Article 7 : Propriété Intellectuelle</h2>

			<h3 class="mb-4 text-xl font-semibold">7.1 Cession de droits en cas de création de Contenus promotionnels audiovisuels par {{ env('APP_NAME').' JOB' }} et SUPPLY CHAIN MAGAZINE et GROUPE6TM</h3>
			<p class="mb-4">En cas de création de Contenus promotionnels audiovisuels pour le compte du Client dans les conditions fixées dans les présentes Conditions Générales de Services, SUPPLY CHAIN MAGAZINE et GROUPE6TM déclare que tous les Contenus, quelles que soient leurs formes notamment textes, images, photographies, sons, audios, vidéos, quels que soient leur nature, leur forme et leur support etc. sont cédés au Client à l’issue du complet paiement de la somme mentionnée au moment de la passation de Commande.</p>
			<p class="mb-4">En cas de complet paiement, SUPPLY CHAIN MAGAZINE et GROUPE6TM cède au Client les droits de reproduction, d’utilisation, d’adaptation, de traduction, de chargement et de diffusion des Contenus promotionnels audiovisuels et ce sur tous supports connus ou inconnus au jour de la rédaction des présentes, pour la durée de protection du droit d’auteur et pour le monde entier.</p>
			<p class="mb-4">Les droits cédés comprennent notamment :</p>
			<ul class="mb-4 list-disc list-inside">
				<li>Le droit de reproduire ou de faire reproduire les Contenus promotionnels audiovisuels et, en tout ou en partie, par tous moyens et procédés, sur tous supports et tous matériaux tant actuels que futurs, connus ou inconnus ;</li>
				<li>Le droit de représenter ou de faire représenter les Contenus promotionnels audiovisuels par tous moyens de diffusion et de communication actuels ou futurs, connus ou inconnus, notamment par tout réseau de télécommunication tels qu’Internet, intranet, réseau de télévision numérique, transmission par voie hertzienne, par satellite, par câble, wap, système télématique interactif, par téléchargement, télétransmission, réseaux de téléphonie avec ou sans fil ;</li>
				<li>Le droit d’adapter, modifier, transformer, faire évoluer, en tout ou en partie, les Contenus promotionnels audiovisuels, de les faire évoluer, de réaliser de nouvelles versions, de les maintenir, de les décompiler, de les mixer, modifier, assembler, transcrire, arranger, numériser, porter sur toute configuration, les transcrire en tout ou en partie, sous toute forme, modifiée, amputée, condensée, étendue, d'en intégrer tout ou partie vers ou dans des œuvres existantes ou à venir, et ce sur tout support connus ou inconnus à ce jour ;</li>
				<li>Le droit de traduire ou de faire traduire les Contenus promotionnels audiovisuels, en tout ou en partie, en toute langue, et de reproduire les créations en résultant sur tout support, papier, magnétique, optique ou électronique, et notamment sur Internet, disque, disquette, bande, CD-ROM, listing ;</li>
				<li>Le droit de mettre sur le marché, de distribuer, commercialiser, diffuser les Contenus promotionnels audiovisuels, par tous moyens connus ou inconnus à ce jour et sur tous supports ;</li>
				<li>Le droit de céder tout ou partie des droits cédés, et notamment de consentir à tout tiers tout contrat de reproduction, de distribution, de diffusion, de commercialisation, de fabrication, sous quelque forme, quelque support et quelque moyen que ce soit, à titre onéreux ou gratuit.</li>
			</ul>
			<p class="mb-4">SUPPLY CHAIN MAGAZINE et GROUPE6TM garantit le Client contre tout recours des tiers quant à la violation de leurs Droits de propriété intellectuelle sur ces contenus créés et cédés et garantit que la diffusion des Contenus promotionnels audiovisuels cédés respecte les Droits de propriété intellectuelle des tiers.</p>

			<h3 class="mb-4 text-xl font-semibold">7.2 Communication</h3>
			<p class="mb-4">Le Client autorise SUPPLY CHAIN MAGAZINE et GROUPE6TM à utiliser ses marques, visuels, slogans, logos et signes distinctifs à des fins de communication sur ses présentations commerciales, sur la Plateforme, sur internet et notamment sur les réseaux sociaux.</p>
			<p class="mb-4">Le Client autorise également SUPPLY CHAIN MAGAZINE et GROUPE6TM à utiliser le résultat et les Contenus promotionnels créés par SUPPLY CHAIN MAGAZINE et GROUPE6TM à des fins de communication sur ses présentations commerciales, sur la Plateforme, sur internet et notamment sur les réseaux sociaux.</p>
			<p class="mb-4">En tout état de cause, SUPPLY CHAIN MAGAZINE et GROUPE6TM s’abstiendra de toute communication susceptible de porter atteinte à l’image ou à la notoriété de son Client.</p>

			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Article 8 : Absence d’exclusivité</h2>
			<p class="mb-4">Le Client reconnait et accepte que SUPPLY CHAIN MAGAZINE et GROUPE6TM ne lui garantit aucune exclusivité lors de la passation de la Commande.</p>
			<p class="mb-4">L’attention du Client de SUPPLY CHAIN MAGAZINE et GROUPE6TM est donc attirée sur le fait que d’autres clients potentiellement concurrents de celui-ci pourront également bénéficier des services et des Prestations de SUPPLY CHAIN MAGAZINE et GROUPE6TM et ce pendant la même période.</p>
			<p class="mb-4">Le Client renonce par avance à toute action en responsabilité à l’encontre de SUPPLY CHAIN MAGAZINE et GROUPE6TM du fait de cette absence d’exclusivité qu’il reconnait avoir parfaitement acceptée.</p>

			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Article 9 : Durée et engagements</h2>
			<p class="mb-4">En passation Commande auprès de SUPPLY CHAIN MAGAZINE et GROUPE6TM et en souscrivant à une offre proposée par le biais de la Plateforme, le Client bénéficiera des services et des Prestations de SUPPLY CHAIN MAGAZINE et GROUPE6TM pendant la durée indiquée lors de la passation de la Commande (de 2 à 12 mois) sans reconduction ou renouvellement tacite.</p>

			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Article 10 : Résiliation du contrat pour manquement ou force majeure</h2>
			<p class="mb-4">La résiliation peut résulter d’un manquement, d’une convenance ou d’un cas de force majeure.</p>

			<h3 class="mb-4 text-xl font-semibold">10.1. Résiliation pour manquement contractuel</h3>
			<p class="mb-4">En cas de manquement par une Partie à l’une de ses obligations, l’autre Partie pourra de plein droit, à sa propre discrétion, résilier le contrat ou son engagement, sans préjudice de tous dommages et intérêts auxquels elle pourrait prétendre.</p>
			<p class="mb-4">La résiliation prendra effet quinze (15) jours après l’envoi d’une mise en demeure de remédier au manquement en cause resté sans effet, adressée à la partie défaillante par lettre recommandée avec accusé de réception ou par courriel.</p>

			<h3 class="mb-4 text-xl font-semibold">10.2. Résiliation pour force majeure</h3>
			<p class="mb-4">Même en cas de force majeure, la partie invoquant l’impossibilité d’exécution pour une telle cause devra tout de même :</p>
			<ul class="mb-4 list-disc list-inside">
				<li>Informer par tout moyen l’autre Partie (et lui confirmer par écrit) de la survenance de<br>
					L’évènement qui le place dans l’impossibilité d’exécuter ses obligations dès la survenance et au plus tard dans les quarante-huit (48) heures en précisant la nature, le point de départ et la durée estimée de l’évènement présentant les caractéristiques de la force majeure ;</li>
				<li>Prendre dans les meilleurs délais, toutes les mesures raisonnables pour remédier à cette situation qui revêt les caractéristiques de la force majeure.</li>
			</ul>
			<p class="mb-4">Si la durée d’inexécution du contrat est inférieure à dix-huit (18) jours, les obligations seront suspendues pendant toute la durée d’interruption.</p>
			<p class="mb-4">Le contrat de diffusion de messages publicitaires s’exécutera de nouveau normalement dès la disparition de l’évènement constitutif de la force majeure pour la durée restant à courir telle qu’indiquée dans la Commande.</p>
			<p class="mb-4">Si la durée d’inexécution outrepasse la durée de dix-huit (18) jours, le contrat pourra être résilié à la demande de l’autre partie, par lettre recommandée avec avis de réception, sans que cette résiliation ne donne droit au profit de l’autre à de quelconques dommages et intérêts.</p>

			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Article 11 : Absence de droit de rétractation</h2>
			<p class="mb-4">Conformément à l’article L221-3 du Code de la consommation, les dispositions relatives au droit de rétractation, applicables aux relations entre consommateurs et professionnels, sont étendues aux contrats conclus hors établissement entre deux professionnels si et seulement si l’objet de ces contrats n’entre pas dans le champ de l’activité principale du professionnel sollicité et que le nombre de salariés employées par celui-ci est inférieur ou égal à cinq.</p>
			<p class="mb-4">Dans ces conditions, il est entendu et compris que toute les Prestations proposées par SUPPLY CHAIN MAGAZINE et GROUPE6TM relatives à la publication d’Annonces, d’accès à la CV-Thèque ou de créations de Contenus promotionnels pour valoriser les marques employeur sont sollicitées par le Client professionnel dans le cadre du développement et du maintien de son activité, entrent dans le champ de son activité principale et n’impliquent aucun droit de rétractation.</p>
			<p class="mb-4">Le Client déclare être informé de ces spécificités et renoncer expressément à son droit de rétractation pour les Commandes effectuées auprès de SUPPLY CHAIN MAGAZINE et GROUPE6TM.</p>
			<p class="mb-4">Dans l’hypothèse où le Client professionnel disposerait d’un nombre de salariés inférieur ou égal à cinq et justifierait que les Prestations n’entrent pas dans le champ de son activité principale, il est invité à transmettre sa demande de rétractation via le formulaire de contact à l’adresse suivante : <a href="{{ route('contact') }}" class="underline underline-offset-4 text-annonces-blue hover:opacity-80">{{ route('contact') }}</a> dans un délai de quatorze jours (14) à compter de la validation de sa Commande en indiquant son souhait univoque de solliciter son droit de rétractation relativement à la Commande passée auprès de SUPPLY CHAIN MAGAZINE et GROUPE6TM.</p>
			<p class="mb-4">Conformément aux dispositions de l’article L.221-24 du Code de la consommation, si le Client exerce valablement son droit de rétractation et dans l’hypothèse où les Prestations n’entrent effectivement pas dans le champ de son activité principale, SUPPLY CHAIN MAGAZINE et GROUPE6TM procèdera aux remboursement des sommes versées, dans les quatorze jours (14) à compter de la date à laquelle le Client a informé SUPPLY CHAIN MAGAZINE et GROUPE6TM de son intention de se rétracter sous réserve toutefois du respect des conditions posées à l’article L221-3 du Code de la consommation.</p>
			<p class="mb-4">Dans une telle hypothèse, le remboursement se fera selon le moyen de paiement utilisé pour la transaction initiale, sauf accord exprès du Client pour un autre moyen de remboursement.</p>

			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Article 12 : Données à caractère personnel</h2>
			<p class="mb-4">Chacune des Parties s’engagent au respect des dispositions de la loi 78-17 du 6 janvier 1978 dite « Loi Informatique et Libertés » dans sa dernière version modifiée ainsi que du Règlement européen n°2016-679 de protection des données personnelles du 27 avril 2016 dit « RGPD ».</p>
			<p class="mb-4">SUPPLY CHAIN MAGAZINE et GROUPE6TM est susceptible de collecter et traiter des données à caractère personnel concernant les Utilisateurs de la Plateforme ainsi que concernant les personnes physiques, salariés ou collaborateurs, travaillant pour ses Clients pour les besoins de la négociation, la conclusion et l’exécution de la Commande.</p>
			<p class="mb-4">Chaque Utilisateur, salarié ou collaborateur concerné dispose des droits prévus par la Règlementation sur les Données personnelles conformément à la Politique de confidentialité accessible sur la Plateforme.</p>

			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Article 13 : Modification des Conditions Générales</h2>
			<p class="mb-4">SUPPLY CHAIN MAGAZINE et GROUPE6TM pourra modifier à tout moment, et à sa seule discrétion, les présentes Conditions Générales de Services. Les modifications entreront en vigueur dès le jour de leur mise en ligne sur la Plateforme.</p>
			<p class="mb-4">Toutefois, en cas de modification des présentes Conditions Générales de Services, les relations contractuelles entre SUPPLY CHAIN MAGAZINE et GROUPE6TM et le Client seront exclusivement régis par les Conditions Générales de Services acceptées par le Client lors de la passation de sa Commande.</p>

			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Article 14 : Nullité</h2>
			<p class="mb-4">Toute tolérance de l’une ou l’autre des Parties envers la non-exécution ou l’exécution imparfaite par l’autre Partie d’une ou plusieurs clauses ou obligations des présentes Conditions Générales de Services, que ce soit de façon temporaire ou permanente, ne saurait s’analyser en une renonciation, même implicite, aux droits découlant de ladite clause.</p>
			<p class="mb-4">Dans l’hypothèse où l’une quelconque des clauses des présentes Conditions Générales de Services viendrait à être invalidée par décision de justice ou en raison d’une modification de la loi, les parties conviennent expressément que les autres dispositions du contrat ne seront nullement affectées et s’engagent à négocier dans les plus brefs délais afin de trouver une clause légalement valable à effet de remplacer la clause ainsi invalidée.</p>

			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Article 15 : Loi applicable et attribution de juridiction</h2>
			<p class="mb-4">Les présentes Conditions Générales de Services sont soumises à la loi française.</p>
			<p class="mb-4">Les Parties feront tout leur possible pour régler à l’amiable tout différend qui pourrait survenir entre elles relativement à l’application des présentes Conditions Générales de Services.</p>
			<p class="mb-4">A défaut d’accord amiable entre les Parties, tout litige lié à la formation ou à l’exécution du contrat relèvera de la compétence exclusive des tribunaux français.</p>
		</div>
	</div>

</x-app-layout>
