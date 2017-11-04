<?php
//funções úteis
//***************************
function zeroEsquerda($valor,$quantidade){
	return str_pad($valor, $quantidade, '0', STR_PAD_LEFT);
}

function buscaCodigoMunicipio($db,$municipio,$uf){
	$sql = "SELECT * FROM municipioIbge WHERE nome = '".trim($municipio)." - ".trim($uf)."' ";
	$resultado = $db->query($sql)->result();
	if(!empty($resultado[0]->id))
		return $resultado[0]->id.calcula_dv_municipio($resultado[0]->id);
	else{
		return "";
	}
}

/*Calcula dígito verificador do município*/
function calcula_dv_municipio($codigo_municipio){
	$peso = "1212120";
	//echo "".substr($peso,0,1)."";
	$soma = 0;
	for($i = 0; $i < 7; $i++){ $valor = substr($codigo_municipio,$i,1) * substr($peso,$i,1); if($valor>9)
	$soma = $soma + substr($valor,0,1) + substr($valor,1,1);
	else
	$soma = $soma + $valor;
	}
	$dv = (10 - ($soma % 10));
	if(($soma % 10)==0)
	$dv = 0;
	return $dv;
}

function float2($valor){ //transforma para: 10.00
	return number_format((float)$valor,2,".","");
}
function float4($valor){ //transforma para: 10.0000
	return number_format((float)$valor,4,".","");
}

function ufToCodigo($uf){
	if($uf=="RO") return "11";
	if($uf=="AC") return "12";
	if($uf=="AM") return "13";
	if($uf=="RR") return "14";
	if($uf=="PA") return "15";
	if($uf=="AP") return "16";
	if($uf=="TO") return "17";
	if($uf=="MA") return "21";
	if($uf=="PI") return "22";
	if($uf=="CE") return "23";
	if($uf=="RN") return "24";
	if($uf=="PB") return "25";
	if($uf=="PE") return "26";
	if($uf=="AL") return "27";
	if($uf=="SE") return "28";
	if($uf=="BA") return "29";
	if($uf=="MG") return "31";
	if($uf=="ES") return "32";
	if($uf=="RJ") return "33";
	if($uf=="SP") return "35";
	if($uf=="PR") return "41";
	if($uf=="SC") return "42";
	if($uf=="RS") return "43";
	if($uf=="MS") return "50";
	if($uf=="MT") return "51";
	if($uf=="GO") return "52";
	if($uf=="DF") return "53";
}//ufToCodigo

function limita_caracteres($texto, $limite, $quebra = true){
   $tamanho = strlen($texto);
   if($tamanho <= $limite){ //Verifica se o tamanho do texto é menor ou igual ao limite
      $novo_texto = $texto;
   }else{ // Se o tamanho do texto for maior que o limite
      if($quebra == true){ // Verifica a opção de quebrar o texto
         $novo_texto = trim(substr($texto, 0, $limite))."...";
      }else{ // Se não, corta $texto na última palavra antes do limite
         $ultimo_espaco = strrpos(substr($texto, 0, $limite), " "); // Localiza o útlimo espaço antes de $limite
         $novo_texto = trim(substr($texto, 0, $ultimo_espaco))."..."; // Corta o $texto até a posição localizada
      }
   }
   return $novo_texto; // Retorna o valor formatado
}

