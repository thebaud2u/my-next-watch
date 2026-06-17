<button {{ $attributes->merge([
	'type' => 'button',
	'class' => 'inline-flex items-center justify-center px-5 py-3 rounded-full whitespace-nowrap '.
				'focus:outline-none transition ease-in-out duration-150 '.
				'border-2 border-mnw-violet hover:border-mnw-violethover text-mnw-deepblue bg-mnw-violet hover:bg-mnw-violethover text-sm font-semibold '.
				'hover:border-mnw-deepblue hover:text-mnw-deepblue '
]) }}>
	{{ $slot }}
</button>
