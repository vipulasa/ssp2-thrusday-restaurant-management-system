<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form method="POST" action="{{ route('admin.users.update', $user) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1">
                        <div class="px-6 py-3">
                            <label for="name" class="block font-medium text-sm text-gray-700">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                   class="form-input rounded-md shadow-sm mt-1 block w-full"/>
                            @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-6 py-3">
                            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-input
                            rounded-md shadow-sm mt-1 block w-full"/>
                            @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

{{--                        <div class="px-6 py-3">--}}
{{--                            <label for="password" class="block font-medium text-sm text-gray-700">Password</label>--}}
{{--                            <input type="password" name="password" id="password"--}}
{{--                                   value="{{ old('password') }}" class="form-input--}}
{{--                            rounded-md shadow-sm mt-1 block w-full"/>--}}
{{--                            @error('password')--}}
{{--                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>--}}
{{--                            @enderror--}}
{{--                        </div>--}}

                        <div class="px-6 py-3">
                            <label for="role" class="block font-medium text-sm text-gray-700">Role</label>

                            <select name="role" id="role" class="form-input
                            rounded-md shadow-sm mt-1 block w-full">
                                <option value="">Select</option>
                                <option value="1" {{ (old('role', $user->role->value) == '1' ? 'selected' : '') }}>
                                    Administrator
                                </option>
                                <option value="2" {{ (old('role', $user->role->value) == '2' ? 'selected' : '') }}>
                                    Restaurant Manager
                                </option>
                                <option value="3" {{ (old('role', $user->role->value) == '3' ? 'selected' : '') }}>
                                    Customer
                                </option>
                            </select>
                            @error('role')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-6 py-3">
                            <button type="submit" class="bg-black text-white font-bold py-2 px-4 rounded">Update User
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
