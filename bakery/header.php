<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Chewy&family=Forum&family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Single+Day&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory') ?>/assets/reset.css" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory') ?>/libs/slick/slick/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory') ?>/libs/slick/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory') ?>/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory') ?>/assets/reponsive.css" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/assets/bootstrap-5/css/bootstrap.min.css">
</head>
<body>
    <header>
        <div class="container box_header">
            <div class="main_menu">
                <nav class=" navbar navbar-expand-lg navbar-light ">
                    <div class="container-fluid box_menu">
                        <a class="navbar-brand" href="<?php bloginfo('url'); ?>">For My Bakery</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse list_menu" id="navbarNavDropdown">
                                <?php wp_nav_menu( 
                                    array( 
                                        'theme_location' => 'top_menu', 
                                        'container' => 'false', 
                                        'menu_id' => 'top_menu', 
                                        'menu_class' => 'top_menu'
                                    ) 
                            ); ?>
                        </div>
                    </div>
                </nav>
            </div>
            </div>
            
        </div>
    </header>
