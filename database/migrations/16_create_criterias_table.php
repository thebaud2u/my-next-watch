<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Criteria;
use App\Models\PostType;
use App\Models\Thematic;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('criterias', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('thematic_id')->nullable();
			$table->unsignedBigInteger('post_type_id')->nullable();
			$table->string('type');
			$table->string('name');

			$table->foreign('thematic_id')->references('id')->on('thematics')->onDelete('set null');
			$table->foreign('post_type_id')->references('id')->on('post_types')->onDelete('set null');
		});

		$data = [
			'transport' => [
				'vente-vehicule' => [
					'looking-for' => [
						'Une offre : vous vendez un véhicule',
						'Une demande : vous recherchez un véhicule'
					],
					'vehicule-type' => [
						'Tracteur',
						'Porteur',
						'Semi-remorque',
						'Remorque',
						'Utilitaire',
						'Engin TP',
						'Bus et Car',
						'Autres'
					]
				],
				'achat-location-vehicule' => [
					'looking-for' => [
						'Une offre : vous louez un véhicule',
						'Une demande : vous recherchez à louer un véhicule'
					],
					'vehicule-type' => [
						'Tracteur',
						'Porteur',
						'Semi-remorque',
						'Remorque',
						'Utilitaire',
						'Engin TP',
						'Bus et Car',
						'Autres'
					]
				],
				'transaction-entreprise' => [
					'sector' => [
						'Pré et post acheminement',
						'Transport Routier',
						'Transport Maritime',
						'Transport Fluvial',
						'Transport Aérien',
						'Transport Ferroviaire',
						'Logistique Supply Chain',
						'Autre'
					],
					'activity-type' => [
						'Transport de marchandises',
						'Transport de personnes / voyageurs',
						'Autre'
					]
				],
				'offre-immobiliere' => [
					'good-type' => [
						'Local commercial',
						'Bureau',
						'Entrepôt',
						'Terrain',
						'Conteneurs',
						'Autre'
					],
					'characteristics' => [
						'Parking / Garage',
						'Accès PMR',
						'Chauffage au sol',
						'Construction récente',
						'Cuisine',
						'Climatisation',
						'Courant Haute Tension',
						'Cablage structuré',
						'Vestiaires',
						'Sanitaires'
					],
					'energy-class' => [
						'A',
						'B',
						'C',
						'D',
						'E',
						'F',
						'G',
						'Vierge'
					],
					'GES' => [
						'A',
						'B',
						'C',
						'D',
						'E',
						'F',
						'G',
						'Vierge'
					]
				],
				'appel-offre' => [
					'market-spectrum' => [
						'Local',
						'National',
						'Européen',
						'Autre'
					],
					'market-type' => [
						'Fournitures',
						'Services',
						'Travaux',
						'Autres'
					],
					'notice-type' => [
						'Avis de publicité',
						'Avis de concession',
						'Avis d\'attribution de marché',
						'Avis de marché',
						'Avis d\'appel public à la concurrence'
					]
				],
				'tractionnaire' => [
					'tractor-type' => [
						'Régional',
						'National',
						'International',
						'Autre'
					]
				]
			],
			'maritime' => [
				'maritime' => [
					'goods-type' => [
						'Colis Lourds (Breakbulk)',
						'Conteneur',
						'Marchandises générales (General Cargo)',
						'Ro-Pax',
						'Roulier',
						'Transport frigorifique (Reefer)',
						'Vrac liquide',
						'Vrac sec / solide'
					],
					'starting-point' => [
						'Dunkerque',
						'Le Havre',
						'Rouen',
						'Nantes Saint-Nazaire',
						'La Rochelle',
						'Sète',
						'Bordeaux',
						'Marseille',
						'Dans les territoires d\'Outre-Mer, quatre grands ports',
						'Guyane',
						'Martinique',
						'Guadeloupe',
						'Port-Réunion'
					],
					'destinations' => [
						'Corse',
						'Antilles',
						'Moyen-Orient',
						'Méditérannée Orientale',
						'Méditérannée Occidentale',
						'Afrique du Nord',
						'Afrique Occidentale et Équatoriale',
						'Amérique du Nord',
						'Amérique du Sud',
						'Asie',
						'Océanie'
					]
				]
			],
			'social' => [
				'appel-offre-dsp' => [
					'market-type' => [
						'Fournitures',
						'Services',
						'Travaux',
						'Autres'
					],
					'notice-type' => [
						'Avis de publicité',
						'Avis de concession',
						'Avis d\'attribution de marché',
						'Avis de marché',
						'Avis d\'appel public à la concurrence'
					]
				]
			]
		];

		foreach($data as $theme => $value) {
			$thematic = Thematic::where('slug', '=', $theme)
				->first();

			foreach($value as $postTypes => $values) {
				$postType = PostType::where('slug', '=', $postTypes)
					->first();

				foreach($values as $type => $criteria) {
					foreach($criteria as $name) {
						$newCriteria = new Criteria;
						$newCriteria->thematic_id = $thematic->id;
						$newCriteria->post_type_id = $postType->id;
						$newCriteria->type = $type;
						$newCriteria->name = $name;
						$newCriteria->save();
					}
				}
			}
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('criterias');
	}
};
