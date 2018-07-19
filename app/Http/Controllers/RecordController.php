<?php

namespace ControleDeHoras\Http\Controllers;

use Carbon\Carbon;
use ControleDeHoras\Department;
use ControleDeHoras\Http\Requests\RecordRequest;
use ControleDeHoras\Record;
use ControleDeHoras\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecordController extends Controller {

	public function __construct() {
		// privar exceto algumas funções
		//$this->middleware('auth', ['except' => ['lista']]);

		// privar toda class
		$this->middleware('auth');
	}

	public function lista(Request $request) {

		// sort the result
		$ord = $request->only('o', 's');

		if(isset($ord['o'])){
			if(isset($ord['s'])){
				$records = Record::all()->sortBy($ord['o'])->take(10);
				$ord['o'] = 'reset';
			} else {
				$records = Record::all()->sortByDesc($ord['o'])->take(10);
			}
		} else {
			$records = Record::all()->sortByDesc('created_at')->take(10);
			$ord['o'] = 'reset';
		}

		foreach ($records as $r) {
			$formatDate = new Carbon($r->produced);
			$r->produced = $formatDate->format('d-m-Y');
		}

		return view('record.listagem', ['records' => $records, 'sort' => $ord['o']]);
	}

	public function remove($id) {
		$record = Record::find($id);

		// Transforma tudo em minutos
		$hour = explode(':', $record->hour);
		$hour[1] += $hour[0] * 60;
		$record->work->minutes += $record->work->hours * 60;

		// Faz o calculo
		if ($record->mode == 'add') {
			$record->work->minutes -= $hour[1];
		} elseif ($record->mode == 'remove') {
			$record->work->minutes += $hour[1];
		}

		// Reverte a transformação
		$record->work->hours = intval($record->work->minutes / 60);
		$record->work->minutes = $record->work->minutes - ($record->work->hours * 60);

		if ($record->work->save()) {

			if ($record->delete()) {
				return flashMessage('Record', 'Registro removido com sucesso');
			} else {
				return flashMessage('Record', 'Falha ao remover registro', 'danger');
			}

		} else {
			return flashMessage('Record', 'Falha ao descontar do funcionário', 'danger');
		}

	}

	public function novo() {
		$departments = Department::all();
		
		return view('record.novo', ['departments' => $departments]);
	}

	public function adiciona(RecordRequest $request) {
		$work = Work::find($request->idWork);

		if (empty($work)) {
			return flashMessage('Record', 'Falha ao adicionar registro', 'danger');
		}

		$dados = $request->except('_token');
		$hour = explode(':', $dados['hour']);

		// Transforma tudo em minutos
		$hour[1] += $hour[0] * 60;
		$work->minutes += $work->hours * 60;

		// Faz o calculo

		if ($dados['mode'] == 'add') {
			$work->minutes += $hour[1];
		} elseif ($request->mode == 'remove') {
			$work->minutes -= $hour[1];
		}

		// Reverte a transformação
		$work->hours = intval($work->minutes / 60);
		$work->minutes = $work->minutes - ($work->hours * 60);

		if ($work->save()) {
			Record::create($request->all());
			return flashMessage('Record', 'Registro adicionado com sucesso');
		}

		return flashMessage('Record', 'Falha ao adicionar registro', 'danger');
	}

	public function edita($id) {
		$record = Record::find($id);

		if (empty($record)) {
			return flashMessage('Record', 'Registro não localizado', 'danger');
		}

		return view('record.edita', ['record' => $record]);
	}

	public function atualiza(RecordRequest $request) {
		$work = Work::find($request->idWork);
		$recordOld = Record::find($request->id);

		$hour = explode(':', $request->hour);
		$hourAntigo = explode(':', $recordOld->hour);

		// Transforma tudo em minutos
		$hour[1] += $hour[0] * 60;
		$hourAntigo[1] += $hourAntigo[0] * 60;

		$work->minutes += $work->hours * 60;

		// Verifica se permanece a modalidade

		if ($recordOld->mode == $request->mode) {

			// Sem alteração no funcionário

			if ($recordOld->hour == $request->hour) {

				if (Record::find($request->id)->update($request->except('_token'))) {
					return flashMessage('Record', 'Registro atualizado com sucesso');
				} else {
					return flashMessage('Record', 'Falha ao atualizar registro #142');
				}

			}

			// Alteração no hora, desfaz o calculo e calcula com o novo valor

			if ($request->mode == 'add') {
				$work->minutes -= $hourAntigo[1];
				$work->minutes += $hour[1];
			} elseif ($request->mode == 'remove') {
				$work->minutes += $hourAntigo[1];
				$work->minutes -= $hour[1];
			}

		}

		// Mudou a modalidade, desfaz o calculo e calcula com a nova modalidade

		else {

			if ($request->mode == 'add') {
				$work->minutes += $hourAntigo[1];
				$work->minutes += $hour[1];
			} elseif ($request->mode == 'remove') {
				$work->minutes -= $hourAntigo[1];
				$work->minutes -= $hour[1];
			}

		}

		// Reverte a transformação
		$work->hours = intval($work->minutes / 60);
		$work->minutes = $work->minutes - ($work->hours * 60);

		if ($work->save()) {
			Record::find($request->id)->update($request->except('_token'));
			return flashMessage('Record', 'Registro atualizado com sucesso');
		} else {
			return flashMessage('Record', 'Falha ao atualizar funcionário', 'danger');
		}

	}

};
