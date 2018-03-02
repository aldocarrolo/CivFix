<?php
    	
		
        if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
 	   	
            $email = $_GET['email']; 
    		$hash = $_GET['hash']; 
            
            $username = "civfix@localhost";
       		$pasword = "cigragudka49";
        	$host = "localhost";
      		$database = "my_civfix";
     
          	$db = mysql_connect($host, $username, $pasword) or die("Errore durante la connessione al database");
     	 	mysql_select_db($database, $db) or die("Errore durante la selezione del database");

            $msql = "SELECT email, hash FROM users WHERE email='".$email."' AND hash='".$hash."'";
            
			$search = mysql_query($msql) or die(mysql_error()); 
			$match  = mysql_num_rows($search);
            
            if($match > 0)
            {
        		mysql_query("UPDATE users SET hash=NULL WHERE email='".$email."' AND hash='".$hash."'") or die(mysql_error());
                
                
        		$check = 'account verificato, clicca <a href="http://www.civfix.altervista.org/login.php">qui</a> per accedere';
                
    		}
            else
            {
        		$check = "l'url non è valido, forse hai già attivato il tuo account oppure è scaduto";
         	}
            
            
		}
        else
        {
	    	$check = "url non valido, usa quello che ti è statospedito per email";
		}
	?>
    
<html lang="en">
    
    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-  fit=no">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

        <title>Accedi | CivFix</title>
        
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
        
        #exampleInputEmail1, #exampleInputPassword1{
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
            
            <a id="register-button"  href="register.php">Registrati</a>
        </div>
        
        <table id="tutto">
            <tr>
            <td id="big-logo"><div id="big-logo-image"><img src="big_logo.png" style="margin-top: 17.5%; width: 90%"></div></td>
            <td id="prova"><div id="registerform">
			

					 <h3 align="center"><b>Verifica Effettuata</b></h3>

						<p align="center"><img src="mail-check.png" width="40%"></p>
                        <p><?php echo $check; ?></p>

            </div></td>
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