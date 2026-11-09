<?php require __DIR__ . '/layouts/header.php'; ?>
<?php require __DIR__ . '/layouts/menu.php'; ?>

<h1>Sistema de Gestión CRUDL - Arquitectura Hexagonal</h1>

<p>Bienvenido al sistema con DDD y CQRS. Selecciona el módulo al que deseas acceder:</p>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <div class="alert-success">
        <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
    <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <h3>👤 Módulo Base: Usuarios</h3>
        <p>Gestión de usuarios y autenticación.</p>
        <div style="display: flex; gap: 10px; margin-top: 15px;">
            <a href="?route=users.index" class="btn">Listar Usuarios</a>
            <a href="?route=users.create" class="btn btn-primary">+ Nuevo Usuario</a>
        </div>
    </div>

    <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #27ae60;">
        <h3>🏨 Ejercicio 31: Reservas de Hotel</h3>
        <p>CRUDL de reservas hoteleras con arquitectura hexagonal, Value Objects y casos de uso.</p>
        <div style="display: flex; gap: 10px; margin-top: 15px;">
            <a href="?route=reservas.index" class="btn">Listar Reservas</a>
            <a href="?route=reservas.create" class="btn btn-primary">+ Nueva Reserva</a>
        </div>
    </div>
</div>

<?php require __DIR__ . '/layouts/footer.php'; ?>
