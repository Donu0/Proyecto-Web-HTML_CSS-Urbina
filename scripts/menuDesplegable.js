document.addEventListener('DOMContentLoaded', () => {
    const userMenu = document.querySelector('.user-menu');

    if (userMenu) {
        userMenu.addEventListener('click', () => {
            userMenu.classList.toggle('active');
        });

        // Cerrar el menú al hacer clic fuera
        document.addEventListener('click', (e) => {
            if (!userMenu.contains(e.target)) {
                userMenu.classList.remove('active');
            }
        });
    }
});
