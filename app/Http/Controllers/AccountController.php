<?php

namespace ControleDeHoras\Http\Controllers;

use ControleDeHoras\Account;
use ControleDeHoras\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class AccountController extends Controller
{
    public function adiciona() {
        $request = Request::except('_token');
        $data = User::where('email', $request['email'])->count();
        
        // Verifica se e-mail esta cadastrado
        if(!empty($data)){
            return redirect('login')->withInput([
                'msg' => 'E-mail já cadastrado',
                'type' => 'danger',
                'passed' => 'true'
            ]);
        }
        else {

            Account::create(Request::only('name'));

            $idAccount = Account::orderBy('id', 'desc')->first();

            User::create([
                'name' => $request['user'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'idAccount' => $idAccount->id
            ]);

           return redirect('login')->withInput([
                'msg' => 'Cadastrado com sucesso, faça login para utilizar',
                'type' => 'success',
                'passed' => 'true'
            ]);
      }
	
    }
    
    public function lista() {
        return view('auth.login');	
	}
}
