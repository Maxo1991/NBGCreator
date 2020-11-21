<?php
    $this->load->view('includes/header');
?>
    <div class="container">
        <div id="loginForm" class="row text-center">
                <form class="form-horizontal" action="<?= base_url() . 'home'; ?>" method="post">
                    <img id="loginLogo" src="https://www.nbgcreator.com/uploads/useruploads/Photos/nbgcreator-logo-210x40.png" alt="logo">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Email:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" placeholder="Enter email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Lozinka:</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" placeholder="Enter password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-warning">Pristupi</button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
<?php
    $this->load->view('includes/footer');
?>