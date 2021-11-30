@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-bordered table-striped">
            <tr>
                <th>Пользователь</th>
                <td>{{$result->user->name}} ({{$result->user->email}})</td>
            </tr>
            <tr>
                <th>Тест</th>
                <td>{{$result->test->test_title}}</td>
            </tr>
            <tr>
                <th>Дата</th>
                <td>{{$result->created_at}}</td>
            </tr>
            <tr>
                <th>Счет</th>
                <td>{{$result->correct_answers}}/{{$result->questions_count}}</td>
            </tr>
        </table>
        <table class="table table-bordered ">
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
        </table>
    </div>
@endsection
