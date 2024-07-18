<x-app-layout>
	@push('seo')
		<title>{{ 'Conditions générales d\'utilisation - '.env('APP_NAME').' JOB' }}</title>
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

	{{ Breadcrumbs::render('pages-cgu') }}

	<div class="w-full sm:max-w-4xl mx-auto mb-6 sm:px-6 sm:py-4 sm:rounded-md sm:border sm:border-gray-200">
		<div class="flex flex-row flex-wrap my-6 mx-10">
			<h1 class="mb-4 leading-10 text-2xl text-left font-bold text-annonces-blue">Conditions générales d'utilisation du site {{ env('APP_NAME').' JOB' }}</h1>
		</div>

		<div class="mx-10">
			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Préambule</h2>
			<p class="mb-4">Les présentes conditions générales d'utilisation sont conclues entre :</p>
			<ul class="mb-4 list-disc list-inside">
				<li>le gérant du site internet, ci-après désigné « l’Éditeur »,</li>
				<li>toute personne souhaitant accéder au site et à ses services, ci-après appelé « l’Utilisateur ».</li>
			</ul>

			<h2 class="mb-4 leading-10 text-xl text-left font-bold text-annonces-darkblue">Article 1 - Principes</h2>
			<p class="mb-4">Les présentes conditions générales d'utilisation ont pour objet l'encadrement juridique de l’utilisation du site <a href="{{ env('APP_URL') }}" target="_blank" class="underline underline-offset-4 text-annonces-blue hover:opacity-80">{{ env('APP_URL') }}</a> et de ses services.</p>
			<p class="mb-4">Le site Internet <a href="{{ env('APP_URL') }}" target="_blank" class="underline underline-offset-4 text-annonces-blue hover:opacity-80">{{ env('APP_URL') }}</a> est un service GROUPE6TM, ci-après définies l’une et/ou l’autre comme étant « l’Éditeur » :</p>
			<ul class="mb-4 list-disc list-inside">
				<li>permettant aux internautes d’accéder à un espace consacré au recrutement des professionnels de l’artisanat et des métiers de bouche</li>
				<li>situées 23 rue Dupont des Loges 57000 Metz</li>
				<li>adresse URL du site : <a href="{{ route('home') }}" class="underline underline-offset-4 text-annonces-blue hover:opacity-80">{{ route('home') }}<a></li>
				<li>formulaire de contact : <a href="{{ route('contact') }}" class="underline underline-offset-4 text-annonces-blue hover:opacity-80">{{ route('contact') }}</a></li>
				<li>numéro de téléphone : 00 33 (0)1 40 05 23 15</li>
			</ul>
			<p class="mb-4">SUPPLY CHAIN MAGAZINE SAS au capital de 50 000 € dont le siège social est situé au 23, rue Dupont des Loges à 57000 METZ, ci-après dénommée l'Editeur. Elle est immatriculée au RCS de Metz sous le numéro B B 485 341 416, SIREN : 485 341 416</p>
			<p class="mb-4">GROUPE6TM, Société par Actions Simplifiée au capital de 2.257.564 Euros, immatriculée au R.C.S de METZ sous le numéro 828 456 061 ayant son siège social 23 rue Dupont des Loges à METZ (57000)</p>
			<p class="mb-4">Les conditions générales d'utilisation doivent être acceptées par tout Utilisateur, et son accès au site vaut acceptation de ces conditions.</p>

			<h2 class="mb-4 leading-10 text-xl text-left font-bold text-annonces-darkblue">Article 2 - Evolution et durée des CGU</h2>
			<p class="mb-4">Les présentes conditions générales d'utilisation sont conclues pour une durée indéterminée. Le contrat produit ses effets à l'égard de l'Utilisateur à compter du début de l’utilisation du service. En navigant sur le Site, les Utilisateurs acceptent sans réserve les CGU.</p>
			<p class="mb-4">Le site <a href="{{ env('APP_URL') }}" target="_blank" class="underline underline-offset-4 text-annonces-blue hover:opacity-80">{{ env('APP_URL') }}</a> se réserve le droit de modifier les clauses de ces conditions générales d’utilisation à tout moment et sans justification.</p>

			<h2 class="mb-4 leading-10 text-xl text-left font-bold text-annonces-darkblue">Article 3 - Accès au site</h2>
			<p class="mb-4">Tout Utilisateur ayant accès à internet peut accéder gratuitement et depuis n’importe où au site <a href="{{ env('APP_URL') }}" target="_blank" class="underline underline-offset-4 text-annonces-blue hover:opacity-80">{{ env('APP_URL') }}</a></p>
			<p class="mb-4">Les frais supportés par l’Utilisateur pour y accéder (connexion internet, matériel informatique, etc.) ne sont pas à la charge de l’Éditeur.</p>
			<p class="mb-4">Le site et ses différents services peuvent être interrompus ou suspendus par l’Éditeur, notamment à l’occasion d’une maintenance, sans obligation de préavis ou de justification.</p>
			<p class="mb-4">L'Utilisateur du site a accès aux services suivants :</p>
			<ul class="mb-4 list-disc list-inside">
				<li>Un service emploi {{ env('APP_NAME').' JOB' }}avec espace candidat et recruteurs</li>
			</ul>

			<h2 class="mb-4 leading-10 text-xl text-left font-bold text-annonces-darkblue">Article 4 - Responsabilités</h2>
			<p class="mb-4">La responsabilité de l'Éditeur ne peut être engagée en cas de défaillance, panne, difficulté ou interruption de fonctionnement, empêchant l'accès au site ou à une de ses fonctionnalités.</p>
			<p class="mb-4">Le matériel de connexion au site utilisée est sous l'entière responsabilité de l'Utilisateur qui doit prendre toutes les mesures appropriées pour protéger le matériel et les données notamment d'attaques virales par Internet. L'Utilisateur est par ailleurs le seul responsable des sites et données qu'il consulte.</p>
			<p class="mb-4">L'Éditeur ne pourra être tenu responsable en cas de poursuites judiciaires à l'encontre de l'Utilisateur :</p>
			<ul class="mb-4 list-disc list-inside">
				<li>du fait de l'usage du site ou de tout service accessible via Internet ;</li>
				<li>du fait du non-respect par l'Utilisateur des présentes conditions générales.</li>
			</ul>
			<p class="mb-4">L'Éditeur n'est pas responsable des dommages causés à l'Utilisateur, à des tiers et/ou à l'équipement de l'Utilisateur du fait de sa connexion ou de son utilisation du site et l'Utilisateur renonce à toute action contre l'Éditeur de ce fait.</p>
			<p class="mb-4">Si l'Éditeur venait à faire l'objet d'une procédure amiable ou judiciaire à raison de l'utilisation du site par l'Utilisateur, il pourra retourner contre lui pour obtenir indemnisation de tous les préjudices, sommes, condamnations et frais qui pourraient découler de cette procédure.</p>

			<h2 class="mb-4 leading-10 text-xl text-left font-bold text-annonces-darkblue">Article 5 - Propriété intellectuelle</h2>
			<p class="mb-4">Tous les documents techniques, produits, photographies, textes, logos, dessins, vidéos, etc., sont soumis à des droits d'auteur et sont protégés par le Code de la propriété intellectuelle. Lorsqu'ils sont remis à nos clients, ils demeurent la propriété exclusive de GROUPE6TM, seul titulaire des droits de propriété intellectuelle sur ces documents, qui doivent lui être rendus à sa demande.</p>
			<p class="mb-4">Nos clients s'engagent à ne faire aucun usage de ces documents, susceptible de porter atteinte aux droits de propriété industrielle ou intellectuelle du fournisseur et s'engagent à ne les divulguer à aucun tiers, en dehors d'une autorisation expresse et préalable donnée par l'Editeur.</p>
			<p class="mb-4">Aucune fonctionnalité du Site, et notamment les fonctions d'impression, de téléchargement, et/ou d'envoi par courrier électronique, ne saurait être utilisée par les Utilisateurs dans le but de violer les droits de propriété intellectuelle attachés aux Informations.</p>
			<p class="mb-4">L’Utilisateur s’engage à ne pas utiliser commercialement les dénominations « TEMA TRANSPORT LOGISTIQUE JOB » et « GROUPE6TM », ainsi que toute autre dénomination protégée plus généralement utilisée dans le cadre du Site, sauf avec l'autorisation préalable et exprès de GROUPE6TM.</p>
			<p class="mb-4">GROUPE6TM se réserve le droit de suspendre l'accès d’un Utilisateur au Site et de résilier les CGU immédiatement et sans avoir à respecter un quelconque préavis dès lors que cet Utilisateur ne respecte pas tout ou partie des obligations précisées ci-dessus, et ce sans préjudice des dommages et intérêts qui pourraient être dus à GROUPE6TM ni de toute autre voie de recours qui pourrait être exercée à l'encontre de cet Utilisateur.</p>

			<h2 class="mb-4 leading-10 text-xl text-left font-bold text-annonces-darkblue">Article 6 - Liens hypertextes</h2>
			<p class="mb-4">La mise en place par l'Utilisateur de tous liens hypertextes vers tout ou partie du site est strictement interdite, sauf autorisation préalable et écrite de l'Éditeur, sollicitée via le formulaire de contact à l’adresse suivante : <a href="{{ route('contact') }}" class="underline underline-offset-4 text-annonces-blue hover:opacity-80">{{ route('contact') }}</a>.</p>
			<p class="mb-4">L'Éditeur est libre de refuser cette autorisation sans avoir à justifier de quelque manière que ce soit sa décision. Dans le cas où l'Éditeur accorderait son autorisation, celle-ci n'est dans tous les cas que temporaire et pourra être retirée à tout moment, sans obligation de justification à la charge de l'Éditeur.</p>
			<p class="mb-4">Dans tous les cas, tout lien devra être retiré sur simple demande de l'Éditeur.</p>
			<p class="mb-4">Toute information accessible via un lien vers d'autres sites n'est pas sous le contrôle de l'Éditeur qui décline toute responsabilité quant à leur contenu.</p>
			<h2 class="mb-4 leading-10 text-xl text-left font-bold text-annonces-darkblue">Article 7 - Protection des données personnelles</h2>

			<h3 class="mb-4 text-xl font-semibold">Données collectées</h3>
			<p class="mb-4">Les données à caractère personnel qui sont collectées sur ce site sont les suivantes :</p>
			<ul class="mb-4 list-disc list-inside">
				<li><span class="font-semibold">ouverture de compte</span> : lors de la création du compte de l'utilisateur :</li>
				<li><span class="font-semibold">connexion</span> : lors de la connexion de l'utilisateur au site web, celui-ci enregistre, notamment, ses nom, prénom, données de connexion, d'utilisation, de localisation et ses données relatives au paiement ;</li>
				<li><span class="font-semibold">profil</span> : l'utilisation des prestations prévues sur le site web permet de renseigner un profil, pouvant comprendre une adresse et un numéro de téléphone ;</li>
				<li><span class="font-semibold">paiement</span> : dans le cadre du paiement des produits et prestations proposés sur le site web, celui-ci enregistre des données financières relatives au compte bancaire ou à la carte de crédit de l'utilisateur ;</li>
				<li><span class="font-semibold">communication</span> : lorsque le site web est utilisé pour communiquer avec d'autres membres, les données concernant les communications de l'utilisateur font l'objet d'une conservation temporaire ;</li>
				<li><span class="font-semibold">cookies</span> : les cookies sont utilisés, dans le cadre de l'utilisation du site. L'utilisateur a la possibilité de désactiver les cookies à partir des paramètres de son navigateur.</li>
			</ul>

			<h3 class="mb-4 text-xl font-semibold">Utilisation des données personnelles</h3>
			<p class="mb-4">Les données personnelles collectées auprès des utilisateurs ont pour objectif la mise à disposition des services du site web, leur amélioration et le maintien d'un environnement sécurisé. Plus précisément, les utilisations sont les suivantes :</p>
			<ul class="mb-4 list-disc list-inside">
				<li>accès et utilisation du site web par l'utilisateur ;</li>
				<li>gestion du fonctionnement et optimisation du site web ;</li>
				<li>organisation des conditions d'utilisation des Services de paiement ;</li>
				<li>vérification, identification et authentification des données transmises par l'utilisateur ;</li>
				<li>proposition à l'utilisateur de la possibilité de communiquer avec d'autres utilisateurs du site web ;</li>
				<li>mise en œuvre d'une assistance utilisateurs ;</li>
				<li>personnalisation des services en affichant des publicités en fonction de l'historique de navigation de l'utilisateur, selon ses préférences ;</li>
				<li>prévention et détection des fraudes, malwares (malicious softwares ou logiciels malveillants) et gestion des incidents de sécurité ;</li>
				<li>gestion des éventuels litiges avec les utilisateurs ;</li>
				<li>envoi d'informations commerciales et publicitaires, en fonction des préférences de l'utilisateur.</li>
			</ul>

			<h3 class="mb-4 text-xl font-semibold">Partage des données personnelles avec des tiers</h3>
			<p class="mb-4">Les données personnelles peuvent être partagées avec des sociétés tierces, dans les cas suivants :</p>
			<ul class="mb-4 list-disc list-inside">
				<li>lorsque l'Utilisateur utilise les services de paiement, pour la mise en œuvre de ces services, le site web est en relation avec des sociétés bancaires et financières tierces avec lesquelles elle a passé des contrats ;</li>
				<li>lorsque l'Utilisateur publie, dans les zones de commentaires libres du site web, des informations accessibles au public ;</li>
				<li>lorsque l'Utilisateur autorise le site web d'un tiers à accéder à ses données ;</li>
				<li>lorsque le site web recourt aux services de prestataires pour fournir l'assistance utilisateurs, la publicité et les services de paiement. Ces prestataires disposent d'un accès limité aux données de l'utilisateur, dans le cadre de l'exécution de ces prestations, et ont une obligation contractuelle de les utiliser en conformité avec les dispositions de la réglementation applicable en matière protection des données à caractère personnel ;</li>
				<li>si la loi l'exige, le site web peut effectuer la transmission de données pour donner suite aux réclamations présentées contre le site web et se conformer aux procédures administratives et judiciaires ;</li>
				<li>si le site web est impliquée dans une opération de fusion, acquisition, cession d'actifs ou procédure de redressement judiciaire, elle pourra être amenée à céder ou partager tout ou partie de ses actifs, y compris les données à caractère personnel. Dans ce cas, les utilisateurs seraient informés, avant que les données à caractère personnel ne soient transférées à une tierce partie.</li>
			</ul>

			<h3 class="mb-4 text-xl font-semibold">Sécurité et confidentialité</h3>
			<p class="mb-4">Le site web met en œuvre des mesures organisationnelles, techniques, logicielles et physiques en matière de sécurité du numérique pour protéger les données personnelles contre les altérations, destructions et accès non autorisés. Toutefois, il est à signaler qu'internet n'est pas un environnement complètement sécurisé et le site web ne peut pas garantir la sécurité de la transmission ou du stockage des informations sur internet.</p>

			<h3 class="mb-4 text-xl font-semibold">Mise en oeuvre des droits des utilisateurs</h3>
			<p class="mb-4">En application de la réglementation applicable aux données à caractère personnel, les utilisateurs disposent des droits suivants, qu'ils peuvent exercer en faisant leur demande via le formulaire de contact à l’adresse suivante : <a href="{{ route('contact') }}" class="underline underline-offset-4 text-annonces-blue hover:opacity-80">{{ route('contact') }}</a>.</p>
			<ul class="mb-4 list-disc list-inside">
				<li>le droit d’accès : ils peuvent exercer leur droit d'accès, pour connaître les données personnelles les concernant. Dans ce cas, avant la mise en œuvre de ce droit, le site web peut demander une preuve de l'identité de l'utilisateur afin d'en vérifier l'exactitude.</li>
				<li>le droit de rectification : si les données à caractère personnel détenues par le site web sont inexactes, ils peuvent demander la mise à jour des informations.</li>
				<li>le droit de suppression des données : les utilisateurs peuvent demander la suppression de leurs données à caractère personnel, conformément aux lois applicables en matière de protection des données.</li>
				<li>le droit à la limitation du traitement : les utilisateurs peuvent de demander au site web de limiter le traitement des données personnelles conformément aux hypothèses prévues par le RGPD.</li>
				<li>le droit de s’opposer au traitement des données : les utilisateurs peuvent s’opposer à ce que ses données soient traitées conformément aux hypothèses prévues par le RGPD.</li>
				<li>le droit à la portabilité : ils peuvent réclamer que le site web leur remette les données personnelles qui lui sont fournies pour les transmettre à un nouveau site web.</li>
			</ul>

			<h3 class="mb-4 text-xl font-semibold">Evolution de la présente clause</h3>
			<p class="mb-4">Le site web se réserve le droit d'apporter toute modification à la présente clause relative à la protection des données à caractère personnel à tout moment. Si une modification est apportée à la présente clause de protection des données à caractère personnel, le site web s'engage à publier la nouvelle version sur son site. Le site web informera également les utilisateurs de la modification par messagerie électronique, dans un délai minimum de 15 jours avant la date d'effet. Si l'utilisateur n'est pas d'accord avec les termes de la nouvelle rédaction de la clause de protection des données à caractère personnel, il a la possibilité de supprimer son compte.</p>

			<h2 class="mb-4 leading-10 text-xl text-left font-bold text-annonces-darkblue">Article 8 - Cookies</h2>
			<p class="mb-4">Le site <a href="{{ env('APP_URL') }}" target="_blank" class="underline underline-offset-4 text-annonces-blue hover:opacity-80">{{ env('APP_URL') }}</a> peut collecter automatiquement des informations standards. Toutes les informations collectées indirectement ne seront utilisées que pour suivre le volume, le type et la configuration du trafic utilisant ce site, pour en développer la conception et l'agencement et à d'autres fins administratives et de planification et plus généralement pour améliorer le service que nous vous offrons.</p>

			<h2 class="mb-4 leading-10 text-xl text-left font-bold text-annonces-darkblue">Article 9 - Loi applicable</h2>
			<p class="mb-4">Les présentes conditions générales d'utilisation sont soumises à l'application du droit français.</p>
			<p class="mb-4">Si les parties n'arrivent pas à résoudre un litige à l'amiable, le litige sera soumis à la compétence des tribunaux français.</p>

			<h2 class="mb-4 leading-10 text-xl text-left font-bold text-annonces-darkblue">Protection des données à caractère personnel</h2>
			<p class="mb-4">Conformément à l’article 32 de la loi nº 78-17 du 6 janvier 1978 modifiée en 2004 (dite «loi Informatique et Libertés»), les Utilisateurs sont informés que des données à caractère personnel les concernant font l’objet d’un traitement automatisé par SUPPLY CHAIN MAGAZINE ET GROUPE6TM afin d’assurer leur accès au Site. Les Utilisateurs sont informés que ces données pourront faire l’objet d’analyses statistiques de la part d’SUPPLY CHAIN MAGAZINE, GROUPE6TM et leurs filiales.</p>
			<p class="mb-4">Les informations demandées dans le cadre des formulaires disponibles sur le Site marquées d’un astérisque sont obligatoires et nécessaires à la gestion des demandes des Utilisateurs. Le défaut de réponse dans un champ obligatoire entraînera l'impossibilité pour SUPPLY CHAIN MAGAZINE ET GROUPE6TM de traiter les demandes des Utilisateurs.</p>
			<p class="mb-4">Conformément aux dispositions de la loi « Informatique et Libertés » (articles 38 et suivants), les Utilisateurs disposent d’un droit d’accès, de rectification et de suppression des données les concernant et peuvent s’opposer au traitement pour des motifs légitimes.</p>
			<p class="mb-4">Pour exercer ces droits, il convient de s’adresser à :</p>
			<p class="mb-4">SUPPLY CHAIN MAGAZINE <br>
				23 rue Dupont des Loges<br>
				57000 Metz</p>
			<p class="mb-4">Les Utilisateurs sont informés qu’en cas d’exercice de leur droit de suppression ou d’opposition, tout ou partie du Site ou de leur Espace Candidat peut leur être rendu inaccessible.</p>
		</div>
	</div>
</x-app-layout>
