<?php
require __DIR__."/../Config/config.php" ;

session_start() ;
session_destroy() ;
header("Location: ../index.php");
exit() ;