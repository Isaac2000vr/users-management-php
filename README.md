# Reservas de Hotel

Este es un programa web muy sencillo para guardar las reservas de un hotel.

Piensa en una libreta donde el recepcionista escribe:

- el nombre del hotel,
- el nombre del huésped,
- las fechas de entrada y salida,
- el valor de la reserva,
- y otros datos importantes.

Este programa hace lo mismo, pero en el navegador.

---

## Qué se puede hacer

- Entrar con un correo y una contraseña.
- Ver la lista de todas las reservas.
- Crear una reserva nueva.
- Abrir una reserva para ver todos sus datos.
- Editarla si algo cambia.
- Borrarla si ya no se necesita.
- Cambiar el estado de una reserva: `PENDING` (pendiente), `CONFIRMED` (confirmada) o `CANCELLED` (cancelada).

Una reserva nueva **siempre empieza en `PENDING`**. El estado se cambia después, al editarla.

---

## Cómo abrir el programa

### Opción 1: con Docker (la más fácil)

Solo necesitas tener Docker abierto. Después, en una terminal dentro de la carpeta del proyecto, escribe:

```bash
docker compose up -d --build
```

Espera unos segundos y abre esta dirección en el navegador:

<http://localhost:8080/public/index.php?route=auth.login>

Para apagarlo:

```bash
docker compose down
```

Si además quieres borrar los datos guardados:

```bash
docker compose down -v
```

### Opción 2: sin Docker

Necesitas PHP 8.3 y MySQL instalados.

1. Crea la base de datos con este comando:

   ```bash
   mysql -u root -p < Infrastructure/Adapters/Persistence/MySQL/Config/database.sql
   ```

2. Copia la plantilla de configuración:

   ```bash
   cp .env.example .env
   ```

3. Abre `.env` y escribe la contraseña de tu MySQL.

4. Arranca el programa:

   ```bash
   php -S 127.0.0.1:8090 -t .
   ```

5. Abre en el navegador:

   <http://127.0.0.1:8090/public/index.php?route=auth.login>

---

## Usuario para entrar

| Correo | Contraseña |
| --- | --- |
| `admin@crud.com` | `admin123` |

---

## Qué hay dentro de cada carpeta

No hace falta saber esto para usar el programa, pero ayuda a entenderlo:

| Carpeta | Qué guarda |
| --- | --- |
| `Domain` | Las reglas del negocio. Por ejemplo: una fecha de salida no puede ser antes que la de entrada. |
| `Application` | Lo que el programa sabe hacer: crear, listar, editar, borrar. |
| `Infrastructure` | Lo que habla con el mundo de afuera: MySQL y el correo. |
| `Infrastructure/Entrypoints` | Las páginas y los formularios que ve el usuario. |
| `public` | La puerta de entrada del programa. |
| `tests` | Las pruebas automáticas. |

---

## Cómo saber si todo funciona

Ejecuta las pruebas:

```bash
php tests/test_reserva_hotel.php
```

Si al final dice que todas pasaron, todo está bien.

También puedes revisar la salud del servicio en:

<http://localhost:8080/public/health.php>

Debe responder algo como:

```json
{"status":"ok","database":"ok"}
```

---

## Probar con Postman

En la carpeta `postman` hay dos archivos:

- la colección con las peticiones,
- el entorno local con la dirección del programa.

Impórtalos en Postman, elige el entorno **Local** y ejecuta las peticiones **en orden**. La primera petición inicia sesión y Postman guarda la cookie para las demás.

---

## En la nube

- Aplicación: _(se escribe aquí después de publicarla en Render)_
- Video: _(se escribe aquí el enlace del video)_

La aplicación en la nube usa TiDB Cloud como base de datos y Render para servir las páginas. Las dos son gratis para practicar.

---

## Si algo falla

- **No carga la página:** revisa que el programa esté encendido.
- **No encuentra la base de datos:** revisa que MySQL esté encendido y que los datos del archivo `.env` sean correctos.
- **Dice "insecure transport":** la base de datos pide una conexión segura. Pon `DB_SSL_CA=true` en `.env`.
- **No puedo entrar:** usa el correo y la contraseña de la tabla de arriba.
