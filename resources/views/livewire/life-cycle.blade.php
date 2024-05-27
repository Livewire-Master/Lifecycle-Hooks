<div>
    <h1>
        Lifecycle Hooks
    </h1>
    <hr>
    <button wire:click.prevent="$refresh">
        Refresh
    </button>
    <hr>
    <h4>
        Mount Hook
    </h4>
    <p>
        Creation Time: {{ $creation_time }}
    </p>
    <p>
        Mount Calls: {{ $mount_calls }} times
    </p>
    <p>
        Route UUID: {{ $uuid ?? 'not set' }}
    </p>
    <hr>
    <h4>
        Boot Hook
    </h4>
    <p>
        Last Boot Time: {{ $boot_time }}
    </p>
    <p>
        Boot Calls: {{ $boot_calls }} times
    </p>
    <hr>
    <h4>
        Update Hooks
    </h4>
    <div>
        <label for="input-user_id">
            User ID
        </label>
        <br>
        <input
            id="input-user_id"
            type="text"
            name="user_id"
            wire:model.blur="user_id"
        >
    </div>
    <br>
    <div>
        <label for="input-username">
            Username
        </label>
        <br>
        <input
            id="input-username"
            type="text"
            name="username"
            wire:model.blur="username"
        >
        @error('username')
        <p style="color: indianred; font-size: 0.8rem">
            {{ $message }}
        </p>
        @enderror
    </div>
    <br>
    <div>
        <label for="input-email">
            Email
        </label>
        <br>
        <input
            id="input-email"
            type="text"
            name="email"
            wire:model.blur="email"
        >
        @error('email')
        <p style="color: indianred; font-size: 0.8rem">
            {{ $message }}
        </p>
        @enderror
    </div>
    <br>
    <br>
    <br>
</div>
