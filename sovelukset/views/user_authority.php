<?php
include 'pää.php';
include 'sivu.php';
?>
<style>

    fieldset.authority-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow: 0px 0px 0px 0px #000;
    }

    legend.authority-border {
        width: inherit;
        padding: 0 10px;
        border-bottom: none;
    }

    input[type="checkbox"] {
        transform: scale(1.5);
    }

    #all-author {
        transform: scale(2);
    }
</style>
<div class="content">
    <div class="container-fluid" style="padding: 0; margin: 0; width: 100%;">
        <div class="row" style="margin: 0;">
            <div class="col-md-12" style="padding: 0;">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header"></div>
                    <form id="userForm">
                        <div class="row">
                            <div class="col-sm-12">
                                <select name="user_id" id="user_id"
                                 class="form-control">
                                </select>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <fieldset class="authority-border">
                                        <legend class="authority-border">
                                        <input type="checkbox" id="all-author" name="all-author">

                                        All Authorities
                                    </legend>

                                    <div class="row" id="authorityArea">
                                            </div>
                                        </fieldset>
                                        </div> 
                                    </div>
                                    </fieldset>
                                </div>

                        </div>
                        <button class="btn btn-info left-right" type="submit" id="submit">Authority Users</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'alatunniste.php';
?>
<script src="../js/user_authority.js"></script>
