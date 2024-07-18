<a {{
	$attributes->merge([
		'class' => 'block w-full px-4 py-2 hover:border-l-4 '.
				'text-left text-[12px] leading-5 text-annonces-gray font-bold hover:text-white hover:font-bold '.
				'border-transparent hover:border-annonces-blue focus:border-annonces-blue hover:bg-annonces-blue focus:bg-annonces-blue focus:outline-none '.
				'transition duration-150 ease-in-out'
	])
}}>{{ $slot }}</a>
