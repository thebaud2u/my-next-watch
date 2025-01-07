<button {{ $attributes->merge([
	'type' => 'submit',
	'class' => 'inline-flex items-center px-3 py-1.5 whitespace-nowrap '.
				'rounded-full text-sm xl:text-base font-medium '.
				'focus:outline-none focus:ring-0 transition ease-in-out duration-150 '.
				'text-white bg-mnw-darkblue border-mnw-darkblue '.
				'hover:bg-mnw-darkerblue hover:border-mnw-darkerblue uppercase '
]) }}>
	{{ $slot }}
</button>
