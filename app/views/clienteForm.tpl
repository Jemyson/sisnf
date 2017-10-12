{include file="../../templates/topo.tpl"}

{literal}

	<script type="text/javascript" language="javascript">

		var config = {};
	
		config.basePath = '{/literal}{$basePath}{literal}';
		
		config.pk     = 'id';
		config.modelo = 'produtoForm';
	
		config.url    = '{/literal}{$basePath}{literal}cliente/dados-form{/literal}{if isset($id)}?id={$id}{/if}{literal}';
		config.form   = '{/literal}{$basePath}{literal}cliente/form';
		config.salvar = '{/literal}{$basePath}{literal}cliente/salvar';
		config.voltar = '{/literal}{$basePath}{literal}cliente';
	
		{/literal}

		{if isset($visualizar) && $visualizar == '1'}

		config.visualizar = '1';
		
		{/if}
			
		{literal}
				
		config.botoes = ['b','s'];

		config.colunas = [];
		config.colunas.push({'nome':'id',	'titulo':'C&oacute;digo',	'tipo':'text',			'span':'2',	'classe':'input-mini',		'obrigatorio':'1', 'disabled':'readonly'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'nome',	'titulo':'Nome',		'tipo':'text',			'span':'5',	'classe':'input-xlarge',	'obrigatorio':'1'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'cpf','titulo':'CPF',		'tipo':'text',			'span':'2',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'nome':'cnpj','titulo':'CNPJ',		'tipo':'text',			'span':'2',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'cep','titulo':'CEP',		'tipo':'text',			'span':'2',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'endereco','titulo':'Endere&ccedil;o',		'tipo':'text',			'span':'4',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'nome':'numero','titulo':'N&uacute;mero',		'tipo':'text',			'span':'2',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'bairro','titulo':'Bairro',		'tipo':'text',			'span':'3',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'nome':'cidade','titulo':'Cidade',		'tipo':'text',			'span':'3',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'nome':'cod_cidade','titulo':'C&oacute;d. Cidade',		'tipo':'hide',			'span':'6',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'telefone','titulo':'Telefone',		'tipo':'text',			'span':'2',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'nome':'celular','titulo':'Celular',		'tipo':'text',			'span':'2',	'classe':'input-xlarge',	'obrigatorio':'0'});
		config.colunas.push({'tipo':'linha'});
		config.colunas.push({'nome':'email','titulo':'E-mail',		'tipo':'text',			'span':'6',	'classe':'input-xlarge',	'obrigatorio':'0'});
		
		var form = new Form('campeonatoForm', config);

		$(document).ready(function(){
	
			form.criarFormulario();
			form.carregarCamposEntidade();
			form.load();
	
		});

	</script>
{/literal}

		<div class="page-wrapper">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"><a href="{$basePath}cliente">Cliente</a> / Cadastro</h1>
				</div>
			</div>	

			<div class="row">

				<div class="col-lg-12">
				
					<div class="panel panel-default">
					
						<div class="panel-heading">
							<a class="pull-right btn btn-primary btn-xs" href="{$basePath}cliente">
								Voltar  <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
							</a>Novo Registro
						</div>
					
						<div class="panel-body" id="divHTML">
						</div>
						
					</div>
				
				</div>

			</div>		

		</div>
		
		
		
		
		

{include file="../../templates/base.tpl"}