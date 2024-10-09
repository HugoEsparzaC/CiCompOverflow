// Obtener el estado del modo oscuro y del botón desde localStorage
let darkmode = localStorage.getItem('darkmode');
let buttonState = localStorage.getItem('buttonState');
const themeSwitch = document.getElementsByClassName('switch')[0]; // Acceder al primer elemento con la clase 'switch'

// Funciones para activar/desactivar el modo oscuro
const enableDarkMode = () => {
    document.body.classList.add('darkmode');
    localStorage.setItem('darkmode', 'active');
}

const disableDarkMode = () => {
    document.body.classList.remove('darkmode');
    localStorage.setItem('darkmode', null);
}

// Función para activar/desactivar el estado visual del botón
const enableButtonActive = () => {
    themeSwitch.classList.add('active');
    localStorage.setItem('buttonState', 'active');
}

const disableButtonActive = () => {
    themeSwitch.classList.remove('active');
    localStorage.setItem('buttonState', null);
}

// Verificar y aplicar el estado inicial del modo oscuro y del botón
if (darkmode === "active") enableDarkMode();
if (buttonState === "active") enableButtonActive();

document.addEventListener('DOMContentLoaded', function() {
    darkModeToggle();
});

function darkModeToggle() {
    // Alternar visualmente la clase 'active' del botón
    const buttonDarkMode = document.querySelector('.switch');
    buttonDarkMode.addEventListener('click', function() {
        if (buttonDarkMode.classList.contains('active')) {
            disableButtonActive(); // Desactivar visualmente el botón
        } else {
            enableButtonActive(); // Activar visualmente el botón
        }
    });
}

// Alternar entre modo oscuro y claro al hacer clic
themeSwitch.addEventListener("click", () => {
    darkmode = localStorage.getItem('darkmode');
    if (darkmode !== "active") {
        enableDarkMode();
    } else {
        disableDarkMode();
    }
});