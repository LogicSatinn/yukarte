@section('title', __('Create your Routine'))

<section>
    <form wire:submit="saveRoutine" class="space-y-2">
        {{ $this->form }}

        <x-filament::button>
            Save
        </x-filament::button>
    </form>
</section>
