<?php

class Human
{
    public function __construct(
        private ?string $name = null,
        public ?int $age = null
    )
    {
    }

    public function __invoke()
    {
        return 'Hello Human';
    }

    public function __get(string $name)
    {
        // check if the attribute exists
        if (!property_exists($this, $name)) {
            // we can do whatever we want here

            return now()->format('Y-m-d');
        }

        return $this->$name;
    }

    public function __set(string $name, $value): void
    {
        // add some validation to check if the attribute is allowed to be set
        $this->$name = $value;
    }
}

$human = new Human();

$human->name = 'John Doe';

dd(
    $human,
    $human(),
    $human->name,
    $human->birth_date,
);
