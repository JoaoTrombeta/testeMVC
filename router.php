<?php
$page = "";
$orientation = "";
$home = "";
$modalInclude = "";
$funcao = "";
if(isset($_GET['page'])){
    $page = $_GET['page'];
}elseif(isset($_GET['orientation'])){
    $orientation = $_GET['orientation'];
}else{
    $home = 'yes';
}

if(isset($_GET['modal'])){
    $modalInclude = $_GET['modal'];
}

if(isset($_GET['function'])){
    $funcao = $_GET['function'];
}

?>