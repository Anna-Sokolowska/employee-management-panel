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
        foreach ($phones as $phone) {
            $data[] = ['phone_number' => $phone];
        }

        $employee->phones()->createMany($data);
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
        $employeePhones = $employee->phones()->select('id')->get();

        foreach ($phones as $key => $phone) {
            $data[] = ['id' => $employeePhones[$key]->id,'phone_number' => $phone, 'employee_id' =>$employee->id];
        }

        $employee->phones()->upsert($data, ['id'], ['phone_number', 'employee_id']);
    }

    public function delete(Employee $employee): void
    {
        $employee->delete();
    }
}
