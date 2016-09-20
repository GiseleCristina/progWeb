<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
<?php
	session_start(); 
	if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
	{
		unset($_SESSION['login']);
		unset($_SESSION['senha']);
		header('location:login.html');
	}
?>
	<title> Minha primeira pagina </title>
</head>

<body>

	<h1> Este é um grande cabeçalho</h1>
	<a href="logout.php"> clique aqui </a> para fazer o logout 
	<h4> Este é um pequeno cabeçalho</h4>
	<div id = "P1">
	Aqui vai um texto aleatorio que criei aleatoriamente.
	Em seguida,  veremos uma tabela denro de um formulario.
	sem motivo algum.
	</div>
	<form method="POST" action="contatos.php" id="contato" />
		<table >
			<tr> 
				<td> Seu nome: </td> 
				<td> <input type = "text" name = "nome" id = "nome"> </td> 
			</tr>
			<tr>
				<td> Seu sexo: </td> 
				<td> <select id ="sexo" name="sexo" >
						<!--<option value="0"> Sexo </option>-->
						<option value="1"> Masculino </option>
						<option value="2"> Feminino </option>
					  </select>
				</td>
			</tr>
			<tr>
				<td> Seus comentarios: </td>
				<td> <textarea name="mensagem" ></textarea> </td>
			</tr>
			<tr>
				<td></td>
				<td> <input type ="submit"></td>
			</tr>
		</table>
	</form>
</body>
</html>
