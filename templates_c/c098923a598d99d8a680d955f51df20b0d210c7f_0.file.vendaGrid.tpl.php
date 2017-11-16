<?php /* Smarty version 3.1.27, created on 2017-11-16 18:05:43
         compiled from "C:\xampp\htdocs\sisnf\app\views\vendaGrid.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1650321345a0dc567d98950_80022510%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c098923a598d99d8a680d955f51df20b0d210c7f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\sisnf\\app\\views\\vendaGrid.tpl',
      1 => 1510850280,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1650321345a0dc567d98950_80022510',
  'variables' => 
  array (
    'basePath' => 0,
    'dadosCliente' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5a0dc567dfc111_60100448',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a0dc567dfc111_60100448')) {
function content_5a0dc567dfc111_60100448 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1650321345a0dc567d98950_80022510';
echo $_smarty_tpl->getSubTemplate ("../../templates/topo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>




	<?php echo '<script'; ?>
 type="text/javascript" language="javascript">

		var config = {};

		config.basePath = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
';
		
		config.pk     = 'id';
		config.modelo = 'venda';
		
		config.url    	= '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
venda/dados';
		config.form   	= '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
venda/iniciar';
		config.excluir  = '<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
venda/excluir';
		config.botoes 	= ['i','v','a','e'];
		
		config.filtros = {}
		config.filtrosDados = {}

		config.filtros.CD_ESPORTE  = {'titulo':'id','campo':'id' ,'tipo':'numero'};
		config.filtros.DS_ESPORTE  = {'titulo':'Valor','campo':'valor' ,'tipo':'texto'};
		
		config.filtrosDados.tipo = [];
		config.filtrosDados.tipo.push({"id":"1","value":"Visualizar"});
		config.filtrosDados.tipo.push({"id":"2","value":"Incluir"});
		config.filtrosDados.tipo.push({"id":"3","value":"Alterar"});
		config.filtrosDados.tipo.push({"id":"4","value":"Excluir"});
		
		config.colunas = [];
		config.colunas.push({'nome':'id',						'titulo':'#', 			'cssbody':'text-align:center', 	'width':'5%'});
		config.colunas.push({'nome':'id_cliente',		'titulo':'CLIENTE',	'cssbody':'text-align:left', 		'formatterDados':'<?php echo $_smarty_tpl->tpl_vars['dadosCliente']->value;?>
'});
		config.colunas.push({'nome':'tipo',					'titulo':'TIPO',		'cssbody':'text-align:center', 	'formatterDados':'{"1":"Or&ccedil;amento", "2":"Venda"}'});
		config.colunas.push({'nome':'data_venda',		'titulo':'DATA',		'cssbody':'text-align:center',	'funcaoFormatter':'Formatter.data'});
		config.colunas.push({'nome':'valor',				'titulo':'VALOR',  	'cssbody':'text-align:right', 	'funcaoFormatter':'Formatter.formatMoedaReal'});
		config.colunas.push({'nome':'status',				'titulo':'STATUS',  'cssbody':'text-align:center', 	'formatterDados':'{"1":"Iniciada", "2":"Aguardando", "3":"Finalizada", "4":"Emitida", "5":"Excluida"}'});
	
		var grid = new Grid('vendaGrid', config);

		grid.acoesFormatter = function(record) {
			
			var botoes = '';
			if(this.opcoes.pk) {
				for(var i = 0 ; i < this.botoes.length ; i++) {
					if(this.botoes[i] == 'a'){
						botoes+='<a class="btn btn-primary btn-xs" href="javascript:grid.alterar(\''+record[this.opcoes.pk]+'\')">Acessar</a>';
					}
				}
			}
			return botoes;
		};

		grid.criarTabela = function(){
			
			this.addHtml('<table class="table table-condensed table-bordered" id="tabela" style="padding-top: auto">');

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

			this.addHtml('</table>');
			
			this.addHtml('<div class="box-body table-responsive no-padding">');
			
			this.addHtml('<table class="table table-condensed table-bordered" id="tabela_'+this.nome+'" style="padding-top: auto">');
			
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
				this.addHtml('<th width="50px" style="text-align: center;">A&Ccedil;&Otilde;ES</th>');
			}
			
			this.addHtml('</tr>');
			this.addHtml('</thead>');
			
			this.addHtml('<tbody>');
			this.addHtml('</tbody>');
			
			this.addHtml('</div>');
			
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
		
		grid.load = function(click){
			
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
			    					cell.setAttribute('width', '50px');
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
		
		$(document).ready(function(){

			grid.criarTabela();
			grid.createFilters();
			grid.load();

		});
			
	<?php echo '</script'; ?>
>

	
		<div class="page-wrapper">
		
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Vendas</h1>
				</div>
			</div>	
		
			<div class="row">

				<div class="col-lg-12">
				
					<div class="panel panel-default">
					
						<div class="panel-heading">
							<a class="pull-right btn btn-primary btn-xs" href="<?php echo $_smarty_tpl->tpl_vars['basePath']->value;?>
venda/form">
								<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Novo registro
							</a>Lista de Registros
						</div>
					
						<div class="panel-body" id="divHTML">
						</div>
						
					</div>
				
				</div>

			</div>		
		
		</div>






<?php echo $_smarty_tpl->getSubTemplate ("../../templates/base.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>