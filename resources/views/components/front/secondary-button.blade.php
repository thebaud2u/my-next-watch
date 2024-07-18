<button {{ $attributes->merge([
	'type' => 'button',
	'class' => 'inline-flex items-center px-3 py-1.5 whitespace-nowrap '.
				'bg-annonces-white hover:bg-annonces-blue '.
				'border-2 border-annonces-blue hover:border-annonces-blue '.
				'rounded-full text-sm xl:text-base text-annonces-blue hover:text-white '.
				'focus:outline-none focus:ring-0 transition ease-in-out duration-150 uppercase '
]) }}>
	{{ $slot }}
</button>
