<? 
	session_start ();
    
    include ("cancella.php");
    
    $username = "civfix@localhost";
    $pasword = "cigragudka49";
    $host = "localhost";
    $database = "my_civfix";

    $db = mysql_connect($host, $username, $pasword) or die("Errore durante la connessione al database");
    mysql_select_db($database, $db) or die("Errore durante la selezione del database");
    
	if ( !isset ( $_SESSION ['id'] ) && !isset ( $_COOKIE ['id'] ))
    	header ("location: login.php");

	if ( !isset ( $_SESSION ['id'] )) {
    	if ( isset ( $_COOKIE ["id"] )) {
        $id = $_COOKIE ["id"];
        
        $src = "SELECT id, email, nome FROM users WHERE id = ".$id;

    	$query = mysql_query($src);
    	$cerca = mysql_fetch_array($query);

    	$_SESSION ['id'] = $cerca ['id'];
    	$_SESSION ['nome'] = $cerca ['nome'];
    	$_SESSION ['email'] = $cerca ['email'];
            
        } }
            
        if ( isset ( $_SESSION ['id'] ) || isset ( $_COOKIE ["id"] ))
        	setcookie ("id", $_COOKIE ["id"], time() + 60 * 60 * 24 * 14);
            

?>
<html lang="it">
    <head>

      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
      <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="editable_map/search_problem.js"></script>

      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="icon" href="editable_map/favico.png" type="image/png" sizes="224x168"> 
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
      <link href="main.css" rel="stylesheet">

      <title>Dashboard | CivFix</title>

      <style>
        #map {
          height: 100%;
        }

        html, body {
          height: 100%;
          font-size: 16px;
          margin: 0;
          padding: 0;

          -webkit-touch-callout: none;
          -webkit-user-select: none;
          -khtml-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
          user-select: none;
        }

        #livesearch{
          margin-top: 5px;
          background-color: #f9f9f9;
          border-radius: 7px;

          max-height: 100%;
        }


        #search-problem-div{
          padding: 10px;
          font-size: 16px;
        }

        #search-problem-div:hover{
          cursor: pointer;
          background-color: #ededed;
        }

        #close-open-bar{
          display: block;
          height: 100%;
          text-align: center;
          background-color: rgba(26, 118, 97, 1);
          font-size: 10%;

          z-index: 999;
          position: fixed;

          left: 0%;

          transition: 0.3s;
        }

        .sidenav {
          height: 100%;
          width: 0;
          position: fixed;
          z-index: 1;
          top: 0;
          left: 0;
          background-color: rgba(26, 118, 97, 0.75);
          overflow-x: hidden; 
          padding: 0px;
          transition: 0.3s;
        }

        .sidenav a:hover{
          color: #f1f1f1;
        }

        .sidenav{
          top: 0;
          right: 25px;
          font-size: 36px;
        }

        #map {
          transition: margin-left .5s;
        }
        
        .material-icons{
        	font-size: 45px;
            width: 100%;
        }

        #close-open-button{
          transform: rotate(0deg); 
          transition: 0.5s;
        }

        #search-input{
          font-size: 16px;
          width: 100%;
          border-radius:50px;
          border-style:solid;
          border-width:0px;
          padding-left:20px;
          font-size:24;
        }

        #insert-marker{
          color: white;
          transition: 0.3s;
        }

        #menu-button, #close-open-button, #insert-marker{
          transition: 0.3s;
        }

        #menu-button:hover, #close-open-button:hover, #insert-marker:hover{
          text-shadow: 0px 0px 3px;
          background-color: rgb(17, 89, 72);
          cursor: pointer;
        }

        #footer{
          position: absolute;
          z-index: 2;
          bottom: -10;
          padding: 0;
          width: 100%;
          color: white;
          font-weight: bold;
        }
      </style>
    </head>
      <body>
                  
        <div id="close-open-bar" style="color: white">
        	<!--<i id="menu-button" class="material-icons" style="font-size: 45px">menu</i><br>-->
            <i id="close-open-button" onclick="closeNav()" class="material-icons" style="font-size:45px">keyboard_arrow_right</i><br>
            <i id="insert-marker" onclick="activeInsertMarker()" class="material-icons" style="font-size:45px">add_location</i>
            <div><a href="impostazioni.php" style="font-size: 16px">Impostazioni</a></div>
            <div><a href="logout.php" style="font-size: 16px">Esci</a></div>
        </div>
      	
        <div id="left-bar" class="sidenav">
          	<div id="search" style="margin-top:50px;">
            	<h2 style="text-align:center;color:white">Cerca località</h2>
                <input id="search-input" type="text" onkeyup="showResult(this.value)">
                <div id="livesearch"></div>
            </div>
        </div>
        <div style="position: fixed; z-index: 99; right: 1%; top: 1%; background-color: white; padding-left: 15px; padding-right: 15px; padding-top: 10px; padding-bottom: 10px">
                  <img src="user.svg" class="iconaprofilo">
                  <div class="dropdown-content" style="right:10px;">
                      <p>
                          <?
                          echo $_SESSION ['nome'];
                          ?>
                      </p>
                  </div>
              <a class="dashboard-nav-item dashboard-link" href="#">Aiuto</a>
          </div>
          <div id="footer">
            <p align="center">Copyright 2018 CivFix - Tutti i diritti riservati.</p>
          </div>
        
        <div id="map" height="460px" width="100%" style="margin-left:45px"></div>
        
        <script>
        function openNav() 
        {
        
        	if(smartphoneDetection == true)
            {
                document.getElementById("left-bar").style.width = "90%";
                document.getElementById("left-bar").style.paddingLeft = "1%";
                document.getElementById("left-bar").style.paddingRight = "1%";
            	document.getElementById("close-open-bar").style.left = "90%";
            }
            else
            {
                document.getElementById("left-bar").style.width = "30%";
                document.getElementById("left-bar").style.paddingLeft = "1%";
                document.getElementById("left-bar").style.paddingRight = "1%";
            	document.getElementById("close-open-bar").style.left = "30%";
            }
            
            document.getElementById("close-open-button").style.transform = "rotate(180deg)";
            
            document.getElementById("close-open-button").onclick = function()
            {
            	closeNav();
            }
        }

        function closeNav() 
        {
            
            document.getElementById("left-bar").style.width = "0px";
            document.getElementById("left-bar").style.paddingLeft = "0px";
            document.getElementById("left-bar").style.paddingRight = "0px";
            
            document.getElementById("close-open-bar").style.left = "0";
            document.getElementById("close-open-button").style.transform = "rotate(0deg)";
            
            document.getElementById("close-open-button").onclick = function()
            {
            	openNav();
            }
        }
        
        var insertMarker = false;
        
        function activeInsertMarker()
        {
        	closeNav();
        
        	insertMarker = !insertMarker;
            
            if(insertMarker)
            	document.getElementById("insert-marker").style.color = "#ff4305";
          	else
        		document.getElementById("insert-marker").style.color = "white";
        }
        
    
        var map;

        var counter = 0;
        var marker = [];
        var problems = [];

        var infowindow;
        var messagewindow;
        
        var city;
        
        var smartphoneDetection = false;
        
        var onloadCallback = function() { }
        
        function fromLatitudeToCity(m)
        {
          	console.log("https://maps.googleapis.com/maps/api/geocode/json?latlng="+m.position.lat() + "," + m.position.lng() + "&key=AIzaSyAE4dEe8dPXybj2QACBJj8dbt0A2wBr8y0");
            makeRequest("https://maps.googleapis.com/maps/api/geocode/json?latlng="+m.position.lat() + "," + m.position.lng() + "&key=AIzaSyAE4dEe8dPXybj2QACBJj8dbt0A2wBr8y0", function(data)
            {
     			var jsonData = JSON.parse(data.responseText);
               
               	console.log(jsonData);
               
             	if(jsonData.status != "OK")
                {
                	alert("Inserisci il marker in un luogo adatto");
             		city = 0;
                    
                  	marker[counter].setMap(null);
                  	counter--;
                	infowindow.close();
                }
                else
                {
                  	city = jsonData.results[0].formatted_address;
                }
            });
        }
        
        function zoomAt(lat, lng)
        {
        	console.log(lat + " " + lng);
        	map.setZoom(20);
            map.setCenter({lat: lat, lng: lng });
            
            var x;
            for(x = 1; x <= counter; x++)
            {
            	if(lat == marker[x].getPosition().lat() && lng == marker[x].getPosition().lng())
                {
                	break;
               	}
            }
			
            if(messagewindow != undefined)
              messagewindow.close();

            messagewindow = new google.maps.InfoWindow({ content: '<p>Problema</p><p id="message">' + problems[x][0] + '</p><p>Segnalato da ' + problems[x][1] + " "  + problems[x][2] + "</p>"});
            messagewindow.open(map, marker[x]);
        }
        
        function initMap() 
        {
        	var t = navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry)/);
        	
            if(t != null)
            	smartphoneDetection = true;
        
            var center = {lat: 41.87194, lng: 12.567379999999957};
            map = new google.maps.Map(document.getElementById('map'), 
              { 
              	zoomControl: false,
                mapTypeControl: false,
                scaleControl: false,
                streetViewControl: false,	
                fullscreenControl: false,
              	center: center, 
                zoom: 6, 
                mapTypeId: 'roadmap',
                minZoom:4
              }
            );

            if (navigator.geolocation) 
            {
                navigator.geolocation.getCurrentPosition(function(position) 
                {
                    var pos = {
                      lat: position.coords.latitude,
                      lng: position.coords.longitude
                    };

                    map.setCenter(pos);
                    map.setZoom(13);
                }, function() 
                {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } 
            else 
            {
                handleLocationError(false, infoWindow, map.getCenter());
            }

            makeRequest("editable_map/take_json_problem.php", function(data) 
            { 
                var jsonData = JSON.parse(data.responseText);

                for (var x = 0; x < jsonData.length; x++) 
                {
                    counter++;

                    problems[counter] = [jsonData[x].problem,jsonData[x].name,jsonData[x].lastname];
                    
                    var temp = new google.maps.LatLng(jsonData[x].lat, jsonData[x].lng);
                    marker[counter] = new google.maps.Marker({ position: temp, map: map });

                    google.maps.event.addListener(marker[counter], 'click', function(event) 
                    {
                        var i;
                        for(i = 1; i <= counter; i++)
                        	if(event.latLng.lat() == marker[i].getPosition().lat() && event.latLng.lng() == marker[i].getPosition().lng())
                        		break;

						zoomAt(marker[i].getPosition().lat(), marker[i].getPosition().lng());

                        if(messagewindow != undefined)
                        messagewindow.close();

                        messagewindow = new google.maps.InfoWindow({ content: '<p>Problema</p><p id="message">' + problems[i][0] + '</p><p>Segnalato da ' + problems[i][1] + " "  + problems[i][2] + "</p>"});
                        messagewindow.open(map, marker[i]);
                    });
                }
            });

            messagewindow = new google.maps.InfoWindow({ content: document.getElementById('message') });

            google.maps.event.addListener(map, 'click', function(event) 
            {
            	if(insertMarker == true)
                {
                    if(infowindow != undefined && infowindow.getMap() != null)
                    {
                        marker[counter].setMap(null);
                        infowindow.close();
                    }
                    else
                    {
                        counter++;
                    }
                    
					if(messagewindow != undefined)
                        messagewindow.close();

                    marker[counter] = new google.maps.Marker({ position: event.latLng, map: map});

                    infowindow = new google.maps.InfoWindow({content: 
                                                             '<form id="form">'+
                                                             '<table>'+
                                                             '<tr><td><input type="text" id="problem" placeholder="Inserisci la descrizione del problema" style="width: 90%; border: 1px solid black; border-radius: 2px"/> </td> </tr>'+
                                                             '<tr><td><div id="recaptcha"></div></td></tr>'+
                                                             '<tr><td><input type="button" value="Save" onclick="saveData()"></td></tr>'+
                                                             '</table>'+
                                                             '</form>'
                                                            });

                    infowindow.open(map, marker[counter]);

                    google.maps.event.addListener(infowindow,'closeclick',function()
                                                  {
                      marker[counter].setMap(null);
                    });

                    recaptcha = grecaptcha.render("recaptcha", {
                      'sitekey' : '6LfGQkcUAAAAAOTBrw7fEVh3pMKMmgkA2JYipqWT',
                      'theme' : 'light'
                    });
                    
                    fromLatitudeToCity(marker[counter]);
                     
                }
            });
        }

        function saveData()
        {
            var problem = document.getElementById("problem").value;

            if(problem != "")
            {
            	if(grecaptcha.getResponse(recaptcha) != "")
                {
                  problems[counter] = [problem,"<?php echo $_SESSION['name']?>","<?php echo $_SESSION['lastname']?>"];

                  google.maps.event.addListener(marker[counter], 'click', function(event) 
                  {
                      var i;
                      for(i = 1; i <= counter; i++)
                          if(event.latLng.lat() == marker[i].getPosition().lat() && event.latLng.lng() == marker[i].getPosition().lng())
                              break;

                      zoomAt(marker[i].getPosition().lat(), marker[i].getPosition().lng());

                      if(messagewindow != undefined)
                          messagewindow.close();

                      messagewindow = new google.maps.InfoWindow({ content: '<h3>Problema</h3><div id="message">' + problems[i] + '</div>' });
                      messagewindow.open(map, marker[i]);
                  });

                  var latlng = marker[counter].getPosition();
                  var url = 'editable_map/insert_problem.php?problem=' + problem + '&lat=' + latlng.lat() + '&lng=' + latlng.lng() + '&response=' + grecaptcha.getResponse(recaptcha) + "&city=" + city;

				  if(city != 0)
                  {
                      downloadUrl(url, function(data, responseCode) 
                      {
                          if (responseCode == 200 && data.length <= 1) 
                          {
                              console.log("inserito");
                              
                              document.getElementById("insert-marker").style.color = "white";
                              insertMarker = false;

                              grecaptcha.reset(recaptcha);
                              infowindow.close();

                              messagewindow = new google.maps.InfoWindow({ content: '<h3>Problema</h3><div id="message">' + problems[counter] + '</div>' });
                              messagewindow.open(map, marker[counter]);
                          }
                      });
                    }
                    else
                    {
                        alert("Inserisci un luogo adatto per segnalare il problema");
                    }
                }
                else
                {
                  document.getElementById("recaptcha").style.border = "1px solid red";
                }
            }
            else
            {
            	document.getElementById("problem").style.border = "1px solid red";
            }
        }

        function downloadUrl(url, callback) 
        {
            var request = window.ActiveXObject ? new ActiveXObject('Microsoft.XMLHTTP') : new XMLHttpRequest;

            request.onreadystatechange = function() 
            {
                if (request.readyState == 4) 
                {
                    request.onreadystatechange = doNothing;
                    callback(request.responseText, request.status);
                }
            };

            request.open('GET', url, true);
            request.send(null);
        }

        function makeRequest(url, callback) 
        {
            var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

            request.onreadystatechange = function() 
            {
                if (request.readyState == 4) 
                {
                    request.onreadystatechange = doNothing;
                    callback(request, request.status);
                }
            };

            request.open('GET', url, true);
            request.send(null);
        }

        function doNothing () { }

        </script>
        <!--script src="mapMaker.js"></script-->
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAE4dEe8dPXybj2QACBJj8dbt0A2wBr8y0 &callback=initMap"></script>
        <script async defer src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=it"></script>
    </body>
</html>