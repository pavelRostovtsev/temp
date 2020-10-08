<?php
require_once 'init.php';

if (Input::exists()) {
	if(Token::check(Input::get('token'))) {

		$validate = new Validate();

		$validate->check($_POST, [
			'email' => ['required' => true, 'email' =>true],
			'password' => ['required' =>true]

		]);

		if($validate->passed()) {
			$user = new User;
			$remember = (Input::get('remember') ==='on' ? true : false); 
			$login = $user->login(Input::get('email'),Input::get('password'), $remember);

			if ($login) {
				Redirect::to('index.php');
			} else {
				echo "no good";
			}
		} else {
			foreach ($validate->errors() as $error) {
				echo $error . "<br>";
			}
		}
	}
}


?>



<form action="" method="post">
	<div class="field">
		<label for="email">email</label>
		<input type="text" name="email" value="<?= Input::get('email')?>">
	</div>

	<div class="field">
		<label for="password">Password</label>
		<input type="password" name="password">
	</div>

	<div class="field">
		<input type="checkbox" name="remember" id="remember">
		<label for="remember">remember</label>
	</div>
	
	<input type="hidden" name="token" value="<?php echo Token::generate();?>">

	<div>
		<button type="submit">Submit</button>
	</div>




</form>