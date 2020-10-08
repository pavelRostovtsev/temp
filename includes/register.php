<?php

require_once 'init.php';

if(Input::exists()) {// если в POST есть данные то начинаем валидацию
  if(Token::check(Input::get('token'))) {

    $validate = new Validate();

    $validation = $validate->check($_POST,[
      'username' => [
        'required' => true,
        'min' => 2,
        'max' => 15,
      ],
      'email' => [
        'required' => true,
        'email' => true,
        'unique' => 'users',
      ],
      'password' => [
        'required' => true,
        'min' => 3
      ],
      'password_again' => [
        'required' => true,
        'matches' => 'password'
      ]
    ]);

    if ($validation->passed()) {
      
      $user = new User();
      $user->create([
        'username' => Input::get('username'),
        'email' => Input::get('email'),
        'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT)
      ]);
      
    } else {
      foreach ($validation->errors() as $error) {
        echo $error . "<br>";
        }
      }
  }
}

?>



<form action="" method = "POST">
  <?php echo Session::flash('success','register success');?>
  <div class="notice">
  
  </div>
  <div class="field">
    <label for="username">Введите имя</label>  
    <input type="text" name="username" value="<?php Input::get('username');?>">
  </div>

  </div>
  <div class="field">
    <label for="email">Введите email</label>  
    <input type="email" name="email" value="<?php Input::get('username');?>" >
  </div>

  <div class="field">
    <label for="password">Введите пароль</label>  
    <input type="text" name="password" value="">
  </div>

  <div class="field">
    <label for="password_again">Повторно пароль</label>  
    <input type="text" name="password_again" value="">
  </div>
 
    <input type="hidden" name="token" value='<?php echo Token::generate();?>'>
  

  <div class="field">
    <button type="submit">Отправить</button>
  </div>

</form>