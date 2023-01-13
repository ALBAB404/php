<?php
include '../inc/connection.php';
// insert category 

if (isset($_POST['add_category'])) {
    $name = $_POST['cat_name'];
    $is_parent = $_POST['is_parent'];
    $file_name = $_FILES['choose-file']['name'];
    $tmp_name = $_FILES['choose-file']['tmp_name'];
    $file_size = $_FILES['choose-file']['size'];

    $splited_files = explode('.',$file_name);
    $extn = strtolower(end($splited_files));

    $extension = array('png','jpg','jpeg');

    if (!empty($file_name)) {
        if (in_array($extn,$extension) === true) {
            $update_name = rand().$file_name;
            move_uploaded_file($tmp_name,'../assets/img/products/category/'.$update_name);
            $cat_insert = "INSERT INTO fashion_category (f_name,is_parent,f_status) value ('$name','$is_parent','1')";
            $cat_insert_res = mysqli_query($db,$cat_insert);
            if ($cat_insert_res) {
            header('location: ../category.php');
            }else{
                die('error in database!'.mysqli_error($db));
            }
                }else {
                    echo "warning ! please upload a (jpg,png,jpeg) files !";
                }
            }else {
                $cat_insert = "INSERT INTO fashion_category (f_name,is_parent,f_status) value ('$name','$is_parent','1')";
                $cat_insert_res = mysqli_query($db,$cat_insert);
                if ($cat_insert_res) {
                header('location: ../category.php');
        }else{
            die('error in database!'.mysqli_error($db));
        }
    }

}


?>