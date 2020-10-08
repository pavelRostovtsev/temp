<?php 
require_once 'init.php'; 

 echo Session::flash('success');

$user = new User;


// $anotherUser = new User (11);
// echo $user->data()->username;//получаем текущего пользователя
// echo $anotherUser->data()->username;//получаем любого другого пользователя


if($user->isLoggendIn()) {
	echo "Здарова,сучара! Ты слышал , что пользователя под ником <a href=''> {$user->data()->username}</a> называют ушлепком";
	echo "<p><a href='logout.php'>Выйти</a></p>";
	echo "<p><a href='update.php'>Update</a></p>";
	echo "<p><a href='changepassword.php'>changepassword</a></p>";

	if ($user->hasPermissions('Admin')) {
		echo "Ты админ";
	}
} else {
	echo "Может зайдешь? <br>";
	echo " <a href='register.php'>Регистрация</a> или <a href='login.php'>Войти</a>";
}




