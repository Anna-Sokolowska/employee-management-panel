<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use App\Models\Employee;
use App\Models\FoodPreference;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $foodPreferences = FoodPreference::factory(7)->create();
        $companies = Company::factory(15)->create();

        Employee::factory(35)
            ->for($companies->random())
            ->for($foodPreferences->random())
            ->create();
    }
}
