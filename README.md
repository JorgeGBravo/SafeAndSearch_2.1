<p align="center"><a href="" target="_blank"><img src="https://i.ibb.co/bLVhNgF/the-php-practitioner.jpg" alt="the-php-practitioner" border="0"></a></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# App SafeAndSearch 
¡Bienvenido a esta tu APP de Guarda y Busqueda de tus datos!

Search es una APP desarrollada en [PHP](https://www.php.net/), de como una simple aplicación de busqueda puede ayudar día a día.

Tecnologias utilizadas:

- [PHP 7.3.33](https://www.php.net/)
- [Composer](https://getcomposer.org/) version 2.0.7.



## Descripción

La APP se ha desarrollado en [PHP](https://www.php.net/) funciona como un CLI, que desde la linea de comando podrás buscar e insertar datos de forma intuitiva.
Toda la información insertada en la BD estará cifrada.

Con una pequeña configuración podrás acceder desde cualquier lugar a tus datos.

## Instalación

Tan simple como copiarlo donde tú quieras y seguir los siguientes pasos:

- Crear una base de datos MySql o MariaDB. Tienes la estructura de la BD y algo más en ```` \database\DB.sql````.
- En el archivo config.php rellenar los datos de conexion para la Base de Datos:
 ```
 DB_HOST = 'localhost';
 DB_PORT = '3306';
 DB_DATABASE = 'NombreBD';
 DB_USERNAME = 'root';
 DB_PASSWORD = '12345';
 PASS_ENCRYPT = 'PASSWORD';
 CYPHER_ALGO = 'AES-128-ECB';
```
- La máquina a trabajar debería tener instalado [Composer](https://getcomposer.org/). Si es así actualiza las dependencias con ```` $ composer update ````.

Para que te resulte más útil, podrías añadirla a tu PATH.

### ¿Listo para comenzar? ¡Excelente!

- El entorno de datos se ha realizado de la siguiente forma:

    - **meaningQuery:**
      - query.
      - typeLang.
      - meaning. 

Es un modelo sencillo pero capaz de soportar cualquier tipo de idioma.

Debemos de tener en cuenta varias cuestiones.

## Funcionamiento
En este punto describiremos de forma sencilla las simples funciones que se han desarrollado para su uso.

### Busqueda
    /php Search.php introduce [word]
Solo el comando y una palabra y te devolverá el o los resultados del mismo.
    
### Introducir en la BD
    /php Search.php introduce [word] [context]
Tan simple como colocar la palabra clave y la información a insertar.

## Seguridad
Hay que tener en cuenta una cosa importante la **Inyección SQL**, el cual podría llegar a ser un problema.

## Codigo de Conducta

Se ha intentado crear un producto acorde a principios de aplicación [12factor](https://12factor.net).


## Licencia

El marco de Laravel es un software de código abierto con licencia bajo la [MIT license](https://opensource.org/licenses/MIT).
