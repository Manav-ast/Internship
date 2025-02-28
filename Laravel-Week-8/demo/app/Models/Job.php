<?php

namespace App\Models;

use Illuminate\Support\Arr;

class Job
{
    public static function all(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Senior Software Engineer',
                'salary' => '$60,000'
            ],
            [
                'id' => 2,
                'title' => 'Junior Software Engineer',
                'salary' => '$50,000'
            ],
            [
                'id' => 3,
                'title' => 'Senior UX Designer',
                'salary' => '$55,000'
            ],
            [
                'id' => 4,
                'title' => 'Junior UX Designer',
                'salary' => '$45,000'
            ]
        ];
    }

    public static function find($id): array
    {
        $job = Arr::first(Job::all(), fn($job) => $job['id'] == $id);
        
        if (!$job) {
            abort(404);
        }

        return $job;
    }
}
