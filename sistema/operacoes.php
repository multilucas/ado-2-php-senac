<?php
include_once "conecta_sqlite.php";

function inserir_pessoa($pessoa) {
    global $pdo;
    $sql = "INSERT INTO pessoa(login,dt_nascimento,url_foto,interesse_homens,interesse_mulheres,sexo)" . "VALUES (:login, :dt_nascimento, :url_foto, :interesse_homens,:interesse_mulheres,:sexo)";
    $pdo->prepare($sql)->execute($pessoa);
    return $pdo->lastInsertId();
}  

function alterar_pessoa($pessoa) {
    global $pdo;
    $sql = "UPDATE pessoa SET " .
           "login = :login, " .
           "dt_nascimento = :dt_nascimento, " .
           "url_foto = :url_foto, " .
           "interesse_homens = :interesse_homens, " .
           "interesse_mulheres = :interesse_mulheres, " .
           "sexo = :sexo" . 
           "WHERE chave = :chave";
    $pdo->prepare($sql)->execute($pessoa);
}

function listar_todas_pessoas(){
    global $pdo;
    $sql = "SELECT * FROM pessoa";
    $resultados = [];
    $consulta = $pdo->query($sql);
    while ($linha = $consulta->fetch()){
        $resultados[] = $linha;
    }
    return $resultados;
}
?>