module.exports =class Troco { 
  // reais: Valor em reais podendo conter centavos
  // Deve retornar um objeto com a quantidadede notas
  getQtdeNotas(reais, arrayNotas) {
	  
	  let qtdeNotas = {
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
		     '0.01': 0,
		   }
	  
	  if(arrayNotas==null)
		  arrayNotas=qtdeNotas;
	  
	  try{
		  var valorCedulaAtual=Math.trunc(reais);	 		 
	      var valorCentavoAtual=reais-valorCedulaAtual;	
	      
	      for (var valorNota in arrayNotas) {    	   
	        if(Math.trunc(valorNota)>0){
	        	var parteInteira=Math.trunc(valorCedulaAtual/valorNota);        	
	        	arrayNotas[valorNota]=parteInteira;    		        	
    			valorCedulaAtual=valorCedulaAtual%valorNota;			
	        }else{
	        	var dif=valorCentavoAtual-valorNota;
    			var cont=0;
    			while (dif>=0){
    				cont=cont+1;    				
    				valorCentavoAtual=dif;
    				dif=valorCentavoAtual-valorNota;	    				
    			}
    			arrayNotas[valorNota]=cont;
	        }
	      }
	      
	      if(valorCedulaAtual!=0 || valorCentavoAtual!=0){
	        console.log(arrayNotas);
	        throw new Error("Não foi possível gerar número de cédulas");
	      }
		  
	  }catch (e) {
		  console.log("Erro: ".e);
	  }
	  
    return arrayNotas;
  }
  
}

