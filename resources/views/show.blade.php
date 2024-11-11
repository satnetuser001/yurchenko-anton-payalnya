@extends('layouts.base')

@section('title', 'Детальна інформація')

@section('main')
    <h2>Детальна інформація</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Ім'я</th>
                <th>Прізвище</th>
                <th>Email</th>
                <th>Телефон</th>
                <th>Статус</th>
                <th>Місто</th>
                <th>Дата реєстрації</th>
                <th colspan="3">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->firstName}}</td>
                <td>{{$user->lastName}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->phone_number}}</td>
                <td>{{$user->status}}</td>
                <td>{{$user->city}}</td>
                <td>{{$user->created_at}}</td>
                <td>
                    <a href="{{ route('user.edit', ['user'=>$user->id]) }}">Изменить</a>
                </td>
                <td>
                    <form action="{{ route('user.destroy', ['user'=>$user->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Видалити">
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
    <a href="{{ route('home') }}">Усі клієнти</a>
@endsection