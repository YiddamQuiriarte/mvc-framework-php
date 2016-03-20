<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    
    <title>Framework Básico: <?php if(isset($this->titulo)) { echo $this->titulo; } ?></title>
    
    <link rel="stylesheet" type="text/css" href="<?php echo $_layoutParams["ruta_css"]; ?>style.css">

</head>

<body>

<header>

    <nav>
    
        <ul>
        
            <li><a href="<?php echo APP_URL; ?>">Inicio</a></li>
            
            <li><a href="<?php echo APP_URL."tareas"; ?>">Tareas</a></li>
            
            <li><a href="<?php echo APP_URL."categorias"; ?>">Categorias</a></li>
            
            <li><a href="<?php echo APP_URL."usuarios"; ?>">Usuarios</a></li>
            
            <li><a href="<?php echo APP_URL."usuarios/logout"; ?>">Salir</a></li>
            
        </ul>
        
    </nav>
    
</header>