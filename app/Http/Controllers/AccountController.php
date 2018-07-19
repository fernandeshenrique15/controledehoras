<?php

namespace ControleDeHoras\Http\Controllers;

use ControleDeHoras\Account;
use ControleDeHoras\User;
use Illuminate\Support\Facades\Request;

class AccountController extends Controller
{
    public function adiciona() {
        $request = Request::except('_token');
        $data = User::where('email', $request['email'])->get();
        
        // Verifica se e-mail esta cadastrado
        if(empty($data)){
            return flashMessage('Login', 'E-mail já cadastrado', 'danger');
        }
        else {

            Account::create(Request::only('name'));
            $idAccount = Account::all()->get();

            User::create([
                'name' => $request['user'],
                'email' => $request['email'],
                'password' => Hash::make($request['password'])
            ]);

            return flashMessage('Account', 'Cadastrado', 'info');
      }
	
	}
}
