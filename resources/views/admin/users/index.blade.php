<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4 items-end flex">
            <a href="{{ route('admin.users.create') }}" class="bg-black text-white font-bold py-2 px-4 rounded">Create User</a>

            <a x-data
               @click="$dispatch('showUserFormModal')"
               class="bg-black text-white font-bold py-2 px-4 rounded">
                Create User From Modal
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
                        Role
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($users as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <div class="text-sm leading-5 text-gray-900">{{ $user->id }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <div class="text-sm leading-5 text-gray-900">{{ $user->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <div class="text-sm leading-5 text-gray-900">{{ $user->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <div class="text-sm leading-5 text-gray-900">{{ $user->role->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <a href="{{ route('admin.users.show', $user->id) }}"
                               class="text-indigo-600 hover:text-indigo-900">Show</a>
                            |
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                               class="text-indigo-600 hover:text-indigo-900">Edit</a>

                            <a x-data
                               @click="$dispatch('showUserFormModal', { user: {{ $user }} })"
                               class="text-indigo-600 hover:text-indigo-900">
                                Edit Modal
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>

            <div class="mt-5">
                {{ $users->links() }}
            </div>

            @livewire('userformmodal')
        </div>
    </div>
</x-app-layout>
