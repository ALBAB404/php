<?php 

include '../inc/connection.php';

if (isset($_POST['add_category'])) {
    $cat_name = $_POST['cat_name'];
    $is_parent = $_POST['is_parent'];
    $file_name = $_FILES['choose-file']['name'];
    $tmp_name = $_FILES['choose-file']['tmp_name'];

    $split = explode('.',$file_name);
    $extn = strtolower(end($split));
    $compaire = array('jpg','png');
    
    if (!empty($cat_name)) {
        if (in_array($extn,$compaire) === true) {
        
            $update_name = rand().$file_name;
            move_uploaded_file($tmp_name,'../assets/img/icon/'.$update_name);
            $insert_sql =  "INSERT INTO fashion_category (f_name,f_image,is_parent,f_status) VALUE ('$cat_name','$update_name','$is_parent','1')";
             $insert_res = mysqli_query($db,$insert_sql);
            if ($insert_res) {
                header('location: ../category.php');
            }else{
                die('error from insert page!'.mysqli_error($db));
            }
        }else {
            $insert_sql =  "INSERT INTO fashion_category (f_name,is_parent,f_status) VALUE ('$cat_name','$is_parent','1')";
        $insert_res = mysqli_query($db,$insert_sql);
            if ($insert_res) {
                header('location: ../category.php');
            }else{
                die('error from insert page!'.mysqli_error($db));
            }
        }
    }else {
        header('location: ../category.php');
        die("<script>alert('Please Fill The Gap')</script>".mysqli_error($db));

    }
  
}

?>