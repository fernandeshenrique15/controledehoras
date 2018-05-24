<?php

namespace ControleDeHoras;

use Illuminate\Database\Eloquent\Model;

class Work extends Model {

	// Desativar os campos padrões 'update_at' e 'created_at'
	public $timestamps = false;

	// Mensurar o que deve ser cadastrado
	protected $fillable = array('name', 'lastname', 'idDepartment', 'email', 'hours', 'minutes');

	// Proibe inserção deste campo
	protected $guarded = ['id'];

	// public function department() {
	//     return $this->belongsTo('ControleDeHoras\Deparment');
	// }

}
