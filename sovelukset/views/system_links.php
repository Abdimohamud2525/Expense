<?php

include 'pää.php';
include 'sivu.php';
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header "></div>
                    <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover table-striped" id="linkTable">
                            <button class="btn btn-info float-right" id="AddNew">Add New transaction</button>
                            <thead>
                                <th>#</th>
                                <th>Name</th>
                                <th>Icon</th>
                                <th>Role</th>
                                <th>Date</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <div class="modal" tabindex="-1" role="dialog" id="linkModel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="linkForm">
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
                                                        <label>Name</label>
                                                        <input type="text" name="name" id="name" class="form-control" placeholder="name">
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>link_id</label>
                                                            <select name="link_id" id="link_id" class="form-control">

                                                            </select>
                                                            <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>category</label>
                                                            <select name="category_id" id="category_id" class="form-control">
                                                            </select>
                                                        </div>
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
                    ©<script>document.write(new Date().getFullYear())</script>
                    <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                </p>
            </nav>
        </div>
    </footer>
</div>
<?php

include 'alatunniste.php';

?>

<script src="../js/system_links.js"></script>

