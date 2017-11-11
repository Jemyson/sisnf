<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html style="height: auto; min-height: 100%;">
	<head>
	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	
		<title>Invoice System</title>
		<link  href="{$basePath}img/favicon.ico" rel="shortcut icon" type="image/x-icon"/>

		<link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
		<link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/dist/css/AdminLTE.min.css">
		<link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/dist/css/skins/_all-skins.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">		
				
				
				
				
		<!-- <link rel="stylesheet" href="public/css/style.css" /> -->
				
		<!-- 
		 -->

		<!-- Optional theme -->
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"> -->

		<!-- 
		 -->
		<link href="{$basePath}css/bootstrap.min.css" rel="styleSheet">

{literal}

		<style>
		
		.corpo{ padding: 20px; #padding-top: 70px;}
		.page-wrapper h1{ margin-top: 0}
		
		div.dataTables_paginate ul.pagination {
		    margin: 2px 0;
		    white-space: nowrap;
		}
		
		div.dataTables_info {
		    padding-top: 8px;
		    color: #999;
		}

* {
  .box-sizing(border-box);
}
*:before,
*:after {
  .box-sizing(border-box);
}


// Body reset

html {
  font-size: 10px;
  -webkit-tap-highlight-color: rgba(0,0,0,0);
}

// Reset fonts for relevant elements
input,
button,
select,
textarea {
  font-family: inherit;
  font-size: inherit;
  line-height: inherit;
}


// Links

a {
  color: @link-color;
  text-decoration: none;

  &:hover,
  &:focus {
    color: @link-hover-color;
    text-decoration: @link-hover-decoration;
  }

  &:focus {
    .tab-focus();
  }
}


// Figures
//
// We reset this here because previously Normalize had no `figure` margins. This
// ensures we don't break anyone's use of the element.

figure {
  margin: 0;
}


// Images

img {
  vertical-align: middle;
}

// Responsive images (ensure images don't scale beyond their parents)
.img-responsive {
  .img-responsive();
}

// Rounded corners
.img-rounded {
  border-radius: @border-radius-large;
}

// Image thumbnails
//
// Heads up! This is mixin-ed into thumbnails.less for `.thumbnail`.
.img-thumbnail {
  padding: @thumbnail-padding;
  line-height: @line-height-base;
  background-color: @thumbnail-bg;
  border: 1px solid @thumbnail-border;
  border-radius: @thumbnail-border-radius;
  .transition(all .2s ease-in-out);

  // Keep them at most 100% wide
  .img-responsive(inline-block);
}

// Perfect circle
.img-circle {
  border-radius: 50%; // set radius in percents
}


// Horizontal rules

hr {
  margin-top:    @line-height-computed;
  margin-bottom: @line-height-computed;
  border: 0;
  border-top: 1px solid @hr-border;
}


// Only display content to screen readers
//
// See: http://a11yproject.com/posts/how-to-hide-content

.sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  margin: -1px;
  padding: 0;
  overflow: hidden;
  clip: rect(0,0,0,0);
  border: 0;
}

// Use in conjunction with .sr-only to only display content when it's focused.
// Useful for "Skip to main content" links; see http://www.w3.org/TR/2013/NOTE-WCAG20-TECHS-20130905/G1
// Credit: HTML5 Boilerplate

.sr-only-focusable {
  &:active,
  &:focus {
    position: static;
    width: auto;
    height: auto;
    margin: 0;
    overflow: visible;
    clip: auto;
  }
}


// iOS "clickable elements" fix for role="button"
//
// Fixes "clickability" issue (and more generally, the firing of events such as focus as well)
// for traditionally non-focusable elements with role="button"
// see https://developer.mozilla.org/en-US/docs/Web/Events/click#Safari_Mobile

[role="button"] {
  cursor: pointer;
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

	<body class="skin-blue layout-top-nav" style="height: auto; min-height: 100%;">
	
	{include file="menu.tpl"}
	
		<div class="corpo">
