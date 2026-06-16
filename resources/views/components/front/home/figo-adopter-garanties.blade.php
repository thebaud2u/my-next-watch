@php
    // old url prendre rdv 'url' => 'https://www.assuropoil.fr/mutuelle-animaux-complete-et-transparente/?part=3500&provenance=prendre_rdv&utm_source=espace_thematique_EOL&utm_medium=prendre_rdv',
    $figoCards = [
        [
            'url' => env('APP_URL').'/article/frais-sante-animale',
            'icon' => 'assuropoil/lp-assuropoil-07-cout.svg',
            'lines' => [__('An accident or illness?'), __('How much does it cost?')],
            'figoLogo' => true,
            'button' => __('Learn more'),
            'blank' => false,
            'id' => 'accident-bas',
        ],
        [
            'url' => 'tel:+33805201202',
            'icon' => 'assuropoil/lp-assuropoil-08-conseiller.svg',
            'lines' => [__('Book an appointment'), __('with an advisor')],
            'figoLogo' => true,
            'button' => __('0805 201 202'),
            'blank' => true,
            'id' => 'tel-bas'
        ],
        [
            'url' => 'https://www.assuropoil.fr/mutuelle-animaux-complete-et-transparente/?part=3500&provenance=demandez_un_devis&utm_source=espace_thematique_EOL&utm_medium=demandez_un_devis',
            'icon' => 'assuropoil/lp-assuropoil-09-remise.svg',
            'lines' => [__('50% discount'), __('on the first two months')],
            'figoLogo' => true,
            'button' => __('Ask for a quote'),
            'blank' => true,
            'id' => 'devis',
        ],
    ];
@endphp

<div class="flex flex-col items-center w-full py-10 bg-jobboard-cream">
    <p class="text-center text-2xl md:text-[28px] text-jobboard-deepblue font-bold mb-8">
        {{ __('Et maintenant ?') }}
    </p>

    <div class="w-full max-w-[1200px] grid grid-cols-1 md:grid-cols-3 gap-6 px-4 lg:px-0">
        @foreach ($figoCards as $card)
            <a href="{{ $card['url'] }}" @if($card['blank']) target="_blank @endif"
                class="bg-white rounded-xl shadow-md w-full p-6 flex flex-col items-center text-center hover:shadow-lg transition">

                <img src="{{ asset('/storage/' . $card['icon']) }}" alt="Icon" class="h-[60px] md:h-[80px] mb-4">

                @foreach ($card['lines'] as $line)
                    <p class="@if ($loop->first) font-bold @endif text-jobboard-deepblue leading-tight">
                        {{ $line }}
                    </p>
                @endforeach

                @if (!empty($card['figoLogo']))
                    <img src="{{ asset('/storage/home_partner_assuropoil.svg') }}" alt="Assur O’Poil" class="mt-3 mb-4 h-5">
                @endif

                @if (!empty($card['button']))
                    <button @if (!empty($card['id'])) id="{{ $card['id'] }}" @endif
                        class="w-full md:w-auto mt-auto bg-white border border-jobboard-deepblue text-jobboard-deepblue px-4 py-2 rounded-full text-sm font-semibold hover:bg-jobboard-deepblue hover:text-white transition @if($card['button'] == '0805 201 202') flex gap-2 @else inline-block @endif">
                        @if($card['button'] == '0805 201 202')
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.388 4.82261C14.3232 5.00472 15.1827 5.46123 15.8565 6.1337C16.5302 6.80617 16.9876 7.66402 17.1701 8.59743M13.388 1C15.331 1.21544 17.1429 2.08388 18.5261 3.46272C19.9093 4.84157 20.7817 6.64887 21 8.58788M20.0425 16.214V19.0809C20.0436 19.3471 19.989 19.6105 19.8821 19.8544C19.7753 20.0983 19.6186 20.3172 19.4221 20.4971C19.2256 20.677 18.9937 20.814 18.7411 20.8993C18.4885 20.9845 18.2208 21.0162 17.9552 20.9922C15.0089 20.6727 12.1787 19.6678 9.69214 18.0584C7.37869 16.5911 5.4173 14.6335 3.94724 12.3245C2.32908 9.83138 1.32206 6.99289 1.00777 4.03897C0.983845 3.7747 1.01531 3.50836 1.10017 3.25689C1.18503 3.00543 1.32141 2.77435 1.50065 2.57838C1.67989 2.3824 1.89804 2.22582 2.14123 2.11861C2.38442 2.0114 2.64731 1.9559 2.91316 1.95565H5.78561C6.25028 1.95109 6.70076 2.11532 7.05309 2.41774C7.40541 2.72016 7.63554 3.14013 7.70057 3.59937C7.82181 4.51686 8.04665 5.41772 8.37081 6.28476C8.49963 6.62681 8.52751 6.99855 8.45115 7.35593C8.37478 7.71331 8.19737 8.04135 7.93994 8.30118L6.72394 9.51486C8.08697 11.9074 10.0717 13.8883 12.4688 15.2488L13.6848 14.0351C13.9452 13.7782 14.2738 13.6011 14.6319 13.5249C14.99 13.4486 15.3624 13.4765 15.7051 13.6051C16.5738 13.9286 17.4764 14.153 18.3956 14.274C18.8608 14.3395 19.2855 14.5733 19.5892 14.931C19.8928 15.2887 20.0542 15.7453 20.0425 16.214Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        @endif

                        {{ $card['button'] }}
                    </button>
                @endif
            </a>
        @endforeach
    </div>
</div>
