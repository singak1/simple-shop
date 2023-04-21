<?php
require_once(__DIR__ . "/../lib/functions.php");
//Note: this is to resolve cookie issues with port numbers
$domain = $_SERVER["HTTP_HOST"];
if (strpos($domain, ":")) {
    $domain = explode(":", $domain)[0];
}
$localWorks = false; //some people have issues with localhost for the cookie params
//if you're one of those people make this false

//this is an extra condition added to "resolve" the localhost issue for the session cookie
if (($localWorks && $domain == "localhost") || $domain != "localhost") {
    session_set_cookie_params([
        "lifetime" => 60 * 60,
        "path" => "$BASE_PATH",
        //"domain" => $_SERVER["HTTP_HOST"] || "localhost",
        "domain" => $domain,
        "secure" => true,
        "httponly" => true,
        "samesite" => "lax"
    ]);
}
session_start();


?>
<!-- include css and js files -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<link rel="stylesheet" href="<?php echo get_url('styles.css'); ?>">
<script src="<?php echo get_url('helpers.js'); ?>"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent" aria-controls="navContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if (is_logged_in()) : ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo get_url('profile.php'); ?>">Profile</a></li>
                <?php endif; ?>
                <?php if (!is_logged_in()) : ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo get_url('login.php'); ?>">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo get_url('register.php'); ?>">Register</a></li>
                <?php endif; ?>
                <?php if (has_role("Admin")) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="rolesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Admin Roles
                        </a>
                        <ul class="dropdown-menu bg-info-subtle" aria-labelledby="rolesDropdown">
                            <li><a class="dropdown-item" href="<?php echo get_url('admin/create_role.php'); ?>">Create Role</a></li>
                            <li><a class="dropdown-item" href="<?php echo get_url('admin/list_roles.php'); ?>">List Roles</a></li>
                            <li><a class="dropdown-item" href="<?php echo get_url('admin/assign_roles.php'); ?>">Assign Roles</a></li>
                            <li><a class="dropdown-item" href="<?php echo get_url('admin/add_item.php'); ?>">Add Item</a></li>
                            <li><a class="dropdown-item" href="<?php echo get_url('admin/list_products.php'); ?>">List Products</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (has_role("Shop Owner") && !has_role("Admin")) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="rolesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Shop Owner Actions
                        </a>
                        <ul class="dropdown-menu bg-info-subtle" aria-labelledby="ShopOwnerDropdown">
                            <li><a class="dropdown-item" href="<?php echo get_url('admin/add_item.php'); ?>">Add Item</a></li>
                            <li><a class="dropdown-item" href="<?php echo get_url('admin/list_products.php'); ?>">List Products</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (is_logged_in()) : ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo get_url('logout.php'); ?>">Logout</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>