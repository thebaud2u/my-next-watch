<button {{ $attributes->merge([
	'type' => 'button',
	'class' => 'inline-flex items-center justify-center px-5 py-3 rounded-full whitespace-nowrap '.
				'focus:outline-none transition ease-in-out duration-150 '.
				'border-2 border-jobboard-violet hover:border-jobboard-violethover text-jobboard-deepblue bg-jobboard-violet hover:bg-jobboard-violethover text-sm font-semibold '.
				'hover:border-jobboard-deepblue hover:text-jobboard-deepblue '
]) }}>
	{{ $slot }}
</button>
