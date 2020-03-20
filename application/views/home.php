<div class="container">
    <h2 class="<?php echo $textPrimary?>"><b>Latest Reviews</b></h2>
    <div class="row">
        <?php
        // loop through the results
        foreach ($result as $row)
        {
            //  Display a card for each review with an image, title, author and preview of the review
            $username = $row->username;
            if(empty($username)) $username = '<small><del>DELETED USER</del></small>';

            $route = $row->reviewID;
            if (!empty($row->slug)) {
                $route = 'reviewedGames/'.$row->slug.'/'.$route;
            }
            echo '<a href="'.$route.'" class="ml-auto mr-auto card cardBodyWidth '.$cssBodyClass.' '.$bg.'" style="max-width: min-content; margin: 1%;">
                    <img class="reviewImage card-img-top" src="'.base_url('application/images/'.str_replace(".jpg", ".jpg", $row->image)).'">
                    <div class="card-body style="max-width: 300px;">
                        <h5 class="card-title titleEllipsis">'.$row->name.' Review</h5>
                        <h5 class="card-text authorEllipsis">By '.$username.'</h5>
                        <p class="card-text previewEllipsis">'.$row->review.'</p>
                    </div>
                </a>';
        }
        ?>
    </div>

</div>
<br>