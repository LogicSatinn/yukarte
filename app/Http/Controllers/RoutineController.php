<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoutineRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\Yaml\Yaml;

class RoutineController extends Controller
{
    public function index(): Response
    {
        return Inertia::render(
            'Routine/Index',
            [
                'routine' => Storage::disk('settings')->exists('routine.yml')
                    ? Yaml::parseFile(Storage::disk('settings')->path('routine.yaml'))
                    : [],
            ]
        );
    }

    public function create(): Response
    {
        return Inertia::render(
            'Routine/Create',
        );
    }

    public function store(StoreRoutineRequest $request): RedirectResponse
    {
        $request
            ->file('routine')
            ->storeAs(
            '',
            'routine.yaml',
            'settings'
        );

        return to_route('routine.index');
    }
}
