class Troco
  require "bigdecimal"
  require 'bigdecimal/util'
  
  # reais: Valor em reais podendo conter centavos
  # Deve retornar um hash com a quantidadede notas
  def get_qtd_notas(reais, array_com_notas:nil)
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
    if array_com_notas.nil?
        array_com_notas=qtde_notas
    end
    return calcular_qtde_notas(reais, array_com_notas);
  end
  
  def calcular_qtde_notas(valor, array_com_notas)
    begin
      valor_cedula_atual=valor.to_i
	  valor_centavo_atual=valor.to_d-valor_cedula_atual.to_d
	  array_com_notas.each_pair do |key, value|
        valor_nota=key.to_s
        if valor_nota.to_i > 0
          parte_inteira=valor_cedula_atual.div(valor_nota.to_i)
          array_com_notas[key]=parte_inteira;
          valor_cedula_atual=valor_cedula_atual.modulo(valor_nota.to_i)
        else
          dif=valor_centavo_atual-valor_nota.to_d
	      cont=0
	      while dif>=0 do
            cont=cont+1
     	    valor_centavo_atual=dif
	        dif=valor_centavo_atual-valor_nota.to_d
          end
	      array_com_notas[key]=cont;
        end
      end
	  if valor_cedula_atual!=0 || valor_centavo_atual!=0
          p array_com_notas
	      raise  Exception , "Não foi possível gerar número de cédulas, sobrou #{valor_cedula_atual} de cédula e #{valor_centavo_atual} de centavos"
	  end
      return array_com_notas;
    rescue Exception => e
      p "Erro: "+e
      return nil
    end
    
  end
  
end
