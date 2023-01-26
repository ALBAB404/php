<?php

include 'connection.php';

function show_sub_category($id){

  global $db;

  $cat_sql = "SELECT * FROM fashion_category  WHERE is_parent = '$id' ORDER BY f_name ASC";
                $cat_res = mysqli_query($db,$cat_sql);
                while ($row = mysqli_fetch_assoc($cat_res)) {
                  $id = $row['id'];
                  $f_name = $row['f_name'];
                  $cat_image = $row['f_image'];
                  $f_status = $row['f_status'];
                  ?>
                  <tr>
                    <th scope="row"><?php echo '--';?></th>
                    <td>
                      <img src="assets/img/icon/<?php echo $cat_image;?>" width = "60">
                    </td>
                    <td><?php echo $f_name;?></td>
                    <td><?php if($f_status == 1)echo "<span class ='badge bg-success'>Active</span>"; else echo "<span class ='badge bg-danger'>Inactive</span>" ;?></td>
                    <td>
                      <a href="category.php?editid=<?php echo $id;?>"><i class = "bi bi-pencil-square text-dark"></i></a>
                      <a href="" data-bs-toggle="modal" data-bs-target="#delid<?php echo $id; ?>"><i class = "bi bi-trash-fill text-danger"></i></a>
                      <!-- Modal -->
                          <div class="modal fade" id="delid<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                  <h1>Are Your Sure?</h1>
                                </div>
                                <div class="modal-footer m-auto">
                                  <a href="category.php?delid=<?php echo $id; ?>" type="button" class="btn btn-danger">Confirm</a>
                                  <button type="button" class="btn btn-primary">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                    </td>
                  </tr>
                  <?php
                   }           
}


// brand insert function 

function is_img($file_name){
  global $db;

  $split = explode('.', $file_name);
  $extn = strtolower(end($split));
  $compaire = array('jpg','png');

  if (in_array($extn,$compaire) === true) {
    return true;
  }else{
    return false;
  }


}


// delete function 

function delete($table,$key,$delid,$redirect){
  global $db;
  $del_sql = "DELETE FROM $table WHERE $key = '$delid'";
  $del_sql_res = mysqli_query($db,$del_sql);

  if ($del_sql_res) {
    header('location: '.$redirect);
  }else {
    die('error from delete function !'.mysqli_error($db));
  }
}


// delete image function 

function delete_img($fa_name,$table,$pkey,$nkey,$path){
  global $db;
  $del_file = mysqli_query($db,"SELECT $fa_name FROM $table WHERE $pkey = '$nkey'");
  $row = mysqli_fetch_assoc($del_file);

  $f_name = $row['f_image'];

  unlink($path.$f_name);


}


?>

