class Troco
  require "bigdecimal"
  require 'bigdecimal/util'
  
  # reais: Valor em reais podendo conter centavos
  # Deve retornar um hash com a quantidadede notas
  def get_qtd_notas(reais, arrayComNotas:nil)
    qtde_notas = {
      '100': 0,
      '50': 0,
      '20': 0,
      '10': 0,
      '5': 0,
      '2': 0,
      '1': 0,
      '0.5': 0,
      '0.25': 0,
      '0.1': 0,
      '0.01': 0
    }
    if arrayComNotas.nil?
        arrayComNotas=qtde_notas
    end
    return calcular_qtde_notas(reais, arrayComNotas);
  end
  
  def calcular_qtde_notas(valor, arrayComNotas)
    valorCedulaAtual=valor.to_i
	valorCentavoAtual=valor.to_d-valorCedulaAtual.to_d
	
	arrayComNotas.each_pair do |key, value|
      valorNota=key.to_s.to_i
      if valorNota > 0
        parteInteira=valorCedulaAtual.div(valorNota)
        arrayComNotas[key]=parteInteira;
        valorCedulaAtual=valorCedulaAtual.modulo(valorNota)
      else
        dif=valorCentavoAtual-valorNota
	    cont=0
	    
      end
    end
	
    return arrayComNotas;
  end
  
end
