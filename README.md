# Magia PHP

[![Join the chat at https://gitter.im/robincoello/Magia_php](https://badges.gitter.im/robincoello/Magia_php.svg)](https://gitter.im/robincoello/Magia_php?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

* Sistema para ayudar en la creación de formularios 

Si temenos una base de datos, y queremos crear un sistema (sitios web) para gestionar 
esta base de datos, osea: Ver, Crear, Editar y Borrar información de esta, magia_php
nos da una forma facil de hacerlo


### instalación
Vamos a la raíz del servidor
`
cd ~/public_html
`

Alli has una copia del magia_php


```
sudo git clone https://github.com/robincoello/magia_php.git
```

Entra en la carpeta

````
cd magia_php
```

Y verifica que has cargado bien los archivos.


## Configuración y uso

Vamos a suponer que tienes una base de datos de un blog con las siguientes tablas: 
```
articulos
escritores
```

La primer cosa que debes hacer es configurar el fichero ```admin/bd.php``` esta es la base de datos la de la cual magia php va a cojer su extructur para crear el sitio web.

```
<?php  
$servidor = "localhost"; 
$bdatos = "blog"; 
$usuario = "root"; 
$clave = "miclave";
?>
```


Después de esto debes entras en <a href="http://localhost/magia_php">http://localhost/magia_php</a>

Ahora estamos listos para empezar: 

Ahora debemos decirle a magia php donde debe crear el sitio web para ello editamos definimos la ruta de los plugins 

'Define rutas de los plugins'

entra en 

```
http://localhost/magia_php/index.php?p=config
```

y pon la ruta de tu sitio web: algo parecido a esto: 

```
/home/pepito/public_html/blog
```

> debes poner la ruta exacta


En windows puede ser algo asi 


```
c:\xampp\www\pepito
```


ahora debemos copiar en la base de datos la extructura necesaria para que nuestro sitio web funcione, esta extructura es adicional a las tablas que ya tienes en tu base de datos
Las tablas adicionales que magia php pondra en tu base de datos son: 
```
_contenido
_grupos
_idiomas
_menu
_paginas
_permisos
_traducciones
_usuarios

```

Estas 8 tablas seran necesarias para que tu web funcione, de forma que tu base de datos quedaria asi 

```
articulos
escritores
_contenido
_grupos
_idiomas
_menu
_paginas
_permisos
_traducciones
_usuarios
```

Ahora entramos nuevamente en 

```
http://localhost/magia_php/index.php
```

y creamos toda la extructura de nuestro sitio web haciendo click en "Crear proyecto"

No debe dar un resultado parecido a esto

```
Vamos a crear los ficheros del proyecto
El path_plugins: /home/pepito/public_html/blog/gestion
: /home/pepito/public_html/blog/admin, creada con exito
: /home/pepito/public_html/blog/gestion, creada con exito
: /home/pepito/public_html/blog/imagenes, creada con exito
: /home/pepito/public_html/blog/includes, creada con exito
: /home/pepito/public_html/blog/extenciones, creada con exito
Copiar ./codigo_fuente/gestion a /home/pepito/public_html/blog/gestion
Copiar ./codigo_fuente/gestion/home a /home/pepito/public_html/blog/gestion/home
Copiar ./codigo_fuente/gestion/home/vista a /home/pepito/public_html/blog/gestion/home/vista
Copiar ./codigo_fuente/gestion/home/modelo a /home/pepito/public_html/blog/gestion/home/modelo
Copiar ./codigo_fuente/gestion/home/controlador a /home/pepito/public_html/blog/gestion/home/controlador
Copiar ./codigo_fuente/gestion/home/request a /home/pepito/public_html/blog/gestion/home/request
Copiar ./codigo_fuente/gestion/home/reg a /home/pepito/public_html/blog/gestion/home/reg
Copiar ./codigo_fuente/includes a /home/pepito/public_html/blog/includes
Copiar ./codigo_fuente/includes/font-awesome a /home/pepito/public_html/blog/includes/font-awesome
Copiar ./codigo_fuente/includes/font-awesome/scss a /home/pepito/public_html/blog/includes/font-awesome/scss
Copiar ./codigo_fuente/includes/font-awesome/font a /home/pepito/public_html/blog/includes/font-awesome/font
Copiar ./codigo_fuente/includes/font-awesome/less a /home/pepito/public_html/blog/includes/font-awesome/less
Copiar ./codigo_fuente/includes/font-awesome/css a /home/pepito/public_html/blog/includes/font-awesome/css
Copiar ./codigo_fuente/includes/bootstrap a /home/pepito/public_html/blog/includes/bootstrap
Copiar ./codigo_fuente/includes/bootstrap/fonts a /home/pepito/public_html/blog/includes/bootstrap/fonts
Copiar ./codigo_fuente/includes/bootstrap/css a /home/pepito/public_html/blog/includes/bootstrap/css
Copiar ./codigo_fuente/includes/bootstrap/js a /home/pepito/public_html/blog/includes/bootstrap/js
Copiar ./codigo_fuente/includes/bootstrap/js/vendor a /home/pepito/public_html/blog/includes/bootstrap/js/vendor
Copiar ./codigo_fuente/includes/css a /home/pepito/public_html/blog/includes/css
Copiar ./codigo_fuente/extenciones/funciones a /home/pepito/public_html/blog/extenciones/funciones
--- bd.php creado con exito
--- conec.php creado con exito
--- coneccion.php creado con exito
--- configuracion.php creado con exito
--- funciones.php creado con exito
--- index.php creado con exito
--- modelo.css creado con exito
--- permisos.php creado con exito
--- traductor.php creado con exito
--- contenido.php creado con exito
--- formularios.php creado con exito
--- index.php creado con exito

```


Ahora si vemos en la raiz de nuestro blog veremos que se han creado varias carpetas y ficheros, después explicarmos como funciona, ahora mismo ya tenemos nuestro sitio web funcionando

si entramos en 

```
http://localhost/lenguaje_basica/gestion
```

nos pedira un login y clave, puedes usar: 
```
login: root
clave: root
```

En este momento tenemos creado la extructura básica, ahora debemos crear todos los ficheros necesarios para 
ver, crear editar y borrar informaciones de cada una de las tablas

Regresamos a <a href="http://localhost/magia_php/index.php">http://localhost/magia_php/index.php</a>

y hacemos click en el último paso: "Crear plugin"

alli creamos el plugin por todas las tablas.

Listo ! ahora entra en 

<a href="http://localhost/lenguaje_basica/gestion">http://localhost/lenguaje_basica/gestion</a>






