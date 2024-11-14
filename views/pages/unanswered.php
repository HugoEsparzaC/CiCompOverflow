<!-- Menú en el lado izquierdo -->
<aside class="menu-aside">
    <a href="/" class="pagina imagen-home">
        <img src="build/img/home-white.svg" alt="Logo home" class="imagen-menu">
        Inicio
    </a>
    <a href="/questions" class="pagina imagen-questions">
        <img src="build/img/questions-white.svg" alt="Logo preguntas" class="imagen-menu">
        Preguntas
    </a>
    <a href="/tags" class="pagina imagen-tags">
        <img src="build/img/tags-white.svg" alt="Logo etiquetas" class="imagen-menu">
        Etiquetas
    </a>
    <?php
        if (isset($_SESSION['login'])) {
            echo <<<'EOT'
            <a href="/saves" class="pagina imagen-saves">
                <img src="build/img/saves-white.svg" alt="Logo guardados" class="imagen-menu">
                Guardados
            </a>
            EOT;
        }
    ?>
    <a href="/users" class="pagina imagen-users">
        <img src="build/img/users-white.svg" alt="Logo usuarios" class="imagen-menu">
        Usuarios
    </a>
    <a href="/unanswered" class="pagina imagen-unanswered">
        <img src="build/img/unanswered-white.svg" alt="Logo sin responder" class="imagen-menu">
        Sin Responder
    </a>
</aside>
<!-- Contenido principal -->
<main>
    <h1>Preguntas Principales</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos quas id quidem quod magnam consectetur repellat, facilis illo vero deserunt est eaque explicabo maiores cum perspiciatis in sunt molestiae quo!</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos quas id quidem quod magnam consectetur repellat, facilis illo vero deserunt est eaque explicabo maiores cum perspiciatis in sunt molestiae quo!</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos quas id quidem quod magnam consectetur repellat, facilis illo vero deserunt est eaque explicabo maiores cum perspiciatis in sunt molestiae quo!</p>
</main>
<!-- Sección de preguntas populares en el lado derecho -->
<aside class="right-aside">
    <h2>Preguntas más recientes</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus soluta accusamus ipsa aliquam quisquam vitae. Porro, iure ducimus qui quis rerum asperiores consectetur provident? Recusandae ipsum laudantium libero asperiores fugiat.</p>
</aside>