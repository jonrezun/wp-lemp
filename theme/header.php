<!-- Header -->
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php echo wp_get_document_title() ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <?php wp_head(); ?>
</head>

<body>
        <header class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="container d-flex">
                    <a class="navbar-brand" href="/"><?php bloginfo('name'); ?></a>
                </div>
            </div>
        </header>
        <main>

