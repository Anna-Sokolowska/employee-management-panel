@extends('layouts.app')

@section('content')
    <form class="row g-3" method="POST" action="{{ route('employees.store') }}">
        @csrf
        <div class="col-md-6">
            <label for="inputFirstName" class="form-label">{{ __('First name') }}</label>
            <input type="text" class="form-control" id="inputFirstName" name="first_name" value="{{ old('first_name') }}">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="inputLastName" class="form-label">{{ __('Last name') }}</label>
            <input type="text" class="form-control" id="inputLastName" name="last_name" value="{{ old('last_name') }}">
        </div>
        <div class="col-12">
            <label for="inputEmail" class="form-label">{{ __('Email') }}</label>
            <input type="email" class="form-control" id="inputEmail" name="email" value="{{ old('email') }}">
        </div>
        <div class="col-12">
            <label for="inputCompany" class="form-label">{{ __('Company') }}</label>
            <select id="inputCompany" class="form-select" name="company_id">
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" @selected(old('company_id') == $company->id)>{{ $company->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12">
            <label for="inputFoodPreference" class="form-label">{{ __('Food preferences') }}</label>
            <select id="inputFoodPreference" class="form-select" name="food_preference_id">
                @foreach ($foodPreferences as $foodPreference)
                    <option value="{{ $foodPreference->id }}" @selected(old('food_preference_id') == $foodPreference->id)>{{ $foodPreference->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-12">
            <label for="inputPhone1" class="form-label">{{ __('Phones') }}</label>
            <input type="text" class="form-control" id="inputPhone1"  name="phones[]" value="{{ old('phones.0') }}">
        </div>
        <div class="col-md-12">
            <label for="inputPhone2" class="form-label">{{ __('Phones 2') }}</label>
            <input type="text" class="form-control" id="inputPhone2"  name="phones[]" value="{{ old('phones.0') }}">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">{{ __('Create employees') }}</button>
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
