@extends('layouts.base')

@section('title', 'Редагувати клієнта')

@section('main')
    <h2>Редагувати клієнта</h2>

    <form action="{{ route('user.update', ['user'=>$user->id]) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label><b>Ім'я</b></label>
        <input name="firstName" value="{{ old('firstName', $user->firstName) }}">
        <div>
            @error('firstName')
                <span><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        
        <label><b>Прізвище</b></label>
        <input name="lastName" value="{{ old('lastName', $user->lastName) }}">
        <div>
            @error('lastName')
                <span><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        
        <label><b>Email</b></label>
        <input name="email" value="{{ old('email', $user->email) }}">
        <div>
            @error('email')
                <span><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        
        <label><b>Телефон</b></label>
        <input name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
        <div>
            @error('phone_number')
                <span><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        
        <label><b>Статус</b></label>
        <input name="status" value="{{ old('status', $user->status) }}">
        <div>
            @error('status')
                <span><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        
        <label><b>Місто</b></label>
        <input name="city" value="{{ old('city', $user->city) }}">
        <div>
            @error('city')
                <span><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        
        <input type="submit" value="Зберегти">
    </form>
    <a href="{{ route('user.index') }}">Скасувати</a>
@endsection