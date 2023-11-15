<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use App\Models\FoodPreference;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function __construct(
        public EmployeeService $employeeService
    ) {}

    public function index(Request $request): View
    {
        $column = $request->query('column') ?: 'id';
        $direction = $request->query('direction') ?: 'asc';

        $this->employeeService->setSorting($column, $direction);

        $employees = $this->employeeService->getPaginatedListingData(10);

        return view('employees.index', ['employees' => $employees]);
    }

    public function create(EmployeeService $employeeService): View
    {
        $data = $employeeService->getAllModelsWhichEmployeeHas();

        return view('employees.create', [], $data);
    }

    public function store(EmployeeRequest $request)
    {
        $validated = $request->validated();

        $this->employeeService->createEmployeeWithPhones($validated);

        return redirect()->route('employees.index');
    }

    public function edit(Employee $employee)
    {
        $data = $this->employeeService->getAllModelsWhichEmployeeHas();

        $phones = $employee->phones;

        return view('employees.edit', compact('employee', 'phones'), $data);
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {
        $validated = $request->validated();

        $this->employeeService->updateEmployeeWithPhones($employee, $validated);

        return redirect()->route('employees.edit', $employee);
    }

    public function destroy(Employee $employee)
    {
        $this->employeeService->delete($employee);

        return redirect()->route('employees.index');
    }
}
