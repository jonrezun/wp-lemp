<?php
/*
Template Name: Home
*/
get_header();
?>

    <!-- Content -->
    <section class="content">
        <div class="container">
            <h1>Main</h1>

        <form class="pt-4" action="<?php echo get_stylesheet_directory_uri(); ?>/includes/send.php" method="post">
            <?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
                <p style="color: green;" class="message success">Success - go to <a href='http://localhost:8025/'>http://localhost:8025</a></p>
            <?php endif; ?>
            <?php if (isset($_GET['status']) && $_GET['status'] === 'error'): ?>
                <p style="color: red;" class="message error">Something went wrong</p>
            <?php endif; ?>
            <?php if (isset($_GET['status']) && $_GET['status'] === 'warning'): ?>
                <p style="color: orange;" class="message error">Fields are not filled in</p>
            <?php endif; ?>
            <h3>Enter your name for test email with Mailpit</h3>
            <input class="form-control" type="text" name="name" placeholder="Your name"/>
            <div class="pt-2">
                <textarea class="form-control"  name="message" id="comment" placeholder="Message" rows="4"></textarea>
            </div>
            <input type="submit" class="btn btn-primary mt-2" value="Send" id="submit-message">

        </form>
        </div>
    </section> 

<?php get_footer(); ?>