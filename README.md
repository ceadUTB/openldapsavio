# Laravel 5 OpenLDAP Auth
Driver de autenticación para Laravel 5.


##Instalación
Agregar al `composer.json` e instalar con `composer install` / `composer update`.
```
{
  require: {
    "utbvirtual/openldapsavio": "dev-master"
  }
}
```

##Agregar a Laravel
Abre tu archivo `config/app.php` y agrega el service providers en el array de providers.

```
utbvirtual\openldapsavio\LdapAuthServiceProvider::class
```
Actualiza tu archivo `config/auth.php` para usar el driver `ldap`.
```
'driver' => 'ldap'
```

##Configuración
Manualmente crear el archivo `config/ldap.php` y agregar lo siguiente:
```
<?php

return [
    'host'      => 'ldaps://example.com',
    'rdn'       => 'ou=System,dc=example,dc=com', // rdn used by the user configured below, optional
    'version'   => '3', // LDAP protocol version (2 or 3)
    
    'basedn'    => 'ou=People,dc=example,dc=com', // basedn for users
    'login_attribute' => 'uid', // login attributes for users
];

?>
```
Crear en el archivo App\User la función `createOrUpdateUser()` que reciba los credentials y toda la información de LDAP, que revise si el usuario existe, y si no, crearlo a partir de esos datos.

Ejemplo:

```
public function createOrUpdateUser($credentials){
        $user = User::where('codigo', '=', $credentials['username'])->first();
        if (!$user) {
            $userdata = ['codigo' => $credentials['username'],
            'name' => $credentials['cn'], 'email' => $credentials['mail']];
            $user = User::create($userdata);
        }
        return $user;
}
```

##Acerca de
Basado en el paquete de [Kuan-Chien Chung(kcchung)](http://jaychung.tw) l5-openldap-auth.
Edited by [Santiago Mendoza](http://www.santiagomendoza.org)
