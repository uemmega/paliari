<?php 

/**
 * class Mensagem
 * Classe para mensagem informativas ou de erro.
 */
class Mensagem{
	 const SEP='@#';
	
	 const ERRO_DIVISAO_ZERO="Divisão por zero";
	 const ERRO="Erro";
	 const ERRO_NAO_GEROU_CEDULAS="Não foi possível gerar número de cédulas, sobrou ".Mensagem::SEP."0 de cédula e ".Mensagem::SEP."1 de centavos";
	 
	 
	 /**
	  * função utilizada para gerar mensagem com atributos
	  * 
	  *@param $mensagem a mensagem a ser utilizada
	  *@param $array um array com os valores dos atributos a serem substituídos na mensagem
	  */
	 public static function geraMensagem($mensagem, $array){	 	 
	 	$str=$mensagem;
	 	$i=0;
	 	foreach ($array as $attr){
	 		$str=str_replace(Mensagem::SEP.$i,$array[$i],$str);
	 		$i++;
	 	}
	 	return $str;
	 }
	
}