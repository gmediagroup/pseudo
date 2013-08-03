<?Php require 'functions.php';

if(count($_POST)) {

	$r=send_pseudo($_POST['phone'], $_SERVER['REMOTE_ADDR'], '');
	if($r=='ok') {
		//отправка успешна! переадресовываем пользователя на страницу ввода кода

		redirect('check.php');
		
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Пример работы с псевдо-подписками</title>
</head>
<body>
	<h1>Псевдо-подписки profit-bill.com</h1>
	
	Доступ к сайту разрешен только для совершеннолетних. Для того чтобы подтвердить ваш возраст, введите ваш номер телефона. <br/>
	Вам будет отправлена бесплатная sms на которую нужно будет ответить.<br/><br/>
	Введите ваш номер телефона:<br/>
	
	<form method="POST">
		<input type="text" value="+7" name="phone"/>
				<input type="submit" value="OK">
				
	<?php if($r):?><br/><br/>
		<span style="color: red">Произошла ошибка отправки: <strong><?php echo($r);?></strong>. </span> <br/>
		Документация по кодам ошибок находится здесь: <a href="http://profit-bill.com/info/pseudo_subscriptions.html">http://profit-bill.com/info/pseudo_subscriptions.html</a>
		
		
	<?Php endif;?>
	</form>
<? /*	
	*/?>
	
	<br/><br/>
	Поддержка абонентов - <a href="http://9help.me">http://9help.me</a>
</body>
</html>
