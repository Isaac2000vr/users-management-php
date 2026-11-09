<?php

declare(strict_types=1);

final class ClassLoader
{
    /**
     * @var array<string, string>
     */
    private static array $classMap = array(
        'InvalidUserEmailException' => 'Domain/Exceptions/InvalidUserEmailException.php',
        'InvalidUserIdException' => 'Domain/Exceptions/InvalidUserIdException.php',
        'InvalidUserNameException' => 'Domain/Exceptions/InvalidUserNameException.php',
        'InvalidUserPasswordException' => 'Domain/Exceptions/InvalidUserPasswordException.php',
        'InvalidUserRoleException' => 'Domain/Exceptions/InvalidUserRoleException.php',
        'InvalidUserStatusException' => 'Domain/Exceptions/InvalidUserStatusException.php',
        'UserAlreadyExistsException' => 'Domain/Exceptions/UserAlreadyExistsException.php',
        'UserNotFoundException' => 'Domain/Exceptions/UserNotFoundException.php',
        'InvalidCredentialsException' => 'Domain/Exceptions/InvalidCredentialsException.php',

        'UserRoleEnum' => 'Domain/Enums/UserRoleEnum.php',
        'UserStatusEnum' => 'Domain/Enums/UserStatusEnum.php',

        'UserId' => 'Domain/ValueObjects/UserId.php',
        'UserName' => 'Domain/ValueObjects/UserName.php',
        'UserEmail' => 'Domain/ValueObjects/UserEmail.php',
        'UserPassword' => 'Domain/ValueObjects/UserPassword.php',

        'UserModel' => 'Domain/Models/UserModel.php',
        'EmailDestinationModel' => 'Domain/Models/EmailDestinationModel.php',
        'EmailSenderException' => 'Domain/Exceptions/EmailSenderException.php',
        'EmailSenderPort' => 'Application/Ports/Out/EmailSenderPort.php',
        'EmailNotificationService' => 'Application/Services/EmailNotificationService.php',
        'EmailSenderService' => 'Infrastructure/Adapters/Email/EmailSenderService.php',

        'CreateUserUseCase' => 'Application/Ports/In/CreateUserUseCase.php',
        'UpdateUserUseCase' => 'Application/Ports/In/UpdateUserUseCase.php',
        'GetUserByIdUseCase' => 'Application/Ports/In/GetUserByIdUseCase.php',
        'GetAllUsersUseCase' => 'Application/Ports/In/GetAllUsersUseCase.php',
        'DeleteUserUseCase' => 'Application/Ports/In/DeleteUserUseCase.php',
        'LoginUseCase' => 'Application/Ports/In/LoginUseCase.php',

        'SaveUserPort' => 'Application/Ports/Out/SaveUserPort.php',
        'UpdateUserPort' => 'Application/Ports/Out/UpdateUserPort.php',
        'GetUserByIdPort' => 'Application/Ports/Out/GetUserByIdPort.php',
        'GetUserByEmailPort' => 'Application/Ports/Out/GetUserByEmailPort.php',
        'GetAllUsersPort' => 'Application/Ports/Out/GetAllUsersPort.php',
        'DeleteUserPort' => 'Application/Ports/Out/DeleteUserPort.php',

        'CreateUserCommand' => 'Application/Services/Dto/Commands/CreateUserCommand.php',
        'UpdateUserCommand' => 'Application/Services/Dto/Commands/UpdateUserCommand.php',
        'DeleteUserCommand' => 'Application/Services/Dto/Commands/DeleteUserCommand.php',
        'LoginCommand' => 'Application/Services/Dto/Commands/LoginCommand.php',
        'GetUserByIdQuery' => 'Application/Services/Dto/Queries/GetUserByIdQuery.php',
        'GetAllUsersQuery' => 'Application/Services/Dto/Queries/GetAllUsersQuery.php',

        'CreateUserService' => 'Application/Services/CreateUserService.php',
        'UpdateUserService' => 'Application/Services/UpdateUserService.php',
        'GetUserByIdService' => 'Application/Services/GetUserByIdService.php',
        'GetAllUsersService' => 'Application/Services/GetAllUsersService.php',
        'DeleteUserService' => 'Application/Services/DeleteUserService.php',
        'LoginService' => 'Application/Services/LoginService.php',
        'UserApplicationMapper' => 'Application/Services/Mappers/UserApplicationMapper.php',

        'Connection' => 'Infrastructure/Adapters/Persistence/MySQL/Config/Connection.php',
        'UserPersistenceDto' => 'Infrastructure/Adapters/Persistence/MySQL/Dto/UserPersistenceDto.php',
        'UserEntity' => 'Infrastructure/Adapters/Persistence/MySQL/Entity/UserEntity.php',
        'UserPersistenceMapper' => 'Infrastructure/Adapters/Persistence/MySQL/Mapper/UserPersistenceMapper.php',
        'UserRepositoryMySQL' => 'Infrastructure/Adapters/Persistence/MySQL/Repository/UserRepositoryMySQL.php',

        'CreateUserWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/CreateUserRequest.php',
        'UpdateUserWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/UpdateUserRequest.php',
        'LoginWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/LoginWebRequest.php',
        'UserResponse' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/UserResponse.php',
        'UserWebMapper' => 'Infrastructure/Entrypoints/Web/Controllers/Mapper/UserWebMapper.php',
        'UserController' => 'Infrastructure/Entrypoints/Web/Controllers/UserController.php',
        'WebRoutes' => 'Infrastructure/Entrypoints/Web/Controllers/Config/WebRoutes.php',

        'View' => 'Infrastructure/Entrypoints/Web/Presentation/View.php',
        'Flash' => 'Infrastructure/Entrypoints/Web/Presentation/Flash.php',

        'DependencyInjection' => 'Common/DependencyInjection.php',

        // ReservaHotel (Ejercicio 31)
        'InvalidReservaHotelException' => 'Domain/Exceptions/InvalidReservaHotelException.php',
        'ReservaHotelNotFoundException' => 'Domain/Exceptions/ReservaHotelNotFoundException.php',
        'ReservaHotelStatusEnum' => 'Domain/Enums/ReservaHotelStatusEnum.php',
        'ReservaHotelId' => 'Domain/ValueObjects/ReservaHotelId.php',
        'ReservaHotelFecha' => 'Domain/ValueObjects/ReservaHotelFecha.php',
        'ReservaHotelValor' => 'Domain/ValueObjects/ReservaHotelValor.php',
        'ReservaHotelModel' => 'Domain/Models/ReservaHotelModel.php',
        'ReservaHotelCreatedDomainEvent' => 'Domain/Events/ReservaHotelCreatedDomainEvent.php',
        'ReservaHotelUpdatedDomainEvent' => 'Domain/Events/ReservaHotelUpdatedDomainEvent.php',
        'ReservaHotelDeletedDomainEvent' => 'Domain/Events/ReservaHotelDeletedDomainEvent.php',

        'CreateReservaHotelUseCase' => 'Application/Ports/In/CreateReservaHotelUseCase.php',
        'UpdateReservaHotelUseCase' => 'Application/Ports/In/UpdateReservaHotelUseCase.php',
        'GetReservaHotelByIdUseCase' => 'Application/Ports/In/GetReservaHotelByIdUseCase.php',
        'GetAllReservasHotelUseCase' => 'Application/Ports/In/GetAllReservasHotelUseCase.php',
        'DeleteReservaHotelUseCase' => 'Application/Ports/In/DeleteReservaHotelUseCase.php',

        'SaveReservaHotelPort' => 'Application/Ports/Out/SaveReservaHotelPort.php',
        'UpdateReservaHotelPort' => 'Application/Ports/Out/UpdateReservaHotelPort.php',
        'GetReservaHotelByIdPort' => 'Application/Ports/Out/GetReservaHotelByIdPort.php',
        'GetAllReservasHotelPort' => 'Application/Ports/Out/GetAllReservasHotelPort.php',
        'DeleteReservaHotelPort' => 'Application/Ports/Out/DeleteReservaHotelPort.php',

        'CreateReservaHotelCommand' => 'Application/Services/Dto/Commands/CreateReservaHotelCommand.php',
        'UpdateReservaHotelCommand' => 'Application/Services/Dto/Commands/UpdateReservaHotelCommand.php',
        'DeleteReservaHotelCommand' => 'Application/Services/Dto/Commands/DeleteReservaHotelCommand.php',
        'GetReservaHotelByIdQuery' => 'Application/Services/Dto/Queries/GetReservaHotelByIdQuery.php',
        'GetAllReservasHotelQuery' => 'Application/Services/Dto/Queries/GetAllReservasHotelQuery.php',

        'CreateReservaHotelService' => 'Application/Services/CreateReservaHotelService.php',
        'UpdateReservaHotelService' => 'Application/Services/UpdateReservaHotelService.php',
        'GetReservaHotelByIdService' => 'Application/Services/GetReservaHotelByIdService.php',
        'GetAllReservasHotelService' => 'Application/Services/GetAllReservasHotelService.php',
        'DeleteReservaHotelService' => 'Application/Services/DeleteReservaHotelService.php',
        'ReservaHotelApplicationMapper' => 'Application/Services/Mappers/ReservaHotelApplicationMapper.php',

        'ReservaHotelPersistenceDto' => 'Infrastructure/Adapters/Persistence/MySQL/Dto/ReservaHotelPersistenceDto.php',
        'ReservaHotelEntity' => 'Infrastructure/Adapters/Persistence/MySQL/Entity/ReservaHotelEntity.php',
        'ReservaHotelPersistenceMapper' => 'Infrastructure/Adapters/Persistence/MySQL/Mapper/ReservaHotelPersistenceMapper.php',
        'ReservaHotelRepositoryMySQL' => 'Infrastructure/Adapters/Persistence/MySQL/Repository/ReservaHotelRepositoryMySQL.php',

        'CreateReservaHotelRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/CreateReservaHotelRequest.php',
        'UpdateReservaHotelRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/UpdateReservaHotelRequest.php',
        'ReservaHotelResponse' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/ReservaHotelResponse.php',
        'ReservaHotelWebMapper' => 'Infrastructure/Entrypoints/Web/Controllers/Mapper/ReservaHotelWebMapper.php',
        'ReservaHotelController' => 'Infrastructure/Entrypoints/Web/Controllers/ReservaHotelController.php',
    );

    public static function register(): void
    {
        spl_autoload_register(array(self::class, 'loadClass'));
    }

    public static function loadClass(string $className): void
    {
        if (!isset(self::$classMap[$className])) {
            return;
        }

        $baseDir = dirname(__DIR__) . DIRECTORY_SEPARATOR;
        $filePath = $baseDir . self::$classMap[$className];

        if (!file_exists($filePath)) {
            throw new RuntimeException(
                sprintf('No se encontró el archivo para la clase %s en %s', $className, $filePath)
            );
        }

        require_once $filePath;
    }
}
