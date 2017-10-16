{include file="../../templates/topo.tpl"}

{literal}

	<script type="text/javascript" language="javascript">

			
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
							</a>Novo Registro: 1462
						</div>
					
						<div class="panel-body" id="divHTML">
						
							<form class="form-horizontal">
							
								<div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">Tipo</label>
							    <div class="col-sm-3">
							      <select class="form-control">
										  <option value="0">Selecione</option>
										  <option value="1">Or&ccedil;amento</option>
										  <option value="2">Venda</option>
										</select>
							    </div>
							  </div>							
								<div class="form-group">
							    <label for="inputEmail3" class="col-sm-2 control-label">Cliente</label>
							    <div class="col-sm-3">
							      <select class="form-control">
										  <option value="0">Selecione</option>
										  <option value="1">Jemyson Vagner Rosa da Silva</option>
										</select>
							    </div>
							  </div>		
							  <div class="form-group">
							    <div class="col-sm-offset-2 col-sm-10">
							      <button type="submit" class="btn btn-success">Iniciar Venda</button>
							      <button type="submit" disabled="disabled" class="btn btn-danger">Finalizar Venda</button>
							      <button type="submit" class="btn btn-warning">Nova Venda</button>
							    </div>
							  </div>					
							
							</form>
						
						</div>
						
					</div>
				
				</div>

			</div>		
		
		</div>






{include file="../../templates/base.tpl"}