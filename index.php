<?php
session_start();

// Verificar se existe a variável global
if(isset($_SESSION['msg'])){

    // Imprimir o valor que está dentro da variável global
    echo $_SESSION['msg'];

    // Destruir a variável global
    unset($_SESSION['msg']);
}

include_once './conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Pesquise o nome do cliente</title>
        <link rel="icon" href="infowayico.png">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="index.php">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">        
    </head>
    
    <body>            
        <h1 class="Titulo">Pesquisar Cliente</h1>
      
        <div class="Organize-Input">
        <form method="POST" action="index.php">            
            <input type="text" name="nomecliente" id="nomecliente" placeholder="Nome do cliente">        
            <button type="submit" id="Botao" name="SendPesqMsg" value="Pesquisar">
              <i class="bi bi-search"></i>
            </button>
        </form>
      </div>

    <div id="excel">  
    <a class ="teste1" href="gerarexcel.php"> 
        <img src="excel.png">
    </a>  
    </div> 
    <?php
        $SendPesqMsg = filter_input(INPUT_POST, 'SendPesqMsg', FILTER_SANITIZE_STRING);          

            $nomecliente = filter_input(INPUT_POST, 'nomecliente', FILTER_SANITIZE_STRING);

             //SQL para selecionar os registro
             $resul_button = "SELECT * FROM tb_cliente WHERE nome_cliente LIKE '%".$nomecliente."%' ORDER BY nome_cliente ASC LIMIT 10";
             $resultado_cont = $conn->prepare($resul_button);
             $resultado_cont->execute();
                                              
            $row_msg_cont = $resultado_cont->fetch(PDO::FETCH_ASSOC);?>   
                 
            <h1 align=center style='color:white'><?php if ($row_msg_cont <> '') {
                echo $row_msg_cont['nome_cliente'];
            }else 
                echo "CLIENTE NÃO ENCONTRADO";
                ?></h1>        
        <?php        
        ?>     

     <table width=100% border=4 cellpadding=1 cellspacing=2 align=center bordercolor="white">
        <tr>            
            <td align=center width="33%" height=60px style='color:black'><b><h2>Host</h2></b></td>
            <td align=center width="33%" style='color:black'><b><h2>Porta</h2></b></td>
            <td align=center width="33%" style='color:black'><b><h2>CNPJ</h2></b></td>                              
        </tr>                 

      <?php
        $SendPesqMsg = filter_input(INPUT_POST, 'SendPesqMsg', FILTER_SANITIZE_STRING);          
        if ($SendPesqMsg){
            $nomecliente = filter_input(INPUT_POST, 'nomecliente', FILTER_SANITIZE_STRING);

             //SQL para selecionar os registro
             $resul_button = "SELECT * FROM tb_cliente WHERE nome_cliente LIKE '%".$nomecliente."%' ORDER BY nome_cliente ASC LIMIT 10";
             $resultado_cont = $conn->prepare($resul_button);
             $resultado_cont->execute();
                                              
            $row_msg_cont = $resultado_cont->fetch(PDO::FETCH_ASSOC);?>

            <TR>
                <td style='color:white' height=40px align=center><b><?php if ($row_msg_cont <> '') { echo $row_msg_cont['host_cliente'] . "<br>"; } else { echo ""; }?></b></td>
                <td style='color:white' align=center><b><?php if ($row_msg_cont <> '') { echo $row_msg_cont['porta'] . "<br>"; } else {echo"";}?></b></td>
                <td style='color:white' align=center><b><?php if ($row_msg_cont <> '') {echo $row_msg_cont['cnpj'] . "<br>";} else {echo"";}?></b></td>
            </TR>

        <?php } ?>                
     </table>

     <br><br>
     
     <table width=100% border=4 cellpadding=1 cellspacing=2 align=center bordercolor="white">
        <tr>            
            <td align=center width="33%" height=60px style='color:black'><b><h2>Senha de acesso</h2></b></td>
            <td align=center width="33%" style='color:black'><b><h2>Personalização</h2></b></td>
            <td align=center width="33%" style='color:black'><b><h2>ERP NOW</h2></b></td>                              
        </tr>                 

      <?php
        $SendPesqMsg = filter_input(INPUT_POST, 'SendPesqMsg', FILTER_SANITIZE_STRING);          
        if ($SendPesqMsg){
            $nomecliente = filter_input(INPUT_POST, 'nomecliente', FILTER_SANITIZE_STRING);

             //SQL para selecionar os registro
             $resul_button = "SELECT * FROM tb_cliente WHERE nome_cliente LIKE '%".$nomecliente."%' ORDER BY nome_cliente ASC LIMIT 10";
             $resultado_cont = $conn->prepare($resul_button);
             $resultado_cont->execute();
                                              
            $row_msg_cont = $resultado_cont->fetch(PDO::FETCH_ASSOC);?>

            <TR>
                <td style='color:white' height=40px align=center><b><?php if ($row_msg_cont <> '') { echo $row_msg_cont['senha_de_acesso'] . "<br>";} else { echo ""; }?></b></td>
                <td style='color:white' align=center><b><?php if ($row_msg_cont <> '') { echo $row_msg_cont['personalizacao']  . "<br>";?> <?php echo $row_msg_cont['sistema']  . "<br>"; } else { echo ""; }?></b></td>
                <td style='color:white' align=center><b><?php if ($row_msg_cont <> '') { echo $row_msg_cont['erp_now'] . "<br>";} else { echo ""; }?></b></td>
            </TR>

        <?php } ?>                
     </table>
       <br>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

        <script>
            $(function(){
              $("#nomecliente").autocomplete({
                  source: 'buscar.php'
              });
            })
        </script>
        
    </body>
</html>
