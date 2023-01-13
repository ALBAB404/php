<?php

include 'connection.php';

function show_sub_category($cat_id){
    global $db;
    $sub_category_sql = "SELECT * FROM fashion_category WHERE is_parent = '$cat_id'";
    $sub_category_res = mysqli_query($db,$sub_category_sql);
    while ($row = mysqli_fetch_assoc($sub_category_res)) {
    $cat_id =  $row['id'];
    $cat_name =  $row['f_name'];
    $cat_image =  $row['f_image'];
    $cat_status =  $row['f_status'];

 ?>
 <tr>
      <th scope="row"><?php echo '-';?></th>
      <td>
        <img src="assets/img/icon/<?php echo $cat_image;?>" width = "25">
      </td>
      <td><?php echo  '<i class = "bi bi-arrow-return-right"><i/>'.$cat_name;?></td>
      <td><?php if($cat_status == 1) echo "<span class = 'badge bg-success'>Active</span>";else echo "<span class = 'badge bg-danger'>Inactive</span>"; ?></td>
      <td>
        <a href=""><i class = "bi bi-trash-fill text-danger"></i></a>
        <a href=""><i class = "vbi bi-pencil-square text-dark"></i></a>
      </td>
 </tr>
 <?php
}
}

?>

