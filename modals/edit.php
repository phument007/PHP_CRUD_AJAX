
<!-- Modal -->
<div class="modal fade" id="modalEditProducts" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width:40%;">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Upate Products</h1>
      </div>
      <div class="modal-body">
        <form  method="POST" id="fromUpdateProduct" enctype="multipart/form-data">
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
                        <input type="number" name="qty"  class="product_qty form-control">
                    </div>
                    <input type="text" name="product_id" class="product_id">
                    <input type="text" name="old_image" class="old_image">
                </div>

                <div class="col-md-5">
                     <div class="form-group">
                        <label for="">Product Qty</label>
                        <input type="file" name="image"  class="product_image form-control">
                        <button onclick="UploadImages('#fromUpdateProduct')" type="button" class="upload_image btn btn-info rounded-0">upload</button>
                    </div>
                    <div class="preview-image">
                         
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button onclick="UpdateProduct('#fromUpdateProduct')" type="button" class="btn btn-success">Update</button>
        </div>
      </form>

    </div>
  </div>
</div>