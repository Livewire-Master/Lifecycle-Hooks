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
</div>
