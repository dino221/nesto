<?php

$numbersJson = file_get_contents(__DIR__. '/words.json');
$numbers = json_decode($numbersJson, true);

if (isset($_POST["upisite_rijec"]) && !empty($_POST["upisite_rijec"])) {
	$samoglasnici = ['a','e','i','o','u'];
	$suglasnici = ['b','c','d','f','g'];
	$word = $_POST['upisite_rijec'];
	$letterNumber = strlen($_POST["upisite_rijec"]);
	$vowels = 0;
	//$consonants = 0;
	for($i=0; $i<$letterNumber; $i++){
	    if(in_array($word[$i], $samoglasnici)) {
		$vowels++;
	    }
	   /* if(in_array($word[$i], $suglasnici)) {
		$consonants++;
	    }*/
	}
	$consonants = $letterNumber - $vowels;
	$num = ['word' => $word,
		'number_letters' => $letterNumber,
		'number_vowels' => $vowels,
		'consonants' => $consonants
	       ]; 
	$numbers[] = $num;
	$numJson = json_encode($numbers);
	$res = file_put_contents(__DIR__. '/words.json', $numJson);
}
?>

<!DOCTYPE html>
<head>
	<title>PHP OSNOVE ISPIT</title>
<head>
<body>
<h2>UPISITE ZELJENU RIJEC!</h2>


<form action = "ispit.php" method="POST">
<label>Upisite rijec:</label><br><input type = "text" name = "upisite_rijec" /><br>
<input type = "submit" value = "Posalji" /><br><br>

<table border = "1" cellpadding = "10">
	<tr>
		<th>Rijec</th>
		<th>Broj slova</th>
		<th>Broj samoglasnika</th>
		<th>Broj suglasnika</th>
	</tr>

<body>
<?php
	foreach($numbers as $number) {
		echo '<tr>';
			echo '<td>'. $number['word']. '</td>';
			echo '<td>'. $number['number_letters']. '</td>';
			echo '<td>'. $number['number_vowels']. '</td>';
			echo '<td>'. $number['consonants']. '</td>';
		echo '</tr>';
}

?>

		
</table>

</html>

