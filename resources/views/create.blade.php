@extends('layouts.base')

@section('title', 'Редагувати клієнта')

@section('main')
    <h2>Редагувати клієнта</h2>

    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        
        <label><b>Ім'я</b></label>
        <input name="firstName" value="{{ old('firstName') }}">
        <div>
            @error('firstName')
                <span><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        
        <label><b>Прізвище</b></label>
        <input name="lastName" value="{{ old('lastName') }}">
        <div>
            @error('lastName')
                <span><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        
        <label><b>Email</b></label>
        <input name="email" value="{{ old('email') }}">
        <div>
            @error('email')
                <span><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <label><b>Пароль</b></label>
        <input name="password" value="{{ old('password') }}">
        <div>
            @error('password')
                <span><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        
        <label><b>Телефон</b></label>
        <input name="phone_number" value="{{ old('phone_number') }}">
        <div>
            @error('phone_number')
                <span><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        
        <label><b>Статус</b></label>
        <select name="status">
            <option value="Потенційний" @if(old('status') == 'Потенційний') selected @endif>Потенційний</option>
            <option value="Активний" @if(old('status') == 'Активний') selected @endif>Активний</option>
            <option value="Неактивний" @if(old('status') == 'Неактивний') selected @endif>Неактивний</option>
            <option value="Втрачений" @if(old('status') == 'Втрачений') selected @endif>Втрачений</option>
        </select>
        <div>
            @error('status')
                <span><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        
        <label><b>Місто</b></label>
        <input name="city" value="{{ old('city') }}">
        <div>
            @error('city')
                <span><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        
        <input type="submit" value="Зберегти">
    </form>
    <a href="{{ route('user.index') }}">Скасувати</a>
@endsection