<?php
    session_start();

    function confirm_logged_in() {
        $location = 'admin-panel-login.php';
        if (!logged_in()){ header("Location: {$location}"); }

    }
    function logged_in() {
        return isset($_SESSION['title']);
    }
?>