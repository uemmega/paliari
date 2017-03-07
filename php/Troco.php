<?php
require_once 'Util.php';
require_once 'Mensagem.php';

/**
 * Class Troco
 * Classe para calcular a quantidade de notas necessárias para um determinado valor em Reais.
 * Suporta centavos. Precisão é utilizado para trabalhar com centavos.
 */
class Troco
{
	
	 const FATOR=10000;
	 const PRECISAO=5;
	
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
    
    /**
     * Verifica se é uma cédula através do seu valor
     * 
     * @param $valor o valor a ser verificado
     * @return true se é uma cédula ou false se é centavos
     */
    public function isCedula($valor){
    	return intval($valor)>0;
    }
    
    /**
     * Função ordena o array de notas, é necessário porque a função que calcular a quantidade de notas
     * baseia-se na ordem das notas dipostas no array de notas.
     * 
     * @param $arrayComNotas array de notas
     * @return o array com os valores das notas ordenado
     */
    private function sortArrayNotas($arrayComNotas){   	
    	/*if($arrayComNotas==null)
    		return null; */   	
    	$array=array();
    	$i=0;
    	foreach ($arrayComNotas as $valorNotaStr => $qtde){
    		$array[$i++]=floatval($valorNotaStr);
    	}
    	arsort($array);
    	return $array;
    }

    /**
     * Calcula o número de notas em relação ao valor das notas no array de notas.
     * 
     * @param $valor o valor a ser verificado as notas disponíveis para ele.
     * @param $arrayComNotas o array com as notas e valores default 0 para quantidade de notas
     * @return o array de notas com o número de notas calculados em relação ao $valor
     */
    private function calcularQtdeNotas($valor, &$arrayComNotas=null)
    {
    	try {
	    	if($arrayComNotas==null)
	    		$arrayComNotas=$this->qtdeNotasDefault;	    	
	    
	    	$val=floatval($valor);	    	
	    	$valorCedulaAtual=intval($val);	    	
	    	$valorCentavoAtual=bcsub($val, $valorCedulaAtual,Troco::PRECISAO);		
	    	$array=$this->sortArrayNotas($arrayComNotas);	 
	    	foreach ($array as $valorNota){	    		    		 
	    		if($this->isCedula($valorNota)){
	    			$parteInteira=Util::parteInteira($valorCedulaAtual,$valorNota);
	    			$arrayComNotas[(string)intval($valorNota)]=$parteInteira;    			
	    			$valorCedulaAtual=Util::resto($valorCedulaAtual, $valorNota);	    			
	    		}else {
	    			//$valNotaFat=$valorNota*Troco::FATOR;
	    			//$valorCentavoAtualFat=$valorCentavoAtual*Troco::FATOR;
	    			/*$parteInteira=Util::parteInteira($valorCentavoAtualFat,$valNotaFat);
	    			if($valorCentavoAtual==0)
	    				break;
	    			$arrayComNotas[(string)$valorCentavoAtual]=$parteInteira;
	    			$valorCentavoAtual=Util::resto($valorCentavoAtualFat, $valNotaFat)/Troco::FATOR;*/
	    			
	    			$dif=bcsub($valorCentavoAtual,$valorNota,Troco::PRECISAO);
	    			$cont=0;
	    			while ($dif>=0){
	    				$cont++;    				
	    				$valorCentavoAtual=$dif;
	    				$dif=bcsub($valorCentavoAtual,$valorNota,Troco::PRECISAO);	    				
	    			}
	    			$arrayComNotas[(string)$valorNota]=$cont;
	    		}
	
	    	}
	    	
	    	if($valorCedulaAtual!=0 || ($valorCentavoAtual)!=0){
	    		print_r($arrayComNotas);
	    		throw new Exception(Mensagem::geraMensagem(Mensagem::ERRO_NAO_GEROU_CEDULAS,[$valorCedulaAtual, $valorCentavoAtual]));
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
