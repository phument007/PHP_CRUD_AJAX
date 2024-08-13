
<!-- Modal -->
<div class="modal fade" id="modalCreateProducts" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width:40%;">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Products</h1>
      </div>
      <div class="modal-body">
        <form  method="POST" id="formCreateProduct" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="">Product Name</label>
                        <input type="text" name="name"  class="product_name form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Product Price($)</label>
                        <input type="number" name="price"  class="product_price form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Product Qty</label>
                        <input type="number" name="qty"  class="product_price form-control">
                    </div>
                </div>

                <div class="col-md-5">
                     <div class="form-group">
                        <label for="">Product Qty</label>
                        <input type="file" name="image"  class="product_image form-control">
                        <button onclick="UploadImages('#formCreateProduct')" type="button" class="upload_image btn btn-info rounded-0">upload</button>
                    </div>
                    <div class="preview-image">
                         
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button onclick="SaveProduct('#formCreateProduct')" type="button" class="btn btn-success">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>