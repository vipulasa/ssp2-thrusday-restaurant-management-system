<?php

use function Livewire\Volt\{state, mount};

state([
    'users' => [],
    'active_chat' => null,
    'messages' => [],

    // For sending message
    'message' => '',
]);

$getUsers = function () {
    return (new \App\Models\User())->where('id', '<>', auth()->id())->get();
};

$startChat = function ($user_id) {

    $from_user_id = auth()->id();

    $to_user_id = $user_id;

    $active_chat = (new \App\Models\Chat())
        ->whereHas('users', function ($query) use ($from_user_id) {
            $query->where('user_id', $from_user_id);
        })->whereHas('users', function ($query) use ($to_user_id) {
            $query->where('user_id', $to_user_id);
        })->first();

    if (!$active_chat) {
        // check if the current user and the selected user has a chat
        // if not, create a new chat
        $active_chat = (new \App\Models\Chat())->create([
            'name' => 'Chat between ' . $from_user_id . ' and ' . $to_user_id,
        ]);

        $active_chat->users()->attach($from_user_id);
        $active_chat->users()->attach($to_user_id);
    }

    $this->active_chat = $active_chat;

    $this->loadMessages();
};

$loadMessages = function () {
    if (!$this->active_chat) {
        return;
    }
    $this->messages = $this->active_chat->messages()->orderBy('created_at', 'asc')->get();
};

$sendMessage = function () {

    $this->active_chat->messages()->create([
        'chat_id' => $this->active_chat->id,
        'user_id' => auth()->id(),
        'message' => $this->message,
    ]);

    $this->message = '';

    $this->loadMessages();
};

mount(function () {

    // load the users
    $this->users = $this->getUsers();

});

?>

<div x-data="{
    refreshChat() {
        this.$wire.loadMessages();
    },
    init() {
        setInterval(() => {
            this.refreshChat();
        }, 5000);
    },
}">

    <ul class="flex px-5 py-4 space-x-3">
        @foreach($users as $user)
            <li wire:click="startChat({{ $user->id }})" class="cursor-pointer">
                <img class="h-10 w-10 rounded-full object-cover" src="{{ $user->profile_photo_url }}"
                     alt="{{ $user->name }}"/>
            </li>
        @endforeach
    </ul>

    <h1>
        {{ $active_chat?->name }}
    </h1>
    @if($active_chat)
        <div>
            <div class="flex flex-col space-y-2 bg-gray-300">
                @foreach($messages as $message)
                    <div class="flex {{ $message->user_id === auth()->user()->id ? "justify-end" : ''}}">
                        <div class="bg-blue-200 text-black p-2 rounded-lg max-w-xs">
                            {{ $message->message }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        <div>
            <input type="text" wire:model="message" placeholder="Type your message here..."/>
            <button wire:click="sendMessage">Send</button>
        </div>
    @endif

</div>
