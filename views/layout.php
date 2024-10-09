<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CiComp Overflow</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="preload" href="build/css/app.css" as="style">
    <link rel="stylesheet" href="build/css/app.css">
    <link rel="icon" href="build/img/laptop.svg" type="image/svg+xml">
</head>
<body>
    <header class="header">
        <div class="contenedor contenido-header">
            <div class="logo">
                <a href="/">
                    <img src="build/img/cicompoverflow-white.svg" alt="Logo CiComp Overflow" class="imagen-logo">
                </a>
            </div>
            <div class="search-bar">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                    <path d="M21 21l-6 -6" />
                </svg>
                <input type="text" class="search-box__input" placeholder="Buscar...">
            </div>
            <div class="navegacion-principal">
                <a href="/login" class="login-button">Iniciar sesión</a>
                <a href="/signup" class="signup-button">Registrarse</a>
                <button class="switch" id="switch">
                    <span>
                        <img src="build/img/Sun.svg" alt="Sun">
                    </span>
                    <span>
                        <img src="build/img/Moon.svg" alt="Moon">
                    </span>
                </button>
            </div>
        </div>
    </header>

    <?php echo $content; ?>

    <script src="build/js/app.js"></script>
</body>
</html>