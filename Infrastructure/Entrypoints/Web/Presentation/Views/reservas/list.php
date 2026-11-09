<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<div style="display: flex; justify-content: space-between; align-items: center;">
    <h1>Lista de Reservas de Hotel</h1>
    <a href="?route=reservas.create" class="btn btn-primary">+ Nueva Reserva</a>
</div>

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

<?php if (empty($reservas)): ?>
    <p>No hay reservas de hotel registradas todavía.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Hotel</th>
                <th>Huésped</th>
                <th>Fechas</th>
                <th>Habitación</th>
                <th>Valor</th>
                <th>Ciudad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservas as $reserva): ?>
                <tr>
                    <td><strong><?= htmlspecialchars($reserva->getHotel(), ENT_QUOTES, 'UTF-8') ?></strong></td>
                    <td><?= htmlspecialchars($reserva->getHuesped(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td>
                        <small>
                            <?= htmlspecialchars($reserva->getFechaInicio(), ENT_QUOTES, 'UTF-8') ?>
                            al <?= htmlspecialchars($reserva->getFechaFin(), ENT_QUOTES, 'UTF-8') ?>
                        </small>
                    </td>
                    <td><?= htmlspecialchars($reserva->getHabitacion(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td>$<?= htmlspecialchars($reserva->getValorFormatted(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($reserva->getCiudad(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td>
                        <span class="badge badge-<?= strtolower($reserva->getStatus()) ?>">
                            <?= htmlspecialchars($reserva->getStatus(), ENT_QUOTES, 'UTF-8') ?>
                        </span>
                    </td>
                    <td class="col-actions">
                        <a class="btn btn-sm" href="?route=reservas.show&amp;id=<?= urlencode($reserva->getId()) ?>">Ver</a>
                        <a class="btn btn-warning btn-sm"
                            href="?route=reservas.edit&amp;id=<?= urlencode($reserva->getId()) ?>">Editar</a>
                        <form method="POST" action="?route=reservas.delete" style="display:inline;"
                            onsubmit="return confirm('¿Seguro que deseas eliminar esta reserva?');">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($reserva->getId(), ENT_QUOTES, 'UTF-8') ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
