<?php

declare(strict_types=1);

final class Connection
{
    private string $host;
    private int $port;
    private string $database;
    private string $username;
    private string $password;
    private string $charset;
    private ?string $sslCa;

    public function __construct(
        string $host,
        int $port,
        string $database,
        string $username,
        string $password,
        string $charset = 'utf8mb4',
        ?string $sslCa = null
    ) {
        $this->host = $host;
        $this->port = $port;
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;
        $this->charset = $charset;
        $this->sslCa = $sslCa;
    }

    public function createPdo(): PDO
    {
        $dsn = sprintf(
            'mysql:host=%s;port=%d;dbname=%s;charset=%s',
            $this->host,
            $this->port,
            $this->database,
            $this->charset
        );

        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_TIMEOUT => 10,
        );

        // TiDB Cloud y otros proveedores rechazan conexiones sin cifrar.
        // Si DB_SSL_CA apunta a un certificado, PDO valida el servidor con TLS.
        if ($this->sslCa !== null && $this->sslCa !== '') {
            if (!is_file($this->sslCa)) {
                throw new RuntimeException('No se encontro el certificado SSL: ' . $this->sslCa);
            }

            $options[PDO::MYSQL_ATTR_SSL_CA] = $this->sslCa;
            $options[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = true;
        }

        $pdo = new PDO(
            $dsn,
            $this->username,
            $this->password,
            $options
        );

        return $pdo;
    }
}
