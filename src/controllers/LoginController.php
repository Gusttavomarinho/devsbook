<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandler;

class LoginController extends Controller {

    
    public function sigin() {
      /**sistema de aviso */
      $flash = '';
      if(!empty($_SESSION['flash'])){
        $flash = $_SESSION['flash'];
        $_SESSION['flash'] = '';
      }
      /**  *************** */ 

      /** colocando o titulo da pagina dinamico */
      $data = [
        'titulo' => 'Login - Devsbook',
        'flash' => $flash
      ];
      /**  *************** */ 

      $this->render('sigin',$data);
        
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
      /**sistema de aviso */
      $flash = '';
      if(!empty($_SESSION['flash'])){
        $flash = $_SESSION['flash'];
        $_SESSION['flash'] = '';
      }
      /**  *************** */ 

      /** colocando o titulo da pagina dinamico */
      $data = [
        'titulo' => 'Cadastro - Devsbook',
        'flash' => $flash
      ];
      /**  *************** */ 

      $this->render('sigup',$data);
        
    }

    public function  sigupAction(){
      //recebendo os dados do formulario
      $name = filter_input(INPUT_POST,'name');
      $email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
      $password = filter_input(INPUT_POST,'password');
      $birthdate = filter_input(INPUT_POST,'birthdate');

      if($name && $email && $password && $birthdate){
        //verificando se a data esta correta
        $birthdate = explode('/',$birthdate);
        if(count($birthdate) != 3){
            $_SESSION['flash'] = 'Data de nascimento inválida!';
            $this->redirect('/cadastro');
          }

          //invertando a data para o formato internacional
          $birthdate = $birthdate[2].'-'.$birthdate[1].'-'.$birthdate[0];
          //verificando se e uma data possivel , valida
          if(strtotime($birthdate) === false){
            $_SESSION['flash'] = 'Data de nascimento inválida!';
            $this->redirect('/cadastro');

          }
          //verificando se o email ja é cadastrado
          if(LoginHandler::emailExists($email) === false){
            //cadastrando o usuario e logando
            $token = LoginHandler::addUser($name,$email,$password,$birthdate);
            $_SESSION['token'] = $token;
            $this->redirect('/');
          }else{
            $_SESSION['flash'] = 'E-mail Já cadastrado';
            $this->redirect('/cadastro');
          }

      }else {
        $this->redirect('/cadastro');
      }

    }
}