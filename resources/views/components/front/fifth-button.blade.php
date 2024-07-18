<button {{ $attributes->merge([
	'type' => 'submit',
	'class' => 'inline-flex items-center px-3 py-1.5 whitespace-nowrap '.
				'hover:bg-annonces-blue hover:text-white border-2 border-annonces-blue rounded-full '.
				'text-sm xl:text-base text-annonces-blue font-medium '.
				'focus:outline-none focus:ring-0 transition ease-in-out duration-150 uppercase '
]) }}>
	{{ $slot }}
</button>
