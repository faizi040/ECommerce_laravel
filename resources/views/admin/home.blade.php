<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.components.css')
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.components.sidebar')
      <!-- partial -->
      @include('admin.components.navbar')
     
      @include('admin.components.body')
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    @include('admin.components.js')
  </body>
</html>