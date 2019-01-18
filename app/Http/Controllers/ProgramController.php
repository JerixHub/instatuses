<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;
use App\Barangay;
use App\Question;
use App\User;
use App\ProgramQuestion;
use Auth;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = Program::where('barangay_id', Auth::user()->barangay_id)->get();
        return view('admin.programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programs = Program::where('barangay_id', Auth::user()->barangay_id)->get();
        $barangays = Barangay::all();
        return view('admin.programs.create', compact('programs', 'barangays'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $program = new Program;
        $program->name = $request->name;
        $program->barangay_id = $request->barangay;
        $program->header_type = $request->header_type;
        if(array_key_exists('with_gender', $request->all())){
            $program->with_gender = 1;
        }else{
            $program->with_gender = 0;
        }
        if(array_key_exists('with_trans', $request->all())){
            $program->with_trans = 1;
        }else{
            $program->with_trans = 0;
        }
        if(array_key_exists('with_target', $request->all())){
            $program->with_target = 1;
        }else{
            $program->with_target = 0;
        }
        if(array_key_exists('with_total', $request->all())){
            $program->with_total = 1;
        }else{
            $program->with_total = 0;
        }
        if(array_key_exists('with_icd_code', $request->all())){
            $program->with_icd_code = 1;
        }else{
            $program->with_icd_code = 0;
        }
        $program->save();

        return redirect('/admin/programs')->with('message', 'Successfully Added New Program');
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
        $barangays = Barangay::all();
        $current_program = Program::find($id);
        return view('admin.programs.edit', compact('programs', 'barangays','current_program'));
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
        $current_program = Program::find($id);
        $current_program->name = $request->name;
        $current_program->barangay_id = $request->barangay;
        $current_program->header_type = $request->header_type;
        if(array_key_exists('with_gender', $request->all())){
            $current_program->with_gender = 1;
        }else{
            $current_program->with_gender = 0;
        }
        if(array_key_exists('with_trans', $request->all())){
            $current_program->with_trans = 1;
        }else{
            $current_program->with_trans = 0;
        }
        if(array_key_exists('with_target', $request->all())){
            $current_program->with_target = 1;
        }else{
            $current_program->with_target = 0;
        }
        if(array_key_exists('with_total', $request->all())){
            $current_program->with_total = 1;
        }else{
            $current_program->with_total = 0;
        }
        if(array_key_exists('with_icd_code', $request->all())){
            $current_program->with_icd_code = 1;
        }else{
            $current_program->with_icd_code = 0;
        }
        $current_program->save();

        return redirect('/admin/programs')->with('message', 'Successfully Updated '.$current_program->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $program = Program::find($id);
        $program->delete();

        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }

    public function showCurrentProgram($program, $barangay, $user)
	{
        $current_program = Program::where('id',$program)->where('barangay_id',$barangay)->first();
        $current_barangay = Barangay::find($barangay);
        $current_user = User::find($user);
		$programs = Program::where('barangay_id', Auth::user()->barangay_id)->get();
		$is_admin = false;
		if(empty($current_user)){
			abort(403);
		}else{
			if($current_user->id != Auth::user()->id){
				abort(403);
			}

			if($current_user->is_admin){
				$is_admin = true;
			}

			if($current_barangay->id != Auth::user()->barangay->id){
				abort(403);
			}
		}

		$header = $this->getTableHeader($current_program);
        $questions = ProgramQuestion::with('question')->where('program_id', $program)->whereYear('created_at', date('Y'))->get();
        
		$answers = $current_program->answers;
		$random_question = ProgramQuestion::with('question')->where('program_id', $program)->whereYear('created_at', date('Y'))->inRandomOrder()->first();
		$random_question = $random_question->question;

		return view('admin.programs.showcurrent', compact(
			'current_program',
			'current_barangay',
			'current_user',
			'programs',
			'is_admin',
			'header',
			'answers',
			'questions',
			'random_question')
		);
	}

	public function getTableHeader($current_program){

		$html = '';
		if($current_program->header_type == 'date'){
			$dates = $this->getDatesArray();
			$html .= '<thead class="text-warning">';
			if($current_program->with_gender && $current_program->with_trans){
				$html .= '<tr><th rowspan="2">Indicators</th>';
				if ($current_program->with_target) {
					$html .= '<th rowspan="2">Target</>';
				}
				if ($current_program->with_icd_code) {
					$html .= '<th rowspan="2">ICD CODE</>';
				}
				foreach ($dates as $date) {
					$html .= '<th colspan="3">'.$date.'</th>';
				}
				if($current_program->with_total){
					$html .= '<th colspan="3">Total</>';
				}
				$html .= '</tr><tr>';
				foreach ($dates as $date) {
					$html .= '<th>M</th><th>F</th><th>T</th>';
				}
				if($current_program->with_total){
					$html .= '<th>M</th><th>F</th><th>T</th>';
				}
				$html .= '</tr>';
			}elseif($current_program->with_gender && !$current_program->with_trans){
				$dates = $this->getDatesArray();
				$html .= '<thead class="text-warning">';
				$html .= '<tr><th rowspan="2">Indicators</th>';
				if ($current_program->with_target) {
					$html .= '<th rowspan="2">Target</>';
				}
				if ($current_program->with_icd_code) {
					$html .= '<th rowspan="2">ICD CODE</>';
				}
				foreach ($dates as $date) {
					$html .= '<th colspan="2">'.$date.'</th>';
				}
				if($current_program->with_total){
					$html .= '<th colspan="2">Total</>';
				}
				$html .= '</tr><tr>';
				foreach ($dates as $date) {
					$html .= '<th>M</th><th>F</th>';
				}
				if($current_program->with_total){
					$html .= '<th>M</th><th>F</th>';
				}
				$html .= '</tr>';
				$html .= '</thead>';
			}elseif(!$current_program->with_gender){
				$dates = $this->getDatesArray();
				$html .= '<thead class="text-warning"><th>Indicators</th>';
				if($current_program->with_target){
					$html .= '<th>Target</th>';
				}
				foreach ($dates as $date) {
					$html .= '<th>'.$date.'</th>';
				}
				if($current_program->with_total){
					$html .= '<th>Total</th>';
				}
				$html .= '</thead>';
			}
		}elseif($current_program->header_type == 'quarterly'){
			$dates = $this->getQuarterlyDateArray();
			$html .= '<thead class="text-warning">';
			if($current_program->with_gender && $current_program->with_trans){
				$html .= '<tr><th rowspan="2">Indicators</th>';
				if ($current_program->with_target) {
					$html .= '<th rowspan="2">Target</>';
				}
				if ($current_program->with_icd_code) {
					$html .= '<th rowspan="2">ICD CODE</>';
				}
				foreach ($dates as $date) {
					$html .= '<th colspan="3">'.$date.'</th>';
				}
				if($current_program->with_total){
					$html .= '<th colspan="3">Total</>';
				}
				$html .= '</tr><tr>';
				foreach ($dates as $date) {
					$html .= '<th>M</th><th>F</th><th>T</th>';
				}
				if($current_program->with_total){
					$html .= '<th>M</th><th>F</th><th>T</th>';
				}
				$html .= '</tr>';
			}elseif($current_program->with_gender && !$current_program->with_trans){
				$dates = $this->getDatesArray();
				$html .= '<thead class="text-warning">';
				$html .= '<tr><th rowspan="2">Indicators</th>';
				if ($current_program->with_target) {
					$html .= '<th rowspan="2">Target</>';
				}
				if ($current_program->with_icd_code) {
					$html .= '<th rowspan="2">ICD CODE</>';
				}
				foreach ($dates as $date) {
					$html .= '<th colspan="2">'.$date.'</th>';
				}
				if($current_program->with_total){
					$html .= '<th colspan="2">Total</>';
				}
				$html .= '</tr><tr>';
				foreach ($dates as $date) {
					$html .= '<th>M</th><th>F</th>';
				}
				if($current_program->with_total){
					$html .= '<th>M</th><th>F</th>';
				}
				$html .= '</tr>';
				$html .= '</thead>';
			}elseif(!$current_program->with_gender){
				$dates = $this->getDatesArray();
				$html .= '<thead class="text-warning"><th>Indicators</th>';
				if($current_program->with_target){
					$html .= '<th>Target</th>';
				}
				foreach ($dates as $date) {
					$html .= '<th>'.$date.'</th>';
				}
				if($current_program->with_total){
					$html .= '<th>Total</th>';
				}
				$html .= '</thead>';
			}
		}elseif($current_program->header_type == 'age_monthly'){
			$ages = $this->getAgeMonthlyArray();
			$html .= '<thead class="text-warning">';
			if($current_program->with_gender && $current_program->with_trans){
				$html .= '<tr><th rowspan="2">Indicators</th>';
				if ($current_program->with_target) {
					$html .= '<th rowspan="2">Target</>';
				}
				if ($current_program->with_icd_code) {
					$html .= '<th rowspan="2">ICD CODE</>';
				}
				foreach ($ages as $age) {
					$html .= '<th colspan="3">'.$age.'</th>';
				}
				if($current_program->with_total){
					$html .= '<th colspan="3">Total</>';
				}
				$html .= '</tr><tr>';
				foreach ($ages as $age) {
					$html .= '<th>M</th><th>F</th><th>T</th>';
				}
				if($current_program->with_total){
					$html .= '<th>M</th><th>F</th><th>T</th>';
				}

				$html .= '</tr>';
			}elseif($current_program->with_gender && !$current_program->with_trans){
				$ages = $this->getAgeMonthlyArray();
				$html .= '<thead class="text-warning">';
				$html .= '<tr><th rowspan="2">Indicators</th>';
				if ($current_program->with_target) {
					$html .= '<th rowspan="2">Target</>';
				}
				if ($current_program->with_icd_code) {
					$html .= '<th rowspan="2">ICD CODE</>';
				}
				foreach ($ages as $age) {
					$html .= '<th colspan="2">'.$age.'</th>';
				}
				if($current_program->with_total){
					$html .= '<th colspan="2">Total</>';
				}
				$html .= '</tr><tr>';
				foreach ($ages as $age) {
					$html .= '<th>M</th><th>F</th>';
				}
				if($current_program->with_total){
					$html .= '<th>M</th><th>F</th>';
				}
				$html .= '</tr>';
				$html .= '</thead>';
			}elseif(!$current_program->with_gender){
				$dates = $this->getDatesArray();
				$html .= '<thead class="text-warning"><th>Indicators</th>';
				if($current_program->with_target){
					$html .= '<th>Target</th>';
				}
				foreach ($dates as $date) {
					$html .= '<th>'.$date.'</th>';
				}
				if($current_program->with_total){
					$html .= '<th>Total</th>';
				}
				$html .= '</thead>';
			}
		}

		return $html;
	}

	public function getQuarterlyDateArray()
	{
		$dates = array(
			'1st Q',
			'2nd Q',
			'3rd Q',
			'4th Q'
		);
		return $dates;
	}

	public function getDatesArray()
	{
		$dates = array(
			'Jan',
			'Feb',
			'Mar',
			'1st Q',
			'Apr',
			'May',
			'Jun',
			'2nd Q',
			'Jul',
			'Aug',
			'Sept',
			'3rd Q',
			'Oct',
			'Nov',
			'Dec',
			'4th Q',
		);
		return $dates;
	}

	public function getAgeMonthlyArray()
	{
		$ages = array(
			'Under 1',
			'1-4',
			'5-9',
			'10-14',
			'15-19',
			'20-24',
			'25-29',
			'30-34',
			'35-39',
			'40-44',
			'45-49',
			'50-54',
			'55-59',
			'60-64',
			'65-69',
			'70 & above',
		);
		return $ages;
	}
}
