<button {{ $attributes->merge([
	'type' => 'submit',
	'class' => 'inline-flex items-center px-3 py-1.5 whitespace-nowrap '.
				'hover:bg-mnw-blue hover:text-white border-2 border-mnw-blue rounded-full '.
				'text-sm xl:text-base text-mnw-blue font-medium '.
				'focus:outline-none focus:ring-0 transition ease-in-out duration-150 uppercase '
]) }}>
	{{ $slot }}
</button>
