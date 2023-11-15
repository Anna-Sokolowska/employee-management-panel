@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end">
        <a class="btn btn-primary mb-4" href="{{ route('employees.create') }}" role="button">{{ __('Add') }}</a>
    </div>
    <div class="d-flex justify-content-end">
        <div class="dropdown mx-sm-4">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ __('Sort by') }}
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('employees.index', ['column' => 'first_name', 'direction'=> 'asc']) }}">{{ __('Sort by First Name (Ascending)') }}</a></li>
                <li><a class="dropdown-item" href="{{ route('employees.index', ['column' => 'first_name', 'direction'=> 'desc']) }}">{{ __('Sort by First Name (Descending)') }}</a></li>
                <li><a class="dropdown-item" href="{{ route('employees.index', ['column' => 'last_name', 'direction'=> 'asc']) }}">{{ __('Sort by Last Name (Ascending)') }}</a></li>
                <li><a class="dropdown-item" href="{{ route('employees.index', ['column' => 'last_name', 'direction'=> 'desc']) }}">{{ __('Sort by Last Name (Descending)') }}</a></li>
                <li><a class="dropdown-item" href="{{ route('employees.index', ['column' => 'email', 'direction'=> 'asc']) }}">{{ __('Sort by Email (Ascending)') }}</a></li>
                <li><a class="dropdown-item" href="{{ route('employees.index', ['column' => 'email', 'direction'=> 'desc']) }}">{{ __('Sort by Email (Descending)') }}</a></li>
            </ul>
        </div>
        <div>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>

    <div class="table-responsive-xxl">
        <table class="table">
            <thead>
            <tr>
                <th scope="col" class="col">#</th>
                <th scope="col" class="col-1">{{ __('First Name') }}</th>
                <th scope="col" class="col-1">{{ __('Last Name') }}</th>
                <th scope="col" class="col-2">{{ __('Email') }}</th>
                <th scope="col" class="col-2">{{ __('Company') }}</th>
                <th scope="col" class="col-2">{{ __('Food Preference') }}</th>
                <th scope="col" class="col-2">{{ __('Phones') }}</th>
                <th scope="col" class="col-2"></th>
            </tr>
            </thead>

            <tbody class="table-group-divider">
            @foreach($employees as $employee)
                <tr>
                    <th scope="row">{{ $employees->firstItem()+($loop->index) }}</th>
                    <td>{{ $employee->first_name }}</td>
                    <td>{{ $employee->last_name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->company->name }}</td>
                    <td>{{ $employee->foodPreference->name }}</td>
                    <td>{{ $employee->phones->pluck('phone_number')->implode(', ') }}</td>
                    <td>
                        <div class="row g-3">
                            <div class="col">
                                <a class="btn btn-primary" href="{{ route('employees.edit', $employee) }}" role="button">{{ __('Edit') }}</a>
                            </div>
                            <form class="col" method="POST" action="{{ route('employees.destroy', $employee) }}">
                                @csrf
                                @method('DELETE')
                                <div class="form-group">
                                    <input type="submit" class="btn btn-danger" value="{{ __('Delete') }}">
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $employees->links() }}
    </div>
@endsection
