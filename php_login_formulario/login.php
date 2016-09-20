<?php  
 session_start();
 $nome = $_POST["user"];
 $senha = $_POST["senha"];
 $validar = $_POST["validar"];

 try{
      #Conexão com MySQL via PDO_MYSQL
      $DBH = new PDO("mysql:host=localhost;dbname=gomoku", "root", "");
      if(isset($validar)){
 	  $verify = $DBH->query("SELECT * FROM Usuario WHERE nome = '$nome' and senha = '".md5($senha)."'");
      $count = $verify->rowCount();
 	  if ($count > 0){
 	  	  $_SESSION['login'] = $nome;
		  $_SESSION['senha'] = $senha;
 		  header("Location:form.php");
 	  }else{
 		  unset($_SESSION['login']);
		  unset($_SESSION['senha']);
		  header('location:login.html');
 	  }
 } 
 }catch (PDOException $e) {
   	   echo $e->getMessage();
 }
?>