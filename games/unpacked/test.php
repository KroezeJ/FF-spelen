<?php 
$homepage = file_get_contents("../../../public_html/actions/conn.php") ?? "error";
echo htmlspecialchars($homepage);
