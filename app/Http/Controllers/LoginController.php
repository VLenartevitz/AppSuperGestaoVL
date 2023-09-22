<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function index(Request $request){

        $erro = '';
        
        if($request->get('erro') == 1 ){
            $erro = 'Usuario e ou senha n existe';
        }
        
        if($request->get('erro') == 2 ){
            $erro = 'Faça login para acessar a pagina';
        }


        return view('site.login',
         ['titulo' => 'login',
          'erro' =>$erro]);
    }
    public function autenticar(Request $request){
        $regras =[
            'usuario' => 'email',
            'senha' => 'required'
        ];
        $feedback =[
            'usuario.email' => 'O campo Usuário {e-mail} é obrigatório',
            'senha.required' => 'O campo Senha é obrigatório'
        ];

        $request->validate($regras, $feedback);

        $email = $request->get('usuario');
        $password = $request->get('senha');

        $user = new User();

        $usuario = $user->where('email' , $email)
        ->where('password' , $password)
        -> get()
        ->first();

        if(isset($usuario->name)){
            session_start();
            $_SESSION['nome'] = $usuario ->name;
            $_SESSION['email'] = $usuario ->email;

            return redirect()-> route('app.cliente');
        }else{
        return redirect()->route('site.login', ['erro' => 1]);
        }

    }
}
