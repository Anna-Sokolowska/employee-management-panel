@extends('layouts.app')

@section('content')
    <form class="row g-3" method="POST" action="{{ route('employees.update', $employee) }}">
        @csrf
        @method('PUT')
        <div class="col-md-6">
            <label for="inputFirstName" class="form-label">{{ __('First name') }}</label>
            <input type="text" class="form-control" id="inputFirstName" name="first_name" value="{{ old('first_name', $employee->first_name) }}">
        </div>
        <div class="col-md-6">
            <label for="inputLastName" class="form-label">{{ __('Last name') }}</label>
            <input type="text" class="form-control" id="inputLastName" name="last_name" value="{{ old('last_name', $employee->last_name) }}">
        </div>
        <div class="col-12">
            <label for="inputEmail" class="form-label">{{ __('Email') }}</label>
            <input type="email" class="form-control" id="inputEmail" name="email" value="{{ old('email', $employee->email) }}">
        </div>
        <div class="col-12">
            <label for="inputCompany" class="form-label">{{ __('Company') }}</label>
            <select id="inputCompany" class="form-select" name="company_id">
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" @selected(old('company_id', $employee->company_id) == $company->id)>{{ $company->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12">
            <label for="inputFoodPreference" class="form-label">{{ __('Food preferences') }}</label>
            <select id="inputFoodPreference" class="form-select" name="food_preference_id">
                @foreach ($foodPreferences as $foodPreference)
                    <option value="{{ $foodPreference->id }}" @selected(old('food_preference_id', $employee->food_preference_id) == $foodPreference->id)>{{ $foodPreference->name }}</option>
                @endforeach
            </select>
        </div>
        @foreach($employee->phones as $phone)
            <div>
                <label for="inputPhone1" class="form-label">{{ __('Phones') }}</label>
                <input type="text" class="form-control" id="inputPhone1"  name="phones[]" value="{{ old('phones.'.$loop->index, $phone->phone_number) }}">
            </div>
        @endforeach
        <div class="col-12">
            <button type="submit" class="btn btn-primary">{{ __('Edit') }}</button>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>
@endsection
