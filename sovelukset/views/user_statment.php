<?php

include 'pää.php';
include 'sivu.php';
?>
<div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                </div>
                               <form id="userForm">
                               <div class="row">
                                    <div class="col-sm-4">
                                        <select name="type" id="type" class="form-control">
                                            <option value="0">All</option>
                                            <option value="custem">Custem</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="date" name="from"id="from"class="form-control">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="date" name="to"id="to"class="form-control">
                                    </div>
                                </div>

                                <div class="card-body table-full-width table-responsive" id="print_area">
                                    <table class="table table-hover table-striped" id="usertable">
                                    <button class="btn btn-info float-right" type="submit" id="AddNew">Add New transaction</button></
                                        <thead>
                                            <th>Date</th>
                                            <th>userID</th>
                                            <th>Income</th>
                                            <th>Expense</th>
                                            <th>Balance</th>
                                        </thead>
                                    </table>
                                    <button class="btn btn-primary" id="print_statment"><i class="fa-solid fa-print"></i>Print</button>
                                    <button class="btn btn-info" id="export_statment"><i class="fa-solid fa-file-export"></i>Export</button>
                                    </form>
                                    <!-- <div class="modal" tabindex="-1" role="dialog" id="kulutModel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="kulutForm">
            <div class="row">
                <div class="col-sm-12">
                <div class="alert alert-success d-none" role="alert">
  This is a success alert—check it out!
</div>
<div class="alert alert-danger d-none" role="alert">
  This is a danger alert—check it out!
</div>
                        <div class="col-md-12">
                            <div class="card card-plain table-plain-bg">
                        </div>
                        
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav>
                        <ul class="footer-menu">
                            <li>
                                <a href="#">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Company
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Portfolio
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Blog
                                </a>
                            </li>
                        </ul>
                        <p class="copyright text-center">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                        </p>
                    </nav>
                </div>
            </footer>
        </div>
    </div> -->
<?php

include 'alatunniste.php';

?>

<script src="../js/user_statment.js"></script>