<?php
/*
Web Development Assignment
Group 5
Members:
	Muhammad Noorur Rashiq bin Abuzar (B20250386)
	Muhammad Haziq Syazani bin Hasroni (B20250360)
	Awangku Ahmad Rasyid bin Pg Saiful Rizal (B20250033)
*/
session_start();
session_unset();
session_destroy();
header("Location: Home.html");
exit;
?>
