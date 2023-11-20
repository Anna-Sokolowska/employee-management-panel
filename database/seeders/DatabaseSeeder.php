<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use App\Models\FoodPreference;
use App\Models\PhoneNumber;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $foodPreferences = FoodPreference::factory(7)->create();
        $companies = Company::factory(15)->create();

        Employee::factory()
            ->count(30)
            ->sequence(fn (Sequence $sequence) => ['company_id' => $companies->random()->id, 'food_preference_id' => $foodPreferences->random()->id])
            ->hasPhoneNumbers(2)
            ->create();

    }
}
