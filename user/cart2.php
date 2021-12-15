<?php
    session_start();
    header('Content-Type: application/json; charset=utf-8');
    die(json_encode($_SESSION));
