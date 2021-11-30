@extends('layouts.app')

@section('content')
    <div class="container">
        @if(count($results) <= 0)
            <h2>Для того, чтобы посмотреть результат необходимо пройти хотя бы одно тестирование.</h2>
        @else
            @foreach($results as $result)
                <h2>{{$result->test->test_title}} {{$result->created_at}}</h2>
                <table class="table table-bordered">
                    @foreach($result->test->questions as $key => $question)
                        <thead class="thead-light">
                            <tr>
                                <th>{{$key+1}}. {{ $question->question_text}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <ul>
                                        @foreach($question->answers as $answer)
                                            @if ($question->type==0)
                                                @if($answer->correct == 1)
                                                    <li>{{$answer->answer_title}}
                                                        <em>(верный ответ)</em>
                                                        @foreach($result->userAnswers as $user_answer)
                                                            @if($user_answer->answer_id == $answer->id)
                                                                <em>(выбранный ответ)</em>
                                                            @endif
                                                        @endforeach
                                                    </li>
                                                @else
                                                    <li>
                                                        {{$answer->answer_title}}
                                                        @foreach($result->userAnswers as $user_answer)
                                                            @if($user_answer->answer_id == $answer->id)
                                                                <em>(выбранный ответ)</em>
                                                            @endif
                                                        @endforeach
                                                    </li>
                                                @endif
                                            @elseif ($question->type==1)
                                                <div>{{$answer->answer_title}}
                                                    <em>(верный ответ)</em>
                                                    @foreach($result->userAnswers as $user_answer)
                                                        @if($user_answer->answer_id == $answer->id)
                                                            @if (strcasecmp($user_answer->user_answer_title, $answer->answer_title) == 0)
                                                                <em>(введенный ответ)</em> 
                                                </div>
                                                            @else
                                                                <div>
                                                                    {{$user_answer->user_answer_title}}
                                                                    <em>(введенный ответ)</em>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                            @endif
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        <tbody>
                    @endforeach
                    <caption>Счет: {{$result->correct_answers}}/{{$result->questions_count}}</caption>
                </table>
            @endforeach
        @endif
    </div>
@endsection