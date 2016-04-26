
<!DOCTYPE html>
<html>
<head>
	<title>Webservice</title>
</head>
<body>
<form method="Post">
<input type="text" name="n1">Numero 1</input>
</br>
<input type="text" name="n2">Numero 2</input>
</br>
<input type="submit" name="operacao" value="somar"></input>
<input type="submit" name="operacao" value="multiplicar"></input>
<input type="submit" name="operacao" value="dividir"></input>
</form> 
</body>
</html>
<?php
// Observacoes:
// Adicionar a extensao php_soap no php.ini

// configurando o objeto executor cliente com o endereco do servidor
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$client = new SoapClient(null, array(
	'location' => 'http://127.0.0.1/webservice01/soap/server.php',  // ex.: http://localhost/soap/server.php
	'uri' => 'http://127.0.0.1/webservice01/soap/',  				// ex.: http://localhost/soap/
	'trace' => 1));

// chamada do servico SOAP
if ($_POST['operacao'] == "somar") {
$result = $client->somar($_POST['n1'],$_POST['n2']);
}
if ($_POST['operacao'] == "multiplicar") {
$result = $client->multiplicar($_POST['n1'],$_POST['n2']);
}
if ($_POST['operacao'] == "dividir") {
$result = $client->dividir($_POST['n1'],$_POST['n2']);
}


// verifica erros na execucao do servico e exibe o resultado
if (is_soap_fault($result)){
	trigger_error("SOAP Fault: (faultcode: {$result->faultcode},
	faultstring: {$result->faulstring})", E_ERROR);
}else{
	echo "Resultado Encontrado: ";
	echo($result->valorRetorno);
	echo($result->mensagem);
}

}
?>