function nfce($string){
  $string = str_replace('?','a',$string);
  $string = str_replace('?','A',$string);
  $string = str_replace('?','a',$string);
  $string = str_replace('?','A',$string);
  $string = str_replace('?','a',$string);
  $string = str_replace('?','A',$string);
  $string = str_replace('?','a',$string);
  $string = str_replace('?','A',$string);
  $string = str_replace('?','c',$string);
  $string = str_replace('?','C',$string);
  $string = str_replace('?','e',$string);
  $string = str_replace('?','E',$string);
  $string = str_replace('?','e',$string);
  $string = str_replace('?','E',$string);
  $string = str_replace('?','e',$string);
  $string = str_replace('?','E',$string);
  $string = str_replace('?','i',$string);
  $string = str_replace('?','I',$string);
  $string = str_replace('?','o',$string);
  $string = str_replace('?','O',$string);
  $string = str_replace('?','o',$string);
  $string = str_replace('?','O',$string);
  $string = str_replace('?','o',$string);
  $string = str_replace('?','O',$string);
  $string = str_replace('?','u',$string);
  $string = str_replace('?','U',$string);
  $string = str_replace('~','',$string);
  $string = str_replace('&','e',$string);
  $string = str_replace('.','',$string);
  $string = str_replace('-','',$string);
  $string = str_replace(',','',$string);
  $string = str_replace(';','',$string);
  $string = str_replace(':','',$string);
  $string = str_replace('(','',$string);
  $string = str_replace(')','',$string);
  $string = str_replace('/','',$string);
  return $string;
} 

function icms($preco, $icms){
$valor = $preco; // valor original
$percentual = $icms / 100.0; // 8%
$valor_final = $valor - ($percentual * $valor);
$creditoicms = $valor - $valor_final;
return $creditoicms;
}

function geraCN($length=8){
  $numero = '';    
  for ($x=0;$x<$length;$x++){
	  $numero .= rand(0,9);
  }
  return $numero;
}

function calculaDV($chave43) {
  $multiplicadores = array(2,3,4,5,6,7,8,9);
  $i = 42;
  $soma_ponderada = 0;
  while ($i >= 0) {
	  for ($m=0; $m<count($multiplicadores) && $i>=0; $m++) {
		  $soma_ponderada+= $chave43[$i] * $multiplicadores[$m];
		  $i--;
	  }
  }
  $resto = $soma_ponderada % 11;
  if ($resto == '0' || $resto == '1') {
	  return 0;
  } else {
	  return (11 - $resto);
 }
}

function clear_tags($str){
	return htmlentities(
		strip_tags($str,
			'<p>'
		),
		ENT_QUOTES | ENT_XHTML | ENT_HTML5,
		'UTF-8'
	);
}

function decode_html($str){
	return html_entity_decode($str, ENT_QUOTES | ENT_XHTML | ENT_HTML5, 'UTF-8');
}

function soNumeros($texto){
	return preg_replace("/[^0-9]/","",$texto);
}//sonumeros

//funções uteis fim
//*************************

$config = parse_ini_file(CON_PATH.DS.'config.ini', true);

$host = $config['db']['host'];
$db = $config['db']['dbname'];
$user = $config['db']['user'];
$pass = '';

