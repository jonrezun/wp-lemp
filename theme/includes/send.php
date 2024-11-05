<?php 

require_once(dirname(__FILE__) . '/../../../../wp-load.php');

if (empty($_POST['name'])) {
    wp_redirect( add_query_arg('status', 'warning', site_url('/')));
    exit;
 }

 $name = isset($_POST['name']) && $_POST['name'] ? sanitize_textarea_field($_POST['name']) : '';
 $message = empty($_POST['message']) ? 'Сообщенеи пустое' : sanitize_textarea_field($_POST['message']);
 $adminEmail = get_option('admin_email');
 $headers = array(
    "From: $name <no-reply@site.ru>",
    "Reply-To: $name <Test>",
);

$result = wp_mail($adminEmail, 'Test', $message, $headers);

if ($result) {
    wp_redirect( add_query_arg('status', 'success', site_url('/')));
    exit;
} else {
    wp_redirect( add_query_arg('status', 'error', site_url('/')));
    exit;
}