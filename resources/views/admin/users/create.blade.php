<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create a new User
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf

                    <div class="grid grid-cols-1">
                        <div class="px-6 py-3">
                            <label for="name" class="block font-medium text-sm text-gray-700">Name</label>
                            <input type="text" name="name" id="name" value=""
                                   class="form-input rounded-md shadow-sm mt-1 block w-full"/>
                        </div>

                        <div class="px-6 py-3">
                            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="" class="form-input
                            rounded-md shadow-sm mt-1 block w-full"/>
                        </div>

                        <div class="px-6 py-3">
                            <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
                            <input type="password" name="password" id="password" value="" class="form-input
                            rounded-md shadow-sm mt-1 block w-full"/>
                        </div>

                        <div class="px-6 py-3">
                            <label for="role" class="block font-medium text-sm text-gray-700">Role</label>

                            <select name="role" id="role" class="form-input
                            rounded-md shadow-sm mt-1 block w-full">
                                <option value="1">Administrator</option>
                                <option value="2">Restaurant Manager</option>
                                <option value="3">Customer</option>
                            </select>
                        </div>

                        <div class="px-6 py-3">
                            <button type="submit" class="bg-black font-bold py-2 px-4 rounded">Create User</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
