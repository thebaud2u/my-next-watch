{{-- <button {{ $attributes->merge([
	'type' => 'button',
	'class' => 'inline-flex items-center px-3 py-1.5 whitespace-nowrap '.
				'bg-annonces-lightblue hover:bg-annonces-lightblue '.
				'border-2 border-annonces-lightblue hover:border-annonces-lightblue '.
				'rounded-full text-sm xl:text-base text-annonces-blue font-bold '.
				'focus:outline-none focus:ring-0 transition ease-in-out duration-150'
]) }}>
	{{ $slot }}
</button> --}}
<h2 {{ $attributes->merge(['class' => "mb-1 text-base lg:text-xl font-semibold text-annonces-blue"]) }}>
	{{ $slot }}
</h2>
