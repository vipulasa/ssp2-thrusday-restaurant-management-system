<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $restaurant->name }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
            <a href="{{ route('admin.restaurants.index') }}"
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back</a>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Restaurant Information</h3>
                        <p class="mt-1 max-w 2xl text-sm text-gray-500">Details About the location.</p>
                    </div>
                </div>

                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Name</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $restaurant->name }}</dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Email address</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $restaurant->email }}</dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $restaurant->status }}</dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Logo</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                                <img src="{{ $restaurant->getFirstMediaUrl('logo') }}" alt="" class="w-1/2">
                            </dd>
                        </div>

                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Gallery</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 flex space-x-2">
                                @foreach($restaurant->getMedia('gallery') as $media)
                                    <img src="{{ $media->getUrl() }}" alt="" class="w-1/5">
                                @endforeach
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
