<div class="phone-login"></div>
<div class="login">
    <form class="formulario" method="POST" action="/account-recovery">
        <h1>Reestablecer contraseña</h1>
        <?php
            include_once __DIR__ . "/../templates/alerts.php";
        ?>
        <?php
            if ($error) {
                echo '    </form></div><div class="phone-login"></div>';
                return;
            }
        ?>
        <div class="campo">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z" />
                <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" />
                <path d="M8 11v-4a4 4 0 1 1 8 0v4" />
            </svg>
            <input type="password" placeholder="Contraseña" name="password">
        </div>
        <div class="signup-link">
            ¿No tienes una cuenta? <a href="signup">Regístrate</a>
        </div>
        <div class="signup-link">
            ¿Ya tienes una cuenta? <a href="login">Iniciar sesión</a>
        </div>
        <div class="cont-center">
            <input class="correo-button" type="submit" value="Cambiar contraseña"/>
        </div>
    </form>
</div>
<div class="phone-login"></div>