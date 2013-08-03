<?php
    include 'functions.php';
	session_start();
	

	 
	if(check_code($_SESSION['code'])) redirect('paid.php'); // если абонент уже однажды вводил верный код, отправить его на странцу получения услуги
	  
	
	
	if(count($_POST)) {
		$r=check_code($_POST['code']);
		if($r) {
			// верный код! сохранить код в сессию и перенаправить пользователя на страницу с платным контентом
			$_SESSION['code']=$_POST['code'];
			redirect('paid.php');
		}
		else {
		    $error='Неправильный код.';
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
	Вам течение нескольких секунд вам придет смс. Ответьте сколько вам лет и вы получите код доступа к сайту. 
	<br/><br/>
	<form method="POST">
		Введите код: 
		<input type="text" value="" name="code"/>
				<input type="submit" value="OK">
				
		<?php if($error): ?><br/>
			<span style="color: red"><?php echo $error;?></span>
		<?php endif;?>
	</form>

</body>
</html>
