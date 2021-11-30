@extends('layouts.app')

@section('content')
<div align="center">
    <h2 class="mb-3">Добавить вопрос в тест "{{$test->test_title}}"</h2>
    <form action="/admin/create/test/{{$test->id}}" method="post" class="col-md-7">
        @csrf
        <div class="col-12 mb-3">
            <label class="form-label">Тип задания</label>
            <select name="type_qtn" class="form-control select_qtn">
                <option value="0" selected>Выбор ответа</option>
                <option value="1">Ввод ответа</option>
            </select>
        </div>
        <div class="col-12 mb-3">
            <label class="form-label">Введите вопрос</label>
            <input type="text" class="form-control" name="question" required>
        </div>
        <div class="col-12 mb-3 dynamic">
            <label class="form-label">Варианты ответов</label>
            <div class="form-row answers">
                <input name="answer[]" type="text" class="form-control col-11 answ" required>
                <input name="correct[]" type="checkbox" value="1" class="form-control col-1 correct" checked>
                <input name="answer[]" type="text" class="form-control col-11 answ" required>
                <input name="correct[]" type="checkbox" value="2" class="form-control col-1 correct">
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-success btn-lg add_answ mb-3" type="submit">Добавить ответ</button>
            <button class="btn btn-danger btn-lg del_answ mb-3" type="submit">Удалить ответ</button>
            <div><input class="btn btn-primary btn-lg mb-3" type="submit" value="Добавить вопрос"></div>
            
        </div>
    </form>
</div>
@endsection
@section('script')
    <script>
    $(document).ready(function () {

        $('.select_qtn').change(function () {
            $('.answ').remove();
            $('.correct').remove();

            var question = $(".select_qtn option:selected").val();
            if(question == 0){
                $('.add_answ').show();
                $('.del_answ').show();
                
                $('<input name="answer[]" type="text" class="form-control col-11 answ" required>').appendTo($('.answers'));
                $('<input name="correct[]" type="checkbox" value="1" class="form-control col-1 correct" checked>').appendTo($('.answers'));
                $('<input name="answer[]" type="text" class="form-control col-11 answ" required>').appendTo($('.answers'));
                $('<input name="correct[]" type="checkbox" value="2" class="form-control col-1 correct">').appendTo($('.answers'));
            }
            else if(question == 1){
                $('.add_answ').hide();
                $('.del_answ').hide();
                
                $('<input name="answer[]" type="text" class="form-control col-11 answ" required>').appendTo($('.answers'));
                $('<input name="correct[]" type="checkbox" value="1" class="form-control col-1 correct" checked disabled>').appendTo($('.answers'));
            }
        });

        $(".add_answ").click(function(){
            var correct_btn = $('input[type="checkbox"]:last');
            var value = correct_btn.attr("value");
            var num = parseInt(value.replace(" "));
            
            $(".dynamic").append('' +
                '<div class="form-row">' +
                    '<input name="answer[]" type="text" class="form-control col-11 answ" required>' +
                    '<input name="correct[]" type="checkbox" value="' +(num+1)+ '" class="form-control col-1 correct">' +
                '</div>');
        });

        $(".del_answ").click(function(e){
            var correct_btn = $('input[type="checkbox"]:last');
            var value = correct_btn.attr("value");
            var qty = parseInt(value.replace(" "));
            e.preventDefault();
            if (qty > 2) {
                $('input[type="text"]:last').remove();
                $('input[type="checkbox"]:last').remove();
            } else {
                alert('Не может быть меньше двух вариантов ответа.');
            }
        });

        var submitButt = $("input[type='submit']");
        submitButt.click(function(e) {
            var checkboxes = $(".correct");
            if (!checkboxes.is(":checked")) {
                e.preventDefault();
                alert('Отметьте хотя бы 1 правильный ответ.');
            }
        });

        
    });
    </script>
@endsection