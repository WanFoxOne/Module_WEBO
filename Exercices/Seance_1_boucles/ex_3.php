<?php
session_start();
(!isset($_SESSION['test'])) ? $_SESSION['test'] = 0 : $_SESSION['test']++;
var_dump($_SESSION['test']);

