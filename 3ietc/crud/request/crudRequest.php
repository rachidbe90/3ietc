<?php

// La connexion à la Datat Base
$pdo = new PDO('mysql:host=localhost;
    dbname=ietc_test',
    'root',
    '');

// créer un reqest
function creatRequest($staff_id, $student_id, $cours_id, $status_id, $document_id){
    global $pdo;
    $request_date = date("F j, Y, g:i a");
    $date_decision = null;
    $sql = "INSERT INTO request VALUE(NULL, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $request_date, PDO::PARAM_STR);
    $stmt->bindValue(2, $date_decision, PDO::PARAM_STR);
    $stmt->bindValue(3, $staff_id, PDO::PARAM_INT);
    $stmt->bindValue(4, $student_id, PDO::PARAM_INT);
    $stmt->bindValue(5, $cours_id, PDO::PARAM_INT);
    $stmt->bindValue(6, $status_id, PDO::PARAM_INT);
    $stmt->bindValue(7, $document_id, PDO::PARAM_INT);
    return $stmt->execute();
    $pdo = null;
}

// effacer
function deleteRequest($id){
    global $pdo;
    $sql = "DELETE FROM request WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    return $stmt->execute();
    $pdo = null;
}

// modifier
function updateRequest($id,$status_id){
    global $pdo;
    $date_decision = date("F j, Y, g:i a");
    $sql = "UPDATE request 
            SET date_decision=?, status_id=? 
            WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $date_decision, PDO::PARAM_STR);
    $stmt->bindValue(2, $status_id, PDO::PARAM_INT);
    $stmt->bindValue(3, $id, PDO::PARAM_INT);
    return $stmt->execute();
    $pdo = null;
}

// voir un
function getRequest($id){
    global $pdo;
    $sql = "SELECT * FROM request WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_OBJ);
    $pdo = null;
}

// voir tout
function getAllRequest(){
    global $pdo;
    $sql = "SELECT * FROM request";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
    $pdo = null;
}