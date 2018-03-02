<!doctype html>
<? 
	session_start (); 
    
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
	<link rel="stylesheet" href="main.css">
    <title>Dashboard | CivFix</title>
    
    <style type="text/css">
    
    body {
    	height:100%;
    }
    
    .dashboard-nav {
    	height:58px;
        background-color:white;
        z-index:1;
        top:0;
        text-align:center;
        font-size:30px;
        padding-top:5px;
    }
    
    	.container-segnalazioni {
        	position:absolute;
        	left:0;
            height:100%;
            padding-top:20px;
            
        }
        
        .lista-risultati {
        	overflow:scroll;
            height:75%;
        }
        
        .wrapper {
        	position:absolute;
        	height:100%;
        }
        
        .container-segnalazione {
        	border-style:solid;
            border-width:1px;
            border-color:lightgrey;
            padding-top:10px;
            padding-bottom:10px;
            border-bottom-width:0;
            
        }
        
        .prima-segnalazione {
        	
            border-radius: 10px 10px 0 0;
        
        }
        
        .ultima-segnalazione {
        
        	border-bottom-width:1px;
            border-radius: 0 0 10px 10px;
        
        }
        
        .container-segnalazione:hover {
        	
            background-color:lightgrey;
        	cursor:pointer;
            
            user-select:none;
        }
    
    </style>
    
  </head>
  
  
  <body>
  	<div class="dashboard-nav">CivFix</div>
  	<div class="container col-12 wrapper">
    
    	<div class="container container-segnalazioni col-6">
        	<h2 class="text-center mb-3">Segnalazioni di <? echo $_SESSION ['comune']; ?> </h2>
        	
            
            <div class="lista-risultati">
            
            
            <a>ciao</a>
              
          </div>
       
        </div>
	</div>
    <footer class="civfix-footer container-fluid">
        
         <p align="center">Copyright 2018 CivFix - Tutti i diritti riservati.</p>
        
    </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
  </body>
</html>