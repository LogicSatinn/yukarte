@section('title', __('Setting'))

<section>
    <form class="space-y-4">
        {{ $this->form }}

        <x-filament::button>
            {{ __('Save') }}
        </x-filament::button>
    </form>
</section>
