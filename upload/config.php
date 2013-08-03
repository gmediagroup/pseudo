<?php

	global $CONFIG;
	error_reporting(E_ALL ^ E_NOTICE);
	
	
	// основная конфигурация
	
	$CONFIG['project_id']=0; // id проекта псевдо-подписки в profit-bill.com
	$CONFIG['secret']='12345';  // секретный код проекта 
	$CONFIG['short_number']='8151'; // используемый кооткий номер						
    $CONFIG['message']='Сколько вам лет?';  // сообщение, которое будет отправлено пользователю

	$CONFIG['code_lifetime']=60; // время жизни кода доступа в минутах 
	////////////////
	
	
	// база данных
	
	
	$CONFIG['dsn']='sqlite:'.dirname(__FILE__).DIRECTORY_SEPARATOR.'sqlite'.DIRECTORY_SEPARATOR.'database.sqlite';  
	
	
	
	
	// если вы хотите использовать mysql, раскомментируйте 5 строчек ниже. и не забудьте выполнить запрос из документации.
	
//	$CONFIG['db_host']='localhost';
//	$CONFIG['db_name']='pseudo';	
//	$CONFIG['db_user']='root';
//	$CONFIG['db_pass']='';
//	$CONFIG['dsn']='mysql:host='.$CONFIG['db_host'].';dbname='.$CONFIG['db_name'];



	
	

	
?>