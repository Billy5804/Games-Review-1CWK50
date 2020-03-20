<div class="container">
    <h2 class="<?php echo $textPrimary?>"><b>Reviewed Games</b></h2>
    <div class="row">
        <?php
        // loop through the results
        foreach ($result as $row)
        {
            //  Display a card for each game with an image, title and preview of the blurb
            echo '<a href="'.$row->slug.'/" class="ml-auto mr-auto card cardBodyWidth '.$cssBodyClass.' '.$bg.'" style="max-width: min-content; margin: 1%;">
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