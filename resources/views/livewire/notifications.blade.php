<?php

use function Livewire\Volt\{state, mount};

state([
    'notifications' => []
]);

mount(function(){
    // get the current user
    $user = auth()->user();

    // load the notifications for the current user
    $this->notifications = $user->unreadNotifications;

});

$close= function($notification_id){
    $notification = auth()->user()->notifications()->where('id', $notification_id)->first();
    $notification->markAsRead();
    $this->notifications = auth()->user()->unreadNotifications;
};
?>

<div class="min-w-96 space-y-3">

    <div class="border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ count($notifications) }} Notifications</span>
    </div>

    @foreach($notifications as $notification)
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ $notification->data['message'] }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg wire:click="close('{{ $notification->id }}')" class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path fill-rule="evenodd" d="M14.95 5.05a.75.75 0 0 1 1.06 1.06L11.06 10l4.95 4.95a.75.75 0 1 1-1.06 1.06L10 11.06l-4.95 4.95a.75.75 0 0 1-1.06-1.06L8.94 10 4.99 5.05a.75.75 0 0 1 1.06-1.06L10 8.94l4.95-4.95z"></path>
            </svg>
        </span>
        </div>
    @endforeach
</div>
