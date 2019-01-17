<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Barangay;
use App\Program;
use Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();
        $programs = Program::where('barangay_id', Auth::user()->barangay_id)->get();
        return view('admin.questions.index', compact('questions','programs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programs = Program::where('barangay_id', Auth::user()->barangay_id)->get();
        return view('admin.questions.create', compact('barangays', 'programs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'question'  => 'required',
        ]);

        $question = new Question;
        $question->name = $request->question;
        $question->icd_code = $request->icd_code;
        $question->save();
        return redirect('/admin/questions')->with('message', 'Successfully Added New Question');
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
        $programs = Program::where('barangay_id', Auth::user()->barangay_id)->get();
        $current_question = Question::find($id);
        return view('admin.questions.edit', compact('id', 'programs', 'current_question'));
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
        $this->validate($request, [
            'question'  => 'required',
        ]);

        $current_question = Question::find($id);
        $current_question->name = $request->question;
        $current_question->icd_code = $request->icd_code;
        $current_question->save();
        return redirect('/admin/questions')->with('message', 'Successfully Updated Question');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }
}
