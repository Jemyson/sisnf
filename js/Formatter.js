Formatter = function(){
	
	this.data = function(record, coluna){
		
		var data = '';
		var tmp = record[coluna.nome]+'';
		
		if(tmp != 'null' && App.isset(tmp)){
			tmp = tmp.split('-');
			data = tmp[2]+'/'+tmp[1]+'/'+tmp[0];
		}else{
			data = '-/-/-';
		}
		
		return data;
		
	}
	
	this.dataHora = function(record, coluna){
		
		var data = '';
		var tmp = record[coluna.nome]+'';
		
		var aux = tmp.split(' ');
		
		tmp = aux[0].split('-');
		data = tmp[2]+'/'+tmp[1]+'/'+tmp[0];
		return data + ' ' +aux[1];
	
	}
	
	this.pad = function(str, max) {
		str = str.toString();
		return str.length < max ? this.pad("0" + str, max) : str;
	}
	
	this.rnd = function(n1, n2, o, cd){
		
		var num1 = n1;
		var num2 = n2;
		var op = o;
		var rn = cd;
		var res;
		
		num1 = parseFloat(num1);
		num2 = parseFloat(num2);
		
		switch(op){
			case "+" :
			res=num1+num2;
			break;
			
			case "-" :
			res=num1-num2;
			break;
			
			case "/" :
			res=num1/num2;
			break;
			
			case "*" :
			res=num1*num2;
			break;
			
			case "%" :
			res=num1%num2;
			break;
		}
		
		var rs = new Number(res);
		var lrs = rs.toFixed(rn);
		
		return lrs;
		
	}
	
	this.converteMoedaFloat = function(valor){
	      
		if(valor === ""){
	  		valor =  0;
  		}else{
	  		valor = valor.replace(".","");
     		valor = valor.replace(",",".");
     		valor = parseFloat(valor);
  		}
  		return valor;

	}
	
	this.formatReal = function(record, coluna){
		
		var data = '';
		var tmp = record[coluna.nome]+'';
		
        tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
        if( tmp.length > 6 )
                tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

        return tmp;
	}	
	
	this.formatMoedaReal = function(record, coluna){
		return Formatter.moeda(record[coluna.nome], 2,',','.');;
	}	
	
	this.moeda = function(valor, casas, separdor_decimal, separador_milhar){ 
		 
		var valorString = valor + "";
		
		var negativo = false;
		
		if(valorString[0] == '-'){
			negativo = true;
			valor = valorString.replace('-', '');
		}

		 var valor_total = parseInt(valor * (Math.pow(10,casas)));
		 var inteiros =  parseInt(parseInt(valor * (Math.pow(10,casas))) / parseFloat(Math.pow(10,casas)));
		 var centavos = parseInt(parseInt(valor * (Math.pow(10,casas))) % parseFloat(Math.pow(10,casas)));
		 
		  
		 if(centavos%10 == 0 && centavos+"".length<2 ){
		  centavos = centavos+"0";
		 }else if(centavos<10){
		  centavos = "0"+centavos;
		 }
		  
		 var milhares = parseInt(inteiros/1000);
		 inteiros = inteiros % 1000; 
		 
		 var retorno = "";
		 
		 if(milhares>0){
		  retorno = milhares+""+separador_milhar+""+retorno
		  if(inteiros == 0){
		   inteiros = "000";
		  } else if(inteiros < 10){
		   inteiros = "00"+inteiros; 
		  } else if(inteiros < 100){
		   inteiros = "0"+inteiros; 
		  }
		 }
		  retorno += inteiros+""+separdor_decimal+""+centavos;
		 
		  if(negativo == true){
			  retorno = '-'+retorno;
		  }
		 
		 return retorno;
		 
	}
	
}