# Ecomexperts Challenge

Modulo para consultar los productos en la tienda https://wp-challenge.ecomexperts.com/
Creado en CakePhp 3.x Documentación https://book.cakephp.org/3/en/index.html
Esta aplicacion permite listar los productos consultados a la Woo Rest API, persistirlos en una base de datos mysql.

##Instalacion

1. Descargar [Composer](https://getcomposer.org/doc/00-intro.md) o actualizar `composer self-update`.
2. Clonar repositorio en directorio local.
3.  Ejecutar en consola en el directorio clonado el comando `composer install`
4. Crear base de datos local Mysql, crear un usuario de base de datso con todos los privilegios
5. Ingregar al directorio del proyecto config/ y si no existe crear un archivo app_local.php y settear los valores de conexion a la base de datos creada previamente.

## Lanzar aplicacion

Ingresar al directorio raiz del proyecto y ejecutar bin/cake server -p 8765 desde consola.

```bash
bin/cake server -p 8765
```
Esto permitirá montar un servidor local para iniciar el proyecto en localhost.
