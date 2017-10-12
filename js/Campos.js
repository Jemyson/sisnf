Campos = function(){
	
	this.carregarVazio = function(span, titulo, cssbody){
		
		var campo = '<div class="span'+span+'" style="'+cssbody+'" >';
		
		if(App.isset(titulo)){
			campo += '<label>&nbsp;</label>';
			campo += '<label>' + titulo + '</label>';
		}
		
		campo += '</div>';
		return campo;
	}
	
	this.carregarHide = function(id){
		
		var campo = '<input id="'+id+'" name="'+id+'" type="hidden" value="" />';
		return campo;
	}
	
	this.carregarLabel = function(id, span, label, disabled, classe, style, divStyle){
		
		var campo = '<div class="span'+span+'" style="'+divStyle+'">';
		
		campo += '<label>'+label+'</label>';
		campo += '<label style="font-weight: bold;" id="'+id+'" name="'+id+'" ></label>';
		campo += '</div>';
	
		return campo;
	}
	
	this.carregarLink = function(campo){
		
		var html = '<div class="span'+campo.span+'" style="'+campo.divStyle+'">';
		
		html += '<label>'+campo.titulo+'</label>';
		html += '<a style="font-weight: bold;" id="'+campo.nome+'" name="'+campo.nome+'" ></a>';
		html += '</div>';
		
		return html;
	}
	
	this.carregarText = function(campo){
		
		var html = '<div class="form-group col-md-'+campo.span+'" style="'+campo.divStyle+'">';
		
		var obrigatorio = '';
		
		if(App.isset(campo.obrigatorio) && campo.obrigatorio == '1'){
			html += '<label>'+campo.titulo+'*</label>';
			obrigatorio = 'obrigatorio="obrigatorio"';
		}else{
			html += '<label>'+campo.titulo+'</label>';
		}
		
		if(App.isset(campo.password) && campo.password == '1'){
			html += '<input '+ obrigatorio +' class="form-control '+campo.classe+'" '+campo.disabled+' type="password" style="'+campo.style+'" id="'+campo.nome+'" name="'+campo.nome+'" placeholder="'+campo.titulo+'">';
		}else{
			html += '<input '+ obrigatorio +' class="form-control '+campo.classe+'" '+campo.disabled+' type="text" style="'+campo.style+'" id="'+campo.nome+'" name="'+campo.nome+'" placeholder="'+campo.titulo+'">';
		}
		
		html += '</div>';
		
		return html;
	}
	
	this.carregarTextarea = function(campo){
		
		var html = '<div class="span'+campo.span+'">';
		
		html += '<label>'+campo.titulo+'</label>';
		html += '<textarea class="input '+campo.classe+'" '+campo.disabled+' type="text" style="'+campo.style+'" id="'+campo.nome+'" name="'+campo.nome+'" placeholder="'+campo.titulo+'"></textarea>';
		html += '</div>';
	
		return html;
	}
	
	this.carregarDateTime = function(campo){

		var html = '<div id="'+campo.nome+'_datepicker" class="input-append date span'+campo.span+'">';
		
		var obrigatorio = '';
		
		if(App.isset(campo.obrigatorio) && campo.obrigatorio == '1'){
			html += '<label>'+campo.titulo+'*</label>';
			obrigatorio = 'obrigatorio="obrigatorio"';
		}else{
			html += '<label>'+campo.titulo+'</label>';
		}
		html += '<input '+obrigatorio+' data-format="'+campo.formato+'" class="input '+campo.classe+'" '+campo.disabled+' type="text" id="'+campo.nome+'" name="'+campo.nome+'" placeholder="'+campo.label+'"></input>';
		html += '<span class="add-on">';
		html += '<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>';
		html += '</span>';
		html += '</div>';
		
		html += '<script type="text/javascript">';
		html += '$(function() {';
		html += '$("#'+campo.nome+'_datepicker").datetimepicker({'+campo.opcoes+'});';
		html += '});';
		html += '</script>';			
		
		
		return html;
	}
	
	this.carregarSelect = function(campo, dados){
		
		var data = jQuery.parseJSON(dados);
		
		var html = '<div class="span'+campo.span+'">';
		
		var obrigatorio = '';
		
		var entidade = '';
		
		if(campo.tipo == 'entidade'){
			entidade = 'entidade="entidade"';
		}
		
		if(App.isset(campo.obrigatorio) && campo.obrigatorio == '1'){
			html += '<label>'+campo.titulo+'*</label>';
			obrigatorio = 'obrigatorio="obrigatorio"';
		}else{
			html += '<label>'+campo.titulo+'</label>';
		}
		
		if(App.isset(campo.carregaDependente)){
			form.carregarDependencia('teste', 'testando');
			html += '<select '+obrigatorio+' '+entidade+' class="'+campo.classe+'" '+campo.disabled+' id="'+campo.nome+'" name="'+campo.nome+'" >';
		}else{
			html += '<select '+obrigatorio+' '+entidade+' class="'+campo.classe+'" '+campo.disabled+' id="'+campo.nome+'" name="'+campo.nome+'" >';
		}
		
		
		if(!App.isset(campo.dependencia)){
			
			html += '<option value="-1"> - - Selecione um &Iacute;tem - - </option>';
			
			for(var x = 0; x < App.count(data); x++){
				html += '<option value="'+data[x].id+'">'+data[x].valor+'</option>';
			}
			
		}else{
			html += '<option value="0"> Nenhum(a) ' + campo.dependencia + ' selecionado(a) </option>';
		}
		
		html += '</select>';
		html += '</div>';

		return html;
		
	}
	
	this.carregarCheckbox = function(id, span, label, disabled, classe, titulo, style, divStyle){
		
		var campo = '<div class="span'+span+'" style="'+divStyle+'">';

		campo += '<label>'+titulo+'</label>';
		campo += '<label class="checkbox">';
		campo += '<input type="checkbox" style="'+style+'" id="'+id+'" name="'+id+'"> ' + label;
		campo += '</label>';
		campo += '</div>';
		
		return campo;
	}
	
	this.carregarMultiCheckbox = function(id, label, elementos, divStyle){
		
		var data = jQuery.parseJSON(elementos);
		
		var campo = '<div class="container" style="'+divStyle+'">';
		
		campo += '<div style="padding-left: 20px; padding-right: 20px">';
		
		campo += '<table class="table table-striped">';

		campo += '<thead><tr style="background: #F3F3F3"><th style="text-align: center; width: 150px">Liberar Acesso</th><th style="text-align: left">'+label+'</th></tr></thead>';
		
		for(var x = 0; x < App.count(data); x++){
			if(data[x].id == 0){
				campo += '<tr>';
				campo += '<td colspan="2" style="text-align: left; background: #0088CC; color: #fff"><i class="icon-folder-open icon-white"></i>&nbsp;'+data[x].nome+'</td>';
				campo += '</tr>';
			}else{
				campo += '<tr>';
				campo += '<td style="text-align: center; width: 50px"><input name="'+id+'[]" value="'+id+'_'+data[x].id+'" type="checkbox" /></td>';
				campo += '<td style="text-align: left">'+data[x].nome+'</td>';
				campo += '</tr>';
			}
		}
		
		campo += '</table>';
		
		campo += '</div>';
		
		campo += '</div>';
		
		return campo;
	}
	
	this.carregar = function(id, span, label, disabled, classe){
		
		var campo = '<div class="span'+span+'">';
		
		campo += '<label>'+label+'</label>';
		campo += '<label><strong>Campo desconhecido</strong></label>';
		campo += '</div>';
	
		return campo;
	}
	
}