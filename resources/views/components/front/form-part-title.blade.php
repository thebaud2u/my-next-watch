{{-- <button {{ $attributes->merge([
	'type' => 'button',
	'class' => 'inline-flex items-center px-3 py-1.5 whitespace-nowrap '.
				'bg-mnw-lightblue hover:bg-mnw-lightblue '.
				'border-2 border-mnw-lightblue hover:border-mnw-lightblue '.
				'rounded-full text-sm xl:text-base text-mnw-blue font-bold '.
				'focus:outline-none focus:ring-0 transition ease-in-out duration-150'
]) }}>
	{{ $slot }}
</button> --}}
<h2 {{ $attributes->merge(['class' => "mb-1 text-base lg:text-xl font-semibold text-mnw-blue"]) }}>
	{{ $slot }}
</h2>
