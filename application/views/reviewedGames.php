

<?php
// Manipulate the body CSS colour here.
?>

<div class="container">
    <h2><b>Reviewed Games</b></h2>
    <div class="row">
        <?php
        $this->load->library('image_lib');
        foreach ($result as $row)
        {
            echo '<a href="'.$row->slug.'/" class="ml-auto mr-auto card cardBodyWidth '.$cssBodyClass.'" style="max-width: min-content; margin: 1%;">
                    <img class="reviewImage card-img-top" src="'.base_url('application/images/'.str_replace(".jpg", ".jpg", $row->image)).'">
                    <div class="card-body style="max-width: 300px;">
                        <h5 class="card-title titleEllipsis">'.$row->name.' Reviews</h5>
                        <p class="card-text previewEllipsis">'.$row->blurb.'</p>
                    </div>
                </a>';
        }
        ?>
    </div>

</div>
<br>