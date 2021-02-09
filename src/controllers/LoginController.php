<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandler;

class LoginController extends Controller {

    
    public function sigin() {
      $data = [
        'titulo' => 'Login - Devsbook'
      ];
      $this->render('login',$data);
        
    }

    public function siginAction(){
      //recebendo os dados do formulario
      $email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
      $password = filter_input(INPUT_POST,'password');

      if($email && $password) {
        //usando o handler "helper " login para verificar o login
        $token = LoginHandler::verifyLogin($email,$password);
        if($token){
            $_SESSION['token'] = $token;
            $this->redirect('/');
        }else{
          $_SESSION['flash'] = 'Email ou senha não conferem';
          $this->redirect('/login');
        }

      }else {
        $this->redirect('/login');
      }
    }

    public function sigup() {

      echo 'cadastro';
        
    }
}