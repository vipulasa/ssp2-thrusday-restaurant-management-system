<?php

use function Livewire\Volt\{state, mount};

state([
    'restaurants' => []
]);

mount(function(){
    $this->restaurants = \App\Models\Restaurant::all();
});

?>

<div>
    <h1 class="text-2xl">
        THIS IS THE LIVEWIRE (VOLT) VERSION
    </h1>
    <div class="grid grid-cols-3 gap-4">
        @foreach($restaurants as $restaurant)
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <img src="{{ $restaurant->getFirstMediaUrl('logo') }}" alt="{{ $restaurant->name }}" class="w-full h-64 object-cover">
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
</div>
