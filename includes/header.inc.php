<!doctype html>
<html>

<head>
    <title><?php if(!isset($title)){ echo("DSC"); } else { echo("DSC | ".ucfirst($title)); } ?></title>
    <meta charset="utf-8">
    <link rel='shortcut icon' href='./images/flame.png'>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" ,
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" 
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/style.css">
</head>

<body style="min-height: 100vh; display: flex; flex-direction: column;">
    <?php
        include("./includes/navbar.inc.php");
    ?>