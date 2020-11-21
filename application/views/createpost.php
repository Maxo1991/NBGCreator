<?php
    $this->load->view('includes/header');
    $this->load->view('includes/navbar');
?>
<div class="container" id="createPage">
    <?php echo form_open_multipart('login_controller/create'); ?>
        <div class="form-group">
            <label for="Naslov">Naslov:</label>
            <input type="text" class="form-control" id="Naslov" name="title">
        </div>
        <div class="form-group">
            <label for="Tekst">Tekst:</label>
            <textarea class="form-control" id="Tekst" name="description"></textarea>
        </div>
        <div class="form-group col-sm-6">
            <label style="float: left; margin-right: 10px;">Dodaj sliku:</label>
            <input type="file" name="files[]" multiple>
        </div>
        <input type="hidden" name="userId" value="<?= $this->session->userdata('user_id'); ?>">
        <div class="form-group col-sm-6 text-right">
            <button class="btn btn-warning"><a href="<?= site_url('home') ?>">Odbaci</a></button>
            <button type="submit" name="submit" class="btn btn-warning">Dodaj članak</button>
        </div>
    </form>
    <?php echo form_close(); ?>
</div>
<script src="<?= base_url() . 'ckeditor/ckeditor.js' ?>"></script>
<script>
    CKEDITOR.replace('description');
</script>
<?php
    $this->load->view('includes/footer');
?>
