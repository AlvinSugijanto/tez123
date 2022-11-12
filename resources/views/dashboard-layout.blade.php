<!DOCTYPE html>
<html lang="en">

<head>

    <title>Elemen Kopi</title>

    <!-- Custom fonts for this template-->
    <script src="https://kit.fontawesome.com/a4c037e7cb.js" crossorigin="anonymous"></script>
    <!-- <link href="../css/fontawesome/css/all.min.css" rel="stylesheet"> -->
    
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <!-- Custom styles for this template-->
    <link href="../css/app.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >

    <link href="../css/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


</head>
<style>
.btnTrx {
  border: 1px solid black;
  background-color: green;
  color: black;
  padding: 14px 25px;
  font-size: 16px;
  cursor: pointer;
  margin-left : 5px;
  margin-right : 5px
}
.success {
  border-color: white;
  color: white;
}

.success:hover {
  background-color: #04AA6D;
  color: white;
}
#testNav {
    overflow: hidden;
  background-color: #333;
  padding:0px;

}
#testNav a {
  float: left;
  font-size: 16px;
  font-weight: bold;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  margin:0px;
  width:219.1px;
  border-radius: 0px;
  background-color: #2186F8;
  color: white;
}
#testNav > .btn:hover{
    background-color:#D7E7F9;
    color: #295483;
    border: 1px solid transparent;

}
</style>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar bg-white sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <img class="img-profile rounded-circle" src="../logo_cafe.png" width="80" height="80">
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <b>Dashboard</b>
                </a>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="/pegawai">
                <i class="fa-solid fa-fw fa-user"></i>
                <span style="font-size:14px; font-weight:bold; color:#707070">Pegawai</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/ongoing-order">
                <i class="fas fa-fw fa-table"></i>
                <span style="font-size:14px; font-weight:bold; color:#707070">Order</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-hamburger" style=""></i>
                    <span style="font-size:14px; font-weight:bold; color:#707070">Menu</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="py-2 collapse-inner rounded" style="background-color:#CEC8C8">
                        <a class="collapse-item" href="/menu" style="font-size:13px; font-weight:bold; color:#313131">Menu</a>
                        <a class="collapse-item" href="/advanced-menu" style="font-size:13px; font-weight:bold; color:#313131">Advanced Menu</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Tables -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="ingredients">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Ingredients</span></a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Ingredients"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <!-- <i class="fas fa-fw fa-table"></i> -->
                    <i class="fa-solid fa-kitchen-set"></i>
                    <span style="font-size:14px; font-weight:bold; color:#707070">Ingredients</span>
                </a>
                <div id="Ingredients" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="py-2 collapse-inner rounded" style="background-color:#CEC8C8">
                        <a class="collapse-item" href="/ingredients" style="font-size:13px; font-weight:bold; color:#313131">Ingredients</a>
                        <a class="collapse-item" href="/ingredients_purchase" style="font-size:13px; font-weight:bold; color:#313131">Ingredients Purchase</a>
                    </div>
                </div>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="order">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Order</span></a>
            </li> -->
            
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
                        
            <li class="nav-item">
                <a class="nav-link" href="/overall-report">
                <i class="fa-solid fa-fw fa-book-open"></i>
                <span style="font-size:14px; font-weight:bold; color:#707070">Report</span></a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Reports</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Monthly Reports</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li> -->
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            <!-- <a><button class="btnTrx success"><h4>Add Transaction</h4></button> -->
            <div class="container" style="text-align:center">
                <a href="/create_order" class="btn btn-primary" style="display:block">Add Transaction</a>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-dark bg-gradient-primary static-top shadow" style="  background-image:linear-gradient(to right, #3591e0 , #4e9ee4);">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div class="input-group">
                        @yield('symbol')
                        <h1 class="h5 mb-0 ml-1 text-white">@yield('title')</h1>
                    </div>
                    
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white">
                                <i class="fa-solid fa-user-large"></i>
                                <span class="d-none d-lg-inline text-white-600 small ml-2">{{ auth()->user()->name }}</span>                             

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"aria-labelledby="userDropdown">
                            <form action="/logout" method="POST" id="logoutSubmit">
                                @csrf
                                <a href="#" onclick="document.getElementById('logoutSubmit').submit()">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                @yield('nav')



                <!-- <div class="col-md-6 offset-md-3">
                    <nav class="navbar navbar-light bg-primary topbar static-top shadow" style="padding:0; height:50px" id="navTest">
                        <div class="col-md-4">
                            <a href = "#">Laporan</a>
                        </div>
                        <div class="col-md-4">
                        <a href = "#" style="height:50px; width:220px;color:black;" href="#">Laporan</a>

                        </div>
                        <div class="col-md-4">
                            <a href = "#" style="height:50px; width:220px;color:black;" href="#">Laporan</a>

                        </div>
                    </nav>
                </div> -->


                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid mt-3">
                   @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <script src="../css/datatables/jquery.dataTables.min.js"></script>
    <script src="../css/datatables/dataTables.bootstrap4.min.js"></script> 

    <script src="../js/jquery-easing/jquery.easing.min.js"></script>

    <script src="../js/sb-admin-2.min.js"></script>

    <script src="../js/chart/Chart.min.js"></script>

    <script src="../js/chart/chart-area-demo.js"></script>
    <script src="../js/chart/chart-pie-demo.js"></script>
    <script src="../js/datatables-demo.js"></script>

   

    
</body>

</html>