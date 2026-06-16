<?php

namespace App\Services;

use Jenssegers\Agent\Agent;

class GoogleAdManagerService
{
    protected $adUnits;
    protected $agent;

    public function __construct()
    {
        $this->agent = new Agent();
        $this->adUnits = config('ads.ad_units');
    }

    /**
     * Récupère les données pour un ad slot donné, selon le type d'appareil et la variante (all/ppg).
     *
     * @param string $slotName Nom de l'ad slot (ex. : banniere_haute)
     * @param string $variant Variante (all ou ppg)
     * @param array $targeting Keys/values additionnels pour le targeting
     * @param string|null $deviceType Forcer le type d'appareil (optionnel)
     * @return array
     */
    public function getAdSlotConfig(string $slotName, string $variant = 'all', array $targeting = [], ?string $deviceType = null): array
    {
        if (!isset($this->adUnits[$slotName][$variant])) {
            throw new \Exception("Ad slot {$slotName} (variante {$variant}) non défini.");
        }

        // Détermine le type d'appareil (desktop ou mobile)
        $device = $deviceType ?: ($this->agent->isMobile() ? 'mobile' : 'desktop');

        $config = $this->adUnits[$slotName][$variant][$device] ?? null;

        if (!$config) {
            throw new \Exception("Configuration pour {$slotName} ({$variant}) sur {$device} non définie.");
        }

        // Fusionne les keys/values par défaut avec ceux passés en paramètre
        $defaultTargeting = [
            'section' => $slotName,
            'variant' => $variant,
            'user_type' => auth()->check() ? 'logged_in' : 'guest',
            'device' => $device,
        ];

        $config['targeting'] = array_merge($defaultTargeting, $targeting);

        return $config;
    }

    /**
     * Récupère tous les slots pour une vue donnée.
     *
     * @param array $slots Liste des slots avec nom et variante (ex. : ['banniere_haute' => 'all'])
     * @param array $targeting Keys/values globaux
     * @param string|null $deviceType Forcer le type d'appareil (optionnel)
     * @return array
     */
    public function getMultipleAdSlots(array $slots, array $targeting = [], ?string $deviceType = null): array
    {
        $configs = [];
        foreach ($slots as $slotName => $variant) {
            $configs[$slotName] = $this->getAdSlotConfig($slotName, $variant, $targeting, $deviceType);
        }
        return $configs;
    }
}