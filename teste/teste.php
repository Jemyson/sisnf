<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Máscara para campos monetários com jquery + maskMoney</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script type="text/javascript" src="../js/jquery.min.js" ></script>
    <script type="text/javascript" src="../js/jquery.maskMoney.js" ></script>
    <script type="text/javascript">
        $(document).ready(function(){
              $("input.dinheiro").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});

              var searchInput = $('input.dinheiro');
              searchInput.focus();
              var strLength = searchInput.val().length * 2;
              searchInput[0].setSelectionRange(strLength, strLength);
              
        });

        
        
    </script>
</head>
<body>
     <h1></h1>
     <form>
            Valor: <input type="text" name="exemplo1" class="dinheiro" style="text-align: right" onfocus="this.value = this.value;" />
     </form>
</body>
</html>