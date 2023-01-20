<?php

session_start();

ob_start();
//Incluir a conexão com o bd
include_once './conexao.php';

//Query para recuperar registros do banco
$query_usuarios = "SELECT  id, nome_cliente, host_cliente, porta, cnpj, senha_de_acesso, personalizacao, erp_now, sistema FROM tb_cliente ORDER BY id ASC";

//Preparar a QUERY
$result_usuarios = $conn->prepare($query_usuarios);

// Executar a QUERY
$result_usuarios->execute();

//Acessa o if quando encontrar registro no banco de dados 

if(($result_usuarios) and ($result_usuarios->rowCount() != 0)){    
    //Aceitar csv ou texto
    header('Content-Type: text/csv; charset=utf-8');

    //Nome do arquivo
    header('Content-Disposition: attachment; filename=arquivo.csv');
    
    //Gravar no buffer
    $resultado = fopen("php://output", 'w');

    //Criar o cabeçalhjo do Excel
    $cabecalho = ['id', 'Nome', 'Host', 'Porta', 'Cnpj', 'Senha', 'Personalizacao', 'ERP NOW', 'Sistema'];

    // Escrever o cabeçalho no arquivo
    fputcsv($resultado,$cabecalho, ';');

   // Ler os registros retornado do banco de dados
   while($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)){

    // Escrever o conteúdo no arquivo
    fputcsv($resultado, $row_usuario, ';');

    }
}else {
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Nenhum usuário encontrado!</p>";
    header("Location: index.php");
}
?>


