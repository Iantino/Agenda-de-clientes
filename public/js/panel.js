/* Comportamiento del template (JavaScript puro, sin librerías extra) */
document.addEventListener('DOMContentLoaded', function () {

    // 1. Mostrar / ocultar contraseña (login, registro, nueva contraseña)
    document.querySelectorAll('[data-toggle-password]').forEach(function (boton) {
        boton.addEventListener('click', function () {
            var input = document.getElementById(boton.dataset.togglePassword);
            var icono = boton.querySelector('i');
            var oculto = input.type === 'password';

            input.type = oculto ? 'text' : 'password';
            icono.className = oculto ? 'bi bi-eye-slash' : 'bi bi-eye';
            boton.setAttribute('aria-label', oculto ? 'Ocultar contraseña' : 'Mostrar contraseña');
        });
    });

    // 2. Menú lateral en celular
    document.querySelectorAll('[data-sidebar-toggle]').forEach(function (boton) {
        boton.addEventListener('click', function () {
            document.body.classList.add('sidebar-open');
        });
    });
    document.querySelectorAll('[data-sidebar-close]').forEach(function (fondo) {
        fondo.addEventListener('click', function () {
            document.body.classList.remove('sidebar-open');
        });
    });

    // 3. El mensaje verde ("Cliente guardado...") se cierra solo a los 5 segundos
    document.querySelectorAll('[data-autoclose]').forEach(function (alerta) {
        setTimeout(function () {
            alerta.classList.remove('show');
            setTimeout(function () { alerta.remove(); }, 300);
        }, 5000);
    });

    // 4. Modal de eliminar: recibe la URL y el nombre del botón que lo abrió
    var modal = document.getElementById('modalEliminar');
    if (modal) {
        modal.addEventListener('show.bs.modal', function (evento) {
            var boton = evento.relatedTarget;
            document.getElementById('formEliminar').action = boton.dataset.action;
            modal.querySelector('[data-nombre-cliente]').textContent = boton.dataset.nombre;
        });
    }
});
