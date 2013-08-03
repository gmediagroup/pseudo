<?php

include 'config.php';

	function db_init()
	{
		global $db, $CONFIG;
		if($db) return true;
		try{
			$db=new PDO($CONFIG['dsn'], $CONFIG['db_user'], $CONFIG['db_pass']);
		} catch(PDOException $error)
		{
			echo('Database error:<br/>');
			die($error->getMessage());  
		}
		return true;
		
		
	}
	
	function delete_old()
	{
	    global $db, $CONFIG;
		db_init();
		
	    $t=time();
		$expires=$t+$CONFIG['code_lifetime']*60;
		// удаляем старые истекшие коды
		$db->query("DELETE FROM `codes` WHERE `expires`<'$t'");
	}
	
	function create_code()
	{
		global $db, $CONFIG;
		db_init();
		

		$code=mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9);
		$t=time();
		$expires=$t+$CONFIG['code_lifetime']*60;
        delete_old();
			

	
			// добавляем новый код
			$db->query("INSERT INTO  `codes` ( `expires`, `code`)  VALUES('$expires', '$code')");
		


		return $code;
		
	}
	
	
	
	function check_code($code)
	{
		global $db;

        db_init();
        delete_old();
		$stmt=$db->prepare("SELECT COUNT(*) as c FROM `codes` WHERE `code`= ? ");
		
		$stmt->execute(array($code));

		$r=$stmt->fetch();
		
		 // в базе есть строчка с кодом доступа, значит он верный
		if($r['c']>0) 			return true;


		// в базе такого кода нет
	}
	
	function send_pseudo($to,$client_ip, $param)
	{
		global $CONFIG;
		
		
		// подготовим URL для вызова
		$url='http://profit-bill.com/pseudo_subscription.php?';
		$url.='id='.$CONFIG['project_id'];
		$url.='&secret='.rawurlencode($CONFIG['secret']);		
		$url.='&phone='.rawurlencode($to);				
		$url.='&short_number='.rawurlencode($CONFIG['short_number']);						
		$url.='&message='.rawurlencode($CONFIG['message']);								
		$url.='&client_ip='.rawurlencode($client_ip);			
		$url.='&param='.rawurlencode($param);			
	
		// посредством вызова API биллинга пользователю отправляется смс
		$f=file_get_contents($url);
		$r=parse_ini_string($f);

		return $r['reply'];
		

				
	}


	if( !function_exists('parse_ini_string') ){

	    function parse_ini_string( $string ) {
	        $array = Array();

	        $lines = explode("\n", $string );

	        foreach( $lines as $line ) {
	            $statement = preg_match(
	"/^(?!;)(?P<key>[\w+\.\-]+?)\s*=\s*(?P<value>.+?)\s*$/", $line, $match );

	            if( $statement ) {
	                $key    = $match[ 'key' ];
	                $value    = $match[ 'value' ];

	                # Remove quote
	                if( preg_match( "/^\".*\"$/", $value ) || preg_match( "/^'.*'$/", $value ) ) {
	                    $value = mb_substr( $value, 1, mb_strlen( $value ) - 2 );
	                }

	                $array[ $key ] = $value;
	            }
	        }
	        return $array;
	    }
	}
	
	
	function redirect($to)
	{
		Header("Location: $to"); die;
	}



?>