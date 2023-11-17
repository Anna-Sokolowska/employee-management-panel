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
                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['column' => 'first_name', 'direction'=> 'asc', 'page' => 1]) }}">{{ __('Sort by First Name (Ascending)') }}</a></li>
                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['column' => 'first_name', 'direction'=> 'desc', 'page' => 1]) }}">{{ __('Sort by First Name (Descending)') }}</a></li>
                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['column' => 'last_name', 'direction'=> 'asc', 'page' => 1]) }}">{{ __('Sort by Last Name (Ascending)') }}</a></li>
                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['column' => 'last_name', 'direction'=> 'desc', 'page' => 1]) }}">{{ __('Sort by Last Name (Descending)') }}</a></li>
                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['column' => 'email', 'direction'=> 'asc', 'page' => 1]) }}">{{ __('Sort by Email (Ascending)') }}</a></li>
                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['column' => 'email', 'direction'=> 'desc', 'page' => 1]) }}">{{ __('Sort by Email (Descending)') }}</a></li>
            </ul>
        </div>
        <div>
            <form class="d-flex" role="search" method="GET" action="{{ url()->full() }}">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>

    <p class="d-inline-flex gap-1">
        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            Link with href
        </a>
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Button with data-bs-target
        </button>
    </p>
    <div class="collapse position-absolute z-3" id="collapseExample">
        <div class="card card-body">
            <form method="POST" action="{{ route('employees.filter') }}">
                @csrf
                @foreach($companies as $company)
                    <div class="input-group">
                        <div class="input-group-text">
                            <input class="form-check-input mt-0" type="checkbox" value="{{ $company->id }}" aria-label="" name="companies[]">
                        </div>
                        <input type="text" class="form-control" aria-label="Text input with checkbox" value="{{ $company->name }}" disabled>
                    </div>
                @endforeach
                <button class="btn btn-outline-success" type="submit">Search</button>

            </form>
        </div>
    </div>
    <div class="row">
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
    </div>
@endsection
