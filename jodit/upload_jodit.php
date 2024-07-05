<?php

// Define o cabeçalho da resposta como JSON
header('Content-Type: application/json');

// Diretório onde os arquivos serão salvos
$targetDir = "uploads/";
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// var_dump($_POST);
// Verifica se o arquivo foi enviado
if (isset($_FILES['files'])) {
    $file = $_FILES['files'];

    $targetFile = $targetDir . basename($file["name"][0]);

    // Verifica se o arquivo já existe
    if (file_exists($targetFile)) {
        echo json_encode([
            'success' => false,
            'message' => 'Erro: O arquivo já existe.'
        ]);
        exit;
    }

    // Move o arquivo enviado para o diretório de destino
    if (move_uploaded_file($file["tmp_name"][0], $targetFile)) {
        // Retorna a URL do arquivo salvo
        // $fileUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $targetFile;
        echo json_encode(['success' => true, 'file' => $targetFile]);
    } else {
        // Retorna um erro se o upload falhar
        echo json_encode(['error' => 'Erro ao fazer upload do arquivo.']);
    }
} else {
    // Retorna um erro se nenhum arquivo for enviado
    echo json_encode(['error' => 'Nenhum arquivo enviado.']);
}


