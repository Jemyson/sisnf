{literal}
<style>

		.nav li{ border-left: 1px solid #ddd }
		.nav li a{ padding-left: 20px; padding-right: 20px}
		.nav li a i{ color: #262626}
		.nav li a span{ margin-right: 10px}

</style>
{/literal}
	
	<nav role="navigation" class="nav navbar-default navbar-fixed-top">

			<div class="container-fluid" style="font-size: 12px;padding-right: 5px; padding-left: 5px; background: #eee">
				<p class="navbar-text pull-left" style="#display:none; margin-top: 0px; margin-bottom: 0px; padding-top: 2px; padding-bottom:10px; height: 20px">
					<!-- <i class="icon-file" style="margin-top: -1px"></i>Vers&atilde;o:<b>1.0.0</b>
				|	--><i class="glyphicon glyphicon-time" style="margin-top: -1px"></i><span id="dataTempoReal"></span>
				</p>
					{literal}
	        <script type="text/javascript">
	        _TIMESTAMP = {/literal}{$realTime}{literal};
	        _TIMESTAMP_DIFF = (new Date()).getTime()-{/literal}{$realTime}{literal};
	        window.setInterval(function (){document.getElementById("dataTempoReal").innerHTML = (new Date((new Date()).getTime()-_TIMESTAMP_DIFF)).toLocaleString('pt-BR');}, 1000);
	        document.getElementById("dataTempoReal").innerHTML = (new Date((new Date()).getTime()-_TIMESTAMP_DIFF)).toLocaleString('pt-BR');
	        </script>
	        {/literal}
				<p class="navbar-text pull-right" style="margin-top: 0px; margin-bottom: 0px; padding-top: 2px; padding-bottom:0px; height: 20px">
					<i class="glyphicon glyphicon-user"></i> {$nomeUsuario}</b>
			<!--| <a href="{$basePath}usuario/trocar-senha"><iclass="pencil icon red"></i>Trocar Senha</a> -->
				| <a href="{$basePath}login/logout"><i class="glyphicon glyphicon-off" style="margin-top: -0.5px"></i> Sair</a>
				</p>
			</div>


		<div class="navbar-header">
		
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu" aria-expanded="false">
			
				<span class="sr-only">Menu Navega&ccedil;&atilde;o</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			
			</button>
		
			<button type="button" class="navbar-toggle" data-toggle="collapse" aria-expanded="false"
					style="height: 34px; padding-top: 6px; color: #fff; background-color: #337ab7; border-color: #2e6da4">
				<span class="glyphicon glyphicon-plus-sign"></span> Nova Venda
			</button>
		
			<a class="navbar-brand" href="#"><label>GAME</label> STATION</a>

		</div>
			
		<div class="collapse navbar-collapse" id="menu" style="padding-left: 14px">

			<ul class="nav navbar-nav">
				<li>
					<a href="{$basePath}venda"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Venda</a>
		  	</li>
				<li>
					<a href="{$basePath}produto"><span class="glyphicon glyphicon-barcode" aria-hidden="true"></span> Produtos</a>
		  	</li>
				<li>
					<a href="{$basePath}kit"><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span> Kits</a>
		  	</li>
				<li>
					<a href="{$basePath}cliente"><span class="glyphicon glyphicon-user"></span> Clientes</a>
		  	</li>
				<li>
					<a href="usuarios.php"><span class="glyphicon glyphicon-lock"></span> Usuarios</a>
		  	</li>
				<li>
					<a href="perfil.php"><span class="glyphicon glyphicon-cog"></span> Configura&ccedil;&atilde;o</a>
		  	</li>
			</ul>
		</div>	
		
	</nav>	
