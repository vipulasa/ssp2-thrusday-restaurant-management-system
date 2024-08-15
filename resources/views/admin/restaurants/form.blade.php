<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Restaurant Form
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('admin.restaurants.store') }}" class="space-y-6"
                      method="post" enctype="multipart/form-data">
                    @csrf
                    @foreach($restaurant->getFillable() as $field)

                        @if($field == 'status')
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="{{ $field }}"
                                         value="{{ ucfirst(str_replace('_', ' ', $field)) }}"/>
                                <x-input id="{{ $field }}" name="{{ $field }}" type="checkbox" class="mt-1 block"/>
                                <x-input-error for="{{ $field }}" class="mt-2"/>
                            </div>
                            @continue
                        @endif

                        @if($field == 'address')
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="{{ $field }}"
                                         value="{{ ucfirst(str_replace('_', ' ', $field)) }}"/>
                                <textarea id="{{ $field }}" name="{{ $field }}"
                                          class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                                <x-input-error for="{{ $field }}" class="mt-2"/>
                            </div>
                            @continue
                        @endif

                        @if($field == 'cuisine')
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="{{ $field }}"
                                         value="{{ ucfirst(str_replace('_', ' ', $field)) }}"/>

                                <div class="grid grid-cols-8">
                                    @foreach($cuisines as $cuisine)
                                        <div>
                                            <div class="flex space-x-3">
                                                <x-label for="{{ $cuisine->id }}"
                                                         value="{{ $cuisine->name }}"/>
                                                <x-input id="{{ $cuisine->id }}"
                                                         name="{{ $field }}[]"
                                                         type="checkbox"
                                                         value="{{ $cuisine->id }}"
                                                         class="mt-1 block"/>
                                            </div>
                                            <small class="text-xs text-gray-500">
                                                {{ $cuisine->description }}
                                            </small>
                                        </div>
                                    @endforeach
                                </div>
                                <x-input-error for="{{ $field }}" class="mt-2"/>
                            </div>
                            @continue
                        @endif

                        @if($field == 'opening_hours')
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="{{ $field }}"
                                         value="{{ ucfirst(str_replace('_', ' ', $field)) }}"/>

                                <div x-data="{
                                    days: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                                    hours: ['00:00', '01:00', '02:00', '03:00', '04:00', '05:00', '06:00', '07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00'],
                                    selected: {},
                                    init() {
                                        this.days.forEach(day => {
                                            this.selected[day] = {
                                                open: '00:00',
                                                close: '00:00'
                                            }
                                        })
                                    }
                                }">
                                    <template x-for="day in days">
                                        <div class="flex space x-3">
                                            <x-label x-text="day"/>
                                            <select x-model="selected[day].open" name="opening_hours[day][open]">
                                                <template x-for="hour in hours">
                                                    <option x-text="hour"></option>
                                                </template>
                                            </select>
                                            <select x-model="selected[day].close" name="opening_hours[day][close]">
                                                <template x-for="hour in hours">
                                                    <option x-text="hour"></option>
                                                </template>
                                            </select>
                                        </div>
                                    </template>

                                    <input id="{{ $field }}" name="{{ $field }}"
                                           type="text" class="hidden"
                                           x-bind:value="JSON.stringify(selected)"/>
                                </div>


                                <x-input-error for="{{ $field }}" class="mt-2"/>
                            </div>
                            @continue
                        @endif

                        @if($field == 'slug')
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="{{ $field }}"
                                         value="{{ ucfirst(str_replace('_', ' ', $field)) }}"/>
                                <x-input id="{{ $field }}" name="{{ $field }}" type="text" class="mt-1 block"/>
                                <x-input-error for="{{ $field }}" class="mt-2"/>
                            </div>
                            @continue
                        @endif

                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="{{ $field }}"
                                     value="{{ ucfirst(str_replace('_', ' ', $field)) }}"/>
                            <x-input id="{{ $field }}" name="{{ $field }}" type="text" class="mt-1 block w-full"/>
                            <x-input-error for="{{ $field }}" class="mt-2"/>
                        </div>
                    @endforeach

                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="logo" value="Logo"/>
                        <x-input id="logo" name="logo" type="file" class="mt-1 block
                        w-full"/>
                        <x-input-error for="logo" class="mt-2"/>
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="image" value="Image"/>
                        <x-input id="image" name="gallery[]" type="file" class="mt-1 block
                        w-full" multiple="multiple"/>
                        <x-input-error for="image" class="mt-2"/>
                    </div>



                    <button type="submit">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
