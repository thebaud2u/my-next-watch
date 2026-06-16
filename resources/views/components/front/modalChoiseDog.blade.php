<x-front.modal name="choise_breed" :class="'w-full max-w-2xl'" focusable>
    <div>
        <img src="{{ asset('/storage/dog_search_white.svg?v1') }}" />
    </div>
    <div class="text-jobboard-deepblue text-3xl mb-4 flex">
        <strong> {{ __('What breed of') }} {{ request()->segment(1) }}</strong>&nbsp;
        {{ __('suits me') }}&nbsp;?
    </div>

    <form method="POST" action="">
        @csrf
        <div class="mt-6">
            <div class="flex flex-row w-full">
                <div class="w-[60%]">
                    <x-front.input-label for="" :value="__('Are you willing to dedicate several hours a week to training your dog? *')" />
                </div>

                <div class="flex flex-row w-[50%] justify-end">
                    <div class="pr-2">
                        <input type="radio" name="god_race_adopt" value="yes" id="god_race_adopt_yes"
                            class="mr-1 w-3 h-3 focus:ring-jobboard-deepblue checked:bg-jobboard-deepblue" />
                        <label for="god_race_adopt_yes">{{ __('yes') }}</label>
                    </div>

                    <div class="pr-2">
                        <input type="radio" name="god_race_adopt" value="no" id="god_race_adopt_no"
                            class="mr-1 w-3 h-3 focus:ring-jobboard-deepblue checked:bg-jobboard-deepblue" />
                        <label for="god_race_adopt_no">{{ __('no') }}</label>
                    </div>
                </div>

            </div>
            <div class="mt-2 text-sm text-red-600 hidden" id="radio_error">
                {{ __('Please select an option') }}
            </div>

            <div class="w-full flex flex-row bg-jobboard-coral text-jobboard-deepblue mt-6 px-6 py-4 gap-2 rounded-xl text-[17px]  h-full hidden "
                id="advice_message">
                <div class="w-[10%] mt-2">
                    <img src="{{ asset('/storage/warning_blue.svg') }}" />
                </div>
                <div class=" w-[90%] justify-end">
                    <strong> {{ __('So it\'s better to adopt a cat or not adopt at all') }} </strong>
                    {{ __('because a dog requires time for its education') }}.
                </div>
            </div>

        </div>



        <div class="mt-6 w-full">
            <x-front.primary-button id="confirmRaceBtn" type="button">
                <img src="{{ asset('/storage/icone_dog_pink.svg') }}" />
                {{ __('Start the test') }}
            </x-front.primary-button>

        </div>
    </form>

</x-front.modal>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        const confirmBtn = document.querySelector('#confirmRaceBtn');
        const radios = document.querySelectorAll('input[name="god_race_adopt"]');
        const errorMsg = document.getElementById('radio_error');
        const adviceMsg = document.getElementById('advice_message');

        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                errorMsg.classList.add('hidden');
                adviceMsg.classList.add('hidden');

                if (this.value === 'no') {
                    confirmBtn.classList.remove('bg-jobboard-deepblue');
                    confirmBtn.classList.add('bg-gray-400');
                    confirmBtn.classList.add('hover:bg-gray-400');
                    confirmBtn.disabled = true;
                    adviceMsg.classList.remove('hidden');
                } else if (this.value === 'yes') {
                    confirmBtn.classList.remove('bg-gray-400');
                    confirmBtn.classList.add('bg-jobboard-deepblue');
                    confirmBtn.classList.add('hover:bg-jobboard-deepblue');
                    confirmBtn.disabled = false;
                }
            });
        });

        confirmBtn.addEventListener('click', function(e) {
            e.preventDefault();

            const selected = Array.from(radios).find(r => r.checked);

            // Reset messages
            errorMsg.classList.add('hidden');
            adviceMsg.classList.add('hidden');

            if (!selected) {
                errorMsg.classList.remove('hidden');
                return;
            }

            if (selected.value === 'yes') {
                // Redirection fixe vers la version chien
                const destination = "{{ route('post-search.post.choise-breed-chien') }}";
                window.location.href = destination;
            }

        });
    });
</script>