$db = new PDO('mysql:host='.$host.';dbname='.$db, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

$emitente = $db->query("SELECT * FROM config")->fetchAll(PDO::FETCH_OBJ);

$result = $db->query("SELECT * FROM cliente WHERE id = 1")->fetchAll(PDO::FETCH_OBJ);

$result = current($result);

$result->idVendas = 3;


//verifica se ja foi emitida
$dadosVenda = $db->query("SELECT * FROM vendas WHERE id = '".$result->idVendas."' ")->fetchAll(PDO::FETCH_ASSOC);



if(!empty($dadosVenda[0]->chave)){ //já foi emitida
	
	//mostra pdf
	?><object data="data:application/pdf;base64,<?php echo base64_encode("./nfe/aprovadas/nfe".$dadosVenda[0]->chave.".pdf"); ?>" type="application/pdf" width="100%" height="100%"></object><?php	
	
}else{ //ainda não foi emitida
	
	//Emitente
	$numeroNf = $emitente[0]->numeroNfe+1;
	$ambiente = $emitente[0]->ambiente;
	$cUF = ufToCodigo($emitente[0]->uf);
	$cnpj = soNumeros($emitente[0]->cnpj);
	$aamm = soNumeros(date('y-m'));
	$mod = "55"; //NFe = 55
	$serie = "001";
	$tpEmis='1';//normal = 1
	$num = str_pad($numeroNf, 9, '0',STR_PAD_LEFT);
	$cn = zeroEsquerda($num+0,8);
//	$cn = geraCN(8);
	$chave = "$cUF$aamm$cnpj$mod$serie$num$tpEmis$cn"; //2345234523452345234532452435234
	$dv = calculaDV($chave);
	$chave .= $dv;
	$datanfe = date('Y-m-d');
	$horanfe = date('H:i:sP');
	$formatadata = $datanfe.'T'.$horanfe;
	//$codmunicipio = buscaCodigoMunicipio($this->db,nfce($emitente[0]->cidade),$emitente[0]->uf);
	$codmunicipio = $emitente[0]->cod_cidade;
	$razao =  ($emitente[0]->nome);
	$endereco =  ($emitente[0]->rua);
	$numero =  ($emitente[0]->numero);
	$complemento = "";
	$bairro =  ($emitente[0]->bairro);
	$cidade =  ($emitente[0]->cidade);
	$estado =  ($emitente[0]->uf);
	$cep = soNumeros($emitente[0]->cep);
	$fone = soNumeros($emitente[0]->telefone);
	$ie = soNumeros($emitente[0]->inscricaoEstadual);

	// Escrevendo XML
	$nomeArquivo = "./nfe/enviadas/nfe$chave.xml";
	
	$ponteiro = fopen($nomeArquivo, "w");

	fwrite($ponteiro, "<?xml version='1.0' encoding='utf-8'?>");
	fwrite($ponteiro, '<NFe xmlns="http://www.portalfiscal.inf.br/nfe">');
	fwrite($ponteiro, '<infNFe Id="NFe'.$chave.'" versao="3.10">');
	fwrite($ponteiro, "<ide>");
	fwrite($ponteiro, "<cUF>".$cUF."</cUF>");
	fwrite($ponteiro, "<cNF>$cn</cNF>");
	fwrite($ponteiro, "<natOp>VENDA DE MERCADORIA</natOp>");
	fwrite($ponteiro, "<indPag>1</indPag>"); // 1 = a vista
	fwrite($ponteiro, "<mod>".$mod."</mod>");
	fwrite($ponteiro, "<serie>".($serie+0)."</serie>");
	fwrite($ponteiro, "<nNF>".($num+0)."</nNF>");
	fwrite($ponteiro, "<dhEmi>$formatadata</dhEmi>");
	fwrite($ponteiro, "<tpNF>1</tpNF>"); //normal = 1
	fwrite($ponteiro, "<idDest>1</idDest>"); 
	fwrite($ponteiro, "<cMunFG>$codmunicipio</cMunFG>");
	fwrite($ponteiro, "<tpImp>1</tpImp>"); //vertical
	fwrite($ponteiro, "<tpEmis>1</tpEmis>"); // normal = 1
	fwrite($ponteiro, "<cDV>".$dv."</cDV>");
	fwrite($ponteiro, "<tpAmb>$ambiente</tpAmb>");
	fwrite($ponteiro, "<finNFe>1</finNFe>");
	fwrite($ponteiro, "<indFinal>1</indFinal>"); //1 = consumidor final | 2 = nao final
	fwrite($ponteiro, "<indPres>1</indPres>"); // 1 = venda presencial
	fwrite($ponteiro, "<procEmi>0</procEmi>");
	fwrite($ponteiro, "<verProc>V2.245</verProc>");
	fwrite($ponteiro, "</ide>");

	fwrite($ponteiro, "<emit>");
	fwrite($ponteiro, "<CNPJ>$cnpj</CNPJ>");
	fwrite($ponteiro, "<xNome>$razao</xNome>");
	fwrite($ponteiro, "<enderEmit>");
	fwrite($ponteiro, "<xLgr>$endereco</xLgr>");
	fwrite($ponteiro, "<nro>$numero</nro>");
	if(!empty($complemento)) fwrite($ponteiro, "<xCpl>$complemento</xCpl>");
	fwrite($ponteiro, "<xBairro>$bairro</xBairro>");
	fwrite($ponteiro, "<cMun>$codmunicipio</cMun>");
	fwrite($ponteiro, "<xMun>$cidade</xMun>");
	fwrite($ponteiro, "<UF>$estado</UF>");
	fwrite($ponteiro, "<CEP>$cep</CEP>");
	fwrite($ponteiro, "<cPais>1058</cPais>");
	fwrite($ponteiro, "<xPais>Brasil</xPais>");
	fwrite($ponteiro, "<fone>$fone</fone>");
	fwrite($ponteiro, "</enderEmit>");
	fwrite($ponteiro, "<IE>$ie</IE>");
	fwrite($ponteiro, "<CRT>3</CRT>");
	fwrite($ponteiro, "</emit>");

	//Cliente
	$cpfcliente = soNumeros($result->cpf);	
	$nomecliente =  ($result->nome);	
	$enderecocliente =  ($result->endereco);
	$numerocliente =  ($result->numero);
	$complementocliente = "";
	$bairrocliente =  ($result->bairro);
	
	//$codigoMunicipioCliente = buscaCodigoMunicipio($this->db,nfce($result->cidade),$result->estado);
	$codigoMunicipioCliente = $result->cod_cidade;
	$cidadecliente =  ($result->cidade);
	$estadocliente =  ($result->uf);
	$cepcliente = soNumeros($result->cep);
	$fonecliente = soNumeros($result->telefone);
	
	if($result->indicacaoIe == '9'){
		$ieCliente = '';
	}else{
		$ieCliente = '123213';
	}
	
	$indicacaoIeCliente = soNumeros($result->indicacaoIe);

	fwrite($ponteiro, "<dest>");
	if(strlen($cpfcliente)==14) fwrite($ponteiro, "<CNPJ>$cpfcliente</CNPJ>");
	if(strlen($cpfcliente)==11) fwrite($ponteiro, "<CPF>$cpfcliente</CPF>");
	fwrite($ponteiro, "<xNome>$nomecliente</xNome>");
	fwrite($ponteiro, "<enderDest>");
	fwrite($ponteiro, "<xLgr>$enderecocliente</xLgr>");
	fwrite($ponteiro, "<nro>$numerocliente</nro>");
	if(!empty($complementocliente)) fwrite($ponteiro, "<xCpl>$complementocliente</xCpl>");
	fwrite($ponteiro, "<xBairro>$bairrocliente</xBairro>");
	fwrite($ponteiro, "<cMun>$codigoMunicipioCliente</cMun>");
	fwrite($ponteiro, "<xMun>$cidadecliente</xMun>");
	fwrite($ponteiro, "<UF>$estadocliente</UF>");
	fwrite($ponteiro, "<CEP>$cepcliente</CEP>");
	fwrite($ponteiro, "<cPais>1058</cPais>");
	fwrite($ponteiro, "<xPais>BRASIL</xPais>");
	fwrite($ponteiro, "<fone>$fonecliente</fone>");
	fwrite($ponteiro, "</enderDest>");
	fwrite($ponteiro, "<indIEDest>$indicacaoIeCliente</indIEDest>");
	if(!empty($ieCliente)) fwrite($ponteiro, "<IE>$ieCliente</IE>");
	fwrite($ponteiro, "</dest>");

	$produtos = $db->query("SELECT * FROM vendas_produtos LEFT JOIN produto ON produto.id = vendas_produtos.id_produto WHERE id_venda = '".$result->idVendas."' ")->fetchAll(PDO::FETCH_OBJ);

	$item = 0; //numero do item
	$soma_total = 0;
	foreach($produtos as $produto){

		$item++;

		$ean = ""; 
		$nomeproduto =  (nfce($produto->nome_produto));
		$ncm = soNumeros($produto->ncm); //NCM
		$cfop = soNumeros($produto->cfop);  //CFOP
		$uTrib = nfce($produto->unidade_medida);  //UN
		$quantity = float4($produto->qtd_produto);
		$preco = float4($produto->preco_venda);
		$subtotal = float2($preco * $quantity);
		$detalhesproduto = "";//strip_tags($prds['product_details']);

		$soma_total = $subtotal + $soma_total;

		fwrite($ponteiro, '<det nItem="'.$item.'">');
		fwrite($ponteiro, "<prod>");
		fwrite($ponteiro, "<cProd>".$produto->id_produto."</cProd>");
		fwrite($ponteiro, "<cEAN>$ean</cEAN>");
		fwrite($ponteiro, "<xProd>$nomeproduto</xProd>");
		fwrite($ponteiro, "<NCM>$ncm</NCM>");
		fwrite($ponteiro, "<CFOP>$cfop</CFOP>");
		fwrite($ponteiro, "<uCom>$uTrib</uCom>");
		fwrite($ponteiro, "<qCom>$quantity</qCom>");
		fwrite($ponteiro, "<vUnCom>$preco</vUnCom>");
		fwrite($ponteiro, "<vProd>$subtotal</vProd>");
		fwrite($ponteiro, "<cEANTrib/>");
		fwrite($ponteiro, "<uTrib>$uTrib</uTrib>");
		fwrite($ponteiro, "<qTrib>$quantity</qTrib>");
		fwrite($ponteiro, "<vUnTrib>$preco</vUnTrib>");
		fwrite($ponteiro, "<indTot>1</indTot>");
		fwrite($ponteiro, "</prod>");

		fwrite($ponteiro, "<imposto>");
		fwrite($ponteiro, "<vTotTrib>0</vTotTrib>");
		fwrite($ponteiro, "<ICMS>");
		fwrite($ponteiro, "<ICMSSN102>");
		fwrite($ponteiro, "<orig>1</orig>");
		fwrite($ponteiro, "<CSOSN>102</CSOSN>");
		fwrite($ponteiro, "</ICMSSN102>");
		fwrite($ponteiro, "</ICMS>");
		fwrite($ponteiro, "<PIS>");
		fwrite($ponteiro, "<PISOutr>");
		fwrite($ponteiro, "<CST>49</CST>");
		fwrite($ponteiro, "<vBC>0.00</vBC>");
		fwrite($ponteiro, "<pPIS>0.00</pPIS>");
		fwrite($ponteiro, "<vPIS>0.00</vPIS>");
		fwrite($ponteiro, "</PISOutr>");
		fwrite($ponteiro, "</PIS>");
		fwrite($ponteiro, "<COFINS>");
		fwrite($ponteiro, "<COFINSOutr>");
		fwrite($ponteiro, "<CST>49</CST>");
		fwrite($ponteiro, "<vBC>0.00</vBC>");
		fwrite($ponteiro, "<pCOFINS>0.00</pCOFINS>");
		fwrite($ponteiro, "<vCOFINS>0.00</vCOFINS>");
		fwrite($ponteiro, "</COFINSOutr>");
		fwrite($ponteiro, "</COFINS>");
		fwrite($ponteiro, "</imposto>");

		if(!empty($detalhesproduto)) fwrite($ponteiro, "<infAdProd>$detalhesproduto</infAdProd>");
		fwrite($ponteiro, "</det>");
	}//produtos

	fwrite($ponteiro, "<total>");
	fwrite($ponteiro, "<ICMSTot>");
	fwrite($ponteiro, "<vBC>0.00</vBC>"); //0
	fwrite($ponteiro, "<vICMS>0.00</vICMS>");
	fwrite($ponteiro, "<vICMSDeson>0.00</vICMSDeson>");
	fwrite($ponteiro, "<vBCST>0.00</vBCST>");
	fwrite($ponteiro, "<vST>0.00</vST>");
	fwrite($ponteiro, "<vProd>$soma_total</vProd>");
	fwrite($ponteiro, "<vFrete>0.00</vFrete>");
	fwrite($ponteiro, "<vSeg>0.00</vSeg>");
	fwrite($ponteiro, "<vDesc>0.00</vDesc>");
	fwrite($ponteiro, "<vII>0.00</vII>");
	fwrite($ponteiro, "<vIPI>0.00</vIPI>");
	fwrite($ponteiro, "<vPIS>0.00</vPIS>");
	fwrite($ponteiro, "<vCOFINS>0.00</vCOFINS>");
	fwrite($ponteiro, "<vOutro>0.00</vOutro>");
	fwrite($ponteiro, "<vNF>$soma_total</vNF>");
	fwrite($ponteiro, "</ICMSTot>");
	fwrite($ponteiro, "</total>");

	fwrite($ponteiro, "<transp>");
	fwrite($ponteiro, "<modFrete>9</modFrete>"); //sem frete
	fwrite($ponteiro, "</transp>");


	$nota = "";
	$adFisco = "";
	fwrite($ponteiro, "<infAdic>");
	if(!empty($nota)) fwrite($ponteiro, "<infCpl>$nota</infCpl>");
	if(!empty($adFisco)) fwrite($ponteiro, "<infAdFisco>$adFisco</infAdFisco>");
	fwrite($ponteiro, "</infAdic>");

	/*
	fwrite($ponteiro, "<pag>");
	fwrite($ponteiro, "<tPag>$formapgto</tPag>");
	fwrite($ponteiro, "<vPag>$totalvendas</vPag>");
	fwrite($ponteiro, "</pag>");
	*/
	// Fecha XML
	fwrite($ponteiro, "</infNFe>");
	fwrite($ponteiro, "</NFe>");

	fclose($ponteiro); //salva o xml no arquivo

	//Código de envio do xml:
	$urlIntegracao    = 'http://www.agilcontabil.net/sistemaInstalado/ajax';
	//$dados['usuario'] = $emitente[0]->nomeAgil;
	//$dados['senha']   = $emitente[0]->senhaAgil;
	$dados['usuario'] = 'marciobispo@jvsolucoes.com';
	$dados['senha']   = 'm@rc10B1sp0';
	$dados['acao']    = 'emitirNfeA3';
		//enviar código de segurança do contribuinte quando for NFC-e
		//$dados['idCsc'] = '000001';
		//$dados['csc'] = 'FFABDA2E-1A3E-48B7-A964-A9D6782AD664';
	$dados['xml']     = base64_encode(file_get_contents($nomeArquivo)); //o xml deve ser enviado em formato base64

		//Inicia comunicação com servidor agilcontabil.net
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $urlIntegracao);
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($dados));
		//recebe a resposta
		$resposta = curl_exec($ch);
		//finaliza comunicação
		curl_close($ch);

	$arrayResposta = json_decode($resposta,true); //transforma resposta json em array do PHP

	//mostra a resposta da emissão da nota
	//o xml da nota fiscal emitida está dentro da variavel $resposta["xml"] e deve ser gravado em sua base de dados
	//o pdf da nota fiscal emitida está dentro da variavel $resposta["pdf"] em formato texto hexadecimal
	if($arrayResposta["cStat"]==100){ //sucesso
		//grava xml de resposta na pasta nfe/aprovadas
		file_put_contents("./nfe/aprovadas/nfe".$chave.".xml",base64_decode($arrayResposta["xml"]));
		//grava pdf
		$pdf = hex2bin($arrayResposta["pdf"]);
		file_put_contents("./nfe/aprovadas/nfe".$chave.".pdf",$pdf);

		//grava a chave da nfe na venda
		$sqlUpdateVenda = "UPDATE vendas SET nfe = '".$chave."' WHERE id = '".$result->idVendas."' ";
		$this->db->query($sqlUpdateVenda)->result();

		//altera número da ultima nota emitida na empresa
		$sqlUpdateNumero = "UPDATE emitente SET numeroNfe = '".$numeroNf."' WHERE id = '".$emitente[0]->id."' ";
		$this->db->query($sqlUpdateNumero)->result();

		?>
		<object data="data:application/pdf;base64,<?php echo base64_encode($pdf); ?>" type="application/pdf" width="100%" height="100%"></object>
		<?php	
	}else{ //erro na emissão (mostra o erro)
		echo "Erro: ".$arrayResposta["cStat"]." - ".$arrayResposta["xMotivo"];
	}
}//else (ainda não foi emitida)
?>