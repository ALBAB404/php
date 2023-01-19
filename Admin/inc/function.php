<?php

include 'connection.php';

function show_sub_category($id){

  global $db;

  $cat_sql = "SELECT * FROM fashion_category  WHERE is_parent = '$id'";
                $cat_res = mysqli_query($db,$cat_sql);
                while ($row = mysqli_fetch_assoc($cat_res)) {
                  $id = $row['id'];
                  $f_name = $row['f_name'];
                  $f_image = $row['f_image'];
                  $f_status = $row['f_status'];
                  ?>
                  <tr>
                    <th scope="row"><?php echo '--';?></th>
                    <td>
                      <img src="assets/img/icon/<?php echo $f_image;?>" width = "50">
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

?>

