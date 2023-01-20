<?php
include_once './conexao.php';
?>

<?php
        $SendPesqMsg = filter_input(INPUT_POST, 'SendPesqMsg', FILTER_SANITIZE_STRING);          
        if ($SendPesqMsg){
            $nomecliente = filter_input(INPUT_POST, 'nomecliente', FILTER_SANITIZE_STRING);

             //SQL para selecionar os registro
             $resul_button = "SELECT * FROM tb_cliente WHERE nome_cliente LIKE '%".$nomecliente."%' ORDER BY nome_cliente ASC LIMIT 10";
             $resultado_cont = $conn->prepare($resul_button);
             $resultado_cont->execute();

            $Testea = 'nome_cliente';
                    
            $row_msg_cont = $resultado_cont->fetch(PDO::FETCH_ASSOC);                              
                  echo $row_msg_cont['nome_cliente'] . "<br>";                
                  echo $row_msg_cont['nome_cliente'] . "<br>";
                                    
                                                                
             }
                         
        ?>