<?php

declare(strict_types=1);

require_once __DIR__ . '/ClassLoader.php';
require_once __DIR__ . '/EnvLoader.php';

final class DependencyInjection
{
    public static function boot(): void
    {
        EnvLoader::load(dirname(__DIR__) . '/.env');
        ClassLoader::register();
    }

    public static function getConnection(): Connection
    {
        ClassLoader::loadClass('Connection');

        return new Connection(
            host: EnvLoader::get('DB_HOST', '127.0.0.1'),
            port: EnvLoader::getInt('DB_PORT', 3306),
            database: EnvLoader::get('DB_DATABASE', 'crud_usuarios'),
            username: EnvLoader::get('DB_USERNAME', 'root'),
            password: EnvLoader::get('DB_PASSWORD', ''),
            charset: EnvLoader::get('DB_CHARSET', 'utf8mb4'),
            sslCa: self::resolveSslCa()
        );
    }

    /**
     * Devuelve la ruta absoluta del certificado TLS o null si no se usa SSL.
     * DB_SSL_CA puede ser "true" (usa el certificado incluido para TiDB Cloud)
     * o una ruta relativa a la raiz del proyecto.
     */
    private static function resolveSslCa(): ?string
    {
        $sslCa = trim((string) EnvLoader::get('DB_SSL_CA', ''));

        if ($sslCa === '' || $sslCa === 'false' || $sslCa === '0') {
            return null;
        }

        if ($sslCa === 'true' || $sslCa === '1') {
            return dirname(__DIR__)
                . '/Infrastructure/Adapters/Persistence/MySQL/Config/certs/isrgrootx1.pem';
        }

        $isAbsolute = str_starts_with($sslCa, '/')
            || preg_match('/^[A-Za-z]:[\\\\\\/]/', $sslCa) === 1;

        return $isAbsolute ? $sslCa : dirname(__DIR__) . '/' . ltrim($sslCa, '/');
    }

    public static function getPdo(): PDO
    {
        return self::getConnection()->createPdo();
    }

    public static function getUserPersistenceMapper(): UserPersistenceMapper
    {
        ClassLoader::loadClass('UserPersistenceMapper');

        return new UserPersistenceMapper();
    }

    public static function getUserRepository(): UserRepositoryMySQL
    {
        ClassLoader::loadClass('UserRepositoryMySQL');

        return new UserRepositoryMySQL(
            self::getPdo(),
            self::getUserPersistenceMapper()
        );
    }

    public static function getEmailSenderService(): EmailSenderService
    {
        ClassLoader::loadClass('EmailSenderService');

        return new EmailSenderService(
            host: EnvLoader::get('SMTP_HOST', 'smtp.gmail.com'),
            username: EnvLoader::get('SMTP_USERNAME', ''),
            password: EnvLoader::get('SMTP_PASSWORD', ''),
            fromAddress: EnvLoader::get('SMTP_FROM_ADDRESS', ''),
            fromName: EnvLoader::get('SMTP_FROM_NAME', 'CRUD Usuarios'),
            encryption: EnvLoader::get('SMTP_ENCRYPTION', 'tls'),
            port: EnvLoader::getInt('SMTP_PORT', 587)
        );
    }

    public static function getEmailNotificationService(): EmailNotificationService
    {
        ClassLoader::loadClass('EmailNotificationService');

        return new EmailNotificationService(
            self::getEmailSenderService()
        );
    }

    public static function getCreateUserUseCase(): CreateUserUseCase
    {
        ClassLoader::loadClass('CreateUserService');
        $repository = self::getUserRepository();

        return new CreateUserService(
            $repository,
            $repository,
            self::getEmailNotificationService()
        );
    }

    public static function getUpdateUserUseCase(): UpdateUserUseCase
    {
        ClassLoader::loadClass('UpdateUserService');
        $repository = self::getUserRepository();

        return new UpdateUserService(
            $repository,
            $repository,
            $repository,
            self::getEmailNotificationService()
        );
    }

