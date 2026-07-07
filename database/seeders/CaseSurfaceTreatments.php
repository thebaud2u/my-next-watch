<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\CaseSurfaceTreatment;

class CaseSurfaceTreatments extends Seeder
{
	public function run(): void
	{
		$admin = Admin::first();

		$caseSurfaceTreatments = [
			'DLC' => 'Diamond-Like Carbon coating offering excellent scratch resistance and a deep black appearance.',
			'black DLC' => 'Black Diamond-Like Carbon coating for enhanced durability and aesthetics.',
			'PVD' => 'Physical Vapor Deposition coating used to improve durability or alter the case color.',
			'black PVD' => 'Black Physical Vapor Deposition coating.',
			'gold PVD' => 'Gold-colored Physical Vapor Deposition coating.',
			'rose gold PVD' => 'Rose gold-colored Physical Vapor Deposition coating.',
			'hard coating' => 'Generic surface hardening treatment improving scratch resistance.',
			'titanium carbide coating' => 'Titanium carbide coating providing increased hardness and wear resistance.',
			'ceramic Coating' => 'Protective ceramic-based surface coating.',
			'Duratect' => 'Citizen surface hardening technology for titanium and stainless steel.',
			'DiaShield' => 'Seiko proprietary scratch-resistant surface coating.',
			'Tegiment' => 'Sinn surface hardening process significantly increasing steel hardness.',
			'Ice Hardened' => 'Surface hardening treatment improving resistance to scratches and wear.',
		];

		foreach($caseSurfaceTreatments as $caseSurfaceTreatmentName => $caseSurfaceTreatmentDescription) {
			$newCaseSurfaceTreatment = new CaseSurfaceTreatment;
			$newCaseSurfaceTreatment->name = $caseSurfaceTreatmentName;
			$newCaseSurfaceTreatment->description = $caseSurfaceTreatmentDescription;
			$newCaseSurfaceTreatment->admin_id = $admin->id;
			$newCaseSurfaceTreatment->save();
		}
	}
}
