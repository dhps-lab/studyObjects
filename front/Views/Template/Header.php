<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $data['page_tag'];?></title>
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/@jarstone/dselect/dist/css/dselect.css">
    
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= baseUrl();?>"><img src="<?= media();?>/images/uploads/logo_ud.png" alt="Logo" style="height: 60px;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= baseUrl();?>StudyObject">Ver objetos de estudio</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="<?= baseUrl();?>Statistics">Reportes de objetos de estudio</a>
                    </li>
                    <li class="nav-item dropdown" id="navbarDropdownMenuLinkLi">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Modificación de
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="<?= baseUrl();?>EditStudyObject">Agregar objetos de estudio</a></li>
                            <li><a class="dropdown-item" href="<?= baseUrl();?>EditAssignStudyObject">Asignar objetos de estudio</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <a class="nav-link active" id="loginButton" onclick="loginModal()" role="button"></a>
    </nav>
    <script src="<?= media(); ?>/js/login.js"></script> 
    <content>
    