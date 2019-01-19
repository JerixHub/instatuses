<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;
use App\Question;
use App\ProgramQuestion;
use Auth;

class ProgramQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = Program::where('barangay_id', Auth::user()->barangay_id)->get();
        $program_questions = ProgramQuestion::with(['program', 'question'])->orderBy('created_at', 'desc')->get();
        return view('admin.programquestion.index', compact('programs', 'program_questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programs = Program::where('barangay_id', Auth::user()->barangay_id)->get();
        $program_answers = Program::all();
        $program_questions = Question::all();
        return view('admin.programquestion.create', compact('programs', 'program_answers','program_questions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $selected_program = Program::find($request->program);
        if($selected_program->header_type == 'date'){
            $program_questions = ProgramQuestion::whereYear('created_at', date('Y', strtotime($request->created_at)))
                                                ->whereMonth('created_at', date('m', strtotime($request->created_at)))
                                                ->where('program_id',$request->program)
                                                ->where('question_id', $request->question)
                                                ->get();

            if(count($program_questions) > 0){
                return redirect()->back()->with('msg', 'The program answer already exists in database, check the selected date if it already exists');
            }
        }elseif($selected_program->header_type == 'quarterly'){
            $program_questions = ProgramQuestion::whereYear('created_at', date('Y', strtotime($request->created_at)))
                                                ->where('program_id',$request->program)
                                                ->where('question_id', $request->question)
                                                ->get();

            if(count($program_questions) > 0){
                return redirect()->back()->with('msg', 'The program answer already exists in database, check the selected date if it already exists');
            }
        }elseif($selected_program->header_type == 'age_monthly'){
            $program_questions = ProgramQuestion::whereYear('created_at', date('Y', strtotime($request->created_at)))
                                                ->whereMonth('created_at', date('m', strtotime($request->created_at)))
                                                ->where('program_id',$request->program)
                                                ->where('question_id', $request->question)
                                                ->get();

            if(count($program_questions) > 0){
                return redirect()->back()->with('msg', 'The program answer already exists in database, check the selected date if it already exists');
            }
        }

        $program_answer = new ProgramQuestion;
        $program_answer->program_id = $request->program;
        $program_answer->question_id = $request->question;
        $program_answer->created_at = $request->created_at;
        if(array_key_exists('m', $request->all())){
            $program_answer->m = $request->m;
        }
        if(array_key_exists('f', $request->all())){
            $program_answer->f = $request->f;
        }
        if(array_key_exists('t', $request->all())){
            $program_answer->t = $request->t;
        }
        if(array_key_exists('target', $request->all())){
            $program_answer->target = $request->target;
        }
        if(array_key_exists('first_q', $request->all())){
            $program_answer->first_q = $request->first_q;
        }
        if(array_key_exists('second_q', $request->all())){
            $program_answer->second_q = $request->second_q;
        }
        if(array_key_exists('third_q', $request->all())){
            $program_answer->third_q = $request->third_q;
        }
        if(array_key_exists('fourth_q', $request->all())){
            $program_answer->fourth_q = $request->fourth_q;
        }
        $program_answer->save();

        return redirect('/admin/program-questions')->with('message', 'Successfully Added New Program Answer');
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
        $program_answers = Program::all();
        $program_questions = Question::all();
        return view('admin.programquestion.edit', compact('programs', 'program_answers','program_questions'));
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
        $program_question = ProgramQuestion::find($id);
        $program_question->delete();

        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }

    public function getSelectedProgram($id)
    {
        $program = Program::find($id);
        $forms = $this->getForms($program);
        return response()->json([
            'data' => $forms
        ]);
    }

    public function getForms($program)
    {
        $html = '<div class="additional-forms">';
        if($program->header_type == 'date'){
            $html .= '<div class="row">
                            <label class="col-sm-2 col-form-label">Selected Date</label>
                            <div class="col-sm-10">
                                <div class="form-group bmd-form-group">
                                    <input type="text" class="form-control datetimepicker" name="created_at">
                                    <span class="bmd-help">Select the date you want this answer to be set</span>
                                </div>
                            </div>
                        </div>';
            if($program->with_gender){
                $html .= '<div class="row">
                            <label class="col-sm-2 col-form-label">Male/s</label>
                            <div class="col-sm-10">
                                <div class="form-group bmd-form-group">
                                    <input type="number" class="form-control" name="m" min="0" value="0">
                                    <span class="bmd-help">Required to have atleast 0 value</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Female/s</label>
                            <div class="col-sm-10">
                                <div class="form-group bmd-form-group">
                                    <input type="number" class="form-control" name="f" min="0" value="0">
                                    <span class="bmd-help">Required to have atleast 0 value</span>
                                </div>
                            </div>
                        </div>';
                if($program->with_trans){
                    $html .= '<div class="row">
                                <label class="col-sm-2 col-form-label">Transgender/s</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="number" class="form-control" name="t" min="0" value="0">
                                        <span class="bmd-help">Required to have atleast 0 value</span>
                                    </div>
                                </div>
                            </div>';
                }
            }else{
                $html .= '<div class="row">
                            <label class="col-sm-2 col-form-label">Answer</label>
                            <div class="col-sm-10">
                                <div class="form-group bmd-form-group">
                                    <input type="number" class="form-control" name="general_answer" min="0" value="0">
                                    <span class="bmd-help">Required to have atleast 0 value</span>
                                </div>
                            </div>
                        </div>';
            }

            if($program->with_target){
                $html .= '<div class="row">
                            <label class="col-sm-2 col-form-label">Target</label>
                            <div class="col-sm-10">
                                <div class="form-group bmd-form-group">
                                    <input type="number" class="form-control" name="target" min="0" value="0">
                                    <span class="bmd-help">Required to have atleast 0 value</span>
                                </div>
                            </div>
                        </div>';
            }
        }elseif($program->header_type == 'quarterly'){
            $html .= '<div class="row">
                            <label class="col-sm-2 col-form-label">Selected Date</label>
                            <div class="col-sm-10">
                                <div class="form-group bmd-form-group">
                                    <input type="text" class="form-control datetimepicker" name="created_at">
                                    <span class="bmd-help">Select the date you want this answer to be set</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Quarter</label>
                            <div class="col-sm-10">
                                <div class="form-group bmd-form-group">
                                <select class="form-control selectpicker" title="Choose Quarter" data-style="btn btn-link" name="quarter">
                                    <option value="first">First Quarter</option>
                                    <option value="second">Second Quarter</option>
                                    <option value="third">Third Quarter</option>
                                    <option value="fourth">Fourth Quarter</option>
                                </select>
                                </div>
                            </div>
                        </div>';
            if($program->with_gender){
                $html .= '<div class="row">
                            <label class="col-sm-2 col-form-label">Male/s</label>
                            <div class="col-sm-10">
                                <div class="form-group bmd-form-group">
                                    <input type="number" class="form-control" name="m" min="0" value="0">
                                    <span class="bmd-help">Required to have atleast 0 value</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Female/s</label>
                            <div class="col-sm-10">
                                <div class="form-group bmd-form-group">
                                    <input type="number" class="form-control" name="f" min="0" value="0">
                                    <span class="bmd-help">Required to have atleast 0 value</span>
                                </div>
                            </div>
                        </div>';
                if($program->with_trans){
                    $html .= '<div class="row">
                                <label class="col-sm-2 col-form-label">Transgender/s</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="number" class="form-control" name="t" min="0" value="0">
                                        <span class="bmd-help">Required to have atleast 0 value</span>
                                    </div>
                                </div>
                            </div>';
                }
            }else{
                $html .= '<div class="row">
                            <label class="col-sm-2 col-form-label">Answer</label>
                            <div class="col-sm-10">
                                <div class="form-group bmd-form-group">
                                    <input type="number" class="form-control" name="general_answer" min="0" value="0">
                                    <span class="bmd-help">Required to have atleast 0 value</span>
                                </div>
                            </div>
                        </div>';
            }
            if($program->with_target){
                $html .= '<div class="row">
                            <label class="col-sm-2 col-form-label">Target</label>
                            <div class="col-sm-10">
                                <div class="form-group bmd-form-group">
                                    <input type="number" class="form-control" name="target" min="0" value="0">
                                    <span class="bmd-help">Required to have atleast 0 value</span>
                                </div>
                            </div>
                        </div>';
            }
        }elseif($program->header_type == 'age_monthly'){
            $html .= '<div class="row">
                            <label class="col-sm-2 col-form-label">Selected Date</label>
                            <div class="col-sm-10">
                                <div class="form-group bmd-form-group">
                                    <input type="text" class="form-control datetimepicker" name="created_at">
                                    <span class="bmd-help">Select the date you want this answer to be set</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Quarter</label>
                            <div class="col-sm-10">
                                <div class="form-group bmd-form-group">
                                <select class="form-control selectpicker" title="Choose Age Range" data-style="btn btn-link" name="age_range">
                                    <option value="under_one">Under 1</option>
                                    <option value="one_four">1-4</option>
                                    <option value="five_nine">5-9</option>
                                    <option value="ten_fourteen">10-14</option>
                                    <option value="fifteen_nineteen">15-19</option>
                                    <option value="twenty_twentyfour">20-24</option>
                                    <option value="twentyfive_twentynine">25-29</option>
                                    <option value="thirty_thirtyfour">30-34</option>
                                    <option value="thirtyfive_thirtynine">35-39</option>
                                    <option value="fourty_fourtyfour">40-44</option>
                                    <option value="fourtyfive_fourtynine">45-49</option>
                                    <option value="fifty_fiftyfour">50-54</option>
                                    <option value="fiftyfive_fiftynine">55-59</option>
                                    <option value="sixty_sixtyfour">60-64</option>
                                    <option value="sixtyfive_sixtynine">65-69</option>
                                    <option value="seventy_above">70 & Above</option>
                                </select>
                                </div>
                            </div>
                        </div>';
            if($program->with_gender){
                $html .= '<div class="row">
                            <label class="col-sm-2 col-form-label">Male/s</label>
                            <div class="col-sm-10">
                                <div class="form-group bmd-form-group">
                                    <input type="number" class="form-control" name="m" min="0" value="0">
                                    <span class="bmd-help">Required to have atleast 0 value</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Female/s</label>
                            <div class="col-sm-10">
                                <div class="form-group bmd-form-group">
                                    <input type="number" class="form-control" name="f" min="0" value="0">
                                    <span class="bmd-help">Required to have atleast 0 value</span>
                                </div>
                            </div>
                        </div>';
                if($program->with_trans){
                    $html .= '<div class="row">
                                <label class="col-sm-2 col-form-label">Transgender/s</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="number" class="form-control" name="t" min="0" value="0">
                                        <span class="bmd-help">Required to have atleast 0 value</span>
                                    </div>
                                </div>
                            </div>';
                }
            }else{
                $html .= '<div class="row">
                            <label class="col-sm-2 col-form-label">Answer</label>
                            <div class="col-sm-10">
                                <div class="form-group bmd-form-group">
                                    <input type="number" class="form-control" name="general_answer" min="0" value="0">
                                    <span class="bmd-help">Required to have atleast 0 value</span>
                                </div>
                            </div>
                        </div>';
            }
        }
        $html .= '</div>';
        return $html;
    }
}
