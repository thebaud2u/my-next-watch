<button {{ $attributes->merge([
	'type' => 'button',
	'class' => 'inline-flex items-center px-2.5 py-1 rounded-full whitespace-nowrap '.
				'focus:outline-none transition ease-in-out duration-150 '.
				'border-2 border-mnw-blue text-mnw-blue font-medium '.
				'hover:border-mnw-darkblue hover:text-mnw-darkblue uppercase '
]) }}>
	{{ $slot }}
</button>
