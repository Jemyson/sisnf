{literal}
<style>

		.preview__header{font-size:12px;height:54px;background-color:#262626;z-index:100;line-height:54px;margin-bottom:1px}
		.preview__envato-logo{float:left;padding:0 20px}
		.preview__envato-logo a{display:inline-block;position:absolute;top:18px;text-indent:-9999px;height:18px;width:152px;#background:url(//public-assets.envato-static.com/assets/logos/envato_market-6eed4f715209e46c7454f26f3f25f7560d9d94713c11a5717436cd18642fb0a0.svg);background-size:152px 18px}
		@media (max-width: 568px){
			.preview__envato-logo{padding:0 10px}
			.preview__envato-logo a{position:absolute;top:20px;left:15px;height:14px;width:118px;background-size:118px 14px}
		}
		.preview__actions{float:right}
		.preview__action--buy,.preview__action--close{display:inline-block;padding:0 20px}
		@media (max-width: 568px){
			.preview__action--buy{padding:0 10px}
		}
		.preview__action--purchase-form{display:inline-block}
		.preview__action--item-details{display:inline-block}
		.preview__action--close{border-left:1px solid #333333}
		.navbar-default .navbar-nav>li>a{color:#999999;text-decoration:none}
		.navbar-default .navbar-nav>li>a:hover{color:white}
		.navbar-default .navbar-nav>li>a i{color:white;font-size:10px;margin-right:10px}

		.navbar-default {
		    background-color: #000;
		    border-color: #000;
		}
		
		.navbar-default .navbar-toggle:focus, .navbar-default .navbar-toggle:hover {
		    background-color: #333;
		}
		
		.navbar-default .navbar-toggle {
		    border-color: #333;
		}
		
		.navbar-default .navbar-toggle .icon-bar {
		    background-color: #fff;
		}
		
		.navbar-nav {
				background-color: #000;
				padding-right: 0px;
		    float: none;
		    margin: 0;
		}		
		
		.nav>li>a {
	    position: relative;
	    display: block;
			padding-left: 0px;
			padding-right: 0px;
		}

		.navbar-brand a {color: #fff; text-transform: uppercase; #font-weight: bold; text-decoration: none; font-weight: 500}
		.navbar-brand a:hover {text-decoration: none}
		
		.navbar-brand label {color: #6f9a37; font-weight: 500; cursor: pointer}
		
</style>
{/literal}
	
	<nav role="navigation" class="preview__header nav navbar-default navbar-fixed-top">
	
		<div class="navbar-header">
		
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu" aria-expanded="false">
			
				<span class="sr-only">Menu Navega&ccedil;&atilde;o</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			
			</button>
		
			<div class="navbar-brand">
			
	    	<a href="{$basePath}index">
					<img alt="logo" src="{$basePath}img/logo_min.png" class="img-responsive" style="margin-top: -7px; margin-right: 10px; width: 140px; height: 40px">
	    		<!-- <label>Invoice</label> System -->
    		</a>
	  	</div>

		</div>
			
		<div class="collapse navbar-collapse" id="menu" style="padding-left: 0px; padding-right: 0px;">
 			
			<ul class="nav navbar-nav">
 			
 				<li class="preview__action--close">
 					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
 						<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Cadastros 
 						<span class="caret"></span>
 					</a>
 					<ul class="dropdown-menu">
						<li class="preview__action--close">
							<a href="{$basePath}cliente"><i class="glyphicon glyphicon-briefcase"></i> Clientes</a>
				  	</li>
						<li class="preview__action--close">
							<a href="{$basePath}fornecedor"><i class="glyphicon glyphicon-tags"></i> Fornecedor</a>
				  	</li>
						<li class="preview__action--close">
							<a href="{$basePath}transportadora"><i class="glyphicon glyphicon-bed"></i> Transportadoras</a>
				  	</li>
						<li class="preview__action--close">
							<a href="{$basePath}produto"><i class="glyphicon glyphicon-barcode"></i> Produtos</a>
				  	</li>
						<li class="preview__action--close">
							<a href="{$basePath}produto/entrada"><i class="glyphicon glyphicon-paste"></i> Entrada de Produtos</a>
				  	</li>
 					</ul>
 				</li>
				<li class="preview__action--close">
					<a href="{$basePath}venda"><i class="glyphicon glyphicon-shopping-cart"></i> Vendas <span class="sr-only">(current)</span></a>
		  	</li>
				<li class="preview__action--close">
					<a href="{$basePath}nota-fiscal"><i class="glyphicon glyphicon-send"></i> Faturas <span class="sr-only">(current)</span></a>
		  	</li>
				<li class="preview__action--close">
 					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<i class="glyphicon glyphicon-cog"></i> Configura&ccedil;&atilde;o
 						<span class="caret"></span>
					</a>
 					<ul class="dropdown-menu">
						<li class="preview__action--close">
							<a href="{$basePath}config"><i class="glyphicon glyphicon-cog"></i> Config</a>
				  	</li>
						<li class="preview__action--close">
							<a href="{$basePath}categoria"><i class="glyphicon glyphicon-th"></i> Categoria</a>
				  	</li>
						<li class="preview__action--close">
							<a href="{$basePath}subcategoria"><i class="glyphicon glyphicon-th-list"></i> Sub-Categoria</a>
				  	</li>
					</ul>					
		  	</li>
	 			
	  		<li class="preview__action--close pull-right">
	    		<a href="{$basePath}login/logout"><i class="glyphicon glyphicon-off"></i> Sair</a>  
	  		</li>
				<li class="preview__action--close pull-right" style="border-left: 0;">
					<a href="usuarios.php"><i class="glyphicon glyphicon-user"></i> Usuario: {$nomeUsuario}</a>
		  	</li>
			
			</ul>
		</div>	
	</nav>	
	