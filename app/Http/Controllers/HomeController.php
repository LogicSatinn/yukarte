<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Cycle;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render(
            component: 'Home',
            props: [
                'shouldCreateFirstCycle' => Cycle::count() === 0,
            ]
        );
    }
}
