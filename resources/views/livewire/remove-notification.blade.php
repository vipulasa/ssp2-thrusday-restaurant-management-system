<?php

use function Livewire\Volt\{state};

state([
    'notification' => null
]);

$markAsRead = function(){
    $this->notification->markAsRead();
}
?>

<div>
<button wire:click="markAsRead">
    Remove
</button>
</div>
