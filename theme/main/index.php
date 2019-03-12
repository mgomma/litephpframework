<?php

include 'header.php';

if(!file_exists($content)){
    $data['messages']['error'] = 'The template file not exist !!';
}

if(isset($data['messages'])){
    include 'messages.php';
}

if(file_exists($content)){
    include $content;
}

include 'footer.php';


