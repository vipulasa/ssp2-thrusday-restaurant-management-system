<x-app-layout>

    hello Notifications

    <ul class="hidden">
{{--        // Get all notification--}}
{{--        @foreach($user->notifications as $notification)--}}

{{--        // get unread notifications--}}
        @foreach($user->unreadNotifications as $notification)
            <li>
                {{ $notification->data['message'] }}
                @livewire('remove-notification', ['notification' => $notification], key($notification->id))
            </li>
        @endforeach
    </ul>


    <div class="max-w-xl mx-auto">
        @livewire('notifications')
    </div>


</x-app-layout>
