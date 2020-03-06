

<?php
// Manipulate the body CSS colour here.
?>

<div class="container">
    <?php
        foreach ($result as $row)
        {
            $username = $row->username;
            if(empty($username)) $username = '<small><del>DELETED USER</del></small>';
            echo '<div class="card">
                    <div class="row no-gutters">
                        <div class="col-auto containerFade">
                        <img class="reviewImage" src="'.base_url('application/images/'.str_replace(".jpg", ".jpg", $row->image)).'">
                            <div class="overlayFade">
                                <div class="textFade">
                                    <h5 class="card-text">Game Blurb: </h5>
                                    <p class="card-text">'.($row->blurb).'</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card-block px-2">
                                <h4 class="card-title">'.$game.' Review</h4>
                                <h5 class="card-text">By '.$username.'</h5>
                                <p class="card-text">'.($row->review).'</p>
                            </div>
                        </div>
                    </div>
                    <div v-on:click="getComments('.($row->reviewID).')" class="card-footer w-100 text-muted" id="comments">
                        Comments
                        <div v-for="comment in comments">
                            <hr size="100%">
                            <h6  class="float-right">{{comment.commentTimestamp}}</h6>
                            <h4 v-html="comment.username"></h4>
                            <p>{{comment.comment}}</p>
                        </div>
                    </div>
                </div>';
            break;
        }
    ?>

</div>
<br>