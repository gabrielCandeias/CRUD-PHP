<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include_once('./PdoAdapter.php');

try {
    $_POST = json_decode(file_get_contents('php://input'), true);

    $values = $_POST['values'] ?? '';
    $conditions = $_POST['conditions'] ?? '';
    $model = $_POST['model'];
    $event = $_POST['event'];

    /** @var PdoAdapter $PDO */
    $PDO = new PdoAdapter($model);


    switch ($event) {

        case "insert":

            die(json_encode($PDO->insert($values)));
        case "select":

            die(json_encode($PDO->select($values, $conditions)));
        case "delete":

            die(json_encode($PDO->delete($conditions)));
        case "update":

            die(json_encode($PDO->update($values, $conditions)));
    }

} catch (Exception $e) {

    die(json_encode(["success" => false, "message" => $e->getMessage()], true));
}