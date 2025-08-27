<?php

namespace App\Models;

use Illuminate\Support\Arr;

class Job {
    public static function all(): array // return type explicit to array
    {
        return [
            [
                'id' => 1,
                'title' => 'Director',
                'salary' => "$50,000",
            ],
            [
                'id' => 2,
                'title' => 'Programmer',
                'salary' => "$100,000",
            ],
            [
                'id' => 3,
                'title' => 'Teacher',
                'salary' => "$30,000",
            ]
        ];

    }

    public static function find($id): array
    {
        // Arr class to interact with arrays first gets the first item
        // of an array that matches a criteria/ finds the first element that matches the
        // given id in the list of arrays
        $job = Arr::first(Job::all(), fn($job) => $job['id'] == $id);

        if (!$job)
        {
            abort(404);
        }

        return $job;
    }
}
