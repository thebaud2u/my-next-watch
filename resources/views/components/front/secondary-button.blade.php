<button {{ $attributes->merge([
	'type' => 'button',
	'class' => 'inline-flex items-center px-5 py-3 whitespace-nowrap gap-x-2 font-bold '.
				'bg-white hover:bg-jobboard-deepblue '.
				'border border-jobboard-deepblue hover:border-jobboard-deepblue '.
				'rounded-full text-sm text-jobboard-deepblue hover:text-white '.
				'focus:outline-none focus:ring-0 transition ease-in-out duration-150 '
]) }}>
	{{ $slot }}
</button>
