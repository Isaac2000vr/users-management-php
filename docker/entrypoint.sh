#!/bin/sh
set -e

# Render entrega el puerto en la variable PORT (por defecto 10000).
# En Docker Compose usamos PORT=80.
PORT="${PORT:-80}"
export PORT

# Apache necesita escuchar en ese puerto.
sed -ri "s/^Listen .*/Listen ${PORT}/" /etc/apache2/ports.conf

# El archivo de configuracion usa ${PORT}; Apache lo expande desde el entorno.
exec "$@"
