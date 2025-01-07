<button {{ $attributes->merge([
	'type' => 'button',
	'class' => 'inline-flex items-center px-3 py-1.5 whitespace-nowrap '.
				'bg-mnw-white hover:bg-mnw-blue '.
				'border-2 border-mnw-blue hover:border-mnw-blue '.
				'rounded-full text-sm xl:text-base text-mnw-blue hover:text-white '.
				'focus:outline-none focus:ring-0 transition ease-in-out duration-150 uppercase '
]) }}>
	{{ $slot }}
</button>
