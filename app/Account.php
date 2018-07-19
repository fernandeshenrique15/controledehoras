<?php

namespace ControleDeHoras;

use Illuminate\Database\Eloquent\Model;

class Account extends Model {
	// Proibe inserção deste campo
	protected $guarded = ['id'];

	public function works() {
		return $this->hasMany('ControleDeHoras\Work', 'idAccount');
    }
    
    public function users() {
		return $this->hasMany('ControleDeHoras\User', 'idAccount');
	}
}
