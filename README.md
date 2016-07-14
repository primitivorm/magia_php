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

Vamos a suponer que tienes una base de datos ya instalada en mysql sino no has hecho aun entra a tu phpmyadmin y crea la tabla y carga su extructura
para nuestro ejemplo suponemos que tienes una base da datos de un blog con las sigueintes tablas:
 
```
articulos
escritores
```

## Configura la base de datos

```admin/bd.php``` 

Pon tus datos 

```
<?php  
$servidor = "localhost"; 
$bdatos = "blog"; 
$usuario = "root"; 
$clave = "miclave";
?>
```

## Define la ruta de tu web

Entra en: <a href="http://localhost/magia_php">http://localhost/magia_php</a>

Define rutas de tu web clic en "Define rutas" algo parecido a esto: 

```
/home/pepito/public_html/blog
```

> debes poner la ruta exacta


En windows puede ser algo asi 


```
c:\xampp\www\pepito
```

##Copia la base de datos 

ahora copia en tu base de datos la extructura que magia php necesita para ello click en 

"Copiar base.sql (grupos, idiomas, paginas, permisos, usuarios)"

Tu base de datos quedara asi:


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


##Crea el proyecto

Ahora  click en "Crear proyecto"


Y nos dara un resultado parecido a esto:

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

## Crear plugin

Debes crear plugin por cada una de las tablas

 ## Gestión

Trabajo termijado, entra en 
<a href="http://localhost/lenguaje_basica/gestion/">http://localhost/lenguaje_basica/gestion/</a>

Nos pedira un login y clave, puedes usar: 
```
login: root
clave: root
```

Disfrurta 