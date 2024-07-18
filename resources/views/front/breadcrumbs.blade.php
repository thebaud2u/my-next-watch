@unless ($breadcrumbs->isEmpty())
    <nav class="w-full max-w-screen-xl">
        <ol class="p-1 rounded flex flex-wrap text-sm lg:text-base text-gray-800">
            @foreach ($breadcrumbs as $breadcrumb)
                @if ($breadcrumb->url && ! $loop->last)
                    <li>
                        <a href="{{ $breadcrumb->url }}" class="hover:underline focus:underline">
                            {{ $breadcrumb->title }}
                        </a>
                    </li>
                @else
                    <li class="font-semibold">{{ $breadcrumb->title }}</li>
                @endif
                @unless($loop->last)
                    <li class="text-gray-500 px-2">&gt;</li>
                @endif
            @endforeach
        </ol>
    </nav>
@endunless