    public static function getGetUserByIdUseCase(): GetUserByIdUseCase
    {
        ClassLoader::loadClass('GetUserByIdService');

        return new GetUserByIdService(
            self::getUserRepository()
        );
    }

    public static function getGetAllUsersUseCase(): GetAllUsersUseCase
    {
        ClassLoader::loadClass('GetAllUsersService');

        return new GetAllUsersService(
            self::getUserRepository()
        );
    }

    public static function getDeleteUserUseCase(): DeleteUserUseCase
    {
        ClassLoader::loadClass('DeleteUserService');
        $repository = self::getUserRepository();

        return new DeleteUserService(
            $repository,
            $repository
        );
    }

    public static function getUserWebMapper(): UserWebMapper
    {
        ClassLoader::loadClass('UserWebMapper');

        return new UserWebMapper();
    }

    public static function getUserController(): UserController
    {
        ClassLoader::loadClass('UserController');

        return new UserController(
            self::getCreateUserUseCase(),
            self::getUpdateUserUseCase(),
            self::getGetUserByIdUseCase(),
            self::getGetAllUsersUseCase(),
            self::getDeleteUserUseCase(),
            self::getUserWebMapper()
        );
    }

    public static function getLoginUseCase(): LoginUseCase
    {
        ClassLoader::loadClass('LoginService');

        return new LoginService(
            self::getUserRepository()
        );
    }

    // ========================================================
    // Inyección de dependencias para ReservaHotel (Ejercicio 31)
    // ========================================================

    public static function getReservaHotelPersistenceMapper(): ReservaHotelPersistenceMapper
    {
        ClassLoader::loadClass('ReservaHotelPersistenceMapper');
        return new ReservaHotelPersistenceMapper();
    }

    public static function getReservaHotelRepository(): ReservaHotelRepositoryMySQL
    {
        ClassLoader::loadClass('ReservaHotelRepositoryMySQL');
        return new ReservaHotelRepositoryMySQL(
            self::getPdo(),
            self::getReservaHotelPersistenceMapper()
        );
    }

    public static function getCreateReservaHotelUseCase(): CreateReservaHotelUseCase
    {
        ClassLoader::loadClass('CreateReservaHotelService');
        return new CreateReservaHotelService(self::getReservaHotelRepository());
    }

    public static function getUpdateReservaHotelUseCase(): UpdateReservaHotelUseCase
    {
        ClassLoader::loadClass('UpdateReservaHotelService');
        $repository = self::getReservaHotelRepository();
        return new UpdateReservaHotelService($repository, $repository);
    }

    public static function getGetReservaHotelByIdUseCase(): GetReservaHotelByIdUseCase
    {
        ClassLoader::loadClass('GetReservaHotelByIdService');
        return new GetReservaHotelByIdService(self::getReservaHotelRepository());
    }

    public static function getGetAllReservasHotelUseCase(): GetAllReservasHotelUseCase
    {
        ClassLoader::loadClass('GetAllReservasHotelService');
        return new GetAllReservasHotelService(self::getReservaHotelRepository());
    }

    public static function getDeleteReservaHotelUseCase(): DeleteReservaHotelUseCase
    {
        ClassLoader::loadClass('DeleteReservaHotelService');
        $repository = self::getReservaHotelRepository();
        return new DeleteReservaHotelService($repository, $repository);
    }

    public static function getReservaHotelWebMapper(): ReservaHotelWebMapper
    {
        ClassLoader::loadClass('ReservaHotelWebMapper');
        return new ReservaHotelWebMapper();
    }

    public static function getReservaHotelController(): ReservaHotelController
    {
        ClassLoader::loadClass('ReservaHotelController');
        return new ReservaHotelController(
            self::getCreateReservaHotelUseCase(),
            self::getUpdateReservaHotelUseCase(),
            self::getGetReservaHotelByIdUseCase(),
            self::getGetAllReservasHotelUseCase(),
            self::getDeleteReservaHotelUseCase(),
            self::getReservaHotelWebMapper()
        );
    }
}
