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
              <tbody>
                <tr>
                  <td>1</td>
                  <td>image.jpg</td>
                  <td>Product 1</td>
                  <td>$300</td>
                  <td>10</td>
                  <td>
                      <button  data-bs-toggle="modal" data-bs-target="#modalEditProducts" class="btn btn-sm btn-info">edit</button>
                      <button class="btn btn-sm btn-danger">delete</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  <?php include "components/footer.php" ?>