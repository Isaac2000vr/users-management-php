<?php declare(strict_types=1); ?>
<?php $authUser = $_SESSION['auth'] ?? null; ?>

<nav>
    <a href="?route=home">Inicio</a>
    <?php if ($authUser): ?>
        <a href="?route=users.index">Usuarios</a>
        <a href="?route=users.create">+ Nuevo Usuario</a>
        <span style="margin: 0 10px; color:#aaa;">|</span>
        <a href="?route=reservas.index"><strong>🏨 Reservas Hotel</strong></a>
        <a href="?route=reservas.create">+ Nueva Reserva</a>
        <span style="margin: 0 10px; color:#555;">|</span>
        <span style="color:#333;">👤 <?= htmlspecialchars($authUser['name'], ENT_QUOTES, 'UTF-8') ?></span>
        &nbsp;
        <a href="?route=auth.logout">Cerrar sesión</a>
    <?php else: ?>
        <a href="?route=auth.login">Iniciar sesión</a>
        <a href="?route=auth.forgot">Recuperar contraseña</a>
    <?php endif; ?>
</nav>

<hr>
