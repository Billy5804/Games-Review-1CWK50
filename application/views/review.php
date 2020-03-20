<div class="container">
    <?php
        // loop through the results
        foreach ($result as $row)
        {
            $commentPoster = $row->username;
            if(empty($commentPoster)) $commentPoster = '<small><del>DELETED USER</del></small>';
            // display review with image, blurb on image, author, review, game name
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
                                <h4 class="card-title">'.$row->name.' Review</h4>
                                <h5 class="card-text">By '.$commentPoster.'</h5>
                                <p class="card-text">'.($row->review).'</p>
                            </div>
                        </div>
                    </div>';
            if(boolval($row->enableComments)) { // show comments
                echo '<div class="card-footer w-100 '.$textSecondary.'" id="comments">
                        Comments
                        <hr size="100%">';
                if ($user) { // if user is logged in show post comment form
                    echo '<textarea id="userComment" rows="3" class="form-control" placeholder="Write your comment here..."></textarea>
                        <button v-on:click="postComment(\''.$username.'\')" class="btn btn-outline-success text-right">Post Comment</button>';
                }
                else {
                    echo 'You Must Be Logged In To Post A Comment.';
                }
                // display comments using vue
                echo '<div v-for="comment in comments">
                            <hr size="100%">
                            <h6  class="float-right">{{comment.timeSince}}</h6>
                            <h4 v-html="comment.username"></h4>
                            <p>{{comment.comment}}</p>
                        </div>
                    </div>
                </div>';
            }
            else { // comments are disabled show message
                echo '<div class="card-footer w-100 '.$textSecondary.'" id="comments">
                        Comments Are Disabled For This Review.
                    </div>
                </div>';
            }
        break; // should only be 1 row in result so break out of loop
        }
    ?>

</div>
<br>