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
use App\Models\WatchDetails\BezelMarking;
use App\Models\WatchDetails\BezelMaterial;
use App\Models\WatchDetails\BraceletClasp;
use App\Models\WatchDetails\BraceletClaspColor;
use App\Models\WatchDetails\BraceletClaspMaterial;
use App\Models\WatchDetails\BraceletColor;
use App\Models\WatchDetails\BraceletMaterial;
use App\Models\WatchDetails\BraceletMicroAdjustementSystem;
use App\Models\WatchDetails\BraceletStitchingColor;
use App\Models\WatchDetails\BraceletStyle;
use App\Models\WatchDetails\CaseColor;
use App\Models\WatchDetails\CaseMaterial;
use App\Models\WatchDetails\Complication;
use App\Models\WatchDetails\CrownColor;
use App\Models\WatchDetails\CrownMaterial;
use App\Models\WatchDetails\CrystalMaterial;
use App\Models\WatchDetails\DialColor;
use App\Models\WatchDetails\DialMarkerColor;
use App\Models\WatchDetails\DialMarkerLumeColor;
use App\Models\WatchDetails\DialMarkerType;

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
					'name' => 'MT5602-U',
					'type' => 'Automatic',
					'COSC' => false,
					'METAS' => true,
					'manufactured_caliber' => true,
					'nationality' => 'Swiss'
				],
				1 => [
					'name' => 'MT5602',
					'type' => 'Automatic',
					'COSC' => true,
					'METAS' => false,
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
					'movement_id' => 'MT5602-U',
					'name' => 'Black Bay',
					'reference' => 'm7941a1a0ru-0003',
					'bezel' => [
						'color' => ['burgundy', 'steel'],
						'direction' => 'unidirectional',
						'marking' => ['engraved', 'numerals'],
						'material' => ['stainless steel', 'aluminium']
					],
					'bracelet' => [
						'clasp' => 'triple deployant',
						'clasp_color' => ['steel'],
						'clasp_material' => ['stainless steel'],
						'material' => ['stainless steel'],
						'micro_adjustement' => true,
						'micro_adjustement_system' => '"t-fit"',
						'stitching' => false,
						'stitching_color' => [],
						'style' => 'jubilee'
					],
					'case' => [
						'color' => ['steel'],
						'diameter' => 41,
						'lug_to_lug' => 50,
						'lug_width' => 21,
						'material' => ['stainless steel'],
						'open_case_back' => false,
						'sapphire_crystal_case_back' => false,
						'thickness' => 13.6,
						'waterproofness' => '200m (660 ft)'
					],
					'crown' => [
						'color' => ['steel'],
						'detail' => 'tudor\'s rose in relief',
						'material' => ['stainless steel'],
						'screwed_down' => true
					],
					'crystal' => [
						'domed' => true,
						'material' => ['sapphire']
					],
					'dial' => [
						'color' => ['black'],
						'domed' => true,
						'marker_color' => ['gold'],
						'marker_lume' => true,
						'marker_lume_color' => ['green'],
						'marker_type' => ['indexes'],
						'textured' => false
					],
					'specification' => [
						'complication' => ['self-winding'],
						'power_reserve' => 70
					],
					'release_price' => 4730,
					'current_price' => null
				],
				1 => [
					'movement_id' => 'MT5602-U',
					'name' => 'Black Bay',
					'reference' => 'm7941a1a0ru-0001',
					'bezel' => [
						'color' => ['burgundy', 'steel'],
						'direction' => 'unidirectional',
						'marking' => ['engraved', 'numerals'],
						'material' => ['stainless steel', 'aluminium']
					],
					'bracelet' => [
						'clasp' => 'triple deployant',
						'clasp_color' => ['steel'],
						'clasp_material' => ['stainless steel'],
						'material' => ['stainless steel'],
						'micro_adjustement' => true,
						'micro_adjustement_system' => '"t-fit"',
						'stitching' => false,
						'stitching_color' => [],
						'style' => 'oyster'
					],
					'case' => [
						'color' => ['steel'],
						'diameter' => 41,
						'lug_to_lug' => 50,
						'lug_width' => 21,
						'material' => ['stainless steel'],
						'open_case_back' => false,
						'sapphire_crystal_case_back' => false,
						'thickness' => 13.6,
						'waterproofness' => '200m (660 ft)'
					],
					'crown' => [
						'color' => ['steel'],
						'detail' => 'tudor\'s rose in relief',
						'material' => ['stainless steel'],
						'screwed_down' => true
					],
					'crystal' => [
						'domed' => true,
						'material' => ['sapphire']
					],
					'dial' => [
						'color' => ['black'],
						'domed' => true,
						'marker_color' => ['gold'],
						'marker_lume' => true,
						'marker_lume_color' => ['green'],
						'marker_type' => ['indexes'],
						'textured' => false
					],
					'specification' => [
						'complication' => ['self-winding'],
						'power_reserve' => 70
					],
					'release_price' => 4620,
					'current_price' => null
				],
				2 => [
					'movement_id' => 'MT5602-U',
					'name' => 'Black Bay',
					'reference' => 'm7941a1a0ru-0002',
					'bezel' => [
						'color' => ['burgundy', 'steel'],
						'direction' => 'unidirectional',
						'marking' => ['engraved', 'numerals'],
						'material' => ['stainless steel', 'aluminium']
					],
					'bracelet' => [
						'clasp' => 'triple deployant',
						'clasp_color' => ['steel'],
						'clasp_material' => ['stainless steel'],
						'material' => ['rubber'],
						'micro_adjustement' => true,
						'micro_adjustement_system' => '"t-fit"',
						'stitching' => false,
						'stitching_color' => [],
						'style' => null
					],
					'case' => [
						'color' => ['steel'],
						'diameter' => 41,
						'lug_to_lug' => 50,
						'lug_width' => 21,
						'material' => ['stainless steel'],
						'open_case_back' => false,
						'sapphire_crystal_case_back' => false,
						'thickness' => 13.6,
						'waterproofness' => '200m (660 ft)'
					],
					'crown' => [
						'color' => ['steel'],
						'detail' => 'tudor\'s rose in relief',
						'material' => ['stainless steel'],
						'screwed_down' => true
					],
					'crystal' => [
						'domed' => true,
						'material' => ['sapphire']
					],
					'dial' => [
						'color' => ['black'],
						'domed' => true,
						'marker_color' => ['gold'],
						'marker_lume' => true,
						'marker_lume_color' => ['green'],
						'marker_type' => ['indexes'],
						'textured' => false
					],
					'specification' => [
						'complication' => ['self-winding'],
						'power_reserve' => 70
					],
					'release_price' => 4400,
					'current_price' => null
				],
				3 => [
					'movement_id' => 'MT5602-U',
					'name' => 'Black Bay Ceramic',
					'reference' => 'm79210cnu-0007',
					'bezel' => [
						'color' => ['black', 'sunray'],
						'direction' => 'unidirectional',
						'marking' => ['engraved', 'numerals'],
						'material' => ['PVD-treated stainless steel', 'ceramic']
					],
					'bracelet' => [
						'clasp' => 'folding',
						'clasp_color' => ['black'],
						'clasp_material' => ['PVD-treated stainless steel'],
						'material' => ['hybrid leather'],
						'micro_adjustement' => false,
						'micro_adjustement_system' => [],
						'stitching' => true,
						'stitching_color' => ['blue'],
						'style' => null
					],
					'case' => [
						'color' => ['black'],
						'diameter' => 41,
						'lug_to_lug' => 50,
						'lug_width' => 22,
						'material' => ['ceramic'],
						'open_case_back' => true,
						'sapphire_crystal_case_back' => true,
						'thickness' => 14.4,
						'waterproofness' => '200m (660 ft)'
					],
					'crown' => [
						'color' => ['black'],
						'detail' => 'tudor\'s rose in relief',
						'material' => ['stainless steel'],
						'screwed_down' => true
					],
					'crystal' => [
						'domed' => true,
						'material' => ['sapphire']
					],
					'dial' => [
						'color' => ['blue'],
						'domed' => true,
						'marker_color' => ['silver'],
						'marker_lume' => true,
						'marker_lume_color' => ['green'],
						'marker_type' => ['indexes'],
						'textured' => false
					],
					'specification' => [
						'complication' => ['self-winding'],
						'power_reserve' => 70
					],
					'release_price' => 5350,
					'current_price' => null
				],
				4 => [
					'movement_id' => 'MT5602-U',
					'name' => 'Black Bay',
					'reference' => 'm7941a1a0nu-0003',
					'bezel' => [
						'color' => ['black', 'steel'],
						'direction' => 'unidirectional',
						'marking' => ['engraved', 'numerals'],
						'material' => ['stainless steel', 'aluminium']
					],
					'bracelet' => [
						'clasp' => 'triple deployant',
						'clasp_color' => ['steel'],
						'clasp_material' => ['stainless steel'],
						'material' => ['stainless steel'],
						'micro_adjustement' => true,
						'micro_adjustement_system' => '"t-fit"',
						'stitching' => false,
						'stitching_color' => [],
						'style' => 'jubilee'
					],
					'case' => [
						'color' => ['steel'],
						'diameter' => 41,
						'lug_to_lug' => 50,
						'lug_width' => 21,
						'material' => ['stainless steel'],
						'open_case_back' => false,
						'sapphire_crystal_case_back' => false,
						'thickness' => 13.6,
						'waterproofness' => '200m (660 ft)'
					],
					'crown' => [
						'color' => ['steel'],
						'detail' => 'tudor\'s rose in relief',
						'material' => ['stainless steel'],
						'screwed_down' => true
					],
					'crystal' => [
						'domed' => true,
						'material' => ['sapphire']
					],
					'dial' => [
						'color' => ['black'],
						'domed' => true,
						'marker_color' => ['silver'],
						'marker_lume' => true,
						'marker_lume_color' => ['green'],
						'marker_type' => ['indexes'],
						'textured' => false
					],
					'specification' => [
						'complication' => ['self-winding'],
						'power_reserve' => 70
					],
					'release_price' => 4730,
					'current_price' => null
				],
				5 => [
					'movement_id' => 'MT5602-U',
					'name' => 'Black Bay',
					'reference' => 'm7941a1a0nu-0001',
					'bezel' => [
						'color' => ['black', 'steel'],
						'direction' => 'unidirectional',
						'marking' => ['engraved', 'numerals'],
						'material' => ['stainless steel', 'aluminium']
					],
					'bracelet' => [
						'clasp' => 'triple deployant',
						'clasp_color' => ['steel'],
						'clasp_material' => ['stainless steel'],
						'material' => ['stainless steel'],
						'micro_adjustement' => true,
						'micro_adjustement_system' => '"t-fit"',
						'stitching' => false,
						'stitching_color' => [],
						'style' => 'oyster'
					],
					'case' => [
						'color' => ['steel'],
						'diameter' => 41,
						'lug_to_lug' => 50,
						'lug_width' => 21,
						'material' => ['stainless steel'],
						'open_case_back' => false,
						'sapphire_crystal_case_back' => false,
						'thickness' => 13.6,
						'waterproofness' => '200m (660 ft)'
					],
					'crown' => [
						'color' => ['steel'],
						'detail' => 'tudor\'s rose in relief',
						'material' => ['stainless steel'],
						'screwed_down' => true
					],
					'crystal' => [
						'domed' => true,
						'material' => ['sapphire']
					],
					'dial' => [
						'color' => ['black'],
						'domed' => true,
						'marker_color' => ['silver'],
						'marker_lume' => true,
						'marker_lume_color' => ['green'],
						'marker_type' => ['indexes'],
						'textured' => false
					],
					'specification' => [
						'complication' => ['self-winding'],
						'power_reserve' => 70
					],
					'release_price' => 4620,
					'current_price' => null
				],
				6 => [
					'movement_id' => 'MT5602-U',
					'name' => 'Black Bay',
					'reference' => 'm7941a1a0nu-0002',
					'bezel' => [
						'color' => ['black', 'steel'],
						'direction' => 'unidirectional',
						'marking' => ['engraved', 'numerals'],
						'material' => ['stainless steel', 'aluminium']
					],
					'bracelet' => [
						'clasp' => 'triple deployant',
						'clasp_color' => ['steel'],
						'clasp_material' => ['stainless steel'],
						'material' => ['rubber'],
						'micro_adjustement' => true,
						'micro_adjustement_system' => '"t-fit"',
						'stitching' => false,
						'stitching_color' => [],
						'style' => null
					],
					'case' => [
						'color' => ['steel'],
						'diameter' => 41,
						'lug_to_lug' => 50,
						'lug_width' => 21,
						'material' => ['stainless steel'],
						'open_case_back' => false,
						'sapphire_crystal_case_back' => false,
						'thickness' => 13.6,
						'waterproofness' => '200m (660 ft)'
					],
					'crown' => [
						'color' => ['steel'],
						'detail' => 'tudor\'s rose in relief',
						'material' => ['stainless steel'],
						'screwed_down' => true
					],
					'crystal' => [
						'domed' => true,
						'material' => ['sapphire']
					],
					'dial' => [
						'color' => ['black'],
						'domed' => true,
						'marker_color' => ['silver'],
						'marker_lume' => true,
						'marker_lume_color' => ['green'],
						'marker_type' => ['indexes'],
						'textured' => false
					],
					'specification' => [
						'complication' => ['self-winding'],
						'power_reserve' => 70
					],
					'release_price' => 4400,
					'current_price' => null
				],
				7 => [
					'movement_id' => 'MT5602',
					'name' => 'Black Bay',
					'reference' => 'm79230g-0001',
					'bezel' => [
						'color' => ['green', 'steel'],
						'direction' => 'unidirectional',
						'marking' => ['engraved', 'numerals'],
						'material' => ['stainless steel', 'aluminium']
					],
					'bracelet' => [
						'clasp' => 'triple deployant',
						'clasp_color' => ['steel'],
						'clasp_material' => ['stainless steel'],
						'material' => ['stainless steel'],
						'micro_adjustement' => true,
						'micro_adjustement_system' => 'classic',
						'stitching' => false,
						'stitching_color' => [],
						'style' => null
					],
					'case' => [
						'color' => ['steel'],
						'diameter' => 41,
						'lug_to_lug' => 50,
						'lug_width' => 22,
						'material' => ['stainless steel'],
						'open_case_back' => false,
						'sapphire_crystal_case_back' => false,
						'thickness' => 14.7,
						'waterproofness' => '200m (660 ft)'
					],
					'crown' => [
						'color' => ['steel'],
						'detail' => 'tudor\'s rose in relief',
						'material' => ['stainless steel'],
						'screwed_down' => true
					],
					'crystal' => [
						'domed' => true,
						'material' => ['sapphire']
					],
					'dial' => [
						'color' => ['black'],
						'domed' => true,
						'marker_color' => ['gold'],
						'marker_lume' => true,
						'marker_lume_color' => ['green'],
						'marker_type' => ['indexes'],
						'textured' => false
					],
					'specification' => [
						'complication' => ['self-winding'],
						'power_reserve' => 70
					],
					'release_price' => 4150,
					'current_price' => null
				],
				8 => [
					'movement_id' => 'MT5602-U',
					'name' => 'Black Bay',
					'reference' => 'm79210cnu-0001',
					'bezel' => [
						'color' => ['black', 'steel'],
						'direction' => 'unidirectional',
						'marking' => ['engraved', 'numerals'],
						'material' => ['PVD-treated stainless steel', 'ceramic']
					],
					'bracelet' => [
						'clasp' => 'folding',
						'clasp_color' => ['black'],
						'clasp_material' => ['PVD-treated stainless steel'],
						'material' => ['hybrid leather', 'rubber'],
						'micro_adjustement' => false,
						'micro_adjustement_system' => null,
						'stitching' => true,
						'stitching_color' => ['white'],
						'style' => null
					],
					'case' => [
						'color' => ['black'],
						'diameter' => 41,
						'lug_to_lug' => 50,
						'lug_width' => 22,
						'material' => ['ceramic'],
						'open_case_back' => true,
						'sapphire_crystal_case_back' => true,
						'thickness' => 14.4,
						'waterproofness' => '200m (660 ft)'
					],
					'crown' => [
						'color' => ['black'],
						'detail' => 'tudor\'s rose in relief',
						'material' => ['PVD-treated stainless steel'],
						'screwed_down' => true
					],
					'crystal' => [
						'domed' => true,
						'material' => ['sapphire']
					],
					'dial' => [
						'color' => ['black'],
						'domed' => true,
						'marker_color' => ['silver'],
						'marker_lume' => true,
						'marker_lume_color' => ['green'],
						'marker_type' => ['indexes'],
						'textured' => false
					],
					'specification' => [
						'complication' => ['self-winding'],
						'power_reserve' => 70
					],
					'release_price' => 5350,
					'current_price' => null
				],
				9 => [
					'movement_id' => 'MT5602-U',
					'name' => 'Black Bay',
					'reference' => 'm79210cnu-0001',
					'bezel' => [
						'color' => ['black', 'steel'],
						'direction' => 'unidirectional',
						'marking' => ['engraved', 'numerals'],
						'material' => ['PVD-treated stainless steel', 'ceramic']
					],
					'bracelet' => [
						'clasp' => 'folding',
						'clasp_color' => ['black'],
						'clasp_material' => ['PVD-treated stainless steel'],
						'material' => ['hybrid leather', 'rubber'],
						'micro_adjustement' => false,
						'micro_adjustement_system' => null,
						'stitching' => true,
						'stitching_color' => ['white'],
						'style' => null
					],
					'case' => [
						'color' => ['black'],
						'diameter' => 41,
						'lug_to_lug' => 50,
						'lug_width' => 22,
						'material' => ['ceramic'],
						'open_case_back' => true,
						'sapphire_crystal_case_back' => true,
						'thickness' => 14.4,
						'waterproofness' => '200m (660 ft)'
					],
					'crown' => [
						'color' => ['black'],
						'detail' => 'tudor\'s rose in relief',
						'material' => ['PVD-treated stainless steel'],
						'screwed_down' => true
					],
					'crystal' => [
						'domed' => true,
						'material' => ['sapphire']
					],
					'dial' => [
						'color' => ['black'],
						'domed' => true,
						'marker_color' => ['silver'],
						'marker_lume' => true,
						'marker_lume_color' => ['green'],
						'marker_type' => ['indexes'],
						'textured' => false
					],
					'specification' => [
						'complication' => ['self-winding'],
						'power_reserve' => 70
					],
					'release_price' => 5350,
					'current_price' => null
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

				// Bezel
				foreach($watch['bezel']['color'] as $color) {
					$bezelColors[] = BezelColor::where('name', $color)->first()->id;
				}

				foreach($watch['bezel']['marking'] as $marking) {
					$bezelmarking[] = BezelMarking::where('name', $marking)->first()->id;
				}

				foreach($watch['bezel']['material'] as $material) {
					$bezelMaterials[] = BezelMaterial::where('name', $material)->first()->id;
				}

				$newWatch->bezel = [
					'color' => $bezelColors,
					'direction' => $watch['bezel']['direction'],
					'marking' => $bezelmarking,
					'material' => $bezelMaterials
				];

				// Bracelet
				foreach($watch['bracelet']['clasp_color'] as $color) {
					$claspColors[] = BraceletClaspColor::where('name', $color)->first()->id;
				}

				foreach($watch['bracelet']['clasp_material'] as $material) {
					$claspMaterials[] = BraceletClaspMaterial::where('name', $material)->first()->id;
				}

				foreach($watch['bracelet']['material'] as $material) {
					$braceletMaterials[] = BraceletMaterial::where('name', $material)->first()->id;
				}

				$stitchingColors = null;
				foreach($watch['bracelet']['stitching_color'] as $color) {
					$stitchingColors[] = BraceletStitchingColor::where('name', $color)->first()->id;
				}

				$braceletStyle = null;
				if(!is_null($watch['bracelet']['style'])) BraceletStyle::where('name', $watch['bracelet']['style'])->first()->id;

				$newWatch->bracelet = [
					'clasp' => BraceletClasp::where('name', $watch['bracelet']['clasp'])->first()->id,
					'clasp_color' => $claspColors,
					'clasp_material' => $claspMaterials,
					'material' => $braceletMaterials,
					'micro_adjustement' => $watch['bracelet']['micro_adjustement'],
					'micro_adjustement_system' => BraceletMicroAdjustementSystem::where('name', '"t-fit"')->first()->id,
					'stitching' => $watch['bracelet']['stitching'],
					'stitching_color' => $stitchingColors,
					'style' => $braceletStyle
				];

				// Case
				foreach($watch['case']['color'] as $color) {
					$caseColors[] = CaseColor::where('name', $color)->first()->id;
				}

				foreach($watch['case']['material'] as $material) {
					$caseMaterials[] = CaseMaterial::where('name', $material)->first()->id;
				}

				$newWatch->case = [
					'color' => $caseColors,
					'diameter' => $watch['case']['diameter'],
					'lug_to_lug' => $watch['case']['lug_to_lug'],
					'lug_width' => $watch['case']['lug_width'],
					'thickness' => $watch['case']['thickness'],
					'waterproofness' => $watch['case']['waterproofness'],
					'material' => $caseMaterials
				];

				// Crown
				foreach($watch['crown']['color'] as $color) {
					$crownColors[] = CrownColor::where('name', $color)->first()->id;
				}

				foreach($watch['crown']['material'] as $material) {
					$crownMaterials[] = CrownMaterial::where('name', $material)->first()->id;
				}

				$newWatch->crown = [
					'color' => $crownColors,
					'detail' => $watch['crown']['detail'],
					'material' => $crownMaterials,
					'screwed_down' => $watch['crown']['screwed_down']
				];

				// Crystal
				foreach($watch['crystal']['material'] as $material) {
					$crystalMaterials[] = CrystalMaterial::where('name', $material)->first()->id;
				}

				$newWatch->crystal = [
					'material' => $crystalMaterials,
					'domed' => $watch['crystal']['domed']
				];

				// Dial
				foreach($watch['dial']['color'] as $color) {
					$dialColors[] = DialColor::where('name', $color)->first()->id;
				}

				foreach($watch['dial']['marker_color'] as $color) {
					$markerColors[] = DialMarkerColor::where('name', $color)->first()->id;
				}

				foreach($watch['dial']['marker_lume_color'] as $color) {
					$markerLumeColors[] = DialMarkerLumeColor::where('name', $color)->first()->id;
				}

				foreach($watch['dial']['marker_type'] as $type) {
					$markerType[] = DialMarkerType::where('name', $type)->first()->id;
				}

				$newWatch->dial = [
					'color' => $dialColors,
					'domed' => $watch['dial']['domed'],
					'marker_color' => $markerColors,
					'marker_lume' =>$watch['dial']['marker_lume'],
					'marker_lume_color' => $markerLumeColors,
					'marker_type' => $markerType,
					'textured' => $watch['dial']['textured']
				];

				// Specification
				foreach($watch['specification']['complication'] as $complication) {
					$complications[] = Complication::where('name', $complication)->first()->id;
				}

				$newWatch->specification = [
					'power_reserve' => $watch['specification']['power_reserve'],
					'complication' => $complications
				];

				$newWatch->release_price = $watch['release_price'];
				$newWatch->current_price = $watch['current_price'];
				$newWatch->admin_id = $admin->id;
				$newWatch->save();
			}
		}
	}
};
