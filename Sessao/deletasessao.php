<?php
error_reporting(0);
include('../Login/login.php');
include('confirmasessao.php');


session_unset();
session_destroy();

echo"<meta http-equiv='refresh' content='0;url=../Login/login.html'>";

