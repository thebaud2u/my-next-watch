<button {{ $attributes->merge([
	'type' => 'submit',
	'class' => 'inline-flex items-center px-3 py-1.5 whitespace-nowrap '.
				'rounded-full text-sm xl:text-base font-medium '.
				'focus:outline-none focus:ring-0 transition ease-in-out duration-150 '.
				'text-white bg-annonces-blue border-annonces-blue hover:bg-annonces-darkblue hover:border-annonces-darkblue uppercase '
]) }}>
	{{ $slot }}
</button>
