<?php
session_start() ;
$logged = isset($_SESSION['nickname']) ;
header("Location: pages/page_principale.php") ;
exit() ;