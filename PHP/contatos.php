<?php 
	$nome = $_POST["nome"];
	$sexo = $_POST["sexo"];
	$mensagem = $_POST["Mensagem"];

	try{
      $DBH = new PDO("mysql:host=localhost;dbname=gomoku", "root", "");
  	}catch (PDOException $e) {
   	   echo $e->getMessage();
  	}

  	$comentario = "";
  	$comentario = $DBH->prepare("INSERT INTO COMENTARIO (id, nome, sexo, comentarios) VALUES (NULL, '$nome', '$sexo', '$mensagem')");
    $comentario->execute();

    $comentario = $DBH->query("SELECT * FROM COMENTARIO");
    $objetosComentario = $comentario->fetch(PDO::FETCH_OBJ);

   while($objetosComentario = $comentario->fetch(PDO::FETCH_OBJ)){
   	echo "<br>Id: ".$objetosComentario->id."<br>";
   	echo "Nome: ".$objetosComentario->nome."<br>";
   	if($objetosComentario->sexo == 1)
   		echo "Sexo: Masculino <br>";
  	else
  		echo "Sexo: Feminino <br>";
   	echo "Comentario: ".$objetosComentario->comentarios."<br>";
   }






?>