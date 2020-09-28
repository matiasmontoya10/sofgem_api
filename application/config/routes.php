<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'cliente';
$route['404_override'] = 'cliente/error_404';
$route['translate_uri_dashes'] = FALSE;

//Api Inicio

$route['contactos_tributario'] = 'api/api_contactos_tributario';
$route['contacto_tributario'] = 'api/api_contacto_tributario';

//Api Termino

$route['boton_contacto'] = 'cliente/controlador_boton_contacto';
$route['contenido_blog'] = 'cliente/controlador_contenido_blog';
$route['boton_iniciar_sesion'] = 'cliente/controlador_iniciar_sesion';
$route['tabla_contacto'] = 'cliente/controlador_tabla_contacto';
$route['crear_blog'] = 'cliente/controlador_crear_blog';
$route['tabla_blog'] = 'cliente/controlador_tabla_blog';
$route['id_blog_tabla'] = 'cliente/controlador_id_blog_tabla';
$route['eliminar_blog'] = 'cliente/controlador_eliminar_blog';
$route['editar_blog_imagen'] = 'cliente/controlador_editar_blog_imagen';
$route['editar_blog'] = 'cliente/controlador_editar_blog';
$route['crear_usuario'] = 'cliente/controlador_crear_usuario';
$route['tabla_usuario'] = 'cliente/controlador_tabla_usuario';
$route['id_panel_usuario'] = 'cliente/controlador_id_panel_usuario';
$route['editar_usuario'] = 'cliente/controlador_editar_usuario';
$route['cambiar_clave'] = 'cliente/controlador_cambiar_clave';
$route['cambiar_datos_usuario'] = 'cliente/controlador_cambiar_datos_usuario';

$route['recuperar_usuario'] = 'cliente/controlador_recuperar_usuario';
$route['eliminar_contacto'] = 'cliente/controlador_eliminar_contacto';

$route['select_perfil_blog'] = 'cliente/controlador_select_perfil_blog';
$route['crear_contacto'] = 'cliente/controlador_crear_contacto';
$route['tabla_form_contacto'] = 'cliente/controlador_tabla_form_contacto';
$route['id_form_contacto_tabla'] = 'cliente/controlador_id_form_contacto_tabla';
$route['id_form_contacto'] = 'cliente/controlador_id_form_contacto';

$route['blog_imagen'] = 'cliente/controlador_blog_imagen';