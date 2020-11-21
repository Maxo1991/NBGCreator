<?php
    $this->load->view('includes/header');
    $this->load->view('includes/navbar');
?>
    <div class="container" id="home">
        <div class="row" style="line-height: 63px;">
            <div class="col-md-8">
                <h2 class="welcome-message">Dobrodosao <?= $this->session->userdata('user_name'); ?>,</h2>
            </div>
            <div class="col-md-4 text-right">
                <a href="<?= base_url() ?>create_post" class="btn btn-warning">DODAJ NOVI ČLANAK</a>
            </div>
        </div>
        <table class="table table-striped">
            <tbody>
            <?php
                if($posts != false){
                    foreach($posts as $post)
                    {
            ?>
                <tr>
                    <td><?= $post->title ?></td>
                    <td>
                        <a href="<?= base_url() ?>login_controller/delete/<?= $post->id ?>"><i class="fas fa-trash-alt"></i></a>
                        <a href="<?= base_url() ?>edit_post/<?= $post->id ?>"><i class="fas fa-pencil-alt"></i></a>
                    </td>
                </tr>
            <?php
                    }
                } else {
                    ?>
                        <p>Nema članaka</p>
                    <?php
                }
            ?>
            </tbody>
        </table>
        <?= $links ?>
    </div>
<?php
    $this->load->view('includes/footer');
?>