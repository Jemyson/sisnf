<?php

class NotaFiscalController extends AppController{
	
	public function emitirAction(){
		
		require_once 'lib/emitirNfe.php';
		
	}
	
}