<x-app-layout>
	@push('seo')
		<title>{{ 'Politique de confidentialité - '.env('APP_NAME').' JOB' }}</title>
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

	{{ Breadcrumbs::render('pages-confidentialite') }}

	<div class="w-full sm:max-w-4xl mx-auto mb-6 sm:px-6 sm:py-4 sm:rounded-md sm:border sm:border-gray-200">
		<div class="flex flex-row flex-wrap my-6 mx-10">
			<h1 class="mb-4 leading-10 text-2xl text-left font-bold text-annonces-blue">
				Politique de confidentialité
			</h1>
		</div>

		<div class="mx-10">
			<h3 class="mb-4 text-xl font-semibold">Version en date du 30 octobre 2023</h3>
			<p class="mb-4">SUPPLY CHAIN MAGAZINE ET GROUPE6TM proposent à leurs utilisateurs des médias omnicanal digital et print à destination des professionnels du transport et de la logistique, qui regroupe des articles, des newsletters, des guides et des magazines. SUPPLY CHAIN MAGAZINE met également à disposition de ses utilisateurs un site emploi, TÉMA TRANSPORT LOGISTIQUE JOB, qui permet une mise en relation fluide entre recruteurs et candidats et met en lumière la marque employeur des entreprises.</p>
			<p class="mb-4">Nous vous invitons à lire attentivement le document « Politique de Confidentialité » ci-dessous. Pour toute question le concernant ou concernant plus généralement la collecte et le traitement de vos informations personnelles par la société SAS SUPPLY CHAIN MAGAZINE ou GROUPE6TM appartenant au même groupe, n’hésitez pas à nous contacter via le formulaire de contact à l’adresse suivante : <span class="text-annonces-blue"><a href="https://job.tema-transport-logistique.com/contact" target="_blank">https://job.tema-transport-logistique.com/contact</a></span>.</p>
			<h3 class="mb-4 text-xl font-semibold">Préambule et champ d’application :</h3>
			<p class="mb-4">SUPPLY CHAIN MAGAZINE est soucieux de préserver la confidentialité de vos informations personnelles et nous attachons une grande importance à la protection de la vie privée des Utilisateurs de nos Services.</p>
			<p class="mb-4">Les sociétés SUPPLY CHAIN MAGAZINE, SAS au capital social de 50.000 €, enregistrée auprès du Registre du Commerce et des Sociétés de Metz sous le numéro Metz B B 485 341 416, SIREN : 485 341 416, dont le siège social est situé 23 rue Dupont des Loges à Metz, et GROUPE6TM SAS au capital de 2.257.564 Euros, immatriculée au R.C.S de METZ sous le numéro 828 456 061 ayant son siège social 23 rue Dupont des Loges à METZ (57000) et représentées par leur gérant en exercice dûment habilité aux fins des présentes, s’engagent à se conformer à la législation en vigueur en France (Loi nᵒ 78-17 du 6 janvier 1978 « Informatique et Libertés ») et en Europe (Règlement 2016/679 du 27 avril 2016 « RGPD »), à assurer la protection, la confidentialité et la sécurité des données à caractère personnel, ainsi qu’à assurer le respect de la vie privée de leurs Clients et de tous les Visiteurs de leur site Web.</p>
			<p class="mb-4">La présente Politique de confidentialité (ci-après « la Politique ») décrit la manière dont SUPPLY CHAIN MAGAZINE collecte et traite les Données à caractère personnel des personnes naviguant sur son Site web ou passant une commande auprès d’elle.</p>
			<p class="mb-4">La Politique précise également les bases légales sur lesquelles SUPPLY CHAIN MAGAZINE et GROUPE6TM s’appuient pour traiter les Données à caractère personnel et fixer leurs durées de conservation.</p>
			<p class="mb-4">En tout état de cause, SUPPLY CHAIN MAGAZINE et GROUPE6TM s’engagent à respecter les principes suivants :</p>
			<ul class="mb-4 list-disc list-inside">
				<li>Vos données sont utilisées uniquement pour des finalités explicites, légitimes et déterminées en lien avec les différentes fonctionnalités proposées sur le Site, pour utiliser le site emploi TÉMA TRANSPORT LOGISTIQUE JOB ou s’abonner à nos articles digitaux ou aux périodiques ou commander des ouvrages ou des publications qui y sont référencés ;</li>
				<li>Seules les Données à caractère personnel qui sont utiles à ces fins sont collectées et traitées par SUPPLY CHAIN MAGAZINE et GROUPE6TM ;</li>
				<li>Vous êtes informé de manière claire et transparente, sur la finalité d’utilisation des Données à caractère personnel collectées vous concernant et sur vos droits en matière de protection des données.</li>
			</ul>
			<p class="mb-4">Notre Politique de Confidentialité ne s’applique pas aux services proposés par des sociétés tierces, exploitant des sites web et outils de nos partenaires ou d’autres sites web ou outils accessibles à partir de nos services. Nous ne sommes pas responsables de la façon dont ces sites utilisent vos Données Personnelles.</p>

			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Article 1 : Définitions</h2>
			<h3 class="mb-4 text-xl font-semibold">1.1 Définitions relatives à la protection des données personnelles</h3>
			<p class="mb-4">« <span class="font-semibold">Donnée à caractère personnel</span> » : Désigne toute information se rapportant à une personne physique identifiée ou identifiable directement (par son nom ou prénom par exemple) ou indirectement (notamment par référence à un identifiant, tel qu’un numéro d’identification, des données de localisation, un identifiant en ligne) ;</p>
			<p class="mb-4">« <span class="font-semibold">Cookies</span> » : Désignent les traceurs qui permettent d’accéder à des informations stockées dans l’équipement terminal du Visiteur du Site ;</p>
			<p class="mb-4">« <span class="font-semibold">Traitement</span> » : Désigne toute opération ou tout ensemble d’opérations effectuées ou non à l’aide de procédés automatisés et appliqués à des données ou des ensembles de données à caractère personnel, telles que la collecte, l’enregistrement, l’organisation, la structuration, la conservation, l’adaptation ou la modification, l’extraction, la consultation, l’utilisation, la communication par transmission, la diffusion ou toute autre forme de mise à disposition, le rapprochement ou l’interconnexion, la limitation, l’effacement ou la destruction ;</p>
			<p class="mb-4">« <span class="font-semibold">Violation de données à caractère personnel</span> » : Désigne la violation qui entraîne, de manière accidentelle ou illicite, la destruction, la perte, l’altération, la divulgation non autorisée de données à caractère personnel transmises, conservées ou traitées d’une autre manière, ou l’accès non autorisé à de telles données.</p>

			<h3 class="mb-4 text-xl font-semibold">1.2 Définitions relatives aux Services</h3>
			<p class="mb-4">« <span class="font-semibold">Commande</span> » : Désigne toute commande passée par le Client par le biais du Site ;</p>
			<p class="mb-4">« <span class="font-semibold">Site</span> » : Désigne le site web édité par SUPPLY CHAIN MAGAZINE accessible à l’adresse URL suivante : <a href="{{ route('home') }}" class="underline underline-offset-4 text-annonces-blue hover:opacity-80">{{ route('home') }}</a></p>
			<p class="mb-4">« <span class="font-semibold">Services</span> » : désigne l’ensemble des services fournis par SUPPLY CHAIN MAGAZINE via l’utilisation de son Site ou de son Produit.</p>
			<p class="mb-4">« <span class="font-semibold">Produit</span> » : désigne les applications logicielles mises à disposition du Client par SUPPLY CHAIN MAGAZINE dans le cadre de la fourniture des Services.</p>

			<h3 class="mb-4 text-xl font-semibold">1.3 Définitions relatives aux personnes concernées</h3>
			<p class="mb-4">« <span class="font-semibold">Visiteur</span> » : Désigne toute personne qui navigue sur le Site web, Client ou non de SUPPLY CHAIN MAGAZINE, sans avoir créé de compte membre ;</p>
			<p class="mb-4">« <span class="font-semibold">Membre</span> » : désigne l’utilisateur du Site SUPPLY CHAIN MAGAZINE qui a créé un compte membre et y a renseigné ses informations personnelles ;</p>
			<p class="mb-4">« <span class="font-semibold">Client</span> » : Désigne toute personne passant commande d’annonces ou accès sur le site emploi SUPPLY CHAIN MAGAZINE par le biais du Site ;</p>
			<p class="mb-4">« <span class="font-semibold">Candidat</span> » : désigne l’utilisateur membre du Site SUPPLY CHAIN MAGAZINE qui postule activement à des offres d’emploi disponibles sur le Site ;</p>
			<p class="mb-4">« <span class="font-semibold">Recruteur</span> » : désigne le Client du Site SUPPLY CHAIN MAGAZINE qui passe commande d’annonces ou accès sur le Site ;</p>
			<p class="mb-4">« <span class="font-semibold">Destinataire</span> » : Désigne la personne physique ou morale qui reçoit la communication de Données à caractère personnel, qu’il s’agisse ou non d’un tiers ;</p>
			<p class="mb-4">« <span class="font-semibold">Personne concernée</span> » / « <span class="font-semibold">Vous</span> » : Désigne la personne physique identifiée ou identifiable et dont les Données à caractère personnel sont traitées par SUPPLY CHAIN MAGAZINE en tant que Visiteur du Site web ou en tant que Client ;</p>
			<p class="mb-4">« <span class="font-semibold">Utilisateurs Autorisés</span> » : désigne les employés, sous-traitants, consultants et représentants du Client qui sont autorisés par ce dernier à utiliser le Produit ;</p>
			<p class="mb-4">« <span class="font-semibold">Utilisateurs du Site</span> » : désigne l’ensemble des utilisateurs du Site SUPPLY CHAIN MAGAZINE qu’ils soient indistinctement visiteur, membre, client, candidat ou recruteur.</p>
			<p class="mb-4">« <span class="font-semibold">Responsable de traitement</span> » : Désigne la personne physique ou morale, qui seul ou conjointement, détermine les finalités et les moyens des Traitements de données à caractère personnel. En l’espèce, la société SAS LH est responsable des traitements ;</p>
			<p class="mb-4">« <span class="font-semibold">Sous-traitant</span> » : Désigne la personne physique ou morale qui traite des Données à caractère personnel pour le compte des Responsables de traitement ;</p>
			<p class="mb-4">« <span class="font-semibold">Tiers</span> » : Désigne toute personne physique ou morale autorisée, autorité publique, service ou organisme autre que la personne concernée, le responsable du traitement, le sous-traitant et les personnes qui, placées sous l’autorité directe du responsable du traitement ou du sous-traitant, sont autorisées à traiter les Données à caractère personnel ;</p>

			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Article 2 : Quand vos données sont-elles collectées ?</h2>
			<p class="mb-4">Vos Données à caractère personnel, en tant que Visiteur du Site ou Client de SUPPLY CHAIN MAGAZINE, sont susceptibles d’être collectées dans les circonstances listées ci-après :</p>
			<ul class="mb-4 list-disc list-inside">
				<li>Lors des visites et de la navigation sur le Site ;</li>
				<li>Lors de la passation d’une Commande (achat d’annonces ou d’accès sur SUPPLY CHAIN MAGAZINE) ;</li>
				<li>Lors de l’inscription aux newsletters de SUPPLY CHAIN MAGAZINE et ses partenaires via le formulaire d’inscription</li>
				<li>Lors des contacts avec le service client par email ou via les formulaires de contact ;</li>
				<li>Lors de demande de devis via nos formulaires de contact ;</li>
				<li>Lors d’échanges et/ou contact entre vous et SUPPLY CHAIN MAGAZINE ou GROUPE6TM</li>
			</ul>

			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Article 3 : Pour quelles finalités vos données sont-elles traitées ?</h2>
			<p class="mb-4">Les Traitements de vos Données à caractère personnel effectués par SUPPLY CHAIN MAGAZINE et GROUPE6TM ont pour finalité :</p>
			<p class="mb-4"><a href="/storage/donnees-collectees.pdf" class="underline underline-offset-4 text-annonces-blue hover:opacity-80" target="_blank">Tableau collecte des données</a></p>

			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Article 4 : Sur quelles bases légales vos données sont-elles collectées ? Combien de temps sont-elles conservées ?</h2>
			<p class="mb-4">Concernant les durées de conservation, il est entendu que SUPPLY CHAIN MAGAZINE et GROUPE6TM ne conservent vos Données à caractère personnel que le temps nécessaire à la réalisation des finalités pour lesquelles elles ont été recueillies, y compris pour satisfaire à toute exigence légale ou comptable.</p>
			<p class="mb-4"><a href="/storage/donnees-collectees.pdf" class="underline underline-offset-4 text-annonces-blue hover:opacity-80" target="_blank">Tableau collecte des données</a></p>

			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Article 5 : Qui sont les destinataires de vos données ?</h2>
			<p class="mb-4">Les Données à caractère personnel vous concernant peuvent être traitées par les personnes suivantes :</p>
			<ul class="mb-4 list-disc list-inside">
				<li>Les membres habilités de l’équipe de SUPPLY CHAIN MAGAZINE ;</li>
				<li>Les membres habilités du groupe GROUPE6TM ;</li>
				<li>Les autres entités du groupe GROUPE6TM </li>
				<li>Les prestataires habilitées par SUPPLY CHAIN MAGAZINE pour procéder aux livraisons des produits ;</li>
				<li>Les fournisseurs de systèmes informatiques et de soutien de l’activité SUPPLY CHAIN MAGAZINE (ex : prestataire informatique, prestataires d’archivages des emails, de sauvegarde et de reprise après sinistre et de services de cyber sécurité, d’hébergement et de maintenance) </li>
				<li>Les réseaux sociaux dans le cadre du partage de contenu (à savoir Facebook, Instagram et LinkedIn) ;</li>
			</ul>
			<p class="mb-4">Vos Données ne seront pas communiquées à d’autres personnes sans votre consentement.</p>
			<p class="mb-4">Les tiers avec lesquels SUPPLY CHAIN MAGAZINE et GROUPE6TM partagent vos Données sont limités (par la loi et par contrat) dans leur capacité à utiliser vos Données à caractère personnel aux fins spécifiques SUPPLY CHAIN MAGAZINE et GROUPE6TM ont identifié.</p>
			<p class="mb-4">En tout état de cause, SUPPLY CHAIN MAGAZINE et GROUPE6TM déploient leurs meilleurs efforts pour assurer que les destinataires de vos Données à caractère personnel sont soumis aux obligations de confidentialité et de sécurité conformes à la présente Politique de Confidentialité, aux lois applicables et notamment au RGPD et à la Loi dite Informatique et Libertés dans sa dernière version en vigueur.</p>
			<p class="mb-4">SUPPLY CHAIN MAGAZINE et GROUPE6TM ne leur permettent de traiter vos Données à caractère personnel qu’à des fins précises et conformément à ses instructions.</p>
			<p class="mb-4">Enfin, vous êtes informé que SUPPLY CHAIN MAGAZINE et GROUPE6TM sont susceptibles de partager vos Données à caractère personnel si SUPPLY CHAIN MAGAZINE et GROUPE6TM y sont contraints par la loi, une disposition réglementaire, ou une ordonnance judiciaire, ou encore si cette divulgation est rendue nécessaire pour les besoins d’une enquête, injonction ou d’une procédure judiciaire, sur le territoire national ou à l’étranger.</p>

			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Article 6 : Vos données sont-elles transférées en dehors de l’Union-Européenne ?</h2>
			<p class="mb-4">En principe, toutes vos Données sont stockées sur le territoire de l’Union Européenne et ne sont pas transférées en dehors de ce territoire.</p>
			<p class="mb-4">Toutefois, si le traitement de vos Données à caractère personnel impliquait un transfert hors de l’Union Européenne, ces transferts seraient effectués en contrepartie de garanties appropriées en matière de sécurité et confidentialité en conformité avec la règlementation applicable (Notamment des clauses contractuelles standards, conformément aux modèles de clauses validées par la Commission Européenne).</p>

			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Article 7 : Quels sont vos droits ?</h2>
			<p class="mb-4">En tant que Personne concernée par le Traitement de Données à caractère personnel, vous possédez différents droits.</p>
			<p class="mb-4">Ces derniers ne sont néanmoins pas absolus et sont soumis à certaines conditions, conformément au RGPD et autres textes en vigueur applicables notamment à la Loi n° 78-17 du 6 janvier 1978 dite « Informatique et Libertés ».</p>

			<h3 class="mb-4 text-xl font-semibold">7.1 Le droit d’accès</h3>
			<p class="mb-4">Vous avez le droit d’obtenir de la part de SUPPLY CHAIN MAGAZINE la confirmation que vos Données à caractère personnel sont ou non traitées par SUPPLY CHAIN MAGAZINE et GROUPE6TM, ainsi que des informations sur la manière dont elles sont traitées.</p>
			<p class="mb-4">Vous avez également le droit d’obtenir une copie des Données à caractère personnel vous concernant traitées par SUPPLY CHAIN MAGAZINE et GROUPE6TM.</p>

			<h3 class="mb-4 text-xl font-semibold">7.2 Le droit de rectification</h3>
			<p class="mb-4">Vous pouvez solliciter SUPPLY CHAIN MAGAZINE afin que cette dernière prenne des mesures pour corriger vos Données à caractère personnel si elles sont inexactes ou incomplètes.</p>
			<p class="mb-4 italic">Par exemple SUPPLY CHAIN MAGAZINE détient le mauvais nom ou la mauvaise adresse pour effectuer la livraison des périodiques ou objets d’une commande.</p>

			<h3 class="mb-4 text-xl font-semibold">7.3 Le droit à l’effacement (« droit à l’oubli »)</h3>
			<p class="mb-4">Vous pouvez demander l’effacement ou la suppression de vos Données à caractère personnel.</p>
			<p class="mb-4 italic">Par exemple lorsqu’il n’existe pas (ou plus) de raison impérieuse pour SUPPLY CHAIN MAGAZINE de continuer à les utiliser.</p>

			<h3 class="mb-4 text-xl font-semibold">7.4 Le droit de limiter le traitement</h3>
			<p class="mb-4">Vous avez le droit de demander la limitation des Traitements de Données à caractère personnel ou d’empêcher l’utilisation ultérieure de vos Données à caractère personnel.</p>
			<p class="mb-4">La limitation du traitement n’empêchera pas la conservation de vos Données caractère personnel, mais SUPPLY CHAIN MAGAZINE et GROUPE6TM ne pourront pas les utiliser au-delà des limites que vous souhaitez imposer.</p>

			<h3 class="mb-4 text-xl font-semibold">7.5 Le droit à la portabilité des données</h3>
			<p class="mb-4">Vous avez le droit de récupérer et de réutiliser certaines Données à caractère personnel vous concernant. </p>
			<p class="mb-4">Ce droit s’applique uniquement aux Données à caractère personnel que vous avez fournies à SUPPLY CHAIN MAGAZINE, que cette dernière traite avec votre consentement, à des fins d’exécution du contrat et traitées par des moyens automatisés.</p>
			<p class="mb-4">Le cas échéant SUPPLY CHAIN MAGAZINE vous fournira une copie de vos Données à caractère personnel dans un format structuré, couramment utilisé et lisible par une machine (lorsque cela est techniquement possible).</p>
			<p class="mb-4">SUPPLY CHAIN MAGAZINE et GROUPE6TM pourront également, si vous le souhaitez, transmettre (dans la mesure du possible) ce type de Données à caractère personnel directement à un autre responsable de traitement.</p>

			<h3 class="mb-4 text-xl font-semibold">7.6 Le droit d’opposition</h3>
			<p class="mb-4">Vous avez le droit de vous opposer à certains types de traitements, pour des raisons liées à votre situation particulière, à tout moment, dans la mesure où ce traitement a eu lieu aux fins d’intérêts légitimes poursuivis par SUPPLY CHAIN MAGAZINE et GROUPE6TM.</p>
			<p class="mb-4">En tout état de cause, SUPPLY CHAIN MAGAZINE et GROUPE6TM seront autorisés à continuer de traiter vos Données à caractère personnel si elles sont capables de démontrer que le Traitement de Données à caractère personnel est justifié par des libertés ou si ces Données à caractère personnel sont nécessaires pour l’établissement, l’exercice ou la défense lors d’actions judiciaires.</p>

			<h3 class="mb-4 text-xl font-semibold">7.7 Le droit de retirer votre consentement</h3>
			<p class="mb-4">Lorsque SUPPLY CHAIN MAGAZINE et GROUPE6TM traitent vos Données à caractère personnel sur la base légale de votre consentement, vous avez la possibilité de retirer votre consentement.</p>
			<p class="mb-4">Toutefois, vous êtes informé par la présente que le retrait n’affecte aucunement la licéité du traitement qui a eu lieu avant l’exercice de ce droit de retrait.</p>

			<h3 class="mb-4 text-xl font-semibold">7.8 Le droit de nous fournir des directives sur l’utilisation de vos données personnelles après votre décès</h3>
			<p class="mb-4">Vous avez le droit de fournir à SUPPLY CHAIN MAGAZINE des instructions sur la gestion (ex : conservation, effacement et divulgation) de vos Données à caractère personnel après votre décès.</p>
			<p class="mb-4">Vous pouvez modifier ou révoquer vos instructions à tout moment.</p>

			<h3 class="mb-4 text-xl font-semibold">7.9 Droit de déposer une réclamation auprès de la CNIL</h3>
			<p class="mb-4">Dans l’éventualité où vous ne seriez pas satisfait de la réponse de SUPPLY CHAIN MAGAZINE à votre réclamation ou si vous pensez que le Traitement de vos Données à caractère personnel n’est pas conforme à la règlementation applicable sur la protection des données à caractère personnel, vous pouvez déposer une réclamation auprès de l’autorité de contrôle compétente en matière de protection des données.</p>
			<p class="mb-4">La Commission Informatique et Libertés (CNIL) est l’autorité de protection des données en France.</p>

			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Article 8 : Comment pouvez-vous exercer vos droits ?</h2>
			<p class="mb-4">Si vous souhaitez exercer l’un de vos droits vous pouvez nous contacter à l’adresse mail suivant : transport-logistique-job@temagroupe.com</p>
			<p class="mb-4">La demande peut également être envoyée par courrier postal à l’adresse ci-après :</p>
			<p class="mb-4">SUPPLY CHAIN MAGAZINE – 23 Rue Dupont des Loges 57000 Metz – Demande d’exercice de droit.</p>
			<p class="mb-4">Pour mieux connaître vos droits, vous pouvez vous rendre sur le site de la CNIL (<a href="https://www.cnil.fr/fr/comprendre-vos-droits" class="underline underline-offset-4 text-annonces-blue hover:opacity-80" target="_blank">https://www.cnil.fr/fr/comprendre-vos-droits</a>).</p>
			<p class="mb-4">Lors d’une demande d’exercice de droits, un titre d’identité peut être demandé, notamment afin de préserver la sécurité du traitement faisant l’objet de la demande.</p>
			<p class="mb-4">Une réponse vous sera adressée, suivant la complexité de votre demande dans les délais prescrits par l’article 12.3 du RGPD.</p>

			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Article 9 : Comment sont protégées vos données à caractère personnel ?</h2>
			<p class="mb-4">SUPPLY CHAIN MAGAZINE et GROUPE6TM s’assurent que les Données à caractère personnel sont traitées en toute sécurité et confidentialité, y compris lorsque certaines opérations sont réalisées par des Sous-traitants.</p>
			<p class="mb-4">À cet effet SUPPLY CHAIN MAGAZINE et GROUPE6TM mettent en place les mesures techniques et organisationnelles appropriées pour éviter la perte, la mauvaise utilisation, l’altération et la suppression de vos Données à caractère personnel.</p>
			<p class="mb-4">Ces mesures sont adaptées selon le niveau de sensibilité des Données à caractère personnel traitées et le niveau de risque que présente le Traitement de ces données ou sa mise en œuvre.</p>
			<p class="mb-4">Si une atteinte à la sécurité des Données à caractère personnel vous concernant se produit, SUPPLY CHAIN MAGAZINE vous en informera dans les délais et selon les modalités précisées par les dispositions légales et règlementaires en vigueur.</p>

			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Article 10 : Comment cette Politique est acceptée et peut-elle être modifiée ?</h2>

			<h3 class="mb-4 text-xl font-semibold">10.1. Acceptation</h3>
			<p class="mb-4">Lors de votre première utilisation de nos Services sur le Site, vous êtes amenés à accepter la présente Politique de Confidentialité. Vous confirmez ainsi en avoir pris connaissance et l’accepter sans restriction ni réserve. Si vous êtes en désaccord avec l’un de ses termes, vous êtes libre de ne pas utiliser nos Services.</p>

			<h3 class="mb-4 text-xl font-semibold">10.2. Mise à jour</h3>
			<p class="mb-4">SUPPLY CHAIN MAGAZINE et GROUPE6TM se réservent la possibilité de modifier la présente Politique de confidentialité. Vous êtes invité à consulter cette page régulièrement afin de vous assurer que vous êtes en accord avec toute modification.</p>
			<p class="mb-4">Si les modifications sont des modifications de forme, la nouvelle politique s’appliquera immédiatement.</p>
			<p class="mb-4">Si les modifications ou mises à jour sont substantielles (par exemple, insertion d’une nouvelle finalité), vous serez informé de ces modifications soit par une mention spéciale sur nos Sites, soit par une notification par email.</p>
			<p class="mb-4">Si le recueil du consentement était à nouveau nécessaire, SUPPLY CHAIN MAGAZINE procéderait évidemment à un nouveau recueil du consentement.</p>

			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Caractère obligatoire ou facultatif de fournir vos Données</h2>
			<p class="mb-4">Les Données Personnelles indispensables à SUPPLY CHAIN MAGAZINE et GROUPE6TM pour atteindre les finalités des Traitements sont signalées par un astérisque au sein des formulaires de collecte.</p>
			<p class="mb-4">Si vous ne renseignez pas ces champs obligatoires, nous ne serons pas en mesure de vous fournir nos Services.</p>
			<p class="mb-4">Les Données Personnelles non signalées par un astérisque sont facultatives : elles nous permettent de mieux vous connaître et d’améliorer nos Services.</p>
			<p class="mb-4">Concernant les Données Personnelles collectées lorsque vous naviguez sur le Site merci de vous référer directement à nos conditions générales d’utilisation du Site.</p>
			<p class="mb-4">Pour en savoir plus de façon générale sur les cookies, sur les moyens de vous opposer à leur utilisation et sur vos droits, nous vous invitons à consulter le site de la Commission Nationale de l’Informatique et des Libertés (CNIL), et notamment son dossier intitulé « Maîtriser mes données » (<a href="https://www.cnil.fr/fr/maitriser-mes-donnees" class="underline underline-offset-4 text-annonces-blue hover:opacity-80" target="_blank">https://www.cnil.fr/fr/maitriser-mes-donnees</a>) ou encore sa rubrique consacrée aux cookies (<a href="https://www.cnil.fr/fr/cookies-et-traceurs-que-dit-la-loi" class="underline underline-offset-4 text-annonces-blue hover:opacity-80" target="_blank">https://www.cnil.fr/fr/cookies-et-traceurs-que-dit-la-loi</a> et <a href="https://www.cnil.fr/fr/cookies-et-autres-traceurs" class="underline underline-offset-4 text-annonces-blue hover:opacity-80" target="_blank">https://www.cnil.fr/fr/cookies-et-autres-traceurs</a>).</p>

			<h2 class="mb-4 text-xl text-left font-bold text-annonces-darkblue">Responsable de traitement et délégué à la protection des données</h2>
			<p class="mb-4">Un responsable du traitement est une entité qui détermine les Finalités et les moyens du Traitement de vos Données Personnelles et qui est responsable envers vous du respect de la Réglementation Données Personnelles.</p>
			<p class="mb-4">
				Camille GRANDIDIER<br>
				<span class="text-annonces-blue">
					<a href="mailto:c.grandider@temagroupe.com">c.grandider@temagroupe.com</a>
				</span>
			</p>
		</div>
	</div>
</x-app-layout>
