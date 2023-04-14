<?php
require __DIR__."/../Config/config.php" ;

session_start() ;

require ".." . DIRECTORY_SEPARATOR .'class'.DIRECTORY_SEPARATOR.'Autoloader.php' ;
Autoloader::register();

use login\Logger ;


$logger = new Logger() ;

$username = null;
$password = null ;
if (isset($_POST['username']) and isset($_POST['password'])){
    $username = $_POST['username'] ;
    $password = $_POST['password'] ;
    $response = $logger->log(trim($username), trim($password)) ;
    if ($response['granted']){
        $_SESSION['nickname'] = $response['nick'] ;
        header("Location: ../index.php");
        exit() ;
    }
}

ob_start() ;
if (!isset($response)) :
    echo "VIDE";
    $logger->generateLoginForm("", $username);
elseif (!$response['granted']) :
    echo "ERREUR";
    echo "<div>" .$response['error']."</div>" ;
    $logger->generateLoginForm("", $username, $response['error']);
endif;


$code = ob_get_clean() ;
Template::render($code);