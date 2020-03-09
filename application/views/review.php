

<?php
// Manipulate the body CSS colour here.
?>

<div class="container">
    <?php
        foreach ($result as $row)
        {
            $commentPoster = $row->username;
            if(empty($commentPoster)) $commentPoster = '<small><del>DELETED USER</del></small>';
            echo '<div class="card '.$bg.'">
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
                                <h5 class="card-text">By '.$commentPoster.'</h5>
                                <p class="card-text">'.($row->review).'</p>
                            </div>
                        </div>
                    </div>';
            if(boolval($row->enableComments) && $user) {
                echo '<div class="card-footer w-100 '.$textSecondary.'" id="comments">
                        Comments
                        <hr size="100%">
                        <textarea id="userComment" rows="3" class="form-control" placeholder="Write your comment here..."></textarea>
                        <button v-on:click="postComment(\''.$username.'\')" class="btn btn-outline-success text-right">Post Comment</button>
                        <div v-for="comment in comments">
                            <hr size="100%">
                            <h6  class="float-right">{{comment.timeSince}}</h6>
                            <h4 v-html="comment.username"></h4>
                            <p>{{comment.comment}}</p>
                        </div>
                    </div>
                </div>';
            }
            elseif(!boolval($row->enableComments)) {
                echo '<div class="card-footer w-100 '.$textSecondary.'" id="comments">
                        Comments Are Disabled For This Review.
                    </div>
                </div>';
            }
            else {
                echo '<div class="card-footer w-100 '.$textSecondary.'" id="comments">
                        You Must Be Logged In To Post A Comment.
                    </div>
                </div>';
            }
        break;
        }
    ?>

</div>
<br>