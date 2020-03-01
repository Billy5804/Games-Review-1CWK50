

<?php
// Manipulate the body CSS colour here.
?>

<div class="container">
    <div class="row">
        <?php
        foreach ($result as $row)
        {
            // These classes onlywork if you attach Bootstrap.
            echo '<div class="card cardBodyWidth '.$cssBodyClass.'">';
            // This is presuming you have a column in your database table called ReviewImage.
            $thisImage = $row->ReviewImage;
            // Look into the image properties library in CodeIgniter for more help on images: 
            
        }
        ?>
    </div>

</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>