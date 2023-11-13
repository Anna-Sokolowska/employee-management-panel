@extends('layouts.app')

@section('content')
    <a class="btn btn-primary mb-4" href="{{ route('employees.create') }}" role="button">{{ __('Add') }}</a>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('First Name') }}</th>
                <th scope="col">{{ __('Last Name') }}</th>
                <th scope="col">{{ __('Email') }}</th>
                <th scope="col">{{ __('Company') }}</th>
                <th scope="col">{{ __('Food Preference') }}</th>
                <th scope="col" class="w-20">{{ __('Phones') }}</th>
                <th scope="col" class="w-20"></th>
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
