<?php

namespace App\Actions;

use App\Models\Employee;

class CreateEmployee
{
    public function execute(array $validated): void
    {
        $employee = Employee::create($validated);

        $employee->phones()->createMany([
            ['phone_number' => $validated['phones'][0]],
            ['phone_number' => $validated['phones'][1]],
        ]);
    }
}
