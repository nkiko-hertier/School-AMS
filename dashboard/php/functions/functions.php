<?php
function checkExist($table, $rowValue){
    $sql = "SELECT * FROM $table WHERE $rowValue";
    $result = mysqli_query(CONN, $sql);
    if (mysqli_num_rows($result)>0) {
        return 1;
    } else {
        return 0;
    }
}

function deleteItemById($table, $id){
    $sql = "DELETE * FROM $table WHERE id = ?";
    $result = mysqli_query(CONN, $sql);
    if (mysqli_num_rows($result)>0) {
        return 1;
    } else {
        return 0;
    }
}
function ObjectSet($title, $icon, $message){
    $object['title'] = $title;
    $object['icon']  = $icon;
    $object['text']  = $message;
    return $object;
}
function colValuePairs($array){
    $columnValuePairs = array();
    foreach ($array as $key => $value) {
        $columnValuePairs[] = "`$key` = '$value'";
    }
    return $columnValuePairs;
}

?>