<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MediaUrl implements ValidationRule
{
	/**
	 * Run the validation rule.
	 *
	 * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
	 */
	public function validate(string $attribute, mixed $value, Closure $fail): void
	{
		if (!filter_var($value, FILTER_VALIDATE_URL)) {
			$fail('L’URL :attribute n’est pas une URL valide.');
			return;
		}

		if (!$this->isYoutubeVideo($value)) {
			$fail('L’URL :attribute doit être un lien valide vers une vidéo YouTube, un podcast Spotify ou une vidéo Facebook.');
		}
	}

	/**
	 * Vérifie si la validation passe.
	 */
	// public function passes($attribute, $value)
	// {
	//     return $this->isYoutubeVideo($value) || $this->isSpotifyPodcast($value) || $this->isFacebookVideo($value);
	// }

	/**
	 * Message d'erreur personnalisé.
	 */
	public function message()
	{
		return 'L’URL doit être un lien valide vers une vidéo YouTube, un podcast Spotify ou une vidéo Facebook.';
	}

	/**
	 * Vérifie si l'URL est une vidéo YouTube.
	 */
	private function isYoutubeVideo($url)
	{
		return preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w-]+)/', $url);
	}

	/**
	 * Vérifie si l'URL est un podcast Spotify.
	 */
	private function isSpotifyPodcast($url)
	{
		return preg_match('/(?:open\.spotify\.com\/episode\/)([\w-]+)/', $url);
	}

	/**
	 * Vérifie si l'URL est une vidéo Facebook.
	 */
	private function isFacebookVideo($url)
	{
		return preg_match('/(?:facebook\.com\/.*\/videos\/)(\d+)/', $url);
	}
}

