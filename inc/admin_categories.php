<?php
    include("conn_pdo.php");
    try {
        $sql = 'SELECT * FROM categories ORDER BY category_name';
        $ref = $pdo->prepare($sql);
        $ref->execute();
        $result = $ref->fetchAll();

        $rowData = array();
        foreach ($result as $key => $val) {
            extract($val);
            $lineData = array();
            if($val['active'] == 1){
                $checked = "checked";
            }else{
                $checked = '';
            }
            $lineData[] = "<input type='checkbox' class='mr-2' $checked onclick='updateStatus({$val['category_id']})'>" . $val['category_name'];
            $lineData[] = "
                <i title='' class='fa fa-trash float-right text-danger fa-2x ml-2' aria-hidden='true' onclick='deleteItem({$val['category_id']},\"cat\")'></i>
                <i title='' class='fa fa-pencil float-right text-primary fa-2x' aria-hidden='true' onclick='editItem({$val['category_id']},\"cat\")'></i>
            ";
            $rowData[] = $lineData;
        }
        $json_data = array(
            "recordsTotal" => 0,
            "recordsFiltered" => 0,
            "data" => $rowData
        );
        echo json_encode($json_data);

    }catch(PDOException $e){
        $errorMessage = $e->getMessage();
        die($errorMessage);
    }

