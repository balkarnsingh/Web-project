<?php
// Destroy all session data to logout
session_destroy();

// Redirect to login page after logout
exit('<script>window.location = "index.php";</script>');
