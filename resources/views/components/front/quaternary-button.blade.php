<button {{ $attributes->merge([
	'type' => 'button',
	'class' => 'inline-flex items-center px-2.5 py-1 rounded-full whitespace-nowrap '.
				'focus:outline-none transition ease-in-out duration-150 '.
				'border-2 border-white text-white font-medium bg-jobboard-deepblue '.
				'hover:bg-white hover:text-jobboard-deepblue uppercase '
]) }}>
	{{ $slot }}
</button>
