Form = function(nome, opcoes){
	
	this.basePath = opcoes.basePath;
	
	this.pk = opcoes.pk;
	this.url = opcoes.url;
	this.html = '';
	this.opcoes = opcoes;
	this.form = opcoes.form;
	this.nome = nome;
	this.modelo = opcoes.modelo;
	this.colunas = (eval(opcoes.colunas));
	this.acoes = (opcoes.acoes != null ? opcoes.acoes : true);
	this.botoes = opcoes.botoes;
	
	this.entidades = [];
	this.entidadeCampo = [];
	this.entidadesPai = [];
	
	this.addHtml = function(html){
		this.html += html;
	};
	
	this.validarCampoObrigatorio = function(){
		var erro = 0;
		
		$('input[obrigatorio=obrigatorio]').each(function(){
			
			if(!App.isset($(this).val()) || $(this).val() == ''){
				erro = 1;
				$(this).parent().addClass( "control-group error" );
				$(this).parent().css("color", "#b94a48");
			}else{
				$(this).parent().removeClass( "control-group error" );
				$(this).parent().css("color", "");
			}
			
		});
		
		$('select[obrigatorio=obrigatorio]').each(function(){
			
			console.log(this);
			console.log($(this).val());
			
			if(!App.isset($(this).val()) || $(this).val() == '-1' || ($(this).val() == '0' && App.isset($(this).attr('entidade')) )){
				erro = 1;
				$(this).parent().addClass( "control-group error" );
				$(this).parent().css("color", "#b94a48");
			}else{
				$(this).parent().removeClass( "control-group error" );
				$(this).parent().css("color", "");
			}
			
		});
		
		if(erro != 0){
			return false;
		}else{
			return true;
		}
		
	}
	
	this.salvar = function(){

		var _this = this;
		
		_this.reset();
		
		$('.salvar').hide();
		$('.disabled').show();
		
		if(this.validarCampoObrigatorio()){
			
			jQuery.ajax({
				type:'POST',
				global:true,
				url:_this.opcoes.salvar,
				dataType:'json',
				data:$('#form_'+_this.modelo).serialize(),
				success: function(data){
					
					_this.reset();
					
					$('.btn-primary').show();
					$('.disabled').hide();
					
					if(data.error == '1'){
						$('#divError').show();
						$('#divError').html(data.msg);
					}else{
						$('#divSuccess').show();
						$('#divSuccess').html(data.msg + ' <a style="cursor: pointer" onclick="javascript:form.novo()">clique aqui</a> para inserir um novo registro.</a>');
					}
					
				},
				failure: function(){
				}
			});
			
		}else{

			alert("Os Campos em vermelho sao obrigatorios.");
			$('.salvar').show();
			$('.disabled').hide();
			
		}
		
	
	}
	
	this.novo = function(){
		window.location = this.opcoes.form;
	}
	
	this.voltar = function(){
		window.location = this.opcoes.voltar;
	}
	
	this.reset = function(){
		$('#divError').hide();
		$('#divSuccess').hide();
	}
	
	this.criarFormulario = function(){
	
		Campos = new Campos();
		
		this.addHtml('<p id="divSuccess" class="bg-success" style="padding: 15px; display: none"></p>');
		this.addHtml('<p id="divError" class="bg-danger" style="padding: 15px; display: none"></p>');
		
		this.addHtml('<form id="form_'+this.modelo+'">');
		
		this.addHtml(Campos.carregarHide('hash'));
		
		this.addHtml('<div class="row">');
		
		for(var i = 0; i < this.colunas.length; i++) {

			campo = this.colunas[i];
			
			if(campo.tipo == 'linha'){
				
				this.addHtml('</div><div class="row">');
				
			}else{
				
				if(!campo.disabled){
					campo.disabled = '';
				}
				
				if(!campo.classe){
					campo.classe = '';
				}

				switch(campo.tipo) {
					case 'vazio':
						this.addHtml(Campos.carregarVazio(campo.span, campo.titulo, campo.cssbody));
						break;
				
					case 'hide':
						this.addHtml(Campos.carregarHide(campo.nome));
						break;
				
					case 'label':
						this.addHtml(Campos.carregarLabel(campo.nome, campo.span, campo.titulo, campo.disabled));
						break;
						
					case 'link': 
						//this.addHtml(Campos.carregarText(campo.nome, campo.span, campo.titulo, campo.disabled, campo.classe, campo.style, campo.divStyle));
						this.addHtml(Campos.carregarLink(campo));
						break;
				
					case 'text': 
						//this.addHtml(Campos.carregarText(campo.nome, campo.span, campo.titulo, campo.disabled, campo.classe, campo.style, campo.divStyle));
						this.addHtml(Campos.carregarText(campo));
						break;
						
					case 'textarea':
						//this.addHtml(Campos.carregarTextarea(campo.nome, campo.span, campo.titulo, campo.disabled, campo.classe));
						this.addHtml(Campos.carregarTextarea(campo));
						break;
						
					case 'select':	
						this.addHtml(Campos.carregarSelect(campo, campo.dados));
						break;
						
					case 'check':
						this.addHtml(Campos.carregarCheckbox(campo.nome, campo.span, campo.titulo, campo.disabled, campo.classe, campo.label, campo.style, campo.divStyle));
						break;
						
					case 'uf':
						var estados = '[ {"id":"AC", "valor":"Acre"}, {"id":"AL", "valor":"Alagoas"}, {"id":"AM", "valor":"Amazonas"}, {"id":"AP", "valor":"Amap&aacute;"}, {"id":"BA", "valor":"Bahia"}, {"id":"CE", "valor":"Cear&aacute;"}, {"id":"DF", "valor":"Distrito Federal"}, {"id":"ES", "valor":"Esp&iacute;rito Santo"}, {"id":"GO", "valor":"Goi&aacute;s"}, {"id":"MA", "valor":"Maranh&atilde;o"}, {"id":"MT", "valor":"Mato Grosso"}, {"id":"MS", "valor":"Mato Grosso do Sul"}, {"id":"MG", "valor":"Minas Gerais"}, {"id":"PA", "valor":"Par&aacute;"}, {"id":"PB", "valor":"Para&iacute;ba"}, {"id":"PR", "valor":"Paran&aacute;"}, {"id":"PE", "valor":"Pernambuco"}, {"id":"PI", "valor":"Piau&iacute;"}, {"id":"RJ", "valor":"Rio de Janeiro"}, {"id":"RN", "valor":"Rio Grande do Norte"}, {"id":"RO", "valor":"Rond&ocirc;nia"}, {"id":"RS", "valor":"Rio Grande do Sul"}, {"id":"RR", "valor":"Roraima"}, {"id":"SC", "valor":"Santa Catarina"}, {"id":"SE", "valor":"Sergipe"}, {"id":"SP", "valor":"S&atilde;o Paulo"}, {"id":"TO", "valor":"Tocantins"} ]';
						this.addHtml(Campos.carregarSelect(campo, estados));
						break;
						
					case 'datetime':	
						this.addHtml(Campos.carregarDateTime(campo));
						break;
						
					case 'entidade':
						this.entidades.push(campo);
						this.entidadeCampo[campo.nome] = campo;
						if(App.isset(campo.filho)){
							this.entidadesPai.push(campo);
						}
						this.addHtml(Campos.carregarSelect(campo, '{}'));
						break;
						
					case 'checkEntidade':
						this.addHtml(Campos.carregarMultiCheckbox(campo.nome, campo.titulo, campo.dadosEntidade, campo.divStyle));
						break;
						
					default:
						this.addHtml(Campos.carregar(campo.nome, campo.span, campo.titulo, campo.disabled, campo.classe));
						break;
				}
				
			}
			
		}
		
		this.addHtml('</div>');
		
		this.addHtml('<hr>');
		
		if(!App.isset(this.opcoes.visualizar)){
			
			this.addHtml('<a type="button" href="javascript:form.salvar()" class="btn btn-lg btn-primary salvar"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Salvar</a>');
			this.addHtml('<button style="display: none" type="button" class="btn btn-lg btn-primary disabled"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> aguarde...</button>');
			this.addHtml('&nbsp;');
			
		}
		
		if(!App.isset(this.opcoes.desabilitarVoltar)){
			
			this.addHtml('<a class="btn btn-lg btn-default" href="javascript:form.voltar()">Voltar <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span></a>');
			
		}
		
		this.addHtml('</form>');
		
		$('#divHTML').html(this.html);
		
	}
	
	this.limparCamposEntidade = function(campo){
		
		$('#'+campo.nome).html('<option>'+this.entidadeCampo[campo.dependencia].titulo+' n&atilde;o informado(a)');
		
		if(App.isset(campo.filho)){
			this.limparCamposEntidade(this.entidadeCampo[campo.filho]);
		}
		
	}
	
	this.carregarCampoEntidade = function(campo){
		
		if(!App.isset(campo.dependencia)){
			
			jQuery.ajax({
				type:'POST',
				global:true,
				url:campo.carregaDadosEntidade+'/dados-entidade',
				async: false,
				dataType:'json',
				data:'',
				success: function(data){
					
					var select = '<option value="0">- - Selecione um &iacute;tem - -</option>';
					
					for(var x = 0; x < App.count(data); x++){
						select += '<option value="'+data[x].id+'">'+data[x].valor+'</option>';
					}
					
					$('#'+campo.nome).html(select);
					
				},
				failure: function(){
				}
			});
			
		}

	}
	
	this.carregarCampoDependencia = function(obj, campoObj, dados){

		if(App.isset(obj) && !App.isset(campoObj)){
			
			campoPai = this.entidadeCampo[obj.currentTarget.id];
			
			valorPai = $('#'+campoPai.nome+' option:selected').val();
			
			campo = this.entidadeCampo[campoPai.filho];
		
		}else{
			
			campoPai = campoObj;
			
			valorPai = $('#'+campoPai.nome+' option:selected').val();
			
			campo = this.entidadeCampo[campoPai.filho];
			
		}
		
		this.limparCamposEntidade(campo);
		
		if(valorPai != 0 && valorPai > 0){
			
			$('#'+campo.nome).html('<option>Carregando...</option>');
			
			jQuery.ajax({
				type:'POST',
				global:true,
				url:campo.carregaDadosEntidade+'/dados-entidade',
				async: false,
				dataType:'json',
				data:'valorPai='+valorPai,
				success: function(data){
					
					var select = '';
					
					if(App.count(data) > 0){

						select = '<option value="0">- - Selecione um &iacute;tem - -</option>';
						
						for(var x = 0; x < App.count(data); x++){
							
							if(App.isset(dados)){
								
								if(App.isset(dados[campo.nome]) && data[x].id == dados[campo.nome]){
									select += '<option value="'+data[x].id+'" selected="selected">'+data[x].valor+'</option>';
								}else{
									select += '<option value="'+data[x].id+'">'+data[x].valor+'</option>';
								}
								
							}else{
								select += '<option value="'+data[x].id+'">'+data[x].valor+'</option>';
							}
							
							
						}
						
					}else{
						select = '<option value="0">Nenhum &iacute;tem encontrado</option>';
					}
					
					$('#'+campo.nome).html(select);
					
				},
				failure: function(){
				}
			});
			
		}
			
		
	}
	
	this.carregarCamposEntidade = function(){

		var _this = this;
		
		if(App.count(_this.entidades) > 0){
			
			for(var x = 0; x < App.count(_this.entidades); x++){
				
				_this.carregarCampoEntidade(_this.entidades[x]);
				
			}
			
		}

		if(App.count(_this.entidadesPai) > 0){
			
			for(var y = 0; y < App.count(_this.entidadesPai); y++){
				
				campo = _this.entidadesPai[y];
				
				$('#'+campo.nome).change(function(obj){
					
					_this.carregarCampoDependencia(obj);
					
				});
				
			}
			
		}
	
		
	}
	
	this.load = function(){
		
		var _this = this;
		
		jQuery.ajax({
		    type:'POST',
		    global:true,
		    url:_this.url,
		    async: false,
		    dataType:'json',
		    data:_this.data,
		    success: function(data){

		    	$('#hash').val(data.hash);
		    	$('#'+_this.pk).val(data.codigo);

		    	if(App.isset(data.registrosDefault)){
		    		
		    		for(var i = 0 ; i < _this.colunas.length ; i++) {
		    			
		    			registro = _this.colunas[i];
		    			
		    			if(registro.tipo != 'linha' && registro.tipo != 'vazio' && registro.tipo != 'entidade'){
		    			
		    				if(registro.tipo == 'check'){
		    					
			    				if(App.isset(data.registrosDefault[registro.nome])){
			    				
			    					if(data.registrosDefault[registro.nome] == 'S' || data.registrosDefault[registro.nome] == '1'){

			    						$('#'+registro.nome).attr("checked",true);
			    						
			    					}
			    					
			    				}
			    				
		    				}else{
			    				
			    				if(App.isset(data.registrosDefault[registro.nome])){
			    					
			    					$('#'+registro.nome).val(data.registrosDefault[registro.nome]);
			    					
			    				}
			    				
			    			}
		    				
		    			}else if(registro.tipo == 'entidade'){
		    				
		    				if(App.isset(data.registrosDefault[registro.nome])){
		    					//console.log(registro.nome + ' - ' + data.registros[registro.nome]);
		    					$('#'+registro.nome).val(data.registrosDefault[registro.nome]);
		    				}
		    				
		    				if(App.isset(_this.entidadeCampo[registro.nome].filho) && App.isset(data.registrosDefault[registro.nome])){
		    					_this.carregarCampoDependencia(null, _this.entidadeCampo[registro.nome], data.registrosDefault);
		    				}
		    				
		    			}
		    				
		    		}
		    		
		    	}
		    	
		    	if(App.isset(data.registros)){

		    		for(var i = 0 ; i < _this.colunas.length ; i++) {
		    			
		    			registro = _this.colunas[i];
		    			
		    			if(registro.tipo != 'linha' && registro.tipo != 'vazio' && registro.tipo != 'entidade'){
		    			
		    				if(registro.tipo == 'check'){
		    					
			    				if(App.isset(data.registros[registro.nome])){
			    				
			    					if(data.registros[registro.nome] == 'S' || data.registros[registro.nome] == '1'){

			    						$('#'+registro.nome).attr("checked",true);
			    						
			    					}
			    					
			    				}
			    				
		    				}else if(registro.tipo == 'checkEntidade'){
		    					
		    					if(App.count(data.registros[registro.nome]) > 0){
		    						
		    						dados = data.registros[registro.nome];
		    						
		    						for(var x = 0; x < App.count(dados); x++){
		    							
		    							$('input[value='+registro.nome+'_'+dados[x]+']').attr("checked",true);
		    							
		    						}
		    						
		    					}
		    				
		    				} else if(registro.tipo == 'label'){	
		    					
		    					$('#'+registro.nome).html(data.registros[registro.nome]);
		    					
			    			}else{
			    				
			    				if(App.isset(data.registros[registro.nome])){
			    					
			    					if(registro.funcaoFormatter){

			    						var formatter = (eval(registro.funcaoFormatter));
					        			dado = formatter(data.registros, registro);
					        			$('#'+registro.nome).val(dado);
			    						
			    					}else{
			    						
			    						$('#'+registro.nome).val(data.registros[registro.nome]);
			    					
			    					}
			    					
			    				}
			    				
			    			}
		    				
		    			}else if(registro.tipo == 'entidade'){
		    				
		    				if(App.isset(data.registros[registro.nome])){
		    					//console.log(registro.nome + ' - ' + data.registros[registro.nome]);
		    					$('#'+registro.nome).val(data.registros[registro.nome]);
		    				}
		    				
		    				if(App.isset(_this.entidadeCampo[registro.nome].filho) && App.isset(data.registros[registro.nome])){
		    					_this.carregarCampoDependencia(null, _this.entidadeCampo[registro.nome], data.registros);
		    				}
		    				
		    			}
		    				
		    		}
		    		
		    	}
		    	
		    },
		    failure: function(){
		    }
		});
		
	}
	
}