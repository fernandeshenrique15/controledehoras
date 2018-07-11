<?php

namespace ControleDeHoras;

use Illuminate\Database\Eloquent\Model;

class Work extends Model {

	// Desativar os campos padrões 'update_at' e 'created_at'
	public $timestamps = false;

	// Proibe inserção deste campo
	protected $guarded = ['id'];

	public function department() {
		return $this->belongsTo('ControleDeHoras\Department', 'idDepartment');
	}

	public function records() {
		return $this->hasMany('ControleDeHoras\Record', 'idWork');
	}

	public function account() {
		return $this->belongsTo('ControleDeHoras\Account', 'idAccount');
	}

}
