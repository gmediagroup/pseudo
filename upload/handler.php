<?php
// этот файл - обработчик входящих сообщений. он генерирует коды доступа к сайту.

    include 'functions.php';
    $code=create_code();
    echo("reply\n");
    echo($code);
    



?>