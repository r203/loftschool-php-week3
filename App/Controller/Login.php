<?php
namespace App\Controller;

use App\Model\User;
use Base\AbstractController;

class Login extends AbstractController 
{
  public function index()
  {
    if($this->getUser()) {
      $this->redirect('/blog');
    }

    return $this->view->render(
      'login.phtml',
      [
        'title' => 'Главная',
        'user' => $this->getUser(),
      ]
    );
  }

  public function auth()
  {
    $email = (string) $_POST['email'];
    $password = (string) $_POST['password'];

    $user = User::getByEmail($email);
    if (!$user) {
      return 'Неверный логин или пароль';
    }

    if ($user->getPassword() !== User::getPasswordHash($password)) {
      return 'Неверный логин или пароль';
    }

    $this->session->authUser($user->getId());

    $this->redirect('/blog');
  }

  public function register()
  {
    $name = (string) $_POST['name'];
    $email = (string) $_POST['email'];
    $password = (string) $_POST['password'];
    $password2 = (string) $_POST['password2'];

    if(!$name || !$password) {
      return 'Не заданы имя и пароль';
    }

    if($password != $password2) {
      return 'Пароли не совпадают';
    }

    if(!$email) {
      return 'Почта не задана';
    }

    if(mb_strlen($password) < 5) {
      return 'Пароль слишком короткий';
    }

    $userData = [
      'name' => $name,
      'password' => $password,
      'created_at' => date('Y-m-d H:i:s'),
      'email' => $email
    ];

    $user = new User($userData);
    $user->save();

    $this->session->authUser($user->getId());
    $this->redirect('/blog');
  }
}
