<?php 

include '../inc/connection.php';
include '../inc/function.php';


if (isset($_POST['add_category'])) {
    $cat_name = $_POST['cat_name'];
    $uis_parent = $_POST['is_parent'];
    $file_name = $_FILES['choose-file']['name'];
    $tmp_name = $_FILES['choose-file']['tmp_name'];

    $split = explode('.',$file_name);
    $extn = strtolower(end($split));
    $compaire = array('jpg','png');
    
    if (!empty($cat_name)) {
        if (in_array($extn,$compaire) === true) {
        
            $update_name = rand().$file_name;
            move_uploaded_file($tmp_name,'../assets/img/icon/'.$update_name);
            $insert_sql =  "INSERT INTO fashion_category (f_name,f_image,is_parent,f_status) VALUE ('$cat_name','$update_name','$uis_parent','1')";
             $insert_res = mysqli_query($db,$insert_sql);
            if ($insert_res) {
                header('location: ../category.php');
            }else{
                die('error from insert page!'.mysqli_error($db));
            }
        }else {
            $insert_sql =  "INSERT INTO fashion_category (f_name,is_parent,f_status) VALUE ('$cat_name','$uis_parent','1')";
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

// .........brand insert start ........... 

if (isset($_POST['add_brand'])) {
    $brand_name = $_POST['brand_name'];
    $file_name = $_FILES['choose-file']['name'];
    $tmp_file = $_FILES['choose-file']['tmp_name'];

    if (!empty($file_name)) {
        $files = is_img($file_name);

        if ($files) {
            $update_name = rand().$file_name;
            move_uploaded_file($tmp_file, '../assets/img/brand/'.$update_name);
           
        }else {
            echo 'Not a image';
        }
       
        }else {
            $update_name = '';
        }
        $brand_insert_sql =  "INSERT INTO fashion_brand (b_name,b_logo,b_status) VALUE ('$brand_name','$update_name','1')";
        $brand_insert_res = mysqli_query($db,$brand_insert_sql);
        if ($brand_insert_res) {
            header('location: ../brand.php');
        }else {
            die('logo cant be see'.mysqli_error($db));
    }
    
    


}

?>