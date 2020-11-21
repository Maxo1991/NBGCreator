<?php
    $this->load->view('includes/header');
    $this->load->view('includes/navbar');

    $singlePost = $post->result_array();
?>
    <div class="container" id="editPage">
        <?php echo form_open_multipart('login_controller/update/' . $singlePost[0]['id']); ?>
        <div class="form-group">
            <label for="Naslov">Naslov:</label>
            <input type="text" class="form-control" id="Naslov" name="title" value="<?= $singlePost[0]['title'] ?>">
        </div>
        <div class="form-group">
            <label for="Tekst">Tekst:</label>
            <textarea class="form-control" id="Tekst" name="description" rows="8"><?= $singlePost[0]['description'] ?></textarea>
        </div>
        <div class="form-group col-sm-6">
            <label style="float: left; margin-right: 10px;">Dodaj sliku:</label>
            <input type="file" name="files[]" multiple>
        </div>
        <input type="hidden" name="userId" value="<?= $this->session->userdata('user_id'); ?>">
        <div class="form-group col-sm-6 text-right">
            <button class="btn btn-warning"><a href="<?= site_url('home') ?>">Otkaži</a></button>
            <button type="submit" name="submit" class="btn btn-warning">Edituj članak</button>
        </div>
        </form>
        <?php echo form_close(); ?>
        <div class="gallery">
            <?php
                foreach($images->result_array() as $image)
                {
            ?>
            <div class="col-sm-3 col-md-3 text-center">
                <img class="card-img-top" src="<?= base_url() . "images/" . $image['name'] ?>" alt="Card image cap">
                <div class="card-body">
                    <a href="<?= base_url() ?>login_controller/deleteImage/<?= $image['id'] ?>" class="btn btn-warning btn-block">Obriši</a>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
<script src="<?= base_url() . 'ckeditor/ckeditor.js' ?>"></script>
<script>
    CKEDITOR.replace('description');
</script>
<?php
    $this->load->view('includes/footer');
?>
