<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Employee;
use App\Models\FoodPreference;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class EmployeeService
{
    public function __construct(
        public string $column = 'id',
        public string $direction = 'asc'
    ) {}

    public function setSortingParameters(string $column, string $direction): void
    {
        $this->column = $column;
        $this->direction = $direction;
    }

    public function getPaginatedListingData(int $paginationItems, ?array $cookie, ?string $search): LengthAwarePaginator
    {
        $employeeBuilder = $this->sort(Employee::query());

        if($cookie)
            $employeeBuilder = $this->filter($employeeBuilder, $cookie);

        if($search)
            $employeeBuilder = $this->search($employeeBuilder, $search);

        $EmployeeBuilderWithCollections = $this->addCollections($employeeBuilder);

        return $this->paginate($EmployeeBuilderWithCollections, $paginationItems);
    }

    public function sort(Builder $builder): Builder
    {
        return $builder->orderBy($this->column, $this->direction);
    }

    public function addCollections(Builder $builder): Builder
    {
        return $builder->with(['company', 'foodPreference', 'phoneNumbers']);
    }

    public function paginate(Builder $builder, int $items): LengthAwarePaginator
    {
        return $builder->paginate($items)->withQueryString();
    }

    public function createEmployeeWithPhones(array $data): void
    {
        $employee = $this->createEmployee($data);
        $this->createEmployeePhones($employee, $data['phoneNumbers']);
    }

    public function createEmployee(array $data): Employee
    {
        return Employee::create($data);
    }

    public function createEmployeePhones(Employee $employee, array $phones): void
    {
        foreach ($phones as $phone) {
            $data[] = ['phone_number' => $phone];
        }

        $employee->phoneNumbers()->createMany($data);
    }

    public function updateEmployeeWithPhones(Employee $employee, array $data): void
    {
        $employee = $this->updateEmployee($employee, $data);
        $this->updateEmployeePhones($employee, $data['phones']);
    }

    public function updateEmployee(Employee $employee, array $data): Employee
    {
        $employee->update($data);
        return $employee;
    }

    public function updateEmployeePhones(Employee $employee, array $phones): void
    {
        $employeePhones = $employee->phoneNumbers()->select('id')->get();

        foreach ($phones as $key => $phone) {
            $data[] = ['id' => $employeePhones[$key]->id,'phone_number' => $phone, 'employee_id' =>$employee->id];
        }

        $employee->phoneNumbers()->upsert($data, ['id'], ['phone_number', 'employee_id']);
    }

    public function delete(Employee $employee): void
    {
        $employee->delete();
    }

    public function getAllModelsWhichEmployeeHas(): array
    {
        $companies = $this->getAllCompanies();
        $foodPreferences = $this->getAllFoodPreferences();

        return compact('companies', 'foodPreferences');
    }

    public function getAllCompanies(): Collection
    {
        return  Company::all();
    }

    public function getAllFoodPreferences(): Collection
    {
        return  FoodPreference::all();
    }

    public function filter(Builder $builder, array $companiesId): Builder
    {
        return  $builder->whereIn('company_id', $companiesId);
    }
    public function search(Builder $builder, string $search): Builder
    {
        return  $builder->where('first_name','LIKE', '%'.$search.'%')
            ->orWhere('last_name','LIKE', '%'.$search.'%')
            ->orWhere('email','LIKE', '%'.$search.'%');
    }
}
