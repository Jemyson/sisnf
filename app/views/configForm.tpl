{include file="../../templates/topo.tpl"}

{literal}

	<script type="text/javascript" language="javascript">

		var config = {};
	
		config.basePath = '{/literal}{$basePath}{literal}';
		
		config.pk     = 'id';
		config.modelo = 'configForm';
	
		config.url    = '{/literal}{$basePath}{literal}config/dados-form{/literal}{if isset($id)}?id={$id}{/if}{literal}';
		config.form   = '{/literal}{$basePath}{literal}config/form';
		config.salvar = '{/literal}{$basePath}{literal}config/salvar';
		config.voltar = '{/literal}{$basePath}{literal}index';
	
		{/literal}

		{if isset($visualizar) && $visualizar == '1'}

		config.visualizar = '1';
		
		{/if}
			
		{literal}
				
		config.botoes = ['b','s'];

		config.colunas = [];
		config.colunas.push({'nome':'nome',	'titulo':'Raz&atilde;o Social',		'tipo':'text',			'span':'5',	'classe':'input-xlarge',	'obrigatorio':'1', 'disabled':'readonly'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'cnpj','titulo':'CNPJ',		'tipo':'text',			'span':'3',	'classe':'input-xlarge',	'obrigatorio':'0', 'disabled':'readonly'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'inscricaoEstadual','titulo':'INSCRI&Ccedil;&Atilde;O ESTADUAL',		'tipo':'text',			'span':'3',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'cep','titulo':'CEP',		'tipo':'text',			'span':'2',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'rua','titulo':'Endere&ccedil;o',		'tipo':'text',			'span':'4',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'numero','titulo':'N&uacute;mero',		'tipo':'text',			'span':'1',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'bairro','titulo':'Bairro',		'tipo':'text',			'span':'3',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'cidade','titulo':'Cidade',		'tipo':'text',			'span':'3',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'nome':'cod_cidade','titulo':'C&oacute;d. Cidade',		'tipo':'hide',			'span':'6',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'uf','titulo':'UF',		'tipo':'text',			'span':'1',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'telefone','titulo':'Telefone',		'tipo':'text',			'span':'2',	'classe':'input-xlarge',	'obrigatorio':'0'});
		
		var form = new Form('configForm', config);

		form.salvar = function(){

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
							$('#divSuccess').html(data.msg);
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
		
		$(document).ready(function(){
	
			form.criarFormulario();
			form.carregarCamposEntidade();
			form.load();

			$('#cep').mask('00000-000');

			$('#cep').blur(function(){

				var cep = $(this).val().replace(/\D/g, '');

				if (cep != "") {
					
					$.ajax({
						type:'POST',
						global:true,
						url:'//viacep.com.br/ws/'+ cep +'/json/?callback=?',
						dataType:'json',
						data:'',
						success: function(data){
	
							$('#rua').val(data.logradouro);
							$('#bairro').val(data.bairro);
							$('#cidade').val(data.localidade);
							$('#cod_cidade').val(data.ibge);
							$('#uf').val(data.uf);
						
						},
						error: function(){
						}
					});

				}
				
			});
			
		});

	</script>
{/literal}

		<div class="page-wrapper">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"><a href="{$basePath}config">Config</a> / Cadastro</h1>
				</div>
			</div>	

			<div class="row">

				<div class="col-lg-12">
				
					<div class="panel panel-default">
					
						<div class="panel-heading">
							<a class="pull-right btn btn-primary btn-xs" href="{$basePath}index">
								Voltar  <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
							</a>Registro de Configura&ccedil;&atilde;o
						</div>
					
						<div class="panel-body" id="divHTML">
						</div>
						
					</div>
				
				</div>

			</div>		

		</div>
		
		
		
		
		

{include file="../../templates/base.tpl"}