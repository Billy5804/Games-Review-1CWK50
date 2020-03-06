<html>
    <head>

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Link CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/css/styles.css');?>">
        <title><?php echo $title?></title>
    </head>
<body>
    <!-- These classes onlywork if you attach Bootstrap. -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#"><?php echo $title?></a>
        

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php echo $home ?>">
                    <a class="nav-link" href="<?php echo base_url(); ?>">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item <?php echo $games ?>">
                    <a class="nav-link" href="<?php echo base_url('reviewedGames/'); ?>">Games<span class="sr-only">(current)</span></a>
                </li>
                <?php 
            if ($user) {
                echo '<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        '.$username.'
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" id="toggleDarkMode" href="#">Dark Mode</a>
                        <a class="dropdown-item" id="toggleAdmin" href="#">Admin</a>
                        <div class="dropdown-divider"></div>
                        <form class="dropdown-item" action="'.base_url('logout').'" method="POST">
                            <button>Log Out</button>
                            <input type="hidden" name="currentPage" value="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'">
                        </form>
                        </div>
                    </li>';
            }
            else {
                echo '
                <li class="nav-item">
                    <form class="nav-link" action="'.base_url('login').'" method="POST">
                        <button>Log In</button>
                        <input type="hidden" name="currentPage" value="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'">
                    </form>
                </li>';
            }
        ?>
            </ul>
        </div>
        
        <form class="form-inline form-background mw-50px mh-38px" id="searchForm" method="GET">
        <button type="submit" aria-hidden="true" tabindex="-1"></button>
            <button class="btn btn-outline-primary" type="toggle" id="searchToggle" onclick="toggleSearch(event, '<?php echo base_url("application/images/icons/"); ?>');"><img src="<?php echo base_url("application/images/icons/search.svg") ?>"></button>
            <input class="form-control invisible mw-0" type="search" placeholder="Search" aria-label="Search" id="searchBox" name="search">
            <button class="btn btn-outline-success invisible mw-0" type="submit" id="searchButton"><img src="<?php echo base_url("application/images/icons/search.svg"); ?>"></button>
        </form>
    </nav>
    <main>
    <br>