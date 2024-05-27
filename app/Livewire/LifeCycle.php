<?php

namespace App\Livewire;

use Livewire\Component;

class LifeCycle extends Component
{
    /**
     * Creation Time
     *
     * @var int
     */
    public int $creation_time;

    /**
     * Mount Function Execution Count
     *
     * @var int
     */
    public int $mount_calls = 0;

    /**
     * Route Param UUID
     *
     * @var ?string
     */
    public ?string $uuid;

    /**
     * Last boot Time
     *
     * @var int
     */
    public int $boot_time;

    /**
     * Boot function execution count
     *
     * @var int
     */
    public int $boot_calls = 0;

    /**
     * Mount the component
     *
     * @param string|null $uuid
     *
     * @return void
     */
    public function mount(string $uuid = null): void
    {
        // on component creation
        // executes only 1 time
        $this->creation_time = time();
        $this->mount_calls++;
        $this->uuid = $uuid;
    }

    /**
     * Boot the component
     *
     * @return void
     */
    public function boot(): void
    {
        // executes on beginning of every request (initial, subsequently)

        $this->boot_time = time();
        $this->boot_calls++;
    }
}
