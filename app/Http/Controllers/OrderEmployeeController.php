<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderEmployeeController extends Controller
{
    public function filter(Request $request):RedirectResponse
    {
        $filterCompaniesId = $request->post('companies');

        $cookie = cookie('filterCompaniesId', json_encode($filterCompaniesId), 20);

        return redirect()->route('employees.index')->cookie($cookie);
    }
}
