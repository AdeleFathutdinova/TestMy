@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Создание нового теста</h2>
    <form action="{{route('createTest')}}" method="post">
        @csrf
        <div class="col-md-9 ">
            <div>
                <label>Название теста</label>
                <input type="text" name="test_title" class="form-control" required>
            </div>
            <div>
                <label>Описание теста</label>
                <textarea type="text" name="test_desc" class="form-control" required></textarea>
            </div>
        </div>
        <button class="btn btn-primary btn-lg mt-3" type="submit">Создать тест</button>
    </form>
</div>
@endsection