<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\{Admin, Address, Brand, Collection, Country, Movement, Type, Watch};
use App\Models\WatchDetails\ {
	BezelColor, BezelMarking, BezelMaterial, BraceletClasp, BraceletClaspColor, BraceletClaspMaterial, BraceletColor, BraceletMaterial,
	BraceletMicroAdjustementSystem, BraceletStitchingColor, BraceletStyle,
	CaseColor, CaseMaterial, Complication, CrownColor, CrownMaterial, CrystalMaterial,
	DialColor, DialMarkerColor, DialMarkerLumeColor, DialMarkerType
};

class Watches extends Seeder
{
	function getIds(string $modelClass, array $names): array
	{
		return collect($names)
			->map(fn($name) => $modelClass::where('name', $name)->value('id')
				?? throw new \RuntimeException("$modelClass not found : $name"))
			->toArray();
	}

	function getId(string $modelClass, string $name): int
	{
		return $modelClass::where('name', $name)->value('id')
			?? throw new \RuntimeException("$modelClass not found : $name");
	}

	public function run(): void
	{
		$admin = Admin::first();

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
						'color' => null,
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
						'waterproofness' => 200
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
						'skeleton' => false,
						'textured' => false
					],
					'specification' => [
						'complication' => ['self-winding'],
						'power_reserve' => 70
					],
					'release_price' => 4730,
					'current_price' => null,
					'type' => ['diver']
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
						'color' => null,
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
						'waterproofness' => 200
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
						'skeleton' => false,
						'textured' => false
					],
					'specification' => [
						'complication' => ['self-winding'],
						'power_reserve' => 70
					],
					'release_price' => 4620,
					'current_price' => null,
					'type' => ['diver']
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
						'color' => 'black',
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
						'waterproofness' => 200
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
						'skeleton' => false,
						'textured' => false
					],
					'specification' => [
						'complication' => ['self-winding'],
						'power_reserve' => 70
					],
					'release_price' => 4400,
					'current_price' => null,
					'type' => ['diver']
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
						'color' => 'black',
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
						'waterproofness' => 200
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
						'skeleton' => false,
						'textured' => false
					],
					'specification' => [
						'complication' => ['self-winding'],
						'power_reserve' => 70
					],
					'release_price' => 5350,
					'current_price' => null,
					'type' => ['diver']
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
						'color' => null,
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
						'waterproofness' => 200
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
						'skeleton' => false,
						'textured' => false
					],
					'specification' => [
						'complication' => ['self-winding'],
						'power_reserve' => 70
					],
					'release_price' => 4730,
					'current_price' => null,
					'type' => ['diver']
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
						'color' => null,
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
						'waterproofness' => 200
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
						'skeleton' => false,
						'textured' => false
					],
					'specification' => [
						'complication' => ['self-winding'],
						'power_reserve' => 70
					],
					'release_price' => 4620,
					'current_price' => null,
					'type' => ['diver']
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
						'color' => 'black',
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
						'waterproofness' => 200
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
						'skeleton' => false,
						'textured' => false
					],
					'specification' => [
						'complication' => ['self-winding'],
						'power_reserve' => 70
					],
					'release_price' => 4400,
					'current_price' => null,
					'type' => ['diver']
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
						'color' => null,
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
						'waterproofness' => 200
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
						'skeleton' => false,
						'textured' => false
					],
					'specification' => [
						'complication' => ['self-winding'],
						'power_reserve' => 70
					],
					'release_price' => 4150,
					'current_price' => null,
					'type' => ['diver']
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
						'color' => null,
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
						'waterproofness' => 200
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
						'skeleton' => false,
						'textured' => false
					],
					'specification' => [
						'complication' => ['self-winding'],
						'power_reserve' => 70
					],
					'release_price' => 5350,
					'current_price' => null,
					'type' => ['diver']
				]
			]
		];

		foreach($watches as $collection => $values) {
			foreach($values as $index => $watch) {
				$newWatch = new Watch;
				$newWatch->collection_id = $this->getId(Collection::class, $collection);
				$newWatch->movement_id = $this->getId(Movement::class, $watch['movement_id']);
				$newWatch->bracelet_clasp_id = $watch['bracelet']['clasp'] ? $this->getId(BraceletClasp::class, $watch['bracelet']['clasp']) : null;
				$newWatch->bracelet_color_id = $watch['bracelet']['color'] ? $this->getId(BraceletColor::class, $watch['bracelet']['color']) : null;
				$newWatch->bracelet_micro_adjustement_system_id = $watch['bracelet']['micro_adjustement_system'] ? $this->getId(BraceletMicroAdjustementSystem::class, $watch['bracelet']['micro_adjustement_system']) : null;
				$newWatch->bracelet_style_id = $watch['bracelet']['style'] ? $this->getId(BraceletStyle::class, $watch['bracelet']['style']) : null;
				$newWatch->name = $watch['name'];
				$newWatch->reference = $watch['reference'];

				// Bezel
				$newWatch->bezel = [
					'direction' => $watch['bezel']['direction']
				];

				// Bracelet
				$newWatch->bracelet = [
					'micro_adjustement' => $watch['bracelet']['micro_adjustement'],
					'stitching' => $watch['bracelet']['stitching'],
				];

				// Case
				$newWatch->case = [
					'diameter' => $watch['case']['diameter'],
					'lug_to_lug' => $watch['case']['lug_to_lug'],
					'lug_width' => $watch['case']['lug_width'],
					'open_case_back' => $watch['case']['open_case_back'],
					'sapphire_crystal_case_back' => $watch['case']['sapphire_crystal_case_back'],
					'thickness' => $watch['case']['thickness'],
					'waterproofness' => $watch['case']['waterproofness']
				];

				// Crown
				$newWatch->crown = [
					'detail' => $watch['crown']['detail'],
					'screwed_down' => $watch['crown']['screwed_down']
				];

				// Crystal
				$newWatch->crystal = [
					'domed' => $watch['crystal']['domed']
				];

				// Dial
				$newWatch->dial = [
					'domed' => $watch['dial']['domed'],
					'marker_lume' =>$watch['dial']['marker_lume'],
					'skeleton' => $watch['dial']['skeleton'],
					'textured' => $watch['dial']['textured']
				];

				// Specification
				$newWatch->specification = [
					'power_reserve' => $watch['specification']['power_reserve']
				];

				$newWatch->release_price = $watch['release_price'];
				$newWatch->current_price = $watch['current_price'];
				$newWatch->admin_id = $admin->id;
				$newWatch->save();

				// Bezel
				$bezelColors = $this->getIds(BezelColor::class, $watch['bezel']['color']);
				$bezelmarking = $this->getIds(BezelMarking::class, $watch['bezel']['marking']);
				$bezelMaterials = $this->getIds(BezelMaterial::class, $watch['bezel']['material']);

				$newWatch->bezelColors()->sync($bezelColors);
				$newWatch->bezelMarkings()->sync($bezelmarking);
				$newWatch->bezelMaterials()->sync($bezelMaterials);

				// Bracelet
				$braceletClaspColors = $this->getIds(BraceletClaspColor::class, $watch['bracelet']['clasp_color']);
				$braceletClaspMaterials = $this->getIds(BraceletClaspMaterial::class, $watch['bracelet']['clasp_material']);
				$braceletMaterials = $this->getIds(BraceletMaterial::class, $watch['bracelet']['material']);
				$braceletStitchingColors = $this->getIds(BraceletStitchingColor::class, $watch['bracelet']['stitching_color']);

				$newWatch->braceletClaspColors()->sync($braceletClaspColors);
				$newWatch->braceletClaspMaterials()->sync($braceletClaspMaterials);
				$newWatch->braceletMaterials()->sync($braceletMaterials);
				$newWatch->braceletStitchingColors()->sync($braceletStitchingColors);

				// Case
				$caseColors = $this->getIds(CaseColor::class, $watch['case']['color']);
				$caseMaterials = $this->getIds(CaseMaterial::class, $watch['case']['material']);

				$newWatch->caseColors()->sync($caseColors);
				$newWatch->caseMaterials()->sync($caseMaterials);

				// Complication
				$complications = $this->getIds(Complication::class, $watch['specification']['complication']);

				$newWatch->complications()->sync($complications);

				// Crown
				$crownColors = $this->getIds(CrownColor::class, $watch['crown']['color']);
				$crownMaterials = $this->getIds(CrownMaterial::class, $watch['crown']['material']);

				$newWatch->crownColors()->sync($crownColors);
				$newWatch->crownMaterials()->sync($crownMaterials);

				// Crystal
				$crystalMaterials = $this->getIds(CrystalMaterial::class, $watch['crystal']['material']);

				$newWatch->crystalMaterials()->sync($crystalMaterials);

				// Dial
				$dialColors = $this->getIds(DialColor::class, $watch['dial']['color']);
				$dialMarkerColors = $this->getIds(DialMarkerColor::class, $watch['dial']['marker_color']);
				$dialMarkerLumeColors = $this->getIds(DialMarkerLumeColor::class, $watch['dial']['marker_lume_color']);
				$dialMarkerTypes = $this->getIds(DialMarkerType::class, $watch['dial']['marker_type']);

				$newWatch->dialColors()->sync($dialColors);
				$newWatch->dialMarkerColors()->sync($dialMarkerColors);
				$newWatch->dialMarkerLumeColors()->sync($dialMarkerLumeColors);
				$newWatch->dialMarkerTypes()->sync($dialMarkerTypes);

				// Type
				$types = $this->getIds(Type::class, $watch['type']);

				$newWatch->types()->sync($types);
			}
		}
	}
}
