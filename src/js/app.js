// Obtener el estado del modo oscuro y del botón desde localStorage
const darkmode = localStorage.getItem('darkmode') === 'true';
const buttonState = localStorage.getItem('buttonState') === 'true';
const themeSwitch = document.querySelector('.switch'); // Acceder al primer elemento con la clase 'switch'

// Funciones para activar/desactivar el modo oscuro
const toggleDarkMode = (enable) => {
    if (enable) {
        document.body.classList.add('darkmode');
        localStorage.setItem('darkmode', 'true');
    } else {
        document.body.classList.remove('darkmode');
        localStorage.setItem('darkmode', 'false');
    }
}

// Función para activar/desactivar el estado visual del botón
const toggleButtonActive = (enable) => {
    if (enable) {
        themeSwitch.classList.add('active');
        localStorage.setItem('buttonState', 'true');
    } else {
        themeSwitch.classList.remove('active');
        localStorage.setItem('buttonState', 'false');
    }
}

// Verificar y aplicar el estado inicial del modo oscuro y del botón
toggleDarkMode(darkmode);
toggleButtonActive(buttonState);

document.addEventListener('DOMContentLoaded', () => {
    themeSwitch.addEventListener("click", () => {
        const isActive = themeSwitch.classList.toggle('active');
        toggleButtonActive(isActive);
        toggleDarkMode(!darkmode); // Alternar entre modos
    });
});

// Selecciona el header y el footer
const header = document.querySelector('.header');
const footer = document.querySelector('.footer');
const contenidoPrincipal = document.querySelector('.contenido-principal');

// Obtiene las alturas del header y footer
const alturaHeader = header.clientHeight;
const alturaFooter = footer.clientHeight;

// Calcula la altura mínima del contenido principal
const alturaMinima = `calc(100vh - ${alturaHeader + alturaFooter}px)`;

// Aplica la altura mínima al contenido principal
contenidoPrincipal.style.minHeight = alturaMinima;