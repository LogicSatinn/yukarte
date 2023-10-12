<?php

namespace App\Services;

use Illuminate\Support\Collection;

class Inspiring extends \Illuminate\Foundation\Inspiring
{
    public static function quotes(): Collection
    {
        return Collection::make([
            "- Remember who you're doing it for. It's Your Workout, Your Time, Your Body, Own It.",
            "- Be proud. Don't wait until you've reached your goal to be proud of yourself. Be proud of every step you take toward reaching that goal.",
            "- Consider the possibilities. When you're at the gym feeling like you'll never be one of those people who look like they've been at it their entire lives, remember that they all started somewhere.",
            "- Make fitness a habit. Motivation is what gets you started. Habit is what keeps you going.",
            "- Keep going. Never give up on a dream just because of the time it will take to accomplish it. The time will pass anyway.",
            "- Every workout counts. The only bad workout is the one that didn't happen.",
            "- Attitude is everything. Whether you think you can or you think you can't, you're right.",
            "- Push yourself. Challenging yourself every day is one of the most exciting ways to live.",
            "- Remember your 'why.' When you feel like quitting, think about why you started.",
            "- Imagine how you'll feel after. You're only one workout away from a good mood.",
            "- Gym=bae. I'm obsessed with BAE: Burpees and Endorphins.",
            "- Give it your best. The same voice that says 'give up' can also be trained to say 'keep going'.",
            "- Make the most of your workout. Walk away from every workout feeling proud, accomplished, and strong as hell.",
            "- Give yourself a pep talk. Three little words: You've Got This. (Now, Get It.)"
        ]);
    }
}
