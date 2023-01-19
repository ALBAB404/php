<?php include "inc/header.php";?>

<?php include 'inc/manubar.php';?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <!-- your main code here  -->

      <div class="row">
        <div class="col-lg-5">
          <div class="form">
          <div class="card-body">

          <!-- update form  -->
          <?php
          
          if (isset($_GET['editid'])) {
            $uid = $_GET['editid'];
            $sql = "SELECT * FROM fashion_category  WHERE id = '$uid'";
            $res = mysqli_query($db,$sql);
            $row = mysqli_fetch_assoc($res);
              $uf_name = $row['f_name'];
              $uf_image = $row['f_image'];
              $uis_parent = $row['is_parent'];
              $uf_status = $row['f_status'];

            ?>
            <!-- update Form -->
            <h5 class="card-title">Update Category Name </h5>
              <form class="row g-3" action = "inc/update.php" method ="POST" enctype = "multipart/form-data">
                <div class="col-md-12">
                  <input type="text" class="form-control" placeholder="Category Name" value="<?php echo $uf_name?>" name="cat_name" >
                </div>
                <div class="col-md-12">
                <label class = "mb-2">Choose File</label>
                  <select id="inputState" class="form-select" name="is_parent">
                    <option selected="">Choose...</option>
                <?php
                $sql = "SELECT * FROM fashion_category  WHERE is_parent = '0' order by f_name asc";
                $res = mysqli_query($db,$sql);
                $serial = 0;
                while ($row = mysqli_fetch_assoc($res)) {
                  $id = $row['id'];
                  $f_name = $row['f_name'];
                  $f_image = $row['f_image'];
                  $is_parent = $row['is_parent'];
                  $f_status = $row['f_status'];
                  ?>
                  <option value = "<?php echo $id?>" <?php if($uis_parent === $id) echo "selected"?> ><?php echo $f_name ;?></option>
                  <?php
                }
                  
                  ?>
                  
                </select>
                <div class="col-lg-12">
                  <label class = "my-2">status</label>
                <select class="form-select" name="f_status">
                    <option <?php if($uf_status == 1) echo "selected";?>>Active</option>
                    <option <?php if($uf_status == 0) echo "selected";?>>Inactive</option>
              </select>
                </div>
              </div>
              
                
                <label class = "mt-2">Choose Category Image</label>
                   <div class="c-img">
                   <div id="img-preview"></div>
                    <?php
                    if (empty($uf_image)) {
                      echo '<p class="alert alert-danger">No Found Image</p>';
                    }else {
                      ?>
                      <div class = "mb-3"><img src="assets/img/icon/<?php echo $uf_image;?>" width="100"></div>
                      <?php
                    }
                    ?>
                    <input type="file" id="choose-file"name="choose-file" accept="image/*" />
                    <label for="choose-file">Choose File</label>
                   </div>
                   <input type="hidden" name="edit" value = "<?php echo $uid;?>">
                <div class="text-start">
                  <button type="submit" class="btn btn-primary" name="update_category">update</button>
                </div>
              </form><!-- End No Labels Form --><?php
            
          }else {
            ?>
            <!-- category Form -->
            <h5 class="card-title">category Name </h5>
              <form class="row g-3" action = "core/insert.php" method ="post" enctype = "multipart/form-data">
                <div class="col-md-12">
                  <input type="text" class="form-control" placeholder="Category Name" name="cat_name" >
                </div>
                <div class="col-md-12">
                <label class = "mb-2">Choose File</label>
                  <select id="inputState" class="form-select" name="is_parent">
                    <option selected="">Choose...</option>
                <?php
                $sql = "SELECT * FROM fashion_category  WHERE is_parent = '0' order by f_name asc";
                $res = mysqli_query($db,$sql);
                $serial = 0;
                while ($row = mysqli_fetch_assoc($res)) {
                  $id = $row['id'];
                  $f_name = $row['f_name'];
                  $f_image = $row['f_image'];
                  $is_parent = $row['is_parent'];
                  $f_status = $row['f_status'];
                  ?>
                  <option value = "<?php echo $id?>"><?php echo $f_name ;?></option>
                  <?php
                }
                  
                  ?>
                  </select>
                </div>
                <label class = "mt-2">Choose Category Image</label>
                   <div class="c-img">
                   <div id="img-preview"></div>
                    <input type="file" id="choose-file" name="choose-file" accept="image/*" />
                    <label for="choose-file">Choose File</label>
                   </div>
                <div class="text-start">
                  <button type="submit" class="btn btn-primary" name="add_category">Submit</button>
                </div>
              </form>
              <!-- category Form -->
              <?php
          }
          ?>
          
          
            

            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="table">
          <div class="card-body">
              <h5 class="card-title">Category Table </h5>

              <!-- Table with hoverable rows -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Image</th>
                    <th scope="col">category Name</th>
                    <th scope="col">status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>

                <!-- php  -->

                <?php
                
                $sql = "SELECT * FROM fashion_category  WHERE is_parent = '0'";
                $res = mysqli_query($db,$sql);
                $serial = 0;
                while ($row = mysqli_fetch_assoc($res)) {
                  $id = $row['id'];
                  $f_name = $row['f_name'];
                  $f_image = $row['f_image'];
                  $is_parent = $row['is_parent'];
                  $f_status = $row['f_status'];
                  $serial++;
                  ?>
                  <tr>
                    <th scope="row"><?php echo $serial;?></th>
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

                  // category finding 
                  show_sub_category($id);
                        
                    }
                    ?>
                   
                </tbody>
              </table>



              <!-- End Table with hoverable rows -->

            </div>
          </div>
        </div>
      </div>
          <?php 
          
          if (isset($_GET['delid'])) {
            $deleteid = $_GET['delid'];
            $del_res = mysqli_query($db,"DELETE FROM fashion_category WHERE id='$deleteid'");

            if ($del_res) {
              header('location: category.php');
            }else {
              die('error from delete function'.mysqli_error($db));
            }

          }
          
          ?>

    </section>

  </main><!-- End #main -->

<?php include 'inc/footer.php';?>