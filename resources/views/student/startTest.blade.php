@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{$test->test_title}}</h2>
        <form action="{{route('allResults')}}" method="post">
            @csrf
            <input type="hidden" name="test_id" value="{{$test->id}}">
            @foreach ( $questions as $key => $question )
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <input type="hidden" name="qtn_id[]" value="{{$question->id}}">
                            <input type="hidden" name="qtn_type[]" value="{{$question->type}}">
                            <th>{{$key+1}}. {{ $question->question_text }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                @foreach($question->answers as $answer)
                                    @if (($question->type)==0)
                                        <div class="custom-control custom-radio">
                                            <input type="checkbox" class="custom-control-input" id="{{$answer->id}}" name="answer[{{$question->id}}][{{$answer->id}}]" value="{{$answer->correct}}">
                                            <label class="custom-control-label" for="{{$answer->id}}">{{$answer->answer_title}}</label>
                                        </div>
                                    @elseif (($question->type)==1)
                                        <div>
                                            <input name="answer[{{$question->id}}][{{$answer->id}}]" type="text" class="form-control col-md-10 answ" required>
                                        </div>
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    <tbody>
                </table>
            @endforeach
            <a href="{{route('result', $test->id)}}"><input type="submit" class="btn btn-primary"></a>
        </form>
</div>
@endsection