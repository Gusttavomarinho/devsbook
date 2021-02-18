<?php
namespace src\handlers;
use \src\models\User;

class LoginHandler {

  public static function checkLogin(){
    //verifica se existe a sessao token
    if(!empty($_SESSION['token'])){
      //pega os valores da sessao token
      $token = $_SESSION['token'];

      //verificando no bd se existe um usuario com este token
      $data = User::select()->where('token',$token)->one();
      if(count($data) > 0){

        $loggedUser = new User();
        $loggedUser->id = $data['id'];
        $loggedUser->email = $data['email'];
        $loggedUser->name = $data['name'];
        $loggedUser->avatar = $data['avatar'];

        return $loggedUser;

      }
    }
      return false;
  }

  public static function verifyLogin($email,$password){
    //buscando o usuario pelo email
    $user = User::select()->where('email',$email)->one();

    //se achar o usuario agora vai verificar a senha
    if ($user){
      if(password_verify($password,$user['password'])){
          //gerando o token de login do usuario
          $token = md5(time().rand(0,9999).time());
          //salvando o token no banco de dados
          User::update()
            ->set('token',$token)
            ->where('email',$email)
          ->execute();
          //retornando o token
          return $token;
      }
    }
    return false;

  }

  public static function  emailExists($email){
    $user = User::select()->where('email',$email)->one();
    return $user ? true : false;

  }

  public static function  addUser($name,$email,$password,$birthdate){
      $hash = password_hash($password,PASSWORD_DEFAULT);
      $token = md5(time().rand(0,9999).time());

      User::insert([
        'email' => $email,
        'password' => $hash,
        'name' => $name,
        'birthdate' => $birthdate,
        'token' => $token
      ])->execute();

      return $token;
  }

}