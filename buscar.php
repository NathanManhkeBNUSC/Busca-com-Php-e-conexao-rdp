<?php
include_once './conexao.php';

$nomecliente = filter_input(INPUT_GET, 'term', FILTER_SANITIZE_STRING);

//SQL para selecionar os registros
$result_sql = "SELECT nome_cliente FROM tb_cliente WHERE nome_cliente LIKE '%".$nomecliente."%' ORDER BY nome_cliente ASC LIMIT 7";

//Seleciona os registros
$resultado_msg_cont = $conn->prepare($result_sql);
$resultado_msg_cont->execute();

while($row_msg_cont = $resultado_msg_cont->fetch(PDO::FETCH_ASSOC)){
    $data[] = $row_msg_cont['nome_cliente'];
}

echo json_encode($data);
?>