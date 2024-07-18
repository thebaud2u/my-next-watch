<button {{ $attributes->merge([
	'type' => 'button',
	'class' => 'inline-flex items-center px-2.5 py-1 rounded-full whitespace-nowrap '.
				'focus:outline-none transition ease-in-out duration-150 '.
				'border-2 border-annonces-blue text-annonces-blue font-medium '.
				'hover:border-annonces-darkblue hover:text-annonces-darkblue uppercase '
]) }}>
	{{ $slot }}
</button>
