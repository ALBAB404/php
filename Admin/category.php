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
            <!-- add catory from  -->
            <div class="card">
            <div class="card-body">
              <h5 class="card-title">Categories</h5>

              <!-- No Labels Form -->
              <form class="row g-3" method = "POST" action = "core/insert.php" enctype = "multipart/form-data">
                <div class="col-md-12">
                  <input type="text" class="form-control" placeholder="Categories Name" name = "cat_name" required>
                  
                </div>
                <div class="col-md-12">
                    <label for="">choose your parent category</label>
                <select id="inputState" class="form-select" name = "is_parent">
                    <option selected="">Choose...</option>

                    <?php
                     $category_sql = "SELECT * FROM fashion_category WHERE is_parent = '0' ORDER BY f_name ASC";
                     $category_res = mysqli_query($db,$category_sql);
                     while ($row = mysqli_fetch_assoc($category_res)) {
                      $cat_id =  $row['id'];
                      $cat_name =  $row['f_name'];
                      $cat_image =  $row['f_image'];
                      $cat_is_parent =  $row['is_parent'];
                      $cat_status =  $row['f_status'];
                      ?>
                      <option value = "<?php echo  $cat_id ;?>"><?php echo $cat_name; ?></option>
                      <?php
                     }
                    
                    ?>

                  </select>
                </div>
                <div class="col-md-12">
                <div class="image-preview c-img">
                <div id="img-preview "></div>
                <small>choose category image</small></br>
                <input type="file" id="choose-file" name="choose-file" accept="image/*" />
                <label for="choose-file">Choose File</label>
                </div>
                </div>
                <div class="text-start">
                  <button type="submit" name = "add_category" class="btn btn-primary">Submit</button>
                </div>
              </form><!-- End No Labels Form -->

            </div>
          </div>

        </div>
        <div class="col-lg-7">
            <!-- all category table  -->
            <div class="card">
            <div class="card-body">
              <h5 class="card-title">All Category Information</h5>

              <!-- Table with hoverable rows -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>

                <?php
                
                
                  $category_sql = "SELECT * FROM fashion_category WHERE is_parent = '0'";
                  $category_res = mysqli_query($db,$category_sql);
                  $serial = 0;
                  while ($row = mysqli_fetch_assoc($category_res)) {
                   $cat_id =  $row['id'];
                   $cat_name =  $row['f_name'];
                   $cat_image =  $row['f_image'];
                   $cat_is_parent =  $row['is_parent'];
                   $cat_status =  $row['f_status'];
                   $serial++;
                    ?>
                   <tr>
                      <th scope="row"><?php echo $serial;?></th>
                      <td>
                        <img src="assets/img/icon/<?php echo $cat_image;?>" width = "25">
                      </td>
                      <td><?php echo $cat_name;?></td>
                      <td><?php if($cat_status == 1) echo "<span class = 'badge bg-success'>Active</span>";else echo "<span class = 'badge bg-danger'>Inactive</span>"; ?></td>
                      <td>
                        <a href=""><i class = "bi bi-trash-fill text-danger"></i></a>
                        <a href=""><i class = "vbi bi-pencil-square text-dark"></i></a>
                      </td>
                 </tr>
                  <?php

                // sub category find
                   show_sub_category($cat_id);

                  }


                  ?>


                
                </tbody>
              </table>
              <!-- End Table with hoverable rows -->

            </div>
          </div>

        </div>
      </div>
      


    </section>

  </main><!-- End #main -->

<?php include 'inc/footer.php';?>