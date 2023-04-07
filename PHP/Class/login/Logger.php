<?php
namespace magic ;

use gdb\recette;

class Logger
{

    public function generateLoginForm(string $action='/', string $username=null, $message=null): void{
        if (isset($response['error'])): ?>
            <div class="magic-card">
                <?php echo $message ?>
            </div>
        <?php endif; ?>
        <form action="<?php $action ?>" id="formulaire">
            <legend>Log In</legend> <hr> <br>
            <label for="name">Username: </label> <br>
            <input type="text" id="name" value="<?php echo $username ?>">
            <br>
            <label for="password">Password: </label> <br>
            <input type="password">
            <br> <br>  <br>
            <input type="submit" value="Se connecter" id="btn">
        </form>
        <?php
    }

    public function log(string $username, string $password) : array{
        // assuming you have a database connection
        $db = new recette();

        $error = null ;
        $nick = null ;
        $granted = false ;
        if (empty($username)){
            $error = "username is empty" ;
        }elseif (empty($password)){
            $error = "password is empty" ;
        }else{
            // query the database to retrieve the user's data
            $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
            $stmt->execute([$username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                $error = "Authentication failed";
            } elseif (!password_verify($password, $user['password'])) {
                $error = "Authentication failed";
            } else {
                $granted = true;
                $nick = htmlspecialchars($user['nickname']);
            }
        }
        return array(
            'granted' => $granted,
            'nick' => $nick,
            'error' => $error
        ) ;
    }


}