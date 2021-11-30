<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Result;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAnswer;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showTests(){
        $tests = Test::all();
        return view('student.showTests', compact('tests'));
    }

    public function startTest($test_id){
        $questions = Question::where('test_id', $test_id)->get();
        $test = Test::find($test_id);
        return view('student.startTest', compact('questions', 'test'));
    }

    public function allResults(Request $request){
        $score = 0;
        $answers = $request->answer;

        if ($answers) {
            foreach ($answers as $key => $value) {
                $question = Question::find($key);
                $type_qtn = $question->type;
                $userCorrectAnswers = 0;
                
                foreach ($value as $answerKey => $answerValue) {
                    if ($type_qtn==0){
                        if ($answerValue == 1) {
                            $userCorrectAnswers++;
                        } else {
                            $userCorrectAnswers--;
                        }
                        
                    } elseif ($type_qtn==1) {
                        $rightAnswer = Answer::find($answerKey)->answer_title;
                        if (strcasecmp($rightAnswer, $answerValue) == 0) {
                            $score++;
                        }
                    }
                    
                }
                if (($question->correctOptionsCount() == $userCorrectAnswers)) {
                    $score++;
                }
                
            }
            $result = new Result();
            $result->user_id = Auth::user()->id;
            $result->test_id = $request->test_id;
            $result->correct_answers = $score;
            $result->questions_count = count($request->qtn_id);
            $result->save();

            foreach ($answers as $key => $value) {
                foreach ($value as $answerKey => $answerValue) {
                    $user_answer = new UserAnswer();
                    $user_answer->user_answer_title = $answerValue;
                    $user_answer->result_id = $result->id;
                    $user_answer->answer_id = $answerKey;
                    $user_answer->save();
                }
            }
        }

        return redirect(route('result', $result->id));
    }

    public function result($result_id){
        $result = Result::find($result_id);
        return view('student.showResult', compact('result'));
    }

    public function myResults($id){
        $results = Result::where('user_id', $id)->get();
        return view('student.myResults', compact('results'));
    }
}
