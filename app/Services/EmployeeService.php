<?php

namespace App\Services;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class EmployeeService
{
    public function getPaginatedListingData(array $sort, $paginationItems): LengthAwarePaginator
    {
        $EmployeeBuilder = $this->sort(Employee::query(), $sort['column'], $sort['direction']);

        $EmployeeBuilderWithCollections = $this->addCollections($EmployeeBuilder);

        return $this->paginate($EmployeeBuilderWithCollections, $paginationItems);
    }

    public function sort(Builder $builder, $column, $direction): Builder
    {
        return $builder->orderBy($column, $direction);
    }

    public function addCollections(Builder $builder): Builder
    {
        return $builder->with(['company', 'foodPreference', 'phones']);
    }

    public function paginate(Builder $builder, int $items): LengthAwarePaginator
    {
        return $builder->paginate($items)->withQueryString();
    }

    public function createEmployeeWithPhones(array $data): void
    {
        $employee = $this->createEmployee($data);
        $this->createEmployeePhones($employee, $data['phones']);
    }

    public function createEmployee(array $data): Employee
    {
        return Employee::create($data);
    }

    public function createEmployeePhones(Employee $employee, array $phones): void
    {
        $data = [];
        foreach ($phones as $phone) {
            $data = ['phone_number' => $phone];
        }

        $employee->phones()->createMany([$data]);
    }

    public function delete(Employee $employee): void
    {
        $employee->delete();
    }
}
