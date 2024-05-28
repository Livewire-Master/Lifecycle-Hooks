<?php

namespace App\Livewire;

use App\DataTransferObjects\Post\PostDto;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Route;
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
     * Target Post DTO
     *
     * @var PostDto|array $post
     */
    public $post;

    /**
     * Exception View
     *
     * @var bool
     */
    public bool $exception_view = true;

    /**
     * Exception Status
     *
     * @var bool
     */
    public bool $has_exception = false;

    /**
     * Exception Message
     *
     * @var string
     */
    public string $exception_message = '';

    /**
     * Mount the component
     *
     * @param string|null $uuidOrTitle
     * @param string|null $caption
     *
     * @return void
     */
    public function mount(string $uuidOrTitle = null, string $caption = null): void
    {
        // on component creation
        // executes only 1 time
        $this->creation_time = time();
        $this->mount_calls++;

        if (Route::is('page.exception'))
        {
            User::find(999);
        }
        else if (Route::is('page.uuid'))
        {
            $this->uuid = $uuidOrTitle;
        }
        else if (Route::is('page.post'))
        {
            // Initial Request
            $this->post = new PostDto($uuidOrTitle, $caption, 0);
        }
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

    /**
     * Hydrate Data
     *
     * @return void
     */
    public function hydrate(): void
    {
        // Runs at the beginning of every "subsequent" request.
        if (is_array($this->post))
        {
            $this->post = PostDto::fromArray($this->post);
        }
    }

    /**
     * Dehydrate the data
     *
     * This method is called at the end of every single request
     * to convert the "post" property to an array.
     *
     * @return void
     */
    public function dehydrate(): void
    {
        // Runs at the end of every single request.
        $this->post = $this->post?->toArray();
    }

    /**
     * Do some magic
     *
     * @return void
     */
    public function magic(): void
    {
        $this->post?->like();
    }

    /**
     * Rendering Hook
     *
     * @param View  $view The view about to be rendered
     * @param array $data The data provided to the view
     *
     * @return void
     */
    public function rendering(View $view, array $data): void
    {
        // Runs BEFORE the provided view is rendered...
        //
        // $view: The view about to be rendered
        // $data: The data provided to the view
    }

    /**
     * Rendered Hook
     *
     * @param View   $view The rendered view.
     * @param string $html The final, rendered HTML.
     *
     * @return void
     */
    public function rendered(View $view, string $html): void
    {
        // Runs AFTER the provided view is rendered...
        //
        // $view: The rendered view
        // $html: The final, rendered HTML
    }

    /**
     * Exception Handler
     *
     * @param Exception $e               The exception object
     * @param callable  $stopPropagation A flag indicating whether to stop event propagation
     *
     * @return void
     */
    public function exception(Exception $e, callable $stopPropagation): void
    {
        if ($e instanceof QueryException)
        {
            $this->exception_view    = false;
            $this->has_exception     = true;
            $this->exception_message = $e->getMessage();
            $stopPropagation();
        }
    }
}
