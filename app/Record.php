<?php

namespace ControleDeHoras;

use Illuminate\Database\Eloquent\Model;

class Record extends Model {

	// Proibe inserção deste campo
	protected $guarded = ['id'];

	public function work() {
		return $this->belongsTo('ControleDeHoras\Work', 'idWork');
	}

}