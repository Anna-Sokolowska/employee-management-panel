@extends('layouts.app')

@section('content')
    <a class="btn btn-primary mb-4" href="{{ route('employees.create') }}" role="button">{{ __('Add') }}</a>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ __('Sort by') }}
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('employees.index', ['sort' => 'first_name', 'direction'=> 'asc']) }}">{{ __('Sort by First Name (Ascending)') }}</a></li>
            <li><a class="dropdown-item" href="{{ route('employees.index', ['sort' => 'first_name', 'direction'=> 'desc']) }}">{{ __('Sort by First Name (Descending)') }}</a></li>
            <li><a class="dropdown-item" href="{{ route('employees.index', ['sort' => 'last_name', 'direction'=> 'asc']) }}">{{ __('Sort by Last Name (Ascending)') }}</a></li>
            <li><a class="dropdown-item" href="{{ route('employees.index', ['sort' => 'last_name', 'direction'=> 'desc']) }}">{{ __('Sort by Last Name (Descending)') }}</a></li>
            <li><a class="dropdown-item" href="{{ route('employees.index', ['sort' => 'email', 'direction'=> 'asc']) }}">{{ __('Sort by Email (Ascending)') }}</a></li>
            <li><a class="dropdown-item" href="{{ route('employees.index', ['sort' => 'email', 'direction'=> 'desc']) }}">{{ __('Sort by Email (Descending)') }}</a></li>
        </ul>
    </div>

    <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    <div class="table-responsive-xxl">
        <table class="table">
            <thead>
            <tr>
                <th scope="col" class="w-5">#</th>
                <th scope="col" class="w-10">{{ __('First Name') }}</th>
                <th scope="col" class="w-10">{{ __('Last Name') }}</th>
                <th scope="col" class="w-10">{{ __('Email') }}</th>
                <th scope="col" class="w-10">{{ __('Company') }}</th>
                <th scope="col" class="w-15">{{ __('Food Preference') }}</th>
                <th scope="col" class="w-20">{{ __('Phones') }}</th>
                <th scope="col" class="w-10"></th>
            </tr>
            </thead>

            <tbody class="table-group-divider">
            @foreach($employees as $employee)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $employee->first_name }}</td>
                    <td>{{ $employee->last_name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->company->name }}</td>
                    <td>{{ $employee->foodPreference->name }}</td>
                    <td>{{ $employee->phones->pluck('phone_number')->implode(', ') }}</td>
                    <td>
                        <form method="POST" action="{{ route('employees.destroy', $employee) }}">
                            @csrf
                            @method('DELETE')
                            <div class="form-group">
                                <input type="submit" class="btn btn-danger" value="{{ __('Delete') }}">
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $employees->links() }}
    </div>
@endsection
