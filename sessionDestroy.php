<?php

ob_start($validarlogin);
session_start($validarlogin);
session_destroy($validarlogin);
header("Location: login.php");
exit;
ob_end_flush($validarlogin);