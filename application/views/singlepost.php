<?php
$this->load->view('includes/header');
$this->load->view('includes/navbar');
?>
    <div class="container" id="singlePost">
        <?php
        if($post->num_rows() > 0){
            foreach($post->result_array() as $single)
            {
                ?>
                <div class="row" style="line-height: 63px;">
                    <div class="col-md-8">
                        <h1><?= $single['title'] ?></h1>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="<?= base_url() ?>posts">VRATI SE NA LISTU ČLANAKA</a>
                    </div>
                </div>
                <div style="overflow-wrap: break-word;"><?= $single['description'] ?></div>
                <?php
            }
        } else {
            echo "No data found";
        }
        ?>
        <div class="gallery">
            <?php
            if($images->num_rows() > 0)
            {
                foreach($images->result_array() as $image)
                {
                    ?>
                        <div class="col-sm-6 col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                        <img alt="" class="img-responsive center-block" src="<?= base_url() . "images/" . $image['name'] ?>">
                                </div>
                            </div>
                        </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
<?php
$this->load->view('includes/footer');
?>