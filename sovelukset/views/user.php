<?php

include 'pää.php';
include 'sivu.php';

?>
<style>
   #show{
      width: 150px; 
      height: 150px; 
      border-radius: 50%;
      overflow: hidden; 
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      object-fit: cover;
      border: 2px solid #EADBC8;
      align-items: center;
      justify-content: center;
   } 
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header"></div>
                    <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover table-striped" id="userTable">
                            <button class="btn btn-info float-right" id="AddNew">Add New user</button>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                     <th>Username</th>
                                      <th>Status</th>
                                     <th>Date</th>
                                     <th>img</th>
                                     <th>action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <div class="modal" tabindex="-1" role="dialog" id="userModel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="userForm" name="userForm" action="user.php" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="alert alert-success d-none" role="alert">
                                                        This is a success alert—check it out!
                                                    </div>
                                                    <div class="alert alert-danger d-none" role="alert">
                                                        This is a danger alert—check it out!
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Username</label>
                                                        <input type="text" name="username" id="username" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input type="password" name="password" id="password" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>File</label>
                                                        <input type="file" name="image" id="fileImage" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-4"></div>
                                                        <div class="form-group">
                                                            <img id="show" name="show">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-plain table-plain-bg"></div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container-fluid">
            <nav>
                <ul class="footer-menu">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Company</a></li>
                    <li><a href="#">Portfolio</a></li>
                    <li><a href="#">Blog</a></li>
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
<?php

include 'alatunniste.php';

?>

<script src="../js/user.js"></script>
