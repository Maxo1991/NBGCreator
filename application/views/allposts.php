<?php
    $this->load->view('includes/header');
    $this->load->view('includes/navbar');
?>
    <div class="container" id="home">
        <table id="allPosts" class="table table-striped">
            <tbody>
            <?php
                if($posts != false){
                    foreach($posts as $post)
                    {
            ?>
                    <tr>
                        <td><?= $post->title ?></td>
                        <td><a href="<?= base_url() ?>show_post/<?= $post->id ?>">POGLEDAJ VIŠE</a></td>
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