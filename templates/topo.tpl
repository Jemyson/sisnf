<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	
		<title>Invoice System</title>
		<link  href="{$basePath}img/favicon.ico" rel="shortcut icon" type="image/x-icon"/>

		<!-- <link rel="stylesheet" href="public/css/style.css" /> -->
				
				
		<!-- 
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		 -->

		<!-- Optional theme -->
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"> -->

		<!-- 
		 -->
		<link href="{$basePath}css/bootstrap.min.css" rel="styleSheet">

{literal}

		<style>
		
		.corpo{ padding: 20px; padding-top: 70px;}
		.page-wrapper h1{ margin-top: 0}
		
		div.dataTables_paginate ul.pagination {
		    margin: 2px 0;
		    white-space: nowrap;
		}
		
		div.dataTables_info {
		    padding-top: 8px;
		    color: #999;
		}
		
		</style>

{/literal}

		<script src="{$basePath}js/jquery.min.js" type="text/javascript"></script>
    <script src="{$basePath}js/jquery.cookies.js" type="text/javascript"></script>
		<script src="{$basePath}js/bootstrap.min.js" type="text/javascript"></script>
		<script src="{$basePath}js/jquery.maskMoney.js" type="text/javascript"></script>
		<script src="{$basePath}js/jquery.mask.js" type="text/javascript"></script>


    <script src="{$basePath}js/Grid.js" type="text/javascript"></script>
    <script src="{$basePath}js/Form.js" type="text/javascript"></script>
    <script src="{$basePath}js/Campos.js" type="text/javascript"></script>
    <script src="{$basePath}js/Formatter.js" type="text/javascript"></script>
    <script src="{$basePath}js/App.js" type="text/javascript"></script>

		<script type="text/javascript">
		
			App = new App();
			Formatter = new Formatter();
		
		</script>

	</head>

	<body class="skin-blue layout-top-nav">
	
	{include file="menu.tpl"}
	
		<div class="corpo">
