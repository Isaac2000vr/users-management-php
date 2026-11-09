<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Editar Reserva de Hotel</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<form method="POST" action="?route=reservas.update">
    <input type="hidden" name="id" value="<?= htmlspecialchars($reserva->getId(), ENT_QUOTES, 'UTF-8') ?>">

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
        <div class="form-group">
            <label for="hotel">Hotel *</label><br>
            <input type="text" id="hotel" name="hotel" required
                value="<?= htmlspecialchars($old['hotel'] ?? $reserva->getHotel(), ENT_QUOTES, 'UTF-8') ?>">
            <?php if (!empty($errors['hotel'])): ?>
                <div class="field-error"><?= htmlspecialchars($errors['hotel'], ENT_QUOTES, 'UTF-8') ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="huesped">Nombre del Huésped *</label><br>
            <input type="text" id="huesped" name="huesped" required
                value="<?= htmlspecialchars($old['huesped'] ?? $reserva->getHuesped(), ENT_QUOTES, 'UTF-8') ?>">
            <?php if (!empty($errors['huesped'])): ?>
                <div class="field-error"><?= htmlspecialchars($errors['huesped'], ENT_QUOTES, 'UTF-8') ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha de Registro *</label><br>
            <input type="date" id="fecha" name="fecha" required
                value="<?= htmlspecialchars($old['fecha'] ?? $reserva->getFecha(), ENT_QUOTES, 'UTF-8') ?>">
            <?php if (!empty($errors['fecha'])): ?>
                <div class="field-error"><?= htmlspecialchars($errors['fecha'], ENT_QUOTES, 'UTF-8') ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="habitacion">Habitación *</label><br>
            <input type="text" id="habitacion" name="habitacion" required
                value="<?= htmlspecialchars($old['habitacion'] ?? $reserva->getHabitacion(), ENT_QUOTES, 'UTF-8') ?>">
            <?php if (!empty($errors['habitacion'])): ?>
                <div class="field-error"><?= htmlspecialchars($errors['habitacion'], ENT_QUOTES, 'UTF-8') ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="fechaInicio">Fecha Inicio (Check-in) *</label><br>
            <input type="date" id="fechaInicio" name="fechaInicio" required
                value="<?= htmlspecialchars($old['fechaInicio'] ?? $reserva->getFechaInicio(), ENT_QUOTES, 'UTF-8') ?>">
            <?php if (!empty($errors['fechaInicio'])): ?>
                <div class="field-error"><?= htmlspecialchars($errors['fechaInicio'], ENT_QUOTES, 'UTF-8') ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="fechaFin">Fecha Fin (Check-out) *</label><br>
            <input type="date" id="fechaFin" name="fechaFin" required
                value="<?= htmlspecialchars($old['fechaFin'] ?? $reserva->getFechaFin(), ENT_QUOTES, 'UTF-8') ?>">
            <?php if (!empty($errors['fechaFin'])): ?>
                <div class="field-error"><?= htmlspecialchars($errors['fechaFin'], ENT_QUOTES, 'UTF-8') ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="valor">Valor Total ($) *</label><br>
            <input type="number" step="0.01" id="valor" name="valor" required
                value="<?= htmlspecialchars((string) ($old['valor'] ?? $reserva->getValor()), ENT_QUOTES, 'UTF-8') ?>">
            <?php if (!empty($errors['valor'])): ?>
                <div class="field-error"><?= htmlspecialchars($errors['valor'], ENT_QUOTES, 'UTF-8') ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="numAcompanantes">Número de Acompañantes *</label><br>
            <input type="number" min="0" id="numAcompanantes" name="numAcompanantes" required
                value="<?= htmlspecialchars((string) ($old['numAcompanantes'] ?? $reserva->getNumAcompanantes()), ENT_QUOTES, 'UTF-8') ?>">
            <?php if (!empty($errors['numAcompanantes'])): ?>
                <div class="field-error"><?= htmlspecialchars($errors['numAcompanantes'], ENT_QUOTES, 'UTF-8') ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="pais">País *</label><br>
            <input type="text" id="pais" name="pais" required
                value="<?= htmlspecialchars($old['pais'] ?? $reserva->getPais(), ENT_QUOTES, 'UTF-8') ?>">
        </div>

        <div class="form-group">
            <label for="departamento">Departamento *</label><br>
            <input type="text" id="departamento" name="departamento" required
                value="<?= htmlspecialchars($old['departamento'] ?? $reserva->getDepartamento(), ENT_QUOTES, 'UTF-8') ?>">
        </div>

        <div class="form-group">
            <label for="ciudad">Ciudad *</label><br>
            <input type="text" id="ciudad" name="ciudad" required
                value="<?= htmlspecialchars($old['ciudad'] ?? $reserva->getCiudad(), ENT_QUOTES, 'UTF-8') ?>">
        </div>

        <div class="form-group">
            <label for="status">Estado *</label><br>
            <select id="status" name="status">
                <?php foreach ($statusOptions as $opt): ?>
                    <option value="<?= htmlspecialchars($opt, ENT_QUOTES, 'UTF-8') ?>" <?= (($old['status'] ?? $reserva->getStatus()) === $opt) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($opt, ENT_QUOTES, 'UTF-8') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="horaCheckin">Hora Check-in *</label><br>
            <input type="text" id="horaCheckin" name="horaCheckin" required
                value="<?= htmlspecialchars($old['horaCheckin'] ?? $reserva->getHoraCheckin(), ENT_QUOTES, 'UTF-8') ?>">
        </div>

        <div class="form-group">
            <label for="horaCheckout">Hora Check-out *</label><br>
            <input type="text" id="horaCheckout" name="horaCheckout" required
                value="<?= htmlspecialchars($old['horaCheckout'] ?? $reserva->getHoraCheckout(), ENT_QUOTES, 'UTF-8') ?>">
        </div>

        <div class="form-group">
            <label for="empleadoAtiende">Empleado que Atiende *</label><br>
            <input type="text" id="empleadoAtiende" name="empleadoAtiende" required
                value="<?= htmlspecialchars($old['empleadoAtiende'] ?? $reserva->getEmpleadoAtiende(), ENT_QUOTES, 'UTF-8') ?>">
        </div>

        <div class="form-group">
            <label for="empleadoDespide">Empleado que Despide *</label><br>
            <input type="text" id="empleadoDespide" name="empleadoDespide" required
                value="<?= htmlspecialchars($old['empleadoDespide'] ?? $reserva->getEmpleadoDespide(), ENT_QUOTES, 'UTF-8') ?>">
        </div>
    </div>

    <div class="form-group" style="margin-top: 15px;">
        <label for="descripcion">Descripción / Observaciones</label><br>
        <textarea id="descripcion" name="descripcion" rows="3" style="width: 100%;"><?= htmlspecialchars($old['descripcion'] ?? $reserva->getDescripcion(), ENT_QUOTES, 'UTF-8') ?></textarea>
    </div>

    <div style="margin-top: 20px;">
        <button type="submit" class="btn btn-primary">Actualizar Reserva</button>
        <a href="?route=reservas.index" class="btn">Cancelar</a>
    </div>
</form>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
