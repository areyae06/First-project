<?php
session_start();
session_unset();
session_destroy();

// Redirect to login page with message
header("Location:index.html");
exit();
