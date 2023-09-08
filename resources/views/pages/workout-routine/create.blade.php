@section('title', __('Create your Routine'))

<section>
    <form wire:submit="saveRoutine">
        {{ $this->form }}

        <x-filament::button>
            Save
        </x-filament::button>
    </form>
</section>
