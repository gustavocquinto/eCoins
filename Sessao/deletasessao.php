<?php
error_reporting(0);
include('../Login/login.php');
include('confirmasessao.php');



session_destroy();
session_unset();

echo"<meta http-equiv='refresh' content='0;url=../Login/login.html'>";

