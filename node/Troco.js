class Troco { 
	
	calcularQtdeNotas(valor, arrayNotas){
		  
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
				  valorCedulaAtual=Math.trunc(reais);	    	
			      valorCentavoAtual=valor-valorCedulaAtual;	
			      console.log(valorCedulaAtual+" "+valorCentavoAtual);
				  
			  }catch (e) {
				
			}
	}
	
  // reais: Valor em reais podendo conter centavos
  // Deve retornar um objeto com a quantidadede notas
  getQtdeNotas(reais, arrayNotas) {
	  
	  console.log("teste");
	  arrayNotas=this.calcularQtdeNotas(reais, arrayNotas);
	  console.log("teste2");
	  
    return arrayNotas
  }
  
}
module.exports =  Troco;

 
