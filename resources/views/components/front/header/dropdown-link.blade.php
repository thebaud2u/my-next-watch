<a {{
	$attributes->merge([
		'class' => 'block w-full px-4 py-2 hover:border-l-4 '.
				'text-left text-[12px] leading-5 text-mnw-gray font-bold hover:text-white hover:font-bold '.
				'border-transparent hover:border-mnw-blue focus:border-mnw-blue hover:bg-mnw-blue focus:bg-mnw-blue focus:outline-none '.
				'transition duration-150 ease-in-out'
	])
}}>{{ $slot }}</a>
