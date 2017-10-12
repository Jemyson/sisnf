Grid = function(nome, opcoes){
	
	this.url = opcoes.url;
	this.html = '';
	this.opcoes = opcoes;
	this.form = opcoes.form;
	this.nome = nome;
	this.modelo = opcoes.modelo;
	this.colunas = (eval(opcoes.colunas));
	this.dados = null;
	this.acoes = (opcoes.acoes != null ? opcoes.acoes : true);
	this.botoes = opcoes.botoes;
	this.formatter = opcoes.formatter;
	this.formatterDados = {};
	
	this.addHtml = function(html){
		this.html += html;
	};
	
	this.novo = function() {
		window.location = this.form;
	};
	
	this.ver = function(id) {
		window.location = this.form+'-visualizar?id='+id;
	};
	
	this.alterar = function(id) {
		window.location = this.form+'?id='+id;
	};
	
	this.excluir = function(id, dado) {
		
		var _this = this;
		
		var top = 'Confirmar a exclus&atilde;o?';
		var body = 'O registro ['+dado+'] n&atilde;o poderar ser recuperado. Confirmar exclus&atilde;o?';
		
		var success = function(response) {
			if(response.response == 0) {
				//_this.load();
				//Kapane.windowAlert('Registro Exclu&iacute;do','check','Registro exclu&iacute;do com sucesso!');
				App.alert('Registro Exclu&iacute;do', 'Registro exclu&iacute;do com sucesso!', {callback:function(){_this.load()}});
			} else {
				//_this.load();
				//Kapane.windowAlert('Erro','warning','Ocorreu um erro na exclus&atilde;o');
				App.alert('Erro', 'Ocorreu um erro na exclus&atilde;o', function(){});
			}
		};
		
		var nao = {label:'Cancelar',callback:function(){}};
		var sim = {label:'Ok',callback:function(){jQuery.ajax({
		    type:'POST',
		    global:true,
		    url:_this.opcoes.excluir,
		    dataType:'json',
		    data:_this.opcoes.pk + '=' + id,
		    failure: function(){
		    }
		}).done(function(data){
			success(data);
		});}};
		
		App.alertDialog(top, body, sim, nao);
		
	};
	
	this.clear = function() {

		var table = this.getTable();
		var rows = table.getElementsByTagName('tr');
		while(rows.length > 0){
			table.deleteRow(0);
		}
	};
	
	this.reset = function() {
		
		var table = this.getTable();
		var rows = table.getElementsByTagName('tr');
		while(rows.length > 0){
			table.deleteRow(0);
		}
	    var newRow = table.insertRow(rows.length);
	    var newCell = newRow.insertCell(0);
	    var colspan = this.colunas.length + (this.botoes ? 1 : 0);
	    newCell.setAttribute('colspan', colspan); 
	    newCell.colspan = colspan;
	    newCell.setAttribute('align', 'center');
	    newCell.innerHTML = '<div class="centering text-center" style="margin-top:100px;min-height:150px"><img src="'+this.opcoes.basePath+'img/ajax-loader.gif" /></div>';
	};
	
	this.pagina = function(pagina) {
		
		this.data = (this.data == null ? {} : this.data);
		this.data.pagina = pagina;
		jQuery.cookies.set(this.modelo+'_grid', this.data);		
		
		this.load(true);
	};
	
	this.sort = function(col) {
		
		if(this.opcoes.colunaordenar != col) {
			this.opcoes.colunaordenar = col;
			this.opcoes.direcaoordenar = 'ASC';
		} else {
			if(this.opcoes.direcaoordenar == 'ASC') {
				this.opcoes.direcaoordenar = 'DESC';
			} else {
				this.opcoes.direcaoordenar = 'ASC';
			}
		}
		
		for(var i = 0; i < this.colunas.length; i++) {
	        var style_order = '10px 10px';
	        if(this.opcoes.colunaordenar == this.colunas[i].nome) {
	        	if(this.opcoes.direcaoordenar == 'ASC'){
	        		style_order = '-3px -16px'; 
	        	} else if(this.opcoes.direcaoordenar == 'DESC') {
	        		style_order = '-68px -16px';
	        	} else {
	        		style_order = '-3px -16px';
	        	}
	        }
	        jQuery('#kapane-grid-cell-icon-'+this.nome+'-'+this.colunas[i].nome).css('background-position', style_order); 
		}
		
		this.load();
	};

	this.novoFormatter = function() {
		
		var botoes = '';
		for(var i = 0 ; i < this.botoes.length ; i++) {
			if(this.botoes[i] == 'i'){
				botoes += '<div class="btn-group pull-right">';
				botoes += '<a class="btn btn-success" onclick="grid.novo()" ><i class="icon-plus-sign icon-white"></i> NOVO</a>';
				botoes += '</div>';
			}
		}
		return botoes;
		
	};
	
	this.acoesFormatter = function(record) {
		
		var botoes = '';
		if(this.opcoes.pk) {
			for(var i = 0 ; i < this.botoes.length ; i++) {
				if(this.botoes[i] == 'v'){
					botoes+='<a class="btn btn-info" href="javascript:grid.ver(\''+record[this.opcoes.pk]+'\')"><i class="icon-search icon-white"></i></a>';
				}
				if(this.botoes[i] == 'a'){
					botoes+='&nbsp;<a class="btn btn-warning" href="javascript:grid.alterar(\''+record[this.opcoes.pk]+'\')"><i class="icon-pencil icon-white"></i></a>';
				}
				if(this.botoes[i] == 'e') {
					if(this.excluirCol == null) {
						var z = 0;
						for(var c in record) {
							if(z == 1) {
								this.excluirCol = c;
								break;
							}
							z++;
						}
					}
					var valor = record[this.excluirCol];
					for(var x = 0 ; x < this.colunas.length ; x++) {
						if(this.colunas[x].nome == this.excluirCol && this.colunas[x].formatter) {
		        			var formatter = (eval(this.colunas[x].formatter));
		        			valor = formatter(record,this.colunas[x]);
							break;
						}
					}
					botoes+='&nbsp;<a class="btn btn-danger" href="javascript:grid.excluir(\''+record[this.opcoes.pk]+'\',\''+valor+'\')"><i class="icon-trash icon-white"></i></a>';
				}
			}
		}
		return botoes;
	};
	
	this.getTable = function(){
		
		return document.getElementById('tabela_' + this.nome).getElementsByTagName('TBODY')[0];
	};	
	
	this.createRow = function() {
		
		var table = this.getTable();
		var row = table.insertRow(table.rows.length);
		
		return row;
	};	
	
	this.createCell = function(row) {
		
		var cell = row.insertCell(row.length);
		return cell;
	};
	
	this.showSelectedFilter = function() {
		
		if(App.count(this.opcoes.filtros) > 0) {
			var ret = [];
			var count = 1;
			var filtros = this.getFilters();
			for(var x in filtros) {
				for(var i = 0 ; i < filtros[x].length ; i++) {
					ret.push(count+'. '+this.formatFilter(filtros[x][i])+" - <a onClick=\"grid.removeFilter('"+x+"',"+i+")\" style=\"cursor:pointer\">excluir</a>");
					count++;
				}
			}
			document.getElementById('grid_filtro_selected_'+this.nome).innerHTML = ret.join(' <span style="font-size:13px">|</span> ') + (ret.length > 0 ? '<br><br>' : '');
		}
	};
	
	this.formatFilter = function(str) {
		
		var pattern = null;
		var filters = ['LIKE','!=','=','>','<','BETWEEN','IS NULL'];
		var descriptions = ['cont&eacute;m','diferente de','igual a','maior que','menor que','entre','N&atilde;o Definido(a)'];
		var expressions = [/.*\sLIKE\s.*/,/.*\s\!=\s.*/,/.*\s=\s.*/,/.*\s>\s.*/,/.*\s<\s.*/,/.*\sBETWEEN\s.*/,/.*\sIS\sNULL\s.*/];
		
		var arr = null;
		var lower = new RegExp(/LOWER\(.*\)/);
		var likei = new RegExp(/^'[^%]+%'$/);
		var likef = new RegExp(/^'%[^%]+'$/);
			
		for(var i = 0 ; i < filters.length ; i++) {
			pattern = new RegExp(expressions[i]);
			if(pattern.test(str)) {

				tmp = str.split(' ');
				
				arr = [tmp[0],tmp[1],str.substr((tmp[0]+' '+tmp[1]).length,str.length).trim()];
				
				arr[0] = arr[0].substr(arr[0].indexOf('.') + 1, arr[0].length); 
				
				arr[1] = descriptions[i];

				if(filters[i] != 'IS NULL') {
				
					if(lower.test(arr[0])) {
						
						arr[0] = arr[0].replace('LOWER(','').replace(')','');
						
						if(likei.test(arr[2])) {
							
							arr[1] = 'inicia com';
							
						} else if(likef.test(arr[2])) {
							
							arr[1] = 'termina com';
						}
					}
					
					if(this.opcoes.filtros[arr[0]].tipo == 'texto') {
					
						if(filters[i] == 'LIKE') {
	
							arr[2] = arr[2].replace(/'%/g,'').replace(/%'/g,'').replace(/\'/g,'');
							
						} else {
							
							arr[2] = arr[2].replace(/''/g,'�').replace(/'/g,'').replace(/�/g,'\'');
						}
					
					} else if(this.opcoes.filtros[arr[0]].tipo == 'data') {
	
						if(filters[i] == 'BETWEEN') {
							
							tmp = arr[2].split(' ');
							
							tmp[0] = tmp[0].replace(/'/g,'').split('-').reverse().join('/');
							tmp[1] = 'e';
							tmp[2] = tmp[2].replace(/'/g,'').split('-').reverse().join('/');

							arr[2] = tmp.join(' '); 
							
						} else {
							arr[2] = arr[2].replace(/'/g,'').split('-').reverse().join('/');
						}
						
					} else if(this.opcoes.filtros[arr[0]].tipo == 'combo') {
						
						var filtrosDados = this.opcoes.filtrosDados[arr[0]];
						for(var x = 0 ; x < filtrosDados.length ; x++) {
							if(filtrosDados[x].id == arr[2]) {
								arr[2] = filtrosDados[x].value;
							}
						}
					}
					
				} else {
					
					arr[2] = '';
				}

				arr[0] = '<strong>'+ this.opcoes.filtros[arr[0]].titulo +'</strong>';
				arr[1] = '<font color="blue"><i>'+ arr[1] + '</i></font>';
				arr[2] = '<strong>'+ arr[2] +'</strong>'; 
				str = arr.join(' ');	
			}
		}
		
		return str;
	};
	
	this.changeOperator = function(operator, tipo, campo) {

		if(operator == 'NULL') {
		
			document.getElementById('grid_campo').innerHTML = '';
					
		} else {
			
			if(tipo == 'data') {
				
				document.getElementById('grid_campo').innerHTML = '&nbsp;' + grid.operatorField(tipo, operator, campo);
						
			} else if(document.getElementById('grid_campo').innerHTML == '') {
				
				document.getElementById('grid_campo').innerHTML = grid.operatorField(tipo, operator, campo);
			}
			
			this.carregarScriptData();
		}
	};
	
	this.operatorFilter = function(tipo, campo) {
		
		var operator = '&nbsp;<select id="id_filtro_operador" onChange="grid.changeOperator(this.options[this.selectedIndex].value, \''+tipo+'\', \''+campo+'\')">';
		
		if(tipo == 'combo')  {

			operator+= '<option value="=">Igual</option>';
			operator+= '<option value="!=">Diferente</option>';
			operator+= '<option value="NULL">N&atilde;o Definido(a)</option>';
				   
		} else if(tipo == 'numero') {
			
			operator+= '<option value="=">Igual</option>';
			operator+= '<option value=">">Maior</option>';
			operator+= '<option value="<">Menor</option>';
			operator+= '<option value="!=">Diferente</option>';
			operator+= '<option value="NULL">N&atilde;o Definido(a)</option>';
			
		} else if(tipo == 'data')   {

			operator+= '<option value="=">Igual</option>';
			operator+= '<option value="!=">Diferente</option>';
			operator+= '<option value="BETWEEN">Entre</option>';
			operator+= '<option value=">">Maior</option>';
			operator+= '<option value="<">Menor</option>';
			operator+= '<option value="NULL">N&atilde;o Definido(a)</option>';
			
		} else if(tipo == 'texto')  {

			operator+= '<option value="LIKE">Cont&eacute;m</option>';
			operator+= '<option value="=">Igual</option>';
			operator+= '<option value="!=">Diferente</option>';
			operator+= '<option value="LIKEI">Inicia Com</option>';
			operator+= '<option value="LIKEF">Termina Com</option>';
			operator+= '<option value="NULL">N&atilde;o Definido(a)</option>';
		}

		operator+= '</select>';
		
		return operator;
	};
	
	this.carregarScriptData = function(){
		
		$("#data_datepicker").datetimepicker({
			pickTime: false
		});
		$("#data1_datepicker").datetimepicker({
			pickTime: false
		});
		$("#data2_datepicker").datetimepicker({
			pickTime: false
		});
		
	}
	
	this.operatorField = function(tipo, operador, campo) {
		
		var field = '';
		
		var keyPressField = "if(event.which || event.keyCode){if ((event.which == 13) || (event.keyCode == 13)) {document.getElementById('adicionar_filtro').click()}}";
		
		if(tipo == 'combo')  {

			field = '<select id="'+ campo +'">';
			filtrosDados = this.opcoes.filtrosDados[campo];
			for(var i = 0 ; i < filtrosDados.length ; i++) {
				field+= '<option value="'+ filtrosDados[i].id +'">'+ filtrosDados[i].value +'</option>';
			}
			field+= '</select>';
			
		} else if(tipo == 'numero') {
			
			field = '<input id="'+ campo +'" type="text" class="kapane-grid-field-number" dir="rtl" onKeyUp="this.value=this.value.replace(/([^\-0-9])/,\'\');'+ keyPressField +'">';
			
		} else if(tipo == 'moeda') {
			
			field = '<input id="'+ campo +'" type="text" class="kapane-grid-field-money" dir="rtl" onKeyUp="this.value=Kapane.Format.money(this.value);'+ keyPressField +'">';
			
		} else if(tipo == 'data')   {

			if(operador == 'BETWEEN') {

				fiel  = '<div id="data1_datepicker" class="input-append">';
				fiel += '<input data-format="dd/MM/yyyy" class="input input-small" type="text" id="'+campo+'1" name="'+campo+'1" placeholder="Data">';
				fiel += '<span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar" class="icon-calendar"></i></span></div>';

				fiel += '&nbsp;<div id="data2_datepicker" class="input-append">';
				fiel += '<input data-format="dd/MM/yyyy" class="input input-small" type="text" id="'+campo+'2" name="'+campo+'2" placeholder="Data">';
				fiel += '<span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar" class="icon-calendar"></i></span></div>';

				field = fiel;
				
			} else {
				
				fiel  = '<div id="data_datepicker" class="input-append">';
				fiel += '<input data-format="dd/MM/yyyy" class="input input-small" type="text" id="'+campo+'" name="'+campo+'" placeholder="Data">';
				fiel += '<span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar" class="icon-calendar"></i></span></div>';

				field = fiel;
				
			}
			
		} else if(tipo == 'texto')  {

			field = '<input id="'+ campo +'" type="text" class="" onKeyUp="'+ keyPressField +'">';
		}

		return field;
	};
	
	this.getFilters = function() {
		
		var cookie = jQuery.cookies.get(this.modelo+'_grid');
		if(!cookie) {
			cookie = {};
			cookie.filtros = {};
		}
		
		var filtros = cookie.filtros;
		if(!filtros) {
			filtros = {};
		}
		return filtros; 
	};
	
	this.setFilters = function(filtros) {
		
		this.data.filtros = filtros;
		jQuery.cookies.set(this.modelo+'_grid', this.data);
	};
	
	this.removeFilter = function(filtro, item) {
		
		 var tmp = [];
		 var filtros = this.getFilters();
		 for(var x in filtros) {
			 if(x == filtro) {
				 for(var i = 0 ; i < filtros[x].length ; i++) {
					 if(i != item){
						 tmp.push(filtros[x][i]);
					 }
				 }
				 filtros[x] = tmp;
				 tmp = [];
			 }
		 }
		 this.setFilters(filtros);
		 this.load();
	};
	
	this.clearFilters = function() {
		
		this.setFilters(null);
		this.load();
	};
	
	this.addFilter = function() {

		var valor = null;
		var filtro = this.opcoes.filtros[document.getElementById('id_filtro').options[document.getElementById('id_filtro').selectedIndex].value];
		var operador = document.getElementById('id_filtro_operador').options[document.getElementById('id_filtro_operador').selectedIndex].value;
		
		var campo = filtro.campo;
		
		var types = {'text':1,'textarea':2,'checkbox':3,'radiobutton':4,'select-one':5,'texto':6,'combo':7,'data':8,'numero':9,'moeda':10};
		var tipo  = (filtro.tipo ? types[filtro.tipo] : types[input.type]);

		if(operador != 'NULL') {
			
			var input = '';		
			
			if(operador != 'BETWEEN'){
				input = document.getElementById(filtro.campo);
			}
			
			switch(tipo) {
				case 1:
					valor = input.value;
				break;
				case 2:
					valor = input.value;
				break;
				case 3:
					
				break;
				case 4:
					
				break;
				case 5:
					valor = document.getElementById(input.id).value;
				break;
				case 6:
					campo = 'LOWER('+campo+')';
					valor = document.getElementById(input.id).value;
					if(operador == 'LIKE') {
						valor = "'%"+ valor.toLowerCase().replace(/'/g,'\'\'') +"%'";
					}else if(operador == 'LIKEI') {
						operador = 'LIKE';
						valor = "'"+ valor.toLowerCase().replace(/'/g,'\'\'') +"%'";
					}else if(operador == 'LIKEF') {
						operador = 'LIKE';
						valor = "'%"+ valor.toLowerCase().replace(/'/g,'\'\'') +"'";
					} else {
						valor =  "'"+ valor.toLowerCase().replace(/'/g,'\'\'') +"'";
					}
				break;
				case 7:
					valor = document.getElementById(input.id).value;
				break;
				case 8:
					if(operador == 'BETWEEN') {
						var valor1 = document.getElementById(campo+'1').value.split('/').reverse().join('-');
						var valor2 = document.getElementById(campo+'2').value.split('/').reverse().join('-');
						valor = "'"+ valor1 +"' AND '"+ valor2 +"'"; 
					} else {
						valor = "'"+ document.getElementById(input.id).value.split('/').reverse().join('-') +"'";
					}
				break;
				case 9:
					valor = document.getElementById(input.id).value;
				break;
				case 10:
					valor = document.getElementById(input.id).value;
				break;
			}
			
			input.value = '';
			
			if(valor == 'NULL') {

				if(operador == '=') {
					operador = 'IS NULL';
				}
				
				if(operador == '!=') {
					operador = 'IS NOT NULL';
				}
				
				valor = '';
			}
			
		} else {

			operador = 'IS NULL';
			
			valor = '';
		} 

		var filtros = this.getFilters();

		if(filtros[filtro.campo] == null) {
			filtros[filtro.campo] = [];
		}
		
		tabela = (this.opcoes.filtros[filtro.campo].tabela ? this.opcoes.filtros[filtro.campo].tabela + '.' : ''); 
		
		filtros[filtro.campo].push(tabela + campo +' '+ operador +' '+ valor);
		
		this.setFilters(filtros);
		
		this.load();
	}; 
	
	this.showFilter = function(id) {

		var operador = null;
		var containerFiltros = document.getElementById('grid_filtro_registro_'+this.nome);
		
		if(id != '') {
			
			var botao = '&nbsp;<div class="btn-group"><a class="btn" id="adicionar_filtro" onClick="grid.addFilter()"><i class="icon-search"></i> Pesquisar</a></div>';
			for(var x in this.opcoes.filtros) {
				if(id == x){
					
					filtro = this.opcoes.filtros[x];
		
					containerFiltros.innerHTML = this.operatorFilter(this.opcoes.filtros[x].tipo, filtro.campo);
					
					operador = document.getElementById('id_filtro_operador').options[document.getElementById('id_filtro_operador').selectedIndex].value;
					
					containerFiltros.innerHTML+= '<span id="grid_campo">&nbsp;' + this.operatorField(this.opcoes.filtros[x].tipo, operador, filtro.campo) + '</span>' + botao; 
		
					if(filtro.tipo == 'data'){
					
						this.carregarScriptData();
					}
				}
			}
			
		} else { document.getElementById('grid_filtro_registro_'+this.nome).innerHTML = ''; }
	};
	
	this.createFilters = function() {
		
		if(App.count(this.opcoes.filtros) > 0) {
			
			var filtro = null;
			var filtros = 'Novo filtro: <select id="id_filtro" onChange="grid.showFilter(this.options[this.selectedIndex].value)">';
			filtros+= '<option value="">-- Selecionar Filtro --</option>';
			for(var x in this.opcoes.filtros) {
				filtro = this.opcoes.filtros[x];
				filtros+= '<option id="" value="'+x+'">'+filtro.titulo+'</option>';
			}
			filtros+= '</select>';
			
			$('#grid_filtro_'+this.nome).html(filtros);
		}
	};
	
	this.criarTabela = function(){
		
		this.addHtml('<table class="table table-condensed table-bordered" id="tabela_'+this.nome+'" style="padding-top: auto">');

		this.addHtml('<caption>');
		
		if(App.count(this.opcoes.filtros) > 0) {
		
			this.addHtml('<div class="row">');
			
			this.addHtml('<div class="col-sm-6"><div class="grid_filtro_linha_1" style="text-align: left">');
			
			this.addHtml('<span id="grid_filtro_selected_'+this.nome+'"></span>');			
			
			this.addHtml('<span id="grid_filtro_'+this.nome+'" class="form-inline"></span>');
			
			this.addHtml('<span id="grid_filtro_registro_'+this.nome+'" class="form-inline"></span>');
			
			this.addHtml('</div></div>');
			
			this.addHtml('<div class="col-sm-6"><a class="pull-right" onClick="grid.clearFilters()" style="cursor:pointer;"><i class="icon icon-trash" title="Limpar Filtros"></i>Limpar Filtros</a></div>')
			
			this.addHtml('</div>');
			
		}
			
		this.addHtml('<div class="row">');
		
		this.addHtml('<div class="col-sm-6"><div class="dataTables_info" id="grid_informacao_'+this.nome+'"></div></div>');
		this.addHtml('<div class="col-sm-6"><span class="grid_paginador"  id="grid_paginator_'+this.nome+'"></span></div>');
		
		this.addHtml('</div>');

		this.addHtml('</caption>');
		
		this.addHtml('<thead>');
		this.addHtml('<tr>');
		
		for(var i = 0; i < this.colunas.length; i++) {
            if(this.colunas[i].titulo) {
                var sortCommand = "grid.sort('"+this.colunas[i].nome+"')";
            	//var sortCommand = "";
                this.addHtml('<th id="kapane-grid-cell-'+this.nome+'-'+this.colunas[i].nome+'" onclick="'+sortCommand+'" style="cursor:pointer;text-align:center'+ (this.colunas[i].width ? ';width:'+ this.colunas[i].width : '') +'">'+ this.colunas[i].titulo +'</th>');
            } else {
                this.addHtml("<th></th>");
            }
        }		
		
		if(this.acoes == true) {
			this.addHtml('<th width="150px" style="text-align: center;">A&Ccedil;&Otilde;ES</th>');
		}
		
		this.addHtml('</tr>');
		this.addHtml('</thead>');
		
		this.addHtml('<tbody>');
		this.addHtml('</tbody>');
		
		var botaoNovo = this.novoFormatter();
		
		if(botaoNovo && 1==2){
			
			this.addHtml('<tfoot id="tabela_footer_'+this.nome+'">');
			this.addHtml('<tr>');
			this.addHtml('<td colspan="'+(this.colunas.length + (this.acoes == true ? 1 : 0))+'">');
			this.addHtml(botaoNovo);
			this.addHtml('</td>');
			this.addHtml('</tr>');
			this.addHtml('</tfoot>');
			
		}
		
		this.addHtml('</table>');
		
		$('#divHTML').html(this.html);
	};
	
	this.setItensPagina = function(limite) {
		
		this.data = (this.data == null ? {} : this.data);
		this.data.limite = limite;
		jQuery.cookies.set(this.modelo+'_grid', this.data);		
		this.load();
	};
	
	this.getItensPagina = function() {
		
		var cookie = jQuery.cookies.get(this.modelo+'_grid');
		if(!cookie) {
			cookie = {};
			cookie.limite = null;
		}
		var limite = cookie.limite;
		if(!limite) {
			limite = null;
		}
		return limite;
	};
	
	this.createHTMLPaginator = function() {
		
		var resultSet = this.dados.controle;
		
		var de = resultSet.de;
		var ao = resultSet.ao;
		var total = resultSet.total;
		var pagina = resultSet.pagina;
		var paginas = resultSet.paginas;
		var indiceInicio = resultSet.indiceInicio;
		var indiceFim = resultSet.indiceFim;

		var itensPorPagina = '<select id="_limite_"'+this.nome+' onChange="grid.setItensPagina(this.options[this.selectedIndex].value)" style="font-size:11px; width: 150px">';
		itensPorPagina+= '<option value=""></option>';
		itensPorPagina+= '<option '+(this.data.limite == '10'  ? 'selected' : '')+' value="10">10 por p&aacute;gina</option>';
		itensPorPagina+= '<option '+(this.data.limite == '50'  ? 'selected' : '')+' value="50">50 por p&aacute;gina</option>';
		itensPorPagina+= '<option '+(this.data.limite == '100' ? 'selected' : '')+' value="100">100 por p&aacute;gina</option>';
		itensPorPagina+= '</select>';
		
		var html = '<span class="form-inline">Mostrando itens '+ de +' - '+ ao + ' de ' + total + ' (P&aacute;gina '+ pagina +')&nbsp;&nbsp;' + itensPorPagina + '</span>';
		
		$('#grid_informacao_'+this.nome).html(html); 
		//$('#grid_paginator_'+this.nome).html(html);
		
		var paginador = '<span class="pagina">';
		var paginador2 = '<div class="dataTables_paginate paging_simple_numbers pull-right" style=""><ul class="pagination">';
		
		paginador+= '<span class="lnk"><a href="javascript:grid.pagina(1)"> &laquo; primeira </a></span> | ';
		
		var comando = ' &lsaquo; anterior';
		
		if(pagina > 1) {
			comando = '<a href="javascript:grid.pagina('+(pagina - 1)+')"> &lsaquo; anterior </a>';
			paginador2 += '<li><a href="javascript:grid.pagina(1)">&laquo;</a></li>';
			paginador2 += '<li><a href="javascript:grid.pagina('+(pagina - 1)+')">&lsaquo;</a></li>';
		}else{
			paginador2 += '<li class="disabled"><a href="javascript:grid.pagina(1)">&laquo;</a></li>';
			paginador2 += '<li class="disabled"><a>&lsaquo;</a></li>';
		}
		paginador+= '<span class="nav">'+ comando +'</span> | ';
		
		for(var i = indiceInicio ; i <= indiceFim ; i++) {
			if(i != pagina) {
				paginador2 += '<li class=""><a href="javascript:grid.pagina('+ i +')">'+ i +'</a></li>';
				paginador+= '<span class="pag"><a href="javascript:grid.pagina('+ i +')">'+ i +'</a></span> | ';
			}else{
				paginador2 += '<li class="active"><a href="javascript:grid.pagina('+ i +')">'+ i +'</a></li>';
				paginador+= '<span class="sel">'+ i +'</span> | ';
			}
		}
		
		
		var comando = 'pr&oacute;xima &rsaquo;';
		if(pagina < paginas) {
			comando = '<a href="javascript:grid.pagina('+(pagina + 1)+')"> pr&oacute;xima &rsaquo;</a>';
			paginador2 += '<li><a href="javascript:grid.pagina('+(pagina + 1)+')">&rsaquo;</a></li>';
			paginador2 += '<li><a href="javascript:grid.pagina('+ paginas +')">&raquo;</a></li>';
		}else{
			paginador2 += '<li class="disabled"><a>&rsaquo;</a></li>';
			paginador2 += '<li class="disabled"><a href="javascript:grid.pagina('+ paginas +')">&raquo;</a></li>';
		}	
		paginador+= '<span class="nav">'+ comando +'</span> | ';
		
		paginador+= '<span class="lnk"><a href="javascript:grid.pagina('+ paginas +')"> &uacute;ltima &raquo;</a></span>';
		
		paginador+= '</span>';
		paginador2 += '</ul></div>';
		
		$('#grid_paginator_'+this.nome).html(paginador2);
		//$('#grid-paginator-2'+this.nome).html(paginador);
    };	
	
	this.load = function(click){
		
		var _this = this;
		
		_this.data = (_this.data == null ? {} : _this.data);

		if(_this.opcoes.colunaordenar){
			_this.data.sort_col = _this.opcoes.colunaordenar;
		}
		if(_this.opcoes.direcaoordenar){
			_this.data.sort_dir = _this.opcoes.direcaoordenar;
		}
		
		if(!click) {
			var cookie = jQuery.cookies.get(_this.modelo+'_grid');
			if(cookie){
				_this.data.pagina = cookie.pagina;
			}
		}

		var _limite_ = _this.getItensPagina();
		if(_limite_ == null){
			_this.data.limite = 10;
			_this.setItensPagina(10);
		} else {
			_this.data.limite = _limite_;
		}
		
		_this.data.filtros = _this.getFilters();

		_this.showSelectedFilter();
		
		_this.reset();
		
		jQuery.ajax({
		    type:'POST',
		    global:true,
		    url:_this.url,
		    dataType:'json',
		    data:_this.data,
		    success: function(data){

		    	if(data != null){
		    		
		    		_this.dados = data;
		    		
		    		var row = null;
		    		var cell = null;
		    		var record = null;
		    		var table = _this.getTable();
		    		var records = data.registros;
		    		
		    		_this.clear();
		    		
		    		if(_this.opcoes.paginator == null || _this.opcoes.paginator == true){
		    			_this.createHTMLPaginator();
		    		}
		    		
		    		if(records.length > 0){
		    			
		    			for(var i = 0 ; i < data.registros.length ; i++) {
		    				row = _this.createRow(table);
		    				for(var j = 0 ; j < _this.colunas.length ; j++) {
		    					record = records[i];
		    					
		    					if(_this.colunas[j].formatterDados){
		    						
		    						var formatter = JSON.parse(_this.colunas[j].formatterDados);
		    						
		    						dado = '';
		    						
		    						if(App.isset(formatter[record[_this.colunas[j].nome]])){
		    							dado = formatter[record[_this.colunas[j].nome]];
		    						}
		    						
		    					}else if(_this.colunas[j].funcaoFormatter){
		    						var formatter = (eval(_this.colunas[j].funcaoFormatter));
				        			dado = formatter(record,_this.colunas[j]);
				        			//console.log(record);
				        			//console.log(_this.colunas[j]);
		    					}else{	
		    						dado = (eval('record.'+_this.colunas[j].nome));
		    					}
		    					cell = _this.createCell(row);
		    					cell.title = dado;
		    					cell.innerHTML = dado;
		    					if(_this.colunas[j].cssbody){
		    						cell.setAttribute('style', _this.colunas[j].cssbody);
		    					}
		    					row.appendChild(cell);
		    				}
		    				
		    				//A��es
		    				
		    				if(_this.acoes == true) {
		    					
		    					cell = _this.createCell(row);
		    					cell.setAttribute('width', '150px');
		    					cell.setAttribute('style', 'text-align: center');
		    					cell.innerHTML = _this.acoesFormatter(record);
		    					row.appendChild(cell);
		    					table.appendChild(row);
		    				}
		    			}		    		
		    		}else{
		    			var qtdCampo = _this.colunas.length;
		    			if(_this.acoes == true){
		    				qtdCampo = qtdCampo + 1;
		    			}
		    			row = _this.createRow(table);
		    			cell = _this.createCell(row);
    					cell.setAttribute('colspan', qtdCampo);
    					cell.setAttribute('style', 'text-align:center');
		    			cell.innerHTML = 'Nenhum registro.';
    					row.appendChild(cell);
		    		}
		    	}
		    	
		    },
		    failure: function(){
		    }
		});
		
	};
	
}