<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;
use Auth;
use App\ProgramQuestion;
use App\Answer;
use App\Question;

class ProgramAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = Program::where('barangay_id', Auth::user()->barangay_id)->get();
        $program_answers = Answer::with(['program_question'])->get();
        return view('admin.programanswer.index',compact('programs', 'program_answers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programs = Program::where('barangay_id', Auth::user()->barangay_id)->get();
        $program_questions = ProgramQuestion::with(['program','question'])->orderBy('priority', 'ASC')->get();
        return view('admin.programanswer.create', compact('programs','program_questions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $program = ProgramQuestion::with('program')->find($request->program_question)->first();
        if($program->program->header_type == 'date'){
            $program_answer = Answer::whereYear('created_at', date('Y', strtotime($request->created_at)))
                                  ->whereMonth('created_at', date('m', strtotime($request->created_at)))
                                  ->where('program_question_id', $request->program_question)
                                  ->count();
            if($program_answer > 0){
                return redirect()->back()->with('msg', 'The program answer already exists in database');
            }
        }elseif($program->program->header_type == 'quarterly'){
            $program_answer = Answer::whereYear('created_at', date('Y', strtotime($request->created_at)))
                                    ->where('quarter', $request->quarter)
                                    ->where('program_question_id', $request->program_question)
                                    ->count();
            if($program_answer > 0){
                return redirect()->back()->with('msg', 'The program answer already exists in database');
            }
        }elseif($program->program->header_type == 'age_monthly'){
            $program_answer = Answer::whereYear('created_at', date('Y', strtotime($request->created_at)))
                                    ->whereMonth('created_at', date('m', strtotime($request->created_at)))
                                    ->where('program_question', $request->program_question)
                                    ->count();
            if($program_answer > 0){
                return redirect()->back()->with('msg', 'The program answer already exists in database');
            }
        }


        $answer = new Answer;
        $answer->program_question_id = $request->program_question;
        if(array_key_exists('m', $request->all())){
            $answer->m = $request->m;
        }
        if(array_key_exists('f', $request->all())){
            $answer->f = $request->f;
        }
        if(array_key_exists('t', $request->all())){
            $answer->t = $request->t;
        }
        if(array_key_exists('target', $request->all())){
            $answer->target = $request->target;
        }
        if(array_key_exists('quarter', $request->all())){
            $answer->quarter = $request->quarter;
        }
        if(array_key_exists('age_range', $request->all())){
            $answer->age_range = $request->age_range;
        }
        if(array_key_exists('general_answer', $request->all())){
            $answer->general_answer = $request->general_answer;
        }
        if(array_key_exists('created_at', $request->all())){
            $answer->created_at = $request->created_at;
        }
        $answer->save();

        return redirect('/admin/program-answers')->with('message', 'Successfully Added New Program Answer');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $answer = Answer::find($id);
        $answer->delete();

        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }
}
