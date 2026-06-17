<button {{ $attributes->merge([
	'type' => 'button',
	'class' => 'inline-flex items-center px-5 py-3 whitespace-nowrap gap-x-2 font-bold '.
				'bg-white hover:bg-mnw-deepblue '.
				'border border-mnw-deepblue hover:border-mnw-deepblue '.
				'rounded-full text-sm text-mnw-deepblue hover:text-white '.
				'focus:outline-none focus:ring-0 transition ease-in-out duration-150 '
]) }}>
	{{ $slot }}
</button>
