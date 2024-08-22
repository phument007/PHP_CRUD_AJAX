 <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid clearfix">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="assets/js/shared/off-canvas.js"></script>
    <script src="assets/js/shared/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="assets/js/demo_1/dashboard.js"></script>
    <!-- End custom js for this page-->
    <script src="assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>

      const Message = (message) => {
        Toastify({
          text: `${message}`,
          duration: 3000,
          destination: "https://github.com/apvarun/toastify-js",
          newWindow: true,
          close: true,
          gravity: "top", // `top` or `bottom`
          position: "right", // `left`, `center` or `right`
          stopOnFocus: true, // Prevents dismissing of toast on hover
          style: {
            background: "green",
          },
          onClick: function(){} // Callback after click
        }).showToast();
      }

      $(document).on("click",".btn_addmore",function () {
         $("#formCreateProduct").trigger('reset');
         $(".preview-image").html("");

      });

      const SelectProducts = (search='',page=1) => {
        $.ajax({
          type: "GET",
          url: "http://localhost:3000/ajax/Product.php?type=select",
          data : {
            search_items : search,
            page: page
          },
          dataType: "json",
          success: function (response) {
            if(response.status == 200){
               var products = response.data;
               var tr = ``;
               $.each(products, function (index,value) { 
                  tr += `
                    <tr>
                        <td>${value.id}</td>
                        <td>
                          <img  src="./uploads/images/${value.image}" alt="">
                        </td>
                        <td>${value.name}</td>
                        <td>$${value.price}</td>
                        <td>${value.qty}</td>
                        <td>
                            <button onclick="EditProduct(${value.id})"  data-bs-toggle="modal" data-bs-target="#modalEditProducts" class="btn btn-sm btn-info">edit</button>
                            <button onclick="DeleteProduct(${value.id},'${value.image}')" class="btn btn-sm btn-danger">delete</button>
                        </td>
                    </tr>
                  `;
               });
               var totalPage = response.totalPage;
               var currentPage = response.currentPage;
               var pagination = `
                  <nav aria-label="Page navigation example">
                    <ul class="pagination">
                      <li onclick="PreviousPage(${currentPage})" class="page-item ${(currentPage == 1) ? 'd-none' : ''}">
                        <a class="page-link"  aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                        </a>
                      </li>`;

                      for(let i=1;i<=totalPage;i++){
                         pagination += `
                           <li onclick="ChangePage(${i})" class="page-item ${(currentPage == i) ? 'active' : ''}"><a class="page-link">${i}</a></li>
                         `;
                      }

                      // <li class="page-item"><a class="page-link" href="#">1</a></li>
                      // <li class="page-item"><a class="page-link" href="#">2</a></li>
                      // <li class="page-item"><a class="page-link" href="#">3</a></li>

                    pagination +=`  <li onclick="NextPage(${currentPage})" class="page-item ${ (currentPage == totalPage) ? 'd-none' : '' }">
                        <a class="page-link"  aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                        </a>
                      </li>
                    </ul>
                  </nav>
                `;

               $("#show-page").html(pagination);

               $(".all_products").html(tr);
            }
          }
        });
      }

      const ChangePage = (page) => {
        SelectProducts('',page);
      }

      const NextPage = (currentPage) => {
        SelectProducts('',currentPage + 1);
      }

      const PreviousPage = (currentPage) => {
        SelectProducts('',currentPage - 1);
      }

      SelectProducts('');

      $(document).on('input','.search_product',function () {
          let searchValue = $(this).val().trim();
          SelectProducts(searchValue);
      });


       //Basic ajax
       const UploadImages = (form) => {

        var allData = new FormData($(form)[0]);
        // formData($("#formCreateProduct")[0])
          //create ajax 
          $.ajax({
            type: "POST",
            url: "http://localhost:3000/ajax/Product.php?type=upload",
            data: allData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (response) {
              if(response.status == 200){
                  var img = `
                    <input type="hidden" name="image_name" value="${response.img}">
                    <img style="width:100%;height:100%" src="../uploads/temp/${response.img}">
                    <button onclick="CancelImage('${response.img}')" type="button" class=" btn btn-danger btn_cancel">Cancel</button>
                  `;

                $(".preview-image").html(img);

              }
            }
          });


       }

       const SaveProduct = (form) => {
          var allData = $(form).serializeArray();  // input=type=>file
          $.ajax({
            type: "POST",
            url: "http://localhost:3000/ajax/Product.php?type=insert",
            data: allData,
            dataType: "json",
            success: function (response) {
              if(response.status == 200){
                $(form).trigger("reset");
                $(".preview-image").html("");
                $("#modalCreateProducts").modal("hide");
                Message(response.message);
                SelectProducts('');
               
              }
            }
          });
       }

       const CancelImage = (image) => {
          $.ajax({
            type: "POST",
            url: "http://localhost:3000/ajax/Product.php?type=cancel",
            data: {
               image_name : image
            },
            dataType: "json",
            success: function (response) {
              if(response.status == 200){
                $(".preview-image").html("");
              }
            }
          });
       }

       const DeleteProduct = (id,img) => {
            if(confirm("Do you want to delete this?")){
              $.ajax({
                type: "POST",
                url: "http://localhost:3000/ajax/Product.php?type=delete",
                data: {
                  product_id : id,
                  image_name : img
                },
                dataType: "json",
                success: function (response) {
                  if(response.status == 200){
                    Message(response.message);
                    SelectProducts('');
                  }
                }
              });
            }
       }

       const EditProduct = (id) => {
          $.ajax({
            type: "POST",
            url: "http://localhost:3000/ajax/Product.php?type=edit",
            data: {
              product_id : id
            },
            dataType: "json",
            success: function (response) {
               if(response.status == 200){
                 let product = response.data;
                 $('.product_id').val(product.id);
                 $(".product_name").val(product.name);
                 $(".product_price").val(product.price);
                 $(".product_qty").val(product.qty);
                 $('.old_image').val(product.image);
                 var img = `
                   
                    <img style="width:100%;height:100%" src="../uploads/images/${product.image}">
                  
                  `;

                 $(".preview-image").html(img);
               }
            }
          });
       }

       const UpdateProduct = (form)=> {
           var allData  = $(form).serializeArray();  //type file
           $.ajax({
            type: "POST",
            url: "http://localhost:3000/ajax/Product.php?type=update",
            data: allData,
            dataType: "json",
            success: function (response) {
              if(response.status == 200){
                $(form).trigger("reset");
                $(".preview-image").html("");
                $("#modalEditProducts").modal("hide");
                Message(response.message);
                SelectProducts('');
              }
            }
           });
       }

       
    </script>
  </body>
</html>