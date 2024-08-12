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
    <script>
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
                    <img style="width:100%;height:100%" src="../uploads/temp/${response.img}">
                    <button onclick="CancelImage('${response.img}')" type="button" class=" btn btn-danger btn_cancel">Cancel</button>
                  `;

                $(".preview-image").html(img);

              }
            }
          });


       }

       const SaveProduct = () => {
          $.ajax({
            type: "POST",
            url: "http://localhost:3000/ajax/Product.php?type=insert",
            data: {},
            dataType: "json",
            success: function (response) {
              
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
    </script>
  </body>
</html>