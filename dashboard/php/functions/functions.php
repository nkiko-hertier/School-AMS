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
function generateForm($tableName, $db_object) {
    if (!isset($db_object[$tableName])) {
        return "Table not found.";
    }

    $formHtml = "<form action='' method='post'>\n";
    foreach ($db_object[$tableName] as $column) {
        if (isset($column['hidden']) && $column['hidden']) {
            continue;
        }

        $label = isset($column['label']) ? $column['label'] : $column['name'];
        $required = isset($column['required']) && $column['required'] ? 'required' : '';
        $type = $column['type'];

        // Determine input type based on SQL data type
        switch ($type) {
            case 'INT':
                $inputType = 'number';
                break;
            case 'DATE':
                $inputType = 'date';
                break;
            case 'VARCHAR(50)':
            case 'VARCHAR(100)':
            case 'VARCHAR(15)':
            case 'VARCHAR(50)':
                $inputType = 'text';
                break;
            case 'DECIMAL(10, 2)':
                $inputType = 'number';
                $step = 'step="0.01"';
                break;
            case 'TEXT':
                $inputType = 'textarea';
                break;
            default:
                $inputType = 'text';
        }

        $formHtml .= "<div>\n";
        $formHtml .= "<label for='{$column['name']}'>$label</label>\n";
        if ($inputType === 'textarea') {
            $formHtml .= "<textarea name='{$column['name']}' id='{$column['name']}' $required></textarea>\n";
        } else {
            $stepAttr = isset($step) ? $step : '';
            $formHtml .= "<input type='$inputType' name='{$column['name']}' id='{$column['name']}' $required $stepAttr />\n";
        }
        $formHtml .= "</div>\n";
    }
    $formHtml .= "<button type='submit'>Submit</button>\n";
    $formHtml .= "</form>\n";

    return $formHtml;
}

?>