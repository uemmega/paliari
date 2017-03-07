<?php
require_once 'Util.php';
require_once 'Mensagem.php';

/**
 * Class Troco
 * Classe para calcular a quantidade de notas necessárias para um determinado valor em Reais.
 * Suporta centavos.
 */
class Troco
{
	private $qtdeNotasDefault = [
          '100' => 0,
           '50' => 0,
           '20' => 0,
           '10' => 0,
            '5' => 0,
            '2' => 0,
            '1' => 0,
          '0.5' => 0,
         '0.25' => 0,
          '0.1' => 0,
         '0.01' => 0,
        ];
	
    /**
     * Dado um valor em reais, retorna a quantidade de notas necessárias para formar o troco.
     *
     * @param $reais Valor em reais, podendo conter centavos.
     * @return array Quantidade de notas, indexada pelo seu valor.
     */
    public function getQtdeNotas($reais, $arrayComNotas)
    {
    	return $this->calcularQtdeNotas($reais, $arrayComNotas);
    }
    
    private function isCedula($valor){
    	return intval($valor)>0;
    }
    
    private function sortArrayNotas($arrayComNotas){
    	$array=array();
    	$i=0;
    	foreach ($arrayComNotas as $valorNotaStr => $qtde){
    		$array[$i++]=floatval($valorNotaStr);
    	}
    	arsort($array);
    	return $array;
    }

    /**
     * Calcula o número de notas em relação ao valor das notas no array de notas. A ordem das notas
     * no array influência no cálculo.
     * 
     * @param
     * @param
     * @return
     */
    private function calcularQtdeNotas($valor, &$arrayComNotas=null)
    {
    	try {
	    	if($arrayComNotas==null)
	    		$arrayComNotas=$this->qtdeNotasDefault;	    	
	    
	    	$val=floatval($valor);
	    	$valorCedulaAtual=intval($val);
	    	$valorCentavoAtual=$val-$valorCedula;
	    	foreach ($arrayComNotas as $valorNotaStr => $qtde){	    		
	    		$valorNota=floatval($valorNotaStr);	    
	    		
	    		if($this->isCedula($valorNota)){
	    			$parteInteira=Util::parteInteira($valorCedulaAtual,$valorNota);
	    			$arrayComNotas[$valorNotaStr]=$parteInteira;    			
	    			$valorCedulaAtual=Util::resto($valorCedulaAtual, $valorNota);	    			
	    		}else {
	    			
	    		}
	
	    	}
	    	return $arrayComNotas;
	    } catch (DivisionByZeroError $dbze) {
	    	echo Mensagem::ERRO_DIVISAO_ZERO." :".$dbze;
	    	return [];
	    } catch (Exception $e) {
	    	echo Mensagem::ERRO." :".$e;
	    	return [];
    	}
    }
}
