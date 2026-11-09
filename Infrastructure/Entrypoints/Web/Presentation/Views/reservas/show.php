<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Detalle de la Reserva de Hotel</h1>

<div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); max-width: 800px;">
    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #eee; padding-bottom: 10px; margin-bottom: 15px;">
        <h2 style="margin: 0; color: #2c3e50;"><?= htmlspecialchars($reserva->getHotel(), ENT_QUOTES, 'UTF-8') ?></h2>
        <span class="badge badge-<?= strtolower($reserva->getStatus()) ?>" style="font-size: 14px; padding: 6px 12px;">
            <?= htmlspecialchars($reserva->getStatus(), ENT_QUOTES, 'UTF-8') ?>
        </span>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; font-size: 15px;">
        <p><strong>Identificador (UUID):</strong><br><code><?= htmlspecialchars($reserva->getId(), ENT_QUOTES, 'UTF-8') ?></code></p>
        <p><strong>Fecha Registro:</strong><br><?= htmlspecialchars($reserva->getFecha(), ENT_QUOTES, 'UTF-8') ?></p>
        <p><strong>Huésped Principal:</strong><br><?= htmlspecialchars($reserva->getHuesped(), ENT_QUOTES, 'UTF-8') ?></p>
        <p><strong>Habitación:</strong><br><?= htmlspecialchars($reserva->getHabitacion(), ENT_QUOTES, 'UTF-8') ?></p>
        <p><strong>Check-in (Inicio):</strong><br><?= htmlspecialchars($reserva->getFechaInicio(), ENT_QUOTES, 'UTF-8') ?> (Hora: <?= htmlspecialchars($reserva->getHoraCheckin(), ENT_QUOTES, 'UTF-8') ?>)</p>
        <p><strong>Check-out (Fin):</strong><br><?= htmlspecialchars($reserva->getFechaFin(), ENT_QUOTES, 'UTF-8') ?> (Hora: <?= htmlspecialchars($reserva->getHoraCheckout(), ENT_QUOTES, 'UTF-8') ?>)</p>
        <p><strong>Valor Total:</strong><br><span style="font-size: 18px; color: #27ae60; font-weight: bold;">$<?= htmlspecialchars($reserva->getValorFormatted(), ENT_QUOTES, 'UTF-8') ?></span></p>
        <p><strong>Número de Acompañantes:</strong><br><?= htmlspecialchars((string) $reserva->getNumAcompanantes(), ENT_QUOTES, 'UTF-8') ?> personas</p>
        <p><strong>Ubicación:</strong><br><?= htmlspecialchars($reserva->getCiudad() . ', ' . $reserva->getDepartamento() . ' (' . $reserva->getPais() . ')', ENT_QUOTES, 'UTF-8') ?></p>
        <p><strong>Atendido por:</strong><br><?= htmlspecialchars($reserva->getEmpleadoAtiende(), ENT_QUOTES, 'UTF-8') ?></p>
        <p><strong>Despedido por:</strong><br><?= htmlspecialchars($reserva->getEmpleadoDespide(), ENT_QUOTES, 'UTF-8') ?></p>
    </div>

    <?php if ($reserva->getDescripcion() !== ''): ?>
        <div style="margin-top: 15px; padding-top: 10px; border-top: 1px solid #eee;">
            <p><strong>Observaciones / Descripción:</strong></p>
            <p style="background: #f8f9fa; padding: 10px; border-radius: 4px;"><?= nl2br(htmlspecialchars($reserva->getDescripcion(), ENT_QUOTES, 'UTF-8')) ?></p>
        </div>
    <?php endif; ?>

    <div style="margin-top: 20px; display: flex; gap: 10px;">
        <a href="?route=reservas.edit&amp;id=<?= urlencode($reserva->getId()) ?>" class="btn btn-warning">Editar Reserva</a>
        <a href="?route=reservas.index" class="btn">Volver al listado</a>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
