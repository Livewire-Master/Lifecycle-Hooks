<?php

namespace App\Livewire;

use Exception;
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
     * Username
     *
     * @var string
     */
    public string $username = '';

    /**
     * Email
     *
     * @var string
     */
    public string $email = '';

    /**
     * User ID
     *
     * @note NOT-LOCKED for educational purpose.
     * WE SHOULD #[Locked] attribute in real applications.
     *
     * @var int
     */
    public int $user_id = 1;

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

    /**
     * Updating Hook
     *
     * @param string $property
     * @param mixed  $value
     *
     * @throws Exception
     */
    public function updating(string $property, mixed $value): void
    {
        if ($property === 'user_id')
        {
            throw new Exception('You can not change User ID');
        }

        if ($property === 'username' && strlen($value) <= 3)
        {
            $this->addError('username', 'Username must be at least 3 characters long');
        }
        else
        {
            $this->resetErrorBag('username');
        }
    }

    /**
     * Updated Hook
     *
     * @param string $property
     *
     * @return void
     */
    public function updated(string $property): void
    {
        if ($property === 'username')
        {
            $this->username = trim(strtoupper($this->username));
        }
    }

    /**
     * Updating Email Property
     *
     * @param mixed $value
     *
     * @return void
     */
    public function updatingEmail(mixed $value): void
    {
        if (strlen($value) <= 3)
        {
            $this->addError('email', 'Email must be at least 3 characters long');
        }
        else
        {
            $this->resetErrorBag('email');
        }
    }

    /**
     * Updated Email Property
     *
     * @return void
     */
    public function updatedEmail(): void
    {
        $this->email = trim(strtolower($this->email));
    }
}
