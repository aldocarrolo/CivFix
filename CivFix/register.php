<!doctype html>
<html lang="en">
    
    <head>
        
        <!-- Meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-  fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

        <title>Registrati | CivFix</title>
        
        <link href="main.css" rel="stylesheet">
        
    </head>
    
    
    <body>
        
        <div class="civnav">
        
            <a class="civlogo" href="#">CivFix</a>
        
        </div>
        
        <p class="welcometext">Crea un account CivFix</p>
        
        <div class="container form-container col-lg-3" id="registerform">
        
            <form method="post" action="register.php">
                
                <div class="form-group">
                    <label for="exampleInputEmail1"><b>Email</b></label>
                      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" name="regemail">
                       
                </div>
                <div class="form-group">
                      <label for="exampleInputPassword1"><b>Password</b></label>
                      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="regpass">
                </div>
                
                <button type="submit" class="btn btn-primary col-12" name="registrati">Registrati</button>
                
                
            
            </form>
            
            <p align="center" class="mt-4">Oppure <a href="login.php">Accedi</a></p>

        </div>
        
        <footer class="civfix-footer container-fluid">
        
            <p align="center">Copyright 2018 CivFix - Tutti i diritti riservati.</p>
        
        </footer>
        
        <?php
    
        $username = "civfix@localhost";
       	$pasword = "cigragudka49";
        $host = "localhost";
      	$database = "my_civfix";
     
        $db = mysql_connect($host, $username, $pasword) or die('errore');
     	mysql_select_db($database, $db) or die('errore');
        
        $can = "DELETE FROM users WHERE data < NOW() - 21600 AND hash IS NOT NULL";

        mysql_query ( $can, $db );
    	
        if ( isset ( $_POST ['registrati'] ) )
        {
            
        	$mail = $_POST ['regemail'];
            $password = hash ( 'sha256', $_POST ['regpass'] );
            $hash = md5( rand(0,1000) );
            $nome = "guest".rand(1000000,9999999);
            
            $username = "civfix@localhost";
       		$pasword = "cigragudka49";
        	$host = "localhost";
      		$database = "my_civfix";
     
        	$db = mysql_connect($host, $username, $pasword) or die("Errore durante la connessione al database");
     	 	mysql_select_db($database, $db) or die("Errore durante la selezione del database");
            
            $src = "SELECT email, hash FROM users WHERE email='".$mail."' AND hash IS NULL";
            $src1 = "SELECT email, hash FROM users WHERE email='".$mail."' AND hash IS NOT NULL";
            
            $search = mysql_query($src) or die(mysql_error()); 
			$match  = mysql_num_rows($search);
            
            $search1 = mysql_query($src1) or die(mysql_error()); 
			$match1  = mysql_num_rows($search1);
            
            if ( $match != 0 )
            	echo "hai già un account, usa quello!";
                
            else if ( $match1 != 0 )
            	echo "un'altro account ha questa mail e deve essere ancora verificato, controlla la tua casella mail";

            else if ($match == 0 && $match1 == 0 )
            {
                do
                {
                	$nome = "guest".rand(1000000000,9999999999);
                    
                	$src = "SELECT nome FROM users WHERE nome='".$nome."'";
                
                	$search = mysql_query($src) or die(mysql_error()); 
					$match  = mysql_num_rows($search);
                }
                while ($match != 0);
                
                $msql = "INSERT INTO users (password, email, hash, nome) 
                VALUES (
                    '". $password ."', 
                    '". $mail ."', 
                    '". $hash ."',
                    '". $nome ."'
                )";

                if (mysql_query ($msql, $db))
                {
                    echo ("Inserimento riuscito!");
                	echo "controlla la tua casella email e verifica l'account entro 6 ore";

                	$to      = $mail; 
                	$subject = 'Registrazione | Verifica';  
                	$message = "

Grazie per esserti registrato!
Il tuo account è stato creato, per accedere clicca sul link di conferma sottostante entro 6 ore
Ti abbiamo fornito un username generato automaticamente, potrai cambiarlo a tuo piacimento nella tua sezione account.

Il tuo username: ".$nome."

------------------------

Clicca questo link per completare la registrazione entro 6 ore!
http://www.civfix.altervista.org/verify.php?email=".$mail."&hash=".$hash."
";

                	$headers = 'From: noreply@civfix.com' . "\r\n"; 
                	mail($to, $subject, $message, $headers);
            	}
            	else
            		echo ("Errore nell'inserimento :-(");
        	}
        }
        
	?>
        
        
        
        
        
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
      </body>
    
</html>