@extends('layouts.base')

@section('title', 'Усі клієнти')

@section('main')
    <h2>Усі клієнти</h2>
    <a href="{{ route('user.create') }}">Створити клієнта</a>
    <br><br>
    <form method="GET" action="{{ route('user.index') }}">
        <label for="firstName">Фільтрувати за Ім'ям:</label>
        <input type="text" name="firstName" id="firstName" value="{{ request('firstName') }}">
        <label for="status">Фільтрувати за Статусом:</label>
        <select name="status" id="status">
            <option value="">Усі</option>
            <option value="Потенційний" {{ request('status') == 'Потенційний' ? 'selected' : '' }}>Потенційний</option>
            <option value="Активний" {{ request('status') == 'Активний' ? 'selected' : '' }}>Активний</option>
            <option value="Неактивний" {{ request('status') == 'Неактивний' ? 'selected' : '' }}>Неактивний</option>
            <option value="Втрачений" {{ request('status') == 'Втрачений' ? 'selected' : '' }}>Втрачений</option>
        </select>
        <button type="submit">Фільтрувати</button>
    </form>
    <br>
    @if ($context->isEmpty())
        <h3>Клієнтів не знайдено</h3>
    @else
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
                @foreach ($context as $user)
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
                        <a href="{{ route('user.show', ['user'=>$user->id]) }}">Детальніше</a>
                    </td>
                    <td>
                        <a href="{{ route('user.edit', ['user'=>$user->id]) }}">Змінити</a>
                    </td>
                    <td>
                        <form action="{{ route('user.destroy', ['user'=>$user->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Видалити">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <!-- pagination -->
        {{ $context->links() }}
    @endif
@endsection