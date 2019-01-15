<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;
use App\Barangay;
use App\User;
use App\Question;
use Auth;

class ProgramController extends Controller
{
	public function index($program, $barangay, $user)
	{
		$current_program = Program::find($program);
		$current_barangay = Barangay::find($barangay);
		$current_user = User::find($user);
		$programs = Program::all();
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
		$questions = $current_program->questions;
		dd($questions);

		$header_indicator = $this->getHeaderIndicators($current_program);
		$answers = $current_program->answers;

		$random_question = Question::where('program_id',$current_program->id)->inRandomOrder()->first();

		return view('admin.programs.index', compact(
			'current_program',
			'current_barangay',
			'current_user',
			'programs',
			'is_admin',
			'random_question',
			'header',
			'header_indicator',
			'answers',
			'questions')
		);
	}

	public function getHeaderIndicators($current_program)
	{
		$header_type = $current_program->header_type;
		if ($header_type == 'date') {
			return $this->getDatesArray();
		}elseif($header_type == 'quarterly'){
			return $this->getQuarterlyDateArray();
		}elseif($header_type == 'age_monthly'){
			return $this->getAgeMonthlyArray();
		}
	}

	public function getTableBody($current_program){

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
