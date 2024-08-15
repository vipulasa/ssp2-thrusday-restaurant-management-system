<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Restaurants') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4 items-end flex">
            <a href="{{ route('admin.restaurants.create') }}"
               class="bg-black text-white font-bold py-2 px-4 rounded">
                Create Restaurant
            </a>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        ID
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Name
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Email
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($restaurants as $restaurant)

                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <div class="text-sm leading-5 text-gray-900">{{ $restaurant->id }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <div class="text-sm leading-5 text-gray-900">{{ $restaurant->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <div class="text-sm leading-5 text-gray-900">{{ $restaurant->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <div class="text-sm leading-5 text-gray-900">{{ $restaurant->status }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <a href="{{ route('admin.restaurants.show', $restaurant->id) }}"
                               class="text-indigo-600 hover:text-indigo-900">Show</a>
                            |
                            <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}"
                               class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>

            <div class="mt-5">
                {{ $restaurants->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
