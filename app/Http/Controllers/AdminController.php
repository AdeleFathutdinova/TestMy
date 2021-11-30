<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Result;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        return view('admin.test');
    }

    public function createTest(Request $request){
        $test = new Test;
        $test->test_title = $request->test_title;
        $test->test_description = $request->test_desc;
        $test->save();
        return view('admin.question',compact('test'));
    }

    public function addQuestion(Request $request, $id){
        if($request->question)
        {
            $question = new Question();
            $question->question_text=$request->question;
            $question->type=$request->type_qtn;
            $question->test_id = $id;
            $question->save();
            $qtn_type = $request->type_qtn;

            $all_answers = $request->answer;
            $correct_answers = $request->correct;
            foreach ($all_answers as $index => $answer) {
                $answers = new Answer();
                $answers->question_id = $question->id;
                $answers->answer_title = $answer;
                if ($qtn_type==0) {
                    foreach ($correct_answers as $correct_answer) {
                        if($correct_answer == $index+1) {
                            $answers->correct = 1;
                        }
                    }
                } elseif ($qtn_type==1) {
                    $answers->correct = 1;
                }
                $answers->save();
            }

        }
        $test = Test::find($id);
        return view('admin.question', compact('test'));
    }

    public function statistic(){
        $results = Result::orderBy('created_at', 'desc')->get();
        return view('admin.statistic',compact('results'));
    }
}
