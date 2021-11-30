@extends('layouts.app')

@section('content')
    <div class="container">
        @if(count($results) <= 0)
            <h2>На данный момент ни один пользователь еще не прошел тестирование.</h2>
        @else
            <h2>Все результаты </h2>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th>Пользователь</th>
                        <th>Название теста</th>
                        <th>Дата</th>
                        <th>Счет</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($results as $result)
                    <tr>
                        <td>{{$result->user->name}} ({{$result->user->email}})</td>
                        <td>{{$result->test->test_title}}</td>
                        <td>{{$result->created_at}}</td>
                        <td>{{$result->correct_answers}}/{{$result->questions_count}}</td>
                        <td>
                            <a href="{{route('result', $result->id)}}" class="btn btn-primary">Посмотреть</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>            
        @endif
    </div>
@endsection