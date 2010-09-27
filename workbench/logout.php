<?php
require_once 'session.php';
require_once 'shared.php';

if ($_SESSION) {
    require_once 'header.php';
    if (getConfig("invalidateSessionOnLogout")) {
        try {
            $partnerConnection->logout();
            $sessionInvatidated = true;
        } catch(Exception $e) {
            $sessionInvatidated = false;
        }
    } else {
        $sessionInvatidated = false;
    }

    session_unset();
    session_destroy();
    print "<p/>";
    if ($sessionInvatidated == true) {
        displayInfo('You have been successfully logged out of Workbench and Salesforce.');
    } else {
        displayInfo('You have been successfully logged out of Workbench.');
    }

    print "<script type='text/javascript'>setTimeout(\"location.href = 'login.php';\",2000);</script>";

    include_once 'footer.php';
} else {
    session_unset();
    session_destroy();

    header('Location: login.php');
}
?>
