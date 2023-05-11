<?php

include_once "conecta-sqlite.php";

function inserir_pessoa($pessoa) {
    global $pdo;
    $sql = "INSERT INTO pessoa (login, dt_nascimento, url_foto, interesse_homens, interesse_mulheres,sexo) " .
            "VALUES (:login, :dt_nascimento, :url_foto, :interesse_homens, :interesse_mulheres, :sexo)";
    $pdo->prepare($sql)->execute($pessoa);
    return $pdo->lastInsertId();
}

function alterar_pessoa($pessoa) {
    global $pdo;
    $sql = "UPDATE pessoa SET " .
            "login = :login, " .
            "dt_nascimento = :dt_nascimento, " .
            "url_foto = :url_foto, ".
            "interesse_homens = :interesse_homens, " .
            "interesse_mulheres = :interesse_mulheres, " .
            "sexo = :sexo ".
            "WHERE chave = :chave";
    $pdo->prepare($sql)->execute($pessoa);
}

function excluir_pessoa($chave) {
    global $pdo;
    $sql = "DELETE FROM pessoa WHERE chave = :chave";
    $pdo->prepare($sql)->execute(["chave" => $chave]);
}

function listar_todas_pessoas() {
    global $pdo;
    $sql = "SELECT * FROM pessoa";
    $resultados = [];
    $consulta = $pdo->query($sql);
    while ($linha = $consulta->fetch()) {
        $resultados[] = $linha;
    }
    return $resultados;
}

function buscar_pessoa($chave) {
    global $pdo;
    $sql = "SELECT * FROM pessoa WHERE chave = :chave";
    $resultados = [];
    $consulta = $pdo->prepare($sql);
    $consulta->execute(["chave" => $chave]);
    return $consulta->fetch();
}

// function listar_todos_tipos() {
//     global $pdo;
//     $sql = "SELECT * FROM tipo_pessoa";
//     $resultados = [];
//     $consulta = $pdo->query($sql);
//     while ($linha = $consulta->fetch()) {
//         $resultados[] = $linha["tipo"];
//     }
//     return $resultados;
// }