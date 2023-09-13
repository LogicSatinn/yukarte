<?php

declare(strict_types=1);

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
            component: 'Routine/Index',
            props: [
                'routine' => Storage::disk('settings')->exists('routine.yaml')
                    ? Yaml::parseFile(Storage::disk('settings')->path('routine.yaml'))
                    : [],
            ]
        );
    }

    public function create(): Response
    {
        return Inertia::render(
            component: 'Routine/Create',
        );
    }

    public function store(StoreRoutineRequest $request): RedirectResponse
    {
        $request
            ->file('routine')
            ->storeAs(
                path: '',
                name: 'routine.yaml',
                options: 'settings'
            );

        return to_route('routine.index');
    }
}
