<?php

namespace App\Livewire;

use Illuminate\Http\Request;
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
}
