<?php include "inc/header.php";?>

<?php include 'inc/manubar.php';?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
          <li class="breadcrumb-item active">Brand</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <!-- your main code here  -->

      <!-- category Form -->
      <div class="row">
        <div class="col-lg-5">
          <div class="form">
          <div class="card-body">
      <h5 class="card-title">Brand Name </h5>
              <form class="row g-3" action = "core/insert.php" method ="POST" enctype = "multipart/form-data">
                <div class="col-md-12">
                  <input type="text" class="form-control" placeholder="Category Name" name="brand_name" required >
                </div>
                <label class = "mt-2">Choose Category Image</label>
                   <div class="c-img">
                   <div id="img-preview"></div>
                    <input type="file" id="choose-file" name="choose-file" accept="image/*" />
                    <label for="choose-file">Choose File</label>
                   </div>
                <div class="text-start">
                  <button type="submit" class="btn btn-primary" name="add_brand">Submit</button>
                </div>
              </form>
              <!-- category Form End  -->
              </div>
            </div>
          </div>
          <div class="col-lg-7">
          <div class="table">
          <div class="card-body">
              <h5 class="card-title"> brand Table </h5>

              <!-- Table with hoverable rows -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">LOGO</th>
                    <th scope="col">Brand Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>

                <?php 
                
               $all_brand_sql =  "SELECT * FROM fashion_brand";
               $all_brand_sql_result =  mysqli_query($db,$all_brand_sql);
               $serial = 0;
               while ($row = mysqli_fetch_assoc($all_brand_sql_result)) {
                $id = $row['id'];
                $b_name = $row['b_name'];
                $b_logo = $row['b_logo'];
                $b_status = $row['b_status'];
                $serial++;
                ?>
                <tr>
                    <th scope="row"><?php echo $serial;?></th>
                    <td><?php 
                    if (empty($b_logo)) {
                      ?> <img src="assets/img/brand/brand-image.png" alt="" width="50"> ; <?php
                    }else {
                      ?> <img src="assets/img/brand/<?php echo $b_logo;?>"  width="50"> ; <?php
                    }
                    ?></td>
                    <td><?php echo $b_name;?></td>
                    <td><?php 
                    if ($b_status == 1) {
                     echo '<span class = "badge bg-success">Active</span>';
                    }else {
                      echo '<span class = "badge bg-danger">Inactive</span>';
                    }
                    ?></td>
                    <td>
                      <a href="brand.php?editid=<?php echo $id;?>"><i class = "bi bi-pencil-square text-dark"></i></a>
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
                                  <a href="brand.php?delid=<?php echo $id; ?>" type="button" class="btn btn-danger">Confirm</a>
                                  <button type="button" class="btn btn-primary">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                      
                    </td>
               </tr>
                <?php
               }

                
                ?>

                  
                </tbody>
              </table>
              <!-- End Table with hoverable rows -->

            </div>
        </div>
      </div>
      <!-- delete code here  -->
      <?php 
      
          if (isset($_GET['delid'])) {
            $delete_id = $_GET['delid'];

            // delete img function 

             delete_img('b_logo','fashion_brand','id',$delete_id,'assets/img/brand/');

            delete('fashion_brand','id',$delete_id,'brand.php');
          }
      
      ?>

    </section>

  </main><!-- End #main -->

<?php include 'inc/footer.php';?>