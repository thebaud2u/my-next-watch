<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Collection;
use App\Models\Movement;
use App\Models\Watch;

use App\Models\WatchDetails\BezelColor;
use App\Models\WatchDetails\BezelMaterial;
use App\Models\WatchDetails\BraceletClasp;
use App\Models\WatchDetails\BraceletColor;
use App\Models\WatchDetails\BraceletMaterial;
use App\Models\WatchDetails\BraceletStyle;
use App\Models\WatchDetails\CaseMaterial;
use App\Models\WatchDetails\CrownMaterial;
use App\Models\WatchDetails\CrystalMaterial;
use App\Models\WatchDetails\DialColor;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$admin = Admin::first();

		$brands = [
			0 => [
				'name' => 'Tudor',
				'logo' => 'Tudor.jpg',
				'description' => 'Tudor est une manufacture horlogère suisse de luxe, basée à Genève. Son nom a été déposé en 1926 par Hans Wilsdorf, créateur de Rolex. Les deux maisons horlogères sont détenues par la Fondation Hans Wilsdorf. Tudor s\'est initialement fait connaître pour ses montres de plongées destinées aux plongeurs militaires et professionnels. Les montres Tudor équipent notamment les Navy SEALs et la Marine Nationale française.',
				'nationality' => 'Swiss',
				'external_link' => 'https://www.tudorwatch.com',
			]
		];

		foreach($brands as $brand => $value) {
			$newBrand = new Brand;
			$newBrand->name = $value['name'];
			$newBrand->logo = $value['logo'];
			$newBrand->description = $value['description'];
			$newBrand->nationality = $value['nationality'];
			$newBrand->external_link = $value['external_link'];
			$newBrand->admin_id = $admin->id;
			$newBrand->save();
		}

		$collections = [
			'Tudor' => [
				0 => [
					'name' => 'Black Bay'
				]
			]
		];

		foreach($collections as $brand => $values) {
			foreach($values as $index => $collection) {
				$newCollection = new Collection;
				$newCollection->brand_id = Brand::where('name', $brand)->first()->id;
				$newCollection->name = $collection['name'];
				$newCollection->admin_id = $admin->id;
				$newCollection->save();
			}
		}

		$movements = [
			'Tudor' => [
				0 => [
					'name' => 'MT5602‑U',
					'type' => 'Automatic',
					'power_reserve' => 70,
					'COSC' => false,
					'METAS' => true,
					'manufactured_caliber' => true,
					'nationality' => 'Swiss'
				]
			]
		];

		foreach($movements as $brand => $values) {
			foreach($values as $index => $movement) {
				$newMovement = new Movement;
				$newMovement->brand_id = Brand::where('name', $brand)->first()->id;
				$newMovement->name = $movement['name'];
				$newMovement->type = $movement['type'];
				$newMovement->power_reserve = $movement['power_reserve'];
				$newMovement->COSC = $movement['COSC'];
				$newMovement->METAS = $movement['METAS'];
				$newMovement->manufactured_caliber = $movement['manufactured_caliber'];
				$newMovement->nationality = $movement['nationality'];
				$newMovement->admin_id = $admin->id;
				$newMovement->save();
			}
		}

		$watches = [
			'Black Bay' => [
				0 => [
					'movement_id' => 'MT5602‑U',
					'name' => 'Black Bay',
					'reference' => 'm7941a1a0ru-0003',
					'bezel' => [
						'color' => 'burgundy',
						'direction' => 'unidirectional',
						'material' => ['stainless steel', 'aluminium']
					],
					'bracelet' => [
						'style' => 'jubilee',
						'clasp' => '"t-fit"',
						'material' => 'stainless steel'
					],
					'case' => [
						'diameter' => 41,
						'lug-to-lug' => 50,
						'lug width' => 21,
						'thickness' => 13.6,
						'waterproofness' => '200m (660 ft)',
						'material' => 'stainless steel'
					],
					'crown' => [
						'material' => 'stainless steel',
						'screwed down' => true,
						'detail' => 'tudor\'s rose in relief'
					],
					'crystal' => [
						'material' => 'sapphire',
						'domed' => true
					],
					'dial' => [
						'color' => 'black',
						'domed' => true,
						'textured' => false
					],
					'release_price' => 4730,
					'current_price' => 3742
				],
			]
		];

		foreach($watches as $collection => $values) {
			foreach($values as $index => $watch) {
				$newWatch = new Watch;
				$newWatch->collection_id = Collection::where('name', $collection)->first()->id;
				$newWatch->movement_id = Movement::where('name', $watch['movement_id'])->first()->id;
				$newWatch->name = $watch['name'];
				$newWatch->reference = $watch['reference'];

				foreach($watch['bezel']['material'] as $material) {
					$bezelMaterials[] = BezelMaterial::where('name', $material)->first()->id;
				}

				$newWatch->bezel = [
					'color' => BezelColor::where('name', $watch['bezel']['color'])->first()->id,
					'direction' => $watch['bezel']['direction'],
					'material' => $bezelMaterials
				];

				$newWatch->bracelet = [
					'style' => BraceletStyle::where('name', $watch['bracelet']['style'])->first()->id,
					'clasp' => BraceletClasp::where('name', $watch['bracelet']['clasp'])->first()->id,
					'material' => BraceletMaterial::where('name', $watch['bracelet']['material'])->first()->id
				];

				$newWatch->case = [
					'diameter' => $watch['case']['diameter'],
					'lug-to-lug' => $watch['case']['lug-to-lug'],
					'lug width' => $watch['case']['lug width'],
					'thickness' => $watch['case']['thickness'],
					'waterproofness' => $watch['case']['waterproofness'],
					'material' => CaseMaterial::where('name', $watch['case']['material'])->first()->id
				];

				$newWatch->crown = [
					'material' => CrownMaterial::where('name', $watch['crown']['material'])->first()->id,
					'screwed down' => $watch['crown']['screwed down'],
					'detail' => $watch['crown']['detail']
				];

				$newWatch->crystal = [
					'material' => CrystalMaterial::where('name', $watch['crystal']['material'])->first()->id,
					'domed' => $watch['crystal']['domed']
				];

				$newWatch->dial = [
					'color' => DialColor::where('name', $watch['dial']['color'])->first()->id,
					'domed' => $watch['dial']['domed'],
					'textured' => $watch['dial']['textured']
				];

				$newWatch->release_price = $watch['release_price'];
				$newWatch->current_price = $watch['current_price'];
				$newWatch->admin_id = $admin->id;
				$newWatch->save();
			}
		}
	}
};
