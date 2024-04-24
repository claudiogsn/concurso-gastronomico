<?php
session_start();
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

        // Prepara a instrução SQL para selecionar o nome do restaurante com base no código fornecido
        $stmt = $conn->prepare("SELECT * FROM restaurante WHERE cod = :cod");
        // Associa o parâmetro com o código fornecido na URL
        $stmt->bindParam(':cod', $_SESSION['cod']);
        // Executa a instrução SQL
        $stmt->execute();

        // Obtém o nome do restaurante

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $nomeRestaurante = $row['nome'];  
        }else{
            $nomeRestaurante = "Restaurante Não Cadastrado";                      
        }
        

    } catch(PDOException $e) {
        echo "Erro ao obter nome do restaurante: " . $e->getMessage();
    }

    // Fecha a conexão com o banco de dados
    $conn = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação Registrada</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-lg w-80 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto text-green-500 mb-4" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 0C4.48 0 0 4.48 0 10s4.48 10 10 10 10-4.48 10-10S15.52 0 10 0zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zM8 14a1 1 0 0 0 1.41 1.41l5-5a1 1 0 1 0-1.41-1.41L9 12.59l-2.29-2.3a1 1 0 0 0-1.41 1.41l3 3z" clip-rule="evenodd" />
        </svg>
        <h2 class="text-2xl font-semibold mb-4">Avaliação Registrada</h2>
        <p class="mb-4">Obrigado por enviar sua avaliação!</p>
        <div class="mb-4">
            <strong>Cupom Fiscal:</strong> <?php echo $_SESSION['cupom_fiscal']; ?><br>
            <strong>Restaurante:</strong> <?php echo $nomeRestaurante; ?><br>
            <strong>Nome:</strong> <?php echo $_SESSION['nome']; ?><br>
            <strong>CPF:</strong> <?php echo $_SESSION['cpf']; ?><br>
            <strong>Telefone:</strong> <?php echo $_SESSION['telefone']; ?><br>
            <strong>Comentário:</strong> <?php echo $_SESSION['avaliacao']; ?><br>
            <strong>Atendimento:</strong> <?php echo $_SESSION['atendimento']; ?><br>
            <strong>Qualidade:</strong> <?php echo $_SESSION['qualidade']; ?><br>
            <strong>Apresentação:</strong> <?php echo $_SESSION['apresentacao']; ?><br>
            <strong>Media Geral:</strong> <?php echo $_SESSION['media_geral']; ?><br>

        </div>
        <a href="index.html" class="text-blue-500">Voltar ao Início</a>
    </div>
</body>
</html>
