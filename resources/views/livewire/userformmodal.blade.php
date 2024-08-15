<?php

use App\Models\User;
use function Livewire\Volt\{state, mount, on};

state([
    'user' => null,
    'name' => '',
    'email' => '',
    'password' => '',
    'role' => '',
    'showModal' => false
]);


on([
    'showUserFormModal' => function ($user = null) {
        if ($user) {
            $user = (new User())->find($user['id']);
            $this->user = $user;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->role = $user->role->value;
        }
        $this->showModal = true;
    }
]);

mount(function () {

});

$saveForm = function () {

    // get the user from the model
    $user = $this->user;

    // validate
    if ($user && $user->id) {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|integer|in:1,2,3'
        ]);

        // save
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role
        ]);

    } else {

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|integer|in:1,2,3'
        ]);

        // save
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role
        ]);
    }


    // redirect
    return redirect()->route('admin.users.index')
        ->with('flash.bannerStyle', 'success')
        ->with('flash.banner', 'User created successfully.');

};


?>

<div class="relative z-10"
     x-data="{ open: @entangle('showModal') }"
     x-show="open"
     aria-labelledby="modal-title"
     role="dialog"
     aria-modal="true">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
                    class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                <form method="POST" wire:submit.prevent="saveForm">
                    @csrf

                    <div class="grid grid-cols-1">
                        <div class="px-6 py-3">
                            <label for="name" class="block font-medium text-sm text-gray-700">Name</label>
                            <input type="text" name="name" id="name" wire:model="name"
                                   class="form-input rounded-md shadow-sm mt-1 block w-full"/>
                            @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-6 py-3">
                            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                            <input type="email" name="email" id="email" wire:model="email" class="form-input
                            rounded-md shadow-sm mt-1 block w-full"/>
                            @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-6 py-3">
                            <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
                            <input type="password" name="password" id="password"
                                   wire:model="password" class="form-input
                            rounded-md shadow-sm mt-1 block w-full"/>
                            @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-6 py-3">
                            <label for="role" class="block font-medium text-sm text-gray-700">Role</label>

                            <select name="role" id="role" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                    wire:model="role">
                                <option value="">Select</option>
                                <option value="1">
                                    Administrator
                                </option>
                                <option value="2">
                                    Restaurant Manager
                                </option>
                                <option value="3">
                                    Customer
                                </option>
                            </select>
                            @error('role')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-6 py-3">
                            <button type="submit" class="bg-black text-white font-bold py-2 px-4 rounded">Create User
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
