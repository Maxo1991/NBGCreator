<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <img src="https://www.nbgcreator.com/uploads/useruploads/Photos/nbgcreator-logo-210x40.png" alt="Logo" style="margin-right: 10px; margin-top: 5px;">
        </div>
        <ul class="nav navbar-nav">
            <li><a href="<?= base_url() ?>home">Moji članci</a></li>
            <li><a href="<?= base_url() ?>posts">Lista članaka</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" style="cursor: pointer;"><?= $this->session->userdata('user_email') . "    "; ?><span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?= base_url() ?>logout">Odjavi se</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>