{include file="../../templates/topo.tpl"}

{literal}

	<script type="text/javascript" language="javascript">

	Venda = function(opcoes){

		this.opcoes = opcoes;
		
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
				
				if(!App.isset($(this).val()) || $(this).val() == '-1' || ($(this).val() == '0' && App.isset($(this).attr('entidade')) )){
					erro = 1;
					$(this).parent().parent().addClass( "has-error" );
				}else{
					$(this).parent().parent().removeClass( "has-error" );
				}
				
			});
			
			if(erro != 0){
				return false;
			}else{
				return true;
			}
			
		}
		
		this.iniciar = function(){

			var _this = this;

			if(this.validarCampoObrigatorio()){

				$.ajax({
					type:'POST',
					global:true,
					url:_this.opcoes.urlSalvar,
					dataType:'json',
					data:$('#form').serialize(),
					success: function(data){

						if(data.error == 0){
							window.location = _this.opcoes.urlIniciar + '?id=' + _this.opcoes.id;
						}else{
							$('#divError').show();
							$('#divError').html(data.msg);
						}
						
					},
					error: function(){
					}
				});

			}else{

				alert("Os Campos em vermelho sao obrigatorios.");
				$('.btn-success').show();
				$('.disabled').hide();

			}
			
		}

	}

	var config = {};

	config.id						= '{/literal}{$id}{literal}';
	config.urlIniciar		= '{/literal}{$basePath}{literal}venda/iniciar';
	config.urlSalvar		= '{/literal}{$basePath}{literal}venda/salvar';

	$(document).ready(function(){

		venda = new Venda(config);

	});	
			
	</script>
{/literal}
	
		<div class="page-wrapper">
		
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"><a href="{$basePath}venda">Vendas</a> / Cadastro</h1>
				</div>
			</div>	
		
			<div class="row">

				<div class="col-lg-12">
				
					<div class="panel panel-default">
					
						<div class="panel-heading">
							<a class="pull-right btn btn-primary btn-xs" href="{$basePath}venda">
								Voltar  <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
							</a>Novo Registro: {$id}
						</div>
					
						<div class="panel-body" id="divHTML">
						
							<form class="form-horizontal" method="post" id="form" name="form">
							
								<p id="divSuccess" class="bg-success" style="padding: 15px; display: none"></p>
								<p id="divError" class="bg-danger" style="padding: 15px; display: none"></p>
							
								<input type="hidden" id="id" name="id" value="{$id}">
								<input type="hidden" id="hash" name="hash" value="{$hash}">
							
								<div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">Tipo*</label>
							    <div class="col-sm-3">
							      <select class="form-control" id="tipo" name="tipo" obrigatorio="obrigatorio" entidade="entidade">
										  <option value="0">Selecione</option>
										  <option value="1">Or&ccedil;amento</option>
										  <option value="2">Venda</option>
										</select>
							    </div>
							  </div>							
								<div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">Cliente*</label>
							    <div class="col-sm-3">
							      <select class="form-control" id="id_cliente" name="id_cliente" obrigatorio="obrigatorio" entidade="entidade">
										  <option value="0">Selecione</option>
										  <option value="1">Jemyson Vagner Rosa da Silva</option>
										</select>
							    </div>
							  </div>		
							  <div class="form-group">
							    <div class="col-sm-offset-2 col-sm-10">
							      <button type="button" onclick="venda.iniciar()" class="btn btn-primary">Iniciar Venda</button>
							    </div>
							  </div>					
							
							</form>
						
						</div>
						
					</div>
				
				</div>

			</div>		
		
		</div>






{include file="../../templates/base.tpl"}