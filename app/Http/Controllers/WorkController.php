<?php

namespace ControleDeHoras\Http\Controllers;

use ControleDeHoras\Department;
use ControleDeHoras\Work;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Mail;
use ControleDeHoras\Mail\moreHours;
use ControleDeHoras\Mail\lessHours;

class WorkController extends Controller {

	public function __construct() {
		// privar toda class
		$this->middleware('auth');
	}

	// Listar funcionários
	public function lista() {

		$works = Work::all()->sortBy('name');

		// Array do ranking
		$positions = [
			'more' => [
				'id' => 0,
				'name' => false,
				'value' => '0:0',
				'email' => '',
				'department' => '',
			],
			'less' => [
				'id' => 0,
				'name' => false,
				'value' => '0:0',
				'email' => '',
				'department' => '',
			],
		];

		// Contabiliza o ranking
		foreach ($works as $work) {

			$work->hours = formatHour($work->hours, $work->minutes);

			if (str_replace(':', '.', $work->hours) > str_replace(':', '.', $positions['more']['value'])) {
				$positions['more']['value'] = $work->hours;
				$positions['more']['id'] = $work->id;
				$positions['more']['name'] = $work->name;
				$positions['more']['department'] = $work->department->name;
			}

			if (str_replace(':', '.', $work->hours) < str_replace(':', '.', $positions['less']['value'])) {
				$positions['less']['value'] = $work->hours;
				$positions['less']['id'] = $work->id;
				$positions['less']['name'] = $work->name;
				$positions['less']['department'] = $work->department->name;
			}

		}

		return view('work.listagem', ['works' => $works, 'positions' => $positions]);
	}

	public function mostra($id) {
		$work = Work::find($id);

		if (empty($work)) {
			return flashMessage('Work', 'Esse funcionário não existe', 'danger');
		} elseif ($work->records->count() == 0) {
			return flashMessage('Work', 'Esse funcionário não tem registros', 'danger');
		}

		return view('work.mostra', ['work' => $work]);
	}

	public function remove($id) {
		$work = Work::find($id);

		if ($work->records->count() == 0) {
			$work->delete();
			return flashMessage('Work', 'Funcionário removido com sucesso');
		} else {
			return flashMessage('Work', 'Este funcionário possui registros, será necessário apagar antes de excluí-lo', 'info');
		}

	}

	public function novo() {
		$departments = Department::all()->sortBy('name');
		return view('work.novo')->with('departments', $departments);
	}

	public function adiciona() {
		Work::create(Request::all());

		return flashMessage('Work', 'Funcionário cadastrado com sucesso');

	}

	public function edita($id) {
		$work = Work::find($id);
		$departments = Department::all()->sortBy('name');

		return view('work.edita', ['departments' => $departments, 'work' => $work]);
	}

	public function atualiza() {
		$request = Request::except('_token');
		Work::find($request['id'])->update($request);

		return flashMessage('Work', 'Funcionário atualizado com sucesso');

	}

	public function emailMore($id) {
		$work = Work::find($id);

		if (empty($work)) {
			return flashMessage('Work', 'Esse funcionário não existe', 'danger');
		} else {

			Mail::to($work->email)->send(new moreHours($work));

			return flashMessage('Work', 'E-mail enviado com sucesso!! ');
		}
		
	}

	public function emailLess($id) {
		$work = Work::find($id);

		if (empty($work)) {
			return flashMessage('Work', 'Esse funcionário não existe', 'danger');
		} else {

			Mail::to($work->email)->send(new lessHours($work));

			return flashMessage('Work', 'E-mail enviado com sucesso!! ');
		}
		
	}
}
