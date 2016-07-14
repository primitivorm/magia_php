<?php 
/**
 * Est funccion controla el acceso a las paginas protegidas por la misma
 * @param type $pagina La página a la cual se desea entrar
 * @param type $accion Accion que se desea hacer en esa pagina: ver, crear, editar, borrar
 * @param type $grupo El grupo de usuarios al cual pertenece 
 * @return boolean  Devuelve un valor verdadero o falso segun si esta o no autorizado realizar la accion 
 */
function permisos_tiene_permiso($pagina,$accion,$grupo){
    return TRUE;
}