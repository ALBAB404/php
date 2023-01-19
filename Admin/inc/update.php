<!-- update page  -->

<?php

include 'connection.php' ;

if (isset($_POST['update_category'])) {
    $name = $_POST['cat_name'];
    $uis_parent = $_POST['is_parent'];
    $status = $_POST['f_status'];
    $editid = $_POST['edit'];
    
    if (!empty($file_name)) {
        $file_name = $_FILES['choose-file']['name'];
        $tmp_name = $_FILES['choose-file']['tmp_name'];
        $split = explode('.',$file_name);
        $extn = strtolower(end($split));
        $compaire = array('jpg','png');
        if (in_array($extn,$compaire) === true ) {
            $update_name = rand().$file_name;
            move_uploaded_file($tmp_name,'../assets/img/icon/'.$update_name);
            $update_sql = "UPDATE fashion_category SET f_name = '$name', f_image='$update_name', is_parent='$uis_parent', f_status='$status' WHERE id = '$editid'";
            $update_res = mysqli_query($db,$update_sql);
            if ($update_res) {
                header('location: ../category.php');
            }else{
                die('error from update page!'.mysqli_error($db));
            }
        }else{
            echo "please upload a image !";
        }
    }else {
        $update_sql = "UPDATE fashion_category SET f_name ='$name', is_parent='$uis_parent', f_status='$status' WHERE id = '$editid'";
        $update_res = mysqli_query($db,$update_sql);
        if ($update_res) {
            header('location: ../category.php');
        }else{
            die('error from update page!'.mysqli_error($db));
        }
   }
}




?>