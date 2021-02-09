<?php
namespace src\controllers;

use \core\Controller;

class LoginController extends Controller {

    
    public function sigin() {
      $data = [
        'titulo' => 'Login - Devsbook'
      ];
      $this->render('login',$data);
        
    }

    public function siginAction(){
      echo 'Login recebido!';
    }

    public function sigup() {

      echo 'cadastro';
        
    }
}