<?
		$username = "civfix@localhost";
		$pasword = "cigragudka49";
		$host = "localhost";
		$database = "my_civfix";
     
      	$db = mysql_connect($host, $username, $pasword) or die("Errore durante la connessione al database");
      	mysql_select_db($database, $db) or die("Errore durante la selezione del database");


$risultato = mysql_query("SELECT * FROM problema");

while ($riga = mysql_fetch_array($risultato, MYSQL_NUM)) {
    echo $riga[0]." ";
    echo $riga[1]." ";
    echo $riga[2];
    echo $riga[4]." ";
    echo $riga[5]." ";
    echo $riga[6]." ";
    echo $riga[7]." ";
    echo $i++;
}

mysql_free_result($risultato);

?>