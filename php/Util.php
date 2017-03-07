<?php 

/**
 * class Util
 * classe que contém métodos úteis
 */

class Util{
	
	
	/**
	 * Calcula e retorna o resto de uma divisão
	 *
	 * @param $numerador O numerador da divisão
	 * @param $denominador O denominador da divisão
	 * @return resto da divisão 
	 */
	public static function resto($numerador, $denominador){
		return $numerador % $denominador;
	}
	
	/**
	 * Calcula e retorna a parte inteira de uma divisão
	 *
	 * @param $numerador O numerador da divisão
	 * @param $denominador O denominador da divisão
	 * @return a parte inteira do quociente da divisão
	 */
	public static function parteInteira($numerador, $denominador){		
		return intval($numerador / $denominador);
	}
	
}