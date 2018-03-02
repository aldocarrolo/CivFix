<?php

$registrationSucceded = false;

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
  if(!empty($_POST['regname']))
  {
    if(preg_match("/^[a-zA-Z]*$/", $_POST['regname']))
    {
      if(!empty($_POST['reglastname']))
      {
        if(preg_match("/^[a-zA-Z]*$/", $_POST['reglastname']))
        {
          if(filter_var($_POST['regemail'], FILTER_VALIDATE_EMAIL))
          {
            if(!empty($_POST['regpass']))
            {
              if(preg_match("/^[a-zA-Z0-9]*$/", $_POST['regpass']))
              {
                if($_POST['regpass'] == $_POST['regcheckpass'])
                {
                  $nome = $_POST['regname'];
                  $cognome = $_POST['reglastname'];
                  $mail = $_POST ['regemail'];
                  $password = hash ( 'sha256', $_POST ['regpass'] );
                  $hash = md5( rand(0,1000) );

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

                  if ($match != 0)
                    $errore = '<p id="errore">E\' già stato registrato un account con quell\'email</p>';
                  else if($match1 != 0)
                    $errore = '<p id="errore">E\' già stato registrato un account con quell\'email. Bisogna verificarlo accedendo alla posta elettronica.</p>';
                  else if($match == 0 && $match1 == 0)
                  {

                    $msql = "INSERT INTO users (password, email, hash, nome, cognome) 
                                                VALUES (
                                                    '". $password ."', 
                                                    '". $mail ."', 
                                                    '". $hash ."',
                                                    '". $nome ."',
                                                    '". $cognome ."'
                                                )";

                    if (mysql_query ($msql, $db))
                    {
                      $registrationSucceded = true;

                      $to      = $mail; 
                      $subject = 'Registrazione | Verifica';  
                      $message = "

                                Grazie per esserti registrato!
                                Il tuo account è stato creato, per accedere clicca sul link di conferma sottostante entro 6 ore
                                Ti abbiamo fornito un username generato automaticamente, potrai cambiarlo a tuo piacimento nella tua sezione account.

                                Il tuo username: ".$nome." ".$cognome."

                                ------------------------

                                Clicca questo link per completare la registrazione entro 6 ore!
                                <a href='http://www.civfix.altervista.org/verify.php?email=".$mail."&hash=".$hash."' Verifica il tuo account</a>
                                ";

                      $headers = 'From: noreply@civfix.com' . "\r\n"; 
                      mail($to, $subject, $message, $headers);
                    }
                    else
                    {
                      $errore = "Errore nell'inserimento :-(";
                    }
                  }
                }
                else
                {
                  $errore = '<p id="errore">Inserisci la password</p>';
                }
              }
              else
              {
                $errore = '<p id="errore">Inserisci un\'email valida</p>';
              }
            }
            else
            {
              $errore = '<p id="errore">Non puoi inserire spazi nella password</p>';
            }
          }
          else
          {
            echo $_POST['regemail'] . "ciao";
            $errore = '<p id="errore">Inserisci un\'email valida</p>';
          }
        }
        else
        {
          $errore = '<p id="errore">Puoi inserire solo lettere nel cognome</p>';
        }
      }
      else
      {
        $errore = '<p id="errore">Inserisci il cognome</p>';
      }
    }
    else
    {
      $errore = '<p id="errore">Puoi inserire solo lettere nel nome</p>';
    }
  }
  else
  {
    $errore = '<p id="errore">Inserisci il nome</p>';
  }
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-  fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

    <title>Registrati | CivFix</title>

    <style>
      body{
        background: linear-gradient(rgba(26, 118, 97, 0.8), rgba(26, 118, 97, 0.8)),
          url('background.jpg');

        color: rgba(26, 118, 97, 1);
      }

      #header-bar{
        margin-top: 0;
        margin-left: 0;
        margin-right: 0;

        width: 100%;
        min-height: 44px; 
        background-color: white;

        padding: 10px;

        vertical-align: middle;
      }

      #register-button{
        width: 20%;

        background-color: rgba(26, 118, 97, 0.8);

        color: white;
        font-weight: bold;

        border:0;
        border-radius: 5px;

        float: right;
        text-align: center;

        text-decoration: none;

        min-width: 116.5px;
        transition: 0.3s;
      }

      #register-button:hover{
        background-color: rgba(26, 118, 97, 1);
      }

      #registerform{
        width: 400px;
        min-width: 250px;
        max-width: 500px;
        background-color: white;

        padding: 20px;

        border-radius: 5px;
      }

      #big-logo-image{
        width: 400px;
        height: 400px;
      }

      #tutto{
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
      }

      #footer{
        position: absolute;
        bottom: 0;
        padding: 0;
        width: 100%;
        color: white;
      }

      #errore{
        color: red;
      }

      #exampleInputEmail1, #exampleInputPassword1, #exampleInputCheckPassword1, #exampleInputName1, #exampleInputLastName1{
        border: 0;
        border-bottom: 2px solid rgb(26, 118, 97);
        border-radius: 0;
      }

      #login-button{
        background-color: rgba(26, 118, 97, 0.8); 
        border: 0;

        font-weight: bold;
      }

      #login-button:hover{
        background-color: rgba(26, 118, 97, 1);
      }

      @media only screen and (max-width: 800px) 
      {
        #big-logo-image {
          display: none;
        }

        #registerform{
          width: 100%;
          min-width: none;
          max-width: none;
        }

        #footer{
          font-size: 13px;
        }

        #big-logo{
          display: none;
        }

        #tutto{
          width: 90%;
        }
      }


      @media only screen and (max-height: 400px) 
      {
        #header-bar{
          display: none;
        }

        body{
          background: linear-gradient(rgba(26, 118, 97, 0.8), rgba(26, 118, 97, 0.8)),
            url('background.jpg');
        }
      }
    </style>
  </head>
  <body>

    <div id="header-bar">
      <a class="civlogo" href=""><img src="small_logo.png" width="87px"></a>
      <a id="register-button"  href="login.php">Accedi</a>
    </div>

    <table id="tutto">
      <tr>
        <td id="big-logo">
          <div id="big-logo-image">
          	<img src="big_logo.png" style="margin-top: 17.5%; width: 90%">
          </div>
        </td>
        
        <td id="prova">
          <div id="registerform">

            <form method="post" action="register.php">

              <? 

              if($registrationSucceded)
              {
                echo '
                        <h3 align="center"><b>Fatto!</b></h3>

						<p align="center"><img src="mail.png" width="40%"></p>
                        <p style="text-align:center">Controlla la tua email, ti abbiamo inviato un messaggio con il link di attivazione :)</p>
                        ';
              }
              else
              {
                echo '

                        <h2><b>Registrati</b></h2>
                        <p id="slogan">Aiuta a rendere migliore la tua città</p>

						'. $errore.'
                        <div class="form-group">
                              <input type="name" class="form-control" id="exampleInputName1" aria-describedby="nameHelp" placeholder="Nome" name="regname" style="float: left; width: 47.5%; margin-right: 5%">
                              <input type="last-name" class="form-control" id="exampleInputLastName1" aria-describedby="lastNameHelp" placeholder="Cognome" name="reglastname" style=" width: 47.5%">
                        </div>

                        <div class="form-group">
                              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" name="regemail">
                        </div>

                        <div class="form-group">
                              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="regpass" style="float: left; width: 47.5%; margin-right: 5%">
                              <input type="password" class="form-control" id="exampleInputCheckPassword1" placeholder="Conferma Password" name="regcheckpass" style=" width: 47.5%">
                        </div>

                        <button id="login-button" type="submit" class="btn btn-primary col-12" name="registrati">Registrati</button>
            			';
              }

              ?>
            </form>
          </div>
        </td>
      </tr>
    </table>

    <div id="footer">
      <p align="center">Copyright 2018 CivFix - Tutti i diritti riservati.</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
  </body>
</html>