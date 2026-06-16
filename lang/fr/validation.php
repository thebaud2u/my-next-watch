<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	'accepted'          => 'Le champ :attribute doit être accepté.',
	'accepted_if'       => 'Le champ :attribute doit être accepté quand le champ :other est égal à :value.',
	'active_url'        => 'Le champ :attribute n\'est pas une URL valide.',
	'after'             => 'Le champ :attribute doit être une date postérieure à :date.',
	'after_or_equal'    => 'Le champ :attribute doit être une date postérieure ou égale à :date.',
	'alpha'             => 'Le champ :attribute doit seulement contenir des lettres.',
	'alpha_dash'        => 'Le champ :attribute doit seulement contenir des lettres, des chiffres et des tirets.',
	'array'             => 'Le champ :attribute doit être un tableau.',
	'alpha_num'         => 'Le champ :attribute doit seulement contenir des chiffres et des lettres.',
	'before'            => 'Le champ :attribute doit être une date antérieure à :date.',
	'before_or_equal'   => 'Le champ :attribute doit être une date antérieure ou égale à :date.',
	'between'           => [
		'array'         => 'Le champ :attribute doit avoir entre :min et :max éléments.',
		'file'          => 'Le fichier :attribute doit avoir une taille entre :min et :max kilo-octets.',
		'numeric'       => 'La valeur de :attribute doit être comprise entre :min et :max.',
		'string'        => 'Le texte :attribute doit avoir entre :min et :max caractères.',
	],
	'boolean'           => 'Le champ :attribute doit être vrai ou faux.',
	'confirmed'         => 'Le champ de confirmation :attribute ne correspond pas.',
	'current_password'  => 'Le mot de passe est incorrect.',
	'date'              => 'Le champ :attribute n\'est pas une date valide.',
	'date_equals'       => 'Le champ :attribute doit être une date égale à  :date.',
	'date_format'       => 'Le champ :attribute ne correspond pas au format :format.',
	'declined'          => 'Le champ :attribute doit être refusé.',
	'declined_if'       => 'Le champ :attribute doit être refusé quand le champ :other est égal à :value.',
	'different'         => 'Les champs :attribute et :other doivent être différents.',
	'digits'            => 'Le champ :attribute doit avoir :digits chiffres.',
	'digits_between'    => 'Le champ :attribute doit avoir entre :min and :max chiffres.',
	'dimensions'        => 'Le champ :attribute contient des valeurs de dimensions d\'image non valide.',
	'distinct'          => 'Le champ :attribute a une valeur dupliquée.',
	'doesnt_end_with'   => 'Le champ :attribute ne doit pas se terminer par une des valeurs suivantes: :values.',
	'doesnt_start_with' => 'Le champ :attribute ne doit pas commencer par une des valeurs suivantes: :values.',
	'email'             => 'Le format du champ :attribute n\'est pas valide.',
	'ends_with'         => 'Le champ :attribute doit se terminer par une des valeurs suivantes: :values.',
	'enum'              => 'Le champs :attribute sélectionné n\'est pas valide.',
	'exists'            => 'Le champ :attribute sélectionné est invalide.',
	'file'              => 'Le champ :attribute doit être un fichier.',
	'filled'            => 'Le champ :attribute doit avoir une valeur.',
	'gt'                => [
		'array'         => 'Le champ :attribute doit avoir plus de :value éléments.',
		'file'          => 'Le fichier :attribute doit avoir un poids supérieur à :value kilo-octets.',
		'numeric'       => 'Le champ :attribute doit être supérieur à :value.',
		'string'        => 'Le texte :attribute doit contenir plus de :value caractères.',
	],
	'gte'               => [
		'array'         => 'Le champ :attribute doit avoir au moins :value éléments.',
		'file'          => 'Le fichier :attribute doit avoir un poids au moins égal à :value kilo-octets.',
		'numeric'       => 'Le champ :attribute doit être au moins égal à :value.',
		'string'        => 'Le texte :attribute doit contenir au moins :value caractères.',
	],
	'image'             => 'Le champ :attribute doit être une image.',
	'in'                => 'Le champ :attribute est invalide.',
	'in_array'          => 'Le champ :attribute n\'existe pas dans le champ :other.',
	'integer'           => 'Le champ :attribute doit être un entier.',
	'ip'                => 'Le champ :attribute doit être une adresse IP valide.',
	'ipv4'              => 'Le champ :attribute doit être une adresse IP v4 valide.',
	'ipv6'              => 'Le champ :attribute doit être une adresse IP v6 valide.',
	'json'              => 'Le champ :attribute doit être une chaîne JSON valide.',
	'lt'                => [
		'array'         => 'Le champ :attribute doit avoir moins de :value éléments.',
		'file'          => 'Le fichier :attribute doit être moins gros que :value kilo-octets.',
		'numeric'       => 'Le champ :attribute doit être inférieur à :value.',
		'string'        => 'Le texte :attribute doit contenir moins de :value caractères.',
	],
	'lte'               => [
		'array'         => 'Le champ :attribute doit avoir au maximum :value éléments.',
		'file'          => 'Le champ :attribute doit avoir un poids inférieur ou égal à :value kilo-octets.',
		'numeric'       => 'Le champ :attribute doit être inférieur ou égal à :value.',
		'string'        => 'Le texte :attribute doit contenir au maximum :value caractères.',
	],
	'mac_address'       => 'Le champ :attribute doit être une adresse MAC valide.',
	'max'               => [
		'array'         => 'Le champ :attribute doit avoir au maximum :max éléments.',
		'file'          => 'Le fichier :attribute ne peut être plus gros que :max kilobytes.',
		'numeric'       => 'Le champ :attribute ne peut être supérieur à :max.',
		'string'        => 'Le texte :attribute doit contenir au maximum :max caractères.',
	],
	'max_digits'        => 'Le champ :attribute ne doit pas avoir plus de :max chiffres.',
	'mimes'             => 'Le champ :attribute doit être un fichier de type : :values.',
	'mimetypes'         => 'Le champ :attribute doit être un fichier de type : :values.',
	'min'               => [
		'array'         => 'Le champ :attribute doit avoir au moins :value éléments.',
		'numeric'       => 'La valeur de :attribute doit être inférieure à :min.',
		'file'          => 'Le fichier :attribute doit être plus que gros que :min kilo-octets.',
		'string'        => 'Le texte :attribute doit contenir au moins :min caractères.',
	],
	'min_digits'        => 'Le champ :attribute doit avoir au moins :max chiffres.',
	'multiple_of'       => 'Le champ :attribute doit être un multiple de :value.',
	'not_in'            => 'Le champ :attribute sélectionné n\'est pas valide.',
	'not_regex'         => 'Le format du champ :attribute n\'est pas valide.',
	'numeric'           => 'Le champ :attribute doit contenir un nombre.',
	'password'          => [
		'letters'       => 'Le mot de passe doit contenir au moins une lettre.',
		'mixed'         => 'Le mot de passe doit contenir au moins une lettre majuscule et une lettre minuscule.',
		'numbers'       => 'Le mot de passe doit contenir au moins un chiffre.',
		'symbols'       => 'Le mot de passe doit contenir au moins un caractère spécial.',
		'uncompromised' => 'Le mot de passe est banni. Merci de choisir une autre valeur.',
	],
	'present'           => 'Le champ :attribute doit être compris.',
	'prohibited'        => 'Le champ :attribute n\'est pas autorisé.',
	'prohibited_if'     => 'Le champ :attribute n\'est pas autorisé lorsque :other comprend :value.',
	'prohibited_unless' => 'Le champ :attribute field n\'est pas autorisé sauf si :other est compris dans :values.',
	'prohibits'         => 'Le champ :attribute n\'autorise pas la présence de :other.',
	'regex'             => 'Le format du champ :attribute n\'est pas valide.',
	'required'          => 'Le champ :attribute est obligatoire.',
	'required_array_keys' => 'Le champ :attribute doit contenir des entrées pour: :values.',

	'required_if'       => 'Le champ :attribute est obligatoire quand la valeur de :other est :value.',
	'required_if_accepted' => 'Le champ :attribute field est obligatoire quand :other est accepté.',
	'required_unless'   => 'Le champ :attribute est obligatoire lorsque :other est compris dans les valeurs :values.',
	'required_with'     => 'Le champ :attribute est obligatoire lorsque la valeur :values est présente.',
	'required_with_all' => 'Le champ :attribute est obligatoires lorsque les valeurs :values sont présentes.',
	'required_without'  => 'Le champ :attribute est obligatoire lorsque la valeur :values n\'est pas présente.',
	'required_without_all' => 'Le champ :attribute field est obligatoire lorsqu\'aucune valeur :values n\'est présente.',
	'same'              => 'Les champs :attribute et :other doivent être identiques.',
	'size'              => [
		'array'         => 'Le champ :attribute doit contenir :size éléments.',
		'file'          => 'La taille du fichier :attribute doit être de :size kilo-octets.',
		'numeric'       => 'La taille de la valeur :attribute doit être :size.',
		'string'        => 'Le texte :attribute doit contenir :size caractères.',
	],
	'starts_with'       => 'Le champ :attribute doit commencer avec une des valeurs suivantes: :values.',
	'string'            => 'Le champ :attribute doit être une chaîne de caractères.',
	'timezone'          => 'Le champ :attribute doit être un timezone valide.',
	'unique'            => 'La valeur du champ :attribute est déjà utilisée.',
	'uploaded'          => 'Le téléversement du champ :attribute a échoué.',
	'url'               => 'Le format de l\'URL de :attribute n\'est pas valide.',
	'uuid'              => 'Le champ :attribute doit être un UUID valide.',

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => [
		'captcha' => [
			'captcha' => 'Le champ Captcha renseigné n\'est pas valide.',
		],
	],
	// 'validation' => [
	//     'captcha' => 'Le champ Captcha renseigné n\'est pas valide.',
	// ],

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap our attribute placeholder
	| with something more reader friendly such as "E-Mail Address" instead
	| of "email". This simply helps us make our message more expressive.
	|
	*/

	'attributes' => [],

];
