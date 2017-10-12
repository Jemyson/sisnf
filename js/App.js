App = function(){
	
	this.count = function(obj){
		return Object.keys(obj).length;
	}
	
	this.isset = function(obj){
		if(typeof obj != 'undefined'){
			return true;
		}else{
			return false;
		}
	}
	
	this.pad = function(str, max) {
		str = str.toString();
		return str.length < max ? this.pad("0" + str, max) : str;
	}	
	
	this.isObject = function(obj){
		if( (typeof obj === "object") && (obj !== null) ){
		    return true;
		}else{
			return false;
		}
	}
	
	this.dataFormatada = function(d) {
	    var data = new Date(d),
	        dia  = data.getDate(),
	        mes  = data.getMonth() + 1,
	        ano  = data.getFullYear();
	    return [dia, mes, ano].join('/');
	}
	
	this.alertDialog = function(textoTopo, textoConteudo, sim, nao){
		
		$('#modal-top').html(textoTopo);
		$('#modal-body').html(textoConteudo);
		
		$('#modal').modal();

		$("#btnCancelar").unbind().click(function(){
	        $("#modal").modal('hide');
	    });		
		
		$("#btnConfirmar").unbind().click(function(){
			$("#modal").modal('hide');
			sim.callback();
	    });
		
	}
	
	this.alert = function(textoTopo, textoConteudo, ok){
		$('#modalSimples-top').html(textoTopo);
		$('#modalSimples-body').html(textoConteudo);
		
		$('#modalSimples').modal();

		$("#btnCancelarSimples").unbind().click(function(){
	        $("#modalSimples").modal('hide');
	        ok.callback();
	    });		
		
	}
	
}