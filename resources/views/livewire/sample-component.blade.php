<?php

use function Livewire\Volt\{state};

state([
    'name' => 'John Doe'
]);

?>

<div>
    {{ $name }}

    <input type="text" wire:model.live="name">
</div>
