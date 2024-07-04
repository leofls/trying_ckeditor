<?php
// Diretório onde os arquivos serão salvos
$targetDir = "uploads/";
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// Verifica se o arquivo foi enviado
if (isset($_FILES["upload"])) {
    $file = $_FILES["upload"];
    $targetFile = $targetDir . basename($file["name"]);

    // Move o arquivo enviado para o diretório de destino
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        // Retorna a URL do arquivo salvo
        $response = array(
            "url" => $targetFile
        );
    } else {
        // Retorna um erro se o upload falhar
        $response = array(
            "error" => array(
                "message" => "Erro ao enviar o arquivo."
            )
        );
    }
} else {
    // Retorna um erro se nenhum arquivo for enviado
    $response = array(
        "error" => array(
            "message" => "Nenhum arquivo enviado."
        )
    );
}

// Define o cabeçalho da resposta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
