<?php
session_start();
function getRealIpAddr() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        // Verifica se o IP do cliente está disponível
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // Verifica se o IP foi passado por um proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        // Se nenhuma informação de IP estiver disponível, usa o REMOTE_ADDR
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// Obtém o IP do cliente
$clientIP = getRealIpAddr();

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configurações do banco de dados
    $servername = "srv1196.hstgr.io";
    $username = "u675487118_gastro";
    $password = "Gas@159..";
    $dbname = "u675487118_gastronomia";

    try {
        // Conecta ao banco de dados usando PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Seta o modo de erro do PDO para exceção
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepara a instrução SQL para inserção de dados
        $stmt = $conn->prepare("INSERT INTO tabela_avaliacao (restaurante, cupom_fiscal, nome, cpf, telefone, avaliacao, atendimento, qualidade, apresentacao, media_geral,ip_request) 
                                VALUES (:restaurante, :cupom_fiscal, :nome, :cpf, :telefone, :avaliacao, :atendimento, :qualidade, :apresentacao, :media_geral,:ip_request)");

        // Calcula a média das notas
        $media_geral = ($_POST['atendimento'] + $_POST['qualidade'] + $_POST['apresentacao']) / 3;
        $media_geral = number_format($media_geral, 2);

        // Associa os parâmetros com os valores do formulário
        $stmt->bindParam(':restaurante', $_POST['cod']);
        $stmt->bindParam(':cupom_fiscal', $_POST['cupom-fiscal']);
        $stmt->bindParam(':nome', $_POST['name']);
        $stmt->bindParam(':cpf', $_POST['cpf']);
        $stmt->bindParam(':telefone', $_POST['telefone']);
        $stmt->bindParam(':avaliacao', $_POST['avaliacao']);
        $stmt->bindParam(':atendimento', $_POST['atendimento']);
        $stmt->bindParam(':qualidade', $_POST['qualidade']);
        $stmt->bindParam(':apresentacao', $_POST['apresentacao']);
        $stmt->bindParam(':media_geral', $media_geral);
        $stmt->bindParam(':ip_request', $clientIP);

        // Executa a instrução SQL
        $stmt->execute();

        $_SESSION['cupom_fiscal'] = $_POST['cupom-fiscal'];
        $_SESSION['restaurante'] = $_POST['restaurante'];
        $_SESSION['nome'] = $_POST['name'];
        $_SESSION['cpf'] = $_POST['cpf'];
        $_SESSION['telefone'] = $_POST['telefone'];
        $_SESSION['avaliacao'] = $_POST['avaliacao'];
        $_SESSION['atendimento'] = $_POST['atendimento'];
        $_SESSION['qualidade'] = $_POST['qualidade'];
        $_SESSION['apresentacao'] = $_POST['apresentacao'];
        $_SESSION['media_geral'] = $media_geral;
        $_SESSION['cod'] = $_POST['cod'];

        // Redireciona para a página de resultado com os dados no corpo da requisição POST
        header("Location: resultado.php");
        exit();
    } catch(PDOException $e) {
        echo "Erro ao enviar avaliação: " . $e->getMessage();
    }

    // Fecha a conexão com o banco de dados
    $conn = null;
}
?>
