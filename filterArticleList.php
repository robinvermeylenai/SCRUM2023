<?php

    $redirectToUrl = $_POST['currentUrl'];
    $connector = (strstr($redirectToUrl, '?')) ? '&' : '?';
    if(trim($_POST['searchKey']) !== '') {
        $redirectToUrl .= $connector.'search='.urlencode(trim($_POST['searchKey']));
    }
    
    header('Location: '.$redirectToUrl);
    exit;