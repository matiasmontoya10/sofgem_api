<?php

class Modelo extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db->query("SET lc_time_names = 'es_CL'");
    }

    // Api Model

    public function modelo_contactos_tributario() {
        $this->db->select("*");
        $this->db->from("contacto_tributario");
        $this->db->order_by("id_contacto", "desc");
        return $this->db->get()->result();
    }

    public function modelo_contacto_tributario($id_contacto) {
        $this->db->select("*");
        $this->db->from("contacto_tributario");
        $this->db->where("id_contacto", $id_contacto);
        return $this->db->get()->result();
    }

    // Fin Api Model

    public function modelo_boton_contacto($nombre_contacto, $telefono_contacto, $fecha_contacto) {
        $data = array("nombre_contacto" => $nombre_contacto,
            "telefono_contacto" => $telefono_contacto,
            "fecha_contacto" => $fecha_contacto
        );
        return $this->db->insert("contacto", $data);
    }

    public function modelo_listado_blog() {
        $this->db->select("id_blog, titulo_blog, autor_blog, sub_titulo_blog, date_format(fecha_blog,'%d/%m/%Y') as fecha_blog, imagen_principal_blog, estado_blog, id_perfil_blog");
        $this->db->from("blog");
        $this->db->order_by("fecha_blog", "asc");
        return $this->db->get()->result();
    }

    public function modelo_buscar_blog($id_blog) {
        $this->db->select("id_blog, titulo_blog, autor_blog, sub_titulo_blog, date_format(fecha_blog,'%d/%m/%Y') as fecha_blog, contenido_blog, imagen_principal_blog, imagen_secundaria_blog, imagen_terciaria_blog");
        $this->db->from("blog");
        $this->db->where("blog.id_blog", $id_blog);
        return $this->db->get()->result();
    }

    public function modelo_iniciar_sesion($rut_usuario, $clave_usuario) {
        $this->db->where("rut_usuario", $rut_usuario);
        $this->db->where("clave_usuario", $clave_usuario);
        return $this->db->get("usuario")->result();
    }

    public function modelo_tabla_contacto() {
        $this->db->select("id_contacto, nombre_contacto, telefono_contacto, date_format(fecha_contacto,'%d/%m/%Y') as fecha_contacto");
        $this->db->from("contacto");
        $this->db->order_by("fecha_contacto", "desc");
        return $this->db->get();
    }

    public function modelo_crear_blog_test_v1($titulo_blog, $autor_blog, $fecha_blog, $sub_titulo_blog, $contenido_blog, $imagen_principal_blog, $id_usuario) {
        $data = array("titulo_blog" => $titulo_blog,
            "autor_blog" => $autor_blog,
            "fecha_blog" => $fecha_blog,
            "sub_titulo_blog" => $sub_titulo_blog,
            "contenido_blog" => $contenido_blog,
            "imagen_principal_blog" => $imagen_principal_blog,
            "imagen_secundaria_blog" => null,
            "id_usuario" => $id_usuario,
        );
        return $this->db->insert("blog", $data);
    }

    public function modelo_tabla_blog() {
        $this->db->select("id_blog, titulo_blog, autor_blog, date_format(fecha_blog,'%d/%m/%Y') as fecha_blog, sub_titulo_blog, estado_blog, perfil_blog.nombre_perfil_blog");
        $this->db->from("blog");
        $this->db->join("perfil_blog", "blog.id_perfil_blog = perfil_blog.id_perfil_blog");
        $this->db->order_by("fecha_blog", "desc");
        return $this->db->get();
    }

    public function modelo_id_blog_tabla($id_blog) {
        $this->db->select("blog.id_blog, blog.titulo_blog, blog.autor_blog, blog.fecha_blog, blog.sub_titulo_blog, blog.contenido_blog, usuario.id_usuario");
        $this->db->from("blog");
        $this->db->join("usuario", "usuario.id_usuario = blog.id_usuario");
        $this->db->where("blog.id_blog =", $id_blog);
        return $this->db->get()->result();
    }

    public function modelo_eliminar_blog($id_blog) {
        $this->db->where("id_blog", $id_blog);
        return $this->db->delete("blog");
    }

    public function modelo_editar_blog_imagen($imagen_principal_blog, $imagen_secundaria_blog, $imagen_tercearia_blog, $id_blog) {
        $this->db->where("id_blog", $id_blog);
        $data = array("imagen_principal_blog" => $imagen_principal_blog,
            "imagen_secundaria_blog" => $imagen_secundaria_blog,
            "imagen_terciaria_blog" => $imagen_tercearia_blog);
        return $this->db->update("blog", $data);
    }

    public function modelo_editar_blog($titulo_blog, $autor_blog, $fecha_blog, $sub_titulo_blog, $contenido_blog, $id_blog, $estado_blog, $id_perfil_blog) {
        $this->db->where("id_blog", $id_blog);
        $data = array("titulo_blog" => $titulo_blog,
            "autor_blog" => $autor_blog,
            "fecha_blog" => $fecha_blog,
            "sub_titulo_blog" => $sub_titulo_blog,
            "contenido_blog" => $contenido_blog,
            "estado_blog" => $estado_blog,
            "id_perfil_blog" => $id_perfil_blog);
        return $this->db->update("blog", $data);
    }

    public function modelo_buscar_rut_usuario_correo($rut_usuario, $correo_usuario) {
        $this->db->where("rut_usuario", $rut_usuario);
        $this->db->or_where("correo_usuario", $correo_usuario);
        return count($this->db->get("usuario")->result());
    }

    public function modelo_crear_usuario($rut_usuario, $clave_usuario, $nombre_usuario, $apellido_usuario, $telefono_usuario, $correo_usuario, $id_perfil) {
        if ($this->modelo_buscar_rut_usuario_correo($rut_usuario, $correo_usuario) == 0) {
            $data = array("rut_usuario" => $rut_usuario,
                "clave_usuario" => md5($clave_usuario),
                "nombre_usuario" => $nombre_usuario,
                "apellido_usuario" => $apellido_usuario,
                "telefono_usuario" => $telefono_usuario,
                "correo_usuario" => $correo_usuario,
                "id_perfil" => $id_perfil);
            return $this->db->insert("usuario", $data);
        } else {
            return 0;
        }
    }

    public function modelo_tabla_usuario($rut_usuario) {
        $this->db->select("usuario.id_usuario, usuario.rut_usuario, concat(usuario.nombre_usuario,' ',usuario.apellido_usuario) as nombre_completo_usuario, usuario.telefono_usuario, usuario.correo_usuario, perfil.nombre_perfil");
        $this->db->from("usuario");
        $this->db->join("perfil", "perfil.id_perfil = usuario.id_perfil");
        $this->db->where("usuario.rut_usuario !=", $rut_usuario);
        return $this->db->get();
    }

    public function modelo_id_panel_usuario($id_usuario) {
        $this->db->select("usuario.id_usuario, usuario.rut_usuario, concat(usuario.nombre_usuario,' ',usuario.apellido_usuario) as nombre_completo_usuario, usuario.telefono_usuario, usuario.correo_usuario, perfil.nombre_perfil");
        $this->db->from("usuario");
        $this->db->join("perfil", "usuario.id_perfil = perfil.id_perfil");
        $this->db->where("usuario.id_usuario =", $id_usuario);
        return $this->db->get()->result();
    }

    public function modelo_editar_usuario($id_usuario, $telefono_usuario, $correo_usuario, $estado_usuario) {
        $this->db->where("id_usuario", $id_usuario);
        $data = array("telefono_usuario" => $telefono_usuario,
            "correo_usuario" => $correo_usuario,
            "id_perfil" => $estado_usuario);
        return $this->db->update("usuario", $data);
    }

    public function modelo_cambiar_clave($id_usuario, $clave_nueva) {
        $this->db->where("id_usuario", $id_usuario);
        $data = array("clave_usuario" => md5($clave_nueva));
        return $this->db->update("usuario", $data);
    }

    public function modelo_cambiar_datos_usuario($id_usuario, $telefono_usuario, $correo_usuario) {
        $this->db->where("id_usuario", $id_usuario);
        $data = array("telefono_usuario" => $telefono_usuario,
            "correo_usuario" => $correo_usuario);
        return $this->db->update("usuario", $data);
    }

    public function modelo_crear_blog($titulo_blog, $autor_blog, $fecha_blog, $sub_titulo_blog, $contenido_blog, $id_usuario, $imagen_principal_blog, $id_perfil_blog) {
        $data = array("titulo_blog" => $titulo_blog,
            "autor_blog" => $autor_blog,
            "fecha_blog" => $fecha_blog,
            "sub_titulo_blog" => $sub_titulo_blog,
            "contenido_blog" => $contenido_blog,
            "imagen_principal_blog" => $imagen_principal_blog,
            "imagen_secundaria_blog" => null,
            "estado_blog" => 1,
            "id_usuario" => $id_usuario,
            "id_perfil_blog" => $id_perfil_blog,
        );
        return $this->db->insert("blog", $data);
    }

    // VERSION RECUPERAR CLAVE


    public function modelo_recuperar_usuario($rut_usuario, $correo_usuario) {
        $this->db->where("rut_usuario", $rut_usuario);
        $this->db->where("correo_usuario", $correo_usuario);
        return $this->db->get("usuario")->result();
    }

    public function modelo_recuperar_clave_usuario($rut_usuario, $clave_nueva) {
        $this->db->where("rut_usuario", $rut_usuario);
        $data = array("clave_usuario" => md5($clave_nueva));
        return $this->db->update("usuario", $data);
    }

    public function modelo_eliminar_contacto($id_contacto) {
        $this->db->where("id_contacto", $id_contacto);
        return $this->db->delete("contacto");
    }

    // SELECT PERFIL BLOG

    public function modelo_select_perfil_blog() {
        $this->db->select("*");
        $this->db->from("perfil_blog");
        return $this->db->get()->result();
    }

    public function modelo_crear_contacto($nombre_contacto, $asunto_contacto, $correo_contacto, $telefono_contacto, $contenido_contacto) {
        $data = array("nombre_form_contacto" => $nombre_contacto,
            "asunto_form_contacto" => $asunto_contacto,
            "correo_form_contacto" => $correo_contacto,
            "telefono_form_contacto" => $telefono_contacto,
            "contenido_form_contacto" => $contenido_contacto
        );
        return $this->db->insert("form_contacto", $data);
    }

    public function modelo_tabla_form_contacto() {
        $this->db->select("*");
        $this->db->from("form_contacto");
        return $this->db->get();
    }

    public function modelo_id_form_contacto($id_form_contacto) {
        $this->db->select("*");
        $this->db->from("form_contacto");
        $this->db->where("form_contacto.id_form_contacto =", $id_form_contacto);
        return $this->db->get()->result();
    }

    public function modelo_blog_imagen($id_blog) {
        $this->db->select("imagen_principal_blog, imagen_secundaria_blog, imagen_terciaria_blog");
        $this->db->from("blog");
        $this->db->where("blog.id_blog =", $id_blog);
        return $this->db->get()->result();
    }

}
