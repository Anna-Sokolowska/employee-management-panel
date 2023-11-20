@extends('layouts.app')
@section('title')
    Create Employee
@endsection
@section('content')
    <form class="row g-3 needs-validation" method="POST" action="{{ route('employees.store') }}" novalidate>
        @csrf
        <div class="col-md-6">
            <label for="inputFirstName" class="form-label">{{ __('First name') }}</label>
            <input type="text" class="form-control" id="inputFirstName" name="first_name" value="{{ old('first_name') }}" required>
        </div>
        <div class="col-md-6">
            <label for="inputLastName" class="form-label">{{ __('Last name') }}</label>
            <input type="text" class="form-control" id="inputLastName" name="last_name" value="{{ old('last_name') }}" required>
        </div>
        <div class="col-12">
            <label for="inputEmail" class="form-label">{{ __('Email') }}</label>
            <input type="email" class="form-control" id="inputEmail" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="col-12">
            <label for="inputCompany" class="form-label">{{ __('Company') }}</label>
            <select id="inputCompany" class="form-select" name="company_id" required>
                <option disabled selected value="">{{ __('Select company') }}</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" @selected(old('company_id') == $company->id)>{{ $company->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12">
            <label for="inputFoodPreference" class="form-label">{{ __('Food preferences') }}</label>
            <select id="inputFoodPreference" class="form-select" name="food_preference_id" required>
                <option disabled selected value="">{{ __('Select food preference') }}</option>
                @foreach ($foodPreferences as $foodPreference)
                    <option value="{{ $foodPreference->id }}" @selected(old('food_preference_id') == $foodPreference->id)>{{ $foodPreference->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-12">
            <label for="inputPhone1" class="form-label">{{ __('Phones') }}</label>
            <input type="text" class="form-control" id="inputPhone1"  name="phoneNumbers[]" value="{{ old('phoneNumbers.0') }}">
        </div>
        <div class="col-md-12">
            <label for="inputPhone2" class="form-label">{{ __('Phones 2') }}</label>
            <input type="text" class="form-control" id="inputPhone2"  name="phoneNumbers[]" value="{{ old('phoneNumbers.1') }}">
        </div>
        <div class="col-12 d-flex justify-content-end gap-2">
            <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>
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
