<?php

namespace ControleDeHoras\Http\Controllers;

use ControleDeHoras\Department;
use ControleDeHoras\Work;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Mail;
use ControleDeHoras\Mail\moreHours;
use ControleDeHoras\Mail\lessHours;
use Illuminate\Support\Facades\Auth;

class WorkController extends Controller {

	public function __construct() {
		// privar toda class
		$this->middleware('auth');
	}

	// Listar funcionários
	public function lista() {

		$works = Work::all()->where('idAccount', Auth::user()->idAccount)->sortBy('name');

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

		$this->authorize('work', $work);

		return view('work.mostra', ['work' => $work]);
	}

	public function remove($id) {
		$work = Work::find($id);

		if (empty($work))
			return flashMessage('Work', 'Esse funcionário não existe', 'danger');
		elseif ($work->records->count() != 0)
			return flashMessage('Work', 'Esse funcionário não tem registros', 'danger');
		
		$this->authorize('work', $work);

		$work->delete();
		return flashMessage('Work', 'Funcionário removido com sucesso');

	}

	public function novo() {
		$idAccount = Auth::user()->idAccount;
		$departments = Department::all()->where('idAccount', $idAccount)->sortBy('name');
		
		return view('work.novo', ['departments' => $departments, 'idAccount' => $idAccount]);
	}

	public function adiciona() {
		$request = Request::all();

		$this->authorize('work', (object) $request);

		Work::create($request);
		return flashMessage('Work', 'Funcionário cadastrado com sucesso');

	}

	public function edita($id) {
		$idAccount = Auth::user()->idAccount;
		$work = Work::find($id);

		if (empty($work))
			return flashMessage('Work', 'Esse funcionário não existe', 'danger');

			$departments = Department::all()->where('idAccount', $idAccount)->sortBy('name');
			$this->authorize('work', $work);

		return view('work.edita', ['departments' => $departments, 'work' => $work, 'idAccount' => $idAccount]);
	}

	public function atualiza() {
		$request = Request::except('_token');

		$this->authorize('work', (object) $request);

		Work::find($request['id'])->update($request);

		return flashMessage('Work', 'Funcionário atualizado com sucesso');

	}

	public function emailMore($id) {
		$work = Work::find($id);

		if (empty($work))
			return flashMessage('Work', 'Esse funcionário não existe', 'danger');

		$this->authorize('work', $work);
		
		Mail::to($work->email)->send(new moreHours($work));
		return flashMessage('Work', 'E-mail enviado com sucesso!! ');
		
	}

	public function emailLess($id) {
		$work = Work::find($id);

		if (empty($work))
			return flashMessage('Work', 'Esse funcionário não existe', 'danger');

		$this->authorize('work', $work);
	
		Mail::to($work->email)->send(new lessHours($work));
		return flashMessage('Work', 'E-mail enviado com sucesso!! ');
		
	}
}
