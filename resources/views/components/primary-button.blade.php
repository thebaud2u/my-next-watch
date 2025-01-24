<button {{ $attributes->merge([
	'type' => 'submit',
	'class' => 'inline-flex items-center px-3 py-1.5 whitespace-nowrap '.
				'rounded-full text-sm xl:text-base font-medium '.
				'focus:outline-none focus:ring-0 transition ease-in-out duration-150 '.
				'text-white bg-mnw-blue border-mnw-blue hover:bg-mnw-darkblue hover:border-mnw-darkblue uppercase '
]) }}>
	{{ $slot }}
</button>
