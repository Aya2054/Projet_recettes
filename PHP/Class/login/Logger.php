<?php
namespace login ;

use gdb\recette;

class Logger
{

    public function generateLoginForm(string $action='/', string $username=null, $message=null): void{
        if (isset($response['error'])): ?>
            <div class="magic-card">
                <?php echo $message ?>
            </div>
        <?php endif; ?>
        <form method="post" action="<?php $action ?>" id="formulaire">
            <legend>Log In</legend> <hr> <br>
            <label for="name">Username: </label> <br>
            <input type="text" id="name" name="username" value="<?php echo $username ?>">
            <br>
            <label for="password">Password: </label> <br>
            <input type="password" name="password">
            <br> <br>  <br>
            <input type="submit" value="Se connecter" id="btn">
        </form>
        <?php
    }

    public function log(string $username, string $password) : array{

        // les data devraient être récupérées dans une base de données...
        $user = "aya" ;
        $pwd = "ayouya1234" ;

        $error = null ;
        $nick = null ;
        $granted = false ;
        if (empty($username)){
            $error = "username is empty" ;
        }elseif (empty($password)){
            $error = "password is empty" ;
        }elseif ($user == $username and $pwd == $password){
            $granted = true ;
            $nick = htmlspecialchars("ayouya") ;
        }else{
            $error = "Authetication Failed" ;
        }
        return array(
            'granted' => $granted,
            'nick' => $nick,
            'error' => $error
        ) ;

    }


}