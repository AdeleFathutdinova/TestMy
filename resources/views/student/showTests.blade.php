@extends('layouts.app')

@section('content')
    <div class="container">
        @if(count($tests) <= 0)
            <h2>Для начала администратор должен создать тест.</h2>
        @else
            <h2>Все тесты</h2>
            <table class="table" >
                <thead class="thead-light">
                    <tr>
                        <th>Название</th>
                        <th>Описание</th>
                        <th>Дата создания</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($tests as $test)
                    <tr>
                        <td>{{$test->test_title}}</td>
                        <td>{{$test->test_description}}</td>
                        <td>{{$test->created_at}}</td>
                        <td>
                            <a href="{{route('startTest', $test->id)}}" class="btn btn-primary " value="{{$test->id}}">Пройти</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection