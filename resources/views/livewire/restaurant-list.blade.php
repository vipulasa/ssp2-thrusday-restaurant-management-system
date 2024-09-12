<?php

use function Livewire\Volt\{state, mount};

state([
    'restaurants' => []
]);

mount(function () {
    $this->restaurants = \App\Models\Restaurant::all();
});

?>

<div>
    <h1 class="text-2xl">
        THIS IS THE LIVEWIRE (VOLT) VERSION
    </h1>
    <div class="grid grid-cols-3 gap-4">
        @foreach($restaurants as $restaurant)
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"
                 x-data="click"
                 x-on:click="makeHit({{ $restaurant->id }})">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <img src="{{ $restaurant->getFirstMediaUrl('logo') }}" alt="{{ $restaurant->name }}"
                         class="w-full h-64 object-cover">
                    <div class="text-2xl font-bold text-gray-800">
                        {{ $restaurant->name }}
                    </div>
                    <div class="text-lg text-gray-500">
                        {{ $restaurant->description }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script>

        document.addEventListener('alpine:init', () => {
            Alpine.data('click', () => ({
                makeHit: function (restaurant_id) {
                    const myHeaders = new Headers();
                    myHeaders.append("Content-Type", "application/json");

                    const raw = JSON.stringify({
                        "model": "Restaurant",
                        "model_id": restaurant_id,
                        "user_id": {{ auth()->id() }},
                        "payload": {
                            "type": "click"
                        }
                    });

                    const requestOptions = {
                        method: "POST",
                        headers: myHeaders,
                        body: raw,
                        redirect: "follow"
                    };

                    fetch("/api/analytics/make-hit", requestOptions)
                        .then((response) => response.text())
                        .then((result) => console.log(result))
                        .catch((error) => console.error(error));
                }
            }));
        });
    </script>
</div>
