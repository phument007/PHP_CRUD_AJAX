<?php include "components/header.php" ?>
<?php include "modals/create.php" ?>
<?php include "modals/edit.php" ?>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="col-md-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <h1>Stock</h1>
            <button data-bs-toggle="modal" data-bs-target="#modalCreateProducts" class=" btn btn-primary rounded-0">add more</button>
          </div>
          <!-- <img src="./uploads/images/353048235.webp" alt=""> -->
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Image</th>
                  <th>Product Name</th>
                  <th>Price</th>
                  <th>Qty</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="all_products">
                 
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  <?php include "components/footer.php" ?>