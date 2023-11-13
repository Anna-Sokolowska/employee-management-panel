<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use App\Models\FoodPreference;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function index(Request $request, EmployeeService $employeeService): View
    {
        $sort['column'] = $request->query('sort') ?: 'id';
        $sort['direction'] = $request->query('direction') ?: 'asc';

        $employees = $employeeService->getPaginatedListingData($sort, 10);

        return view('employees.index', ['employees' => $employees]);
    }

    public function create(): View
    {
        $companies = Company::all();
        $foodPreferences = FoodPreference::all();

        return view('employees.create', ['companies' => $companies, 'foodPreferences' => $foodPreferences]);
    }

    public function store(StoreEmployeeRequest $request, EmployeeService $employeeService)
    {
        $validated = $request->validated();

        $employeeService->createEmployeeWithPhones($validated);

        return redirect()->route('employees.index');
    }

    public function show(Employee $employee)
    {
        //
    }

    public function edit(Employee $employee)
    {
        //
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        //
    }

    public function destroy(Employee $employee, EmployeeService $employeeService)
    {
        $employeeService->delete($employee);

        return redirect()->route('employees.index');
    }
}
