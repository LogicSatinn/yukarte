<?php

namespace App\Http\Controllers;

use App\Actions\GenerateFirstCycle;
use App\Http\Requests\CreateFirstCycleRequest;
use Brick\Math\Exception\MathException;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use When\InvalidStartDate;

class CreateFirstCycleController extends Controller
{
    /**
     * @param  CreateFirstCycleRequest  $request
     * @param  GenerateFirstCycle  $generateFirstCycle
     * @return RedirectResponse
     */
    public function __invoke(CreateFirstCycleRequest $request, GenerateFirstCycle $generateFirstCycle): RedirectResponse
    {
        try {
            $startingDate = Carbon::parse($request->get('starting_date'));

            $generateFirstCycle(startingDate: $startingDate);

            return to_route('home');
        } catch (Exception|MathException|InvalidStartDate) {
            return to_route('home');
        }
    }
}
