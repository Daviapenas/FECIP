<?php

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php: //input'), true);

// Defina as informações de conexão
$serverName = "digitalcoreserver.database.windows.net";  // Host do servidor SQL
$connectionOptions = array(
    "Database" => "DigitalCoreDB",  // Nome do banco de dados
    "Uid" => "DIGITAL.CORE",  // Nome de usuário
    "PWD" => "@FECIP2K24",  // Senha
    "Encrypt" => true,  // SSL habilitado (recomendado para Azure)
    "TrustServerCertificate" => false,  // Certificado SSL
    "LoginTimeout" => 30,  // Timeout da conexão
);

// Estabelecer a conexão com o SQL Server
$conn = sqlsrv_connect($serverName, $connectionOptions);


// Verificar se a conexão foi bem-sucedida
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

echo "Conexão bem-sucedida com o SQL Server!";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     error_log("Requisição POST recebida");
    
if(isset($_POST['nome_user']) && isset($_POST['senha_user']) && isset($_POST['icone_escolhido'])){

 $nome_user = $_POST['nome_user'];  
 $senha_user = $_POST['senha_user'];  
 $icone_user = $_POST['icone_escolhido'];

 echo $nome_user, $senha_user, $icone_user;

 //Montar o comando SQL de inserção
    $sql = "INSERT INTO digitalcore.usuario (nome_user, senha_user, icone_user) VALUES (?, ?, ?)";

    // Preparar os parâmetros
    $params = array($nome_user, $senha_user, $icone_user);

    // Executar a query de inserção
    $stmt = sqlsrv_query($conn, $sql, $params);

    // Verificar se a query foi bem-sucedida
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "Usuário inserido com sucesso!<br>";
    }
}
else{
    echo "erro com a requisisao POST";
}

    $response = array('status' => 'sucesso', 'data' => $data);
    echo json_encode($response);
// Fechar a conexão
sqlsrv_close($conn);
?>
