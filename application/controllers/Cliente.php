<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("modelo");
    }

    public function error_404() {
        redirect("cliente/index", 'refresh');
    }

    public function index() {
        $this->load->view('paginas_landing/header_principal');
        $this->load->view('paginas_landing/iniciar_sesion');
        $this->load->view('paginas_landing/footer_principal');
    }

    public function controlador_iniciar_sesion() {
        $rut_usuario = $this->input->post('rut_usuario');
        $clave_usuario = $this->input->post('clave_usuario');

        $usuario = $this->modelo->modelo_iniciar_sesion($rut_usuario, md5($clave_usuario));

        if (count($usuario) > 0) {
            if ($usuario[0]->id_perfil != 3) {
                $this->session->set_userdata("administrador", $usuario);
                echo json_encode(array("mensaje" => "cliente/administrador"));
            } else {
                echo json_encode(array("mensaje" => "1"));
            }
        } else {
            echo json_encode(array("mensaje" => "0"));
        }
    }

    // FUNCIONES PANEL

    public function cerrar_sesion() {
        $this->session->sess_destroy();
        redirect("cliente/index", 'refresh');
    }

    public function administrador() {
        if ($this->session->userdata("administrador")) {
            $this->load->view('paginas_administrador/header_administrador');
            $this->load->view('paginas_administrador/panel_administrador');
            $this->load->view('paginas_administrador/footer_administrador');
        } else {
            redirect("cliente/index", 'refresh');
        }
    }

    public function club() {
        if ($this->session->userdata("administrador")) {
            $this->load->view('paginas_administrador/header_administrador');
            $this->load->view('paginas_administrador/nav_administrador');
            $this->load->view('paginas_administrador/panel_club');
            $this->load->view('paginas_administrador/footer_administrador');
        } else {
            redirect("cliente/index", 'refresh');
        }
    }
    
    //--------------------------------------------------------------------------
  
    public function creacion_usuario() {
        if ($this->session->userdata("administrador")) {
            $this->load->view('paginas_administrador/header_administrador');
            $this->load->view('paginas_administrador/nav_administrador');
            $this->load->view('paginas_administrador/creacion_usuario');
            $this->load->view('paginas_administrador/footer_administrador');
        } else {
            redirect("cliente/index", 'refresh');
        }
    }

    public function administra_usuario() {
        if ($this->session->userdata("administrador")) {
            $this->load->view('paginas_administrador/header_administrador');
            $this->load->view('paginas_administrador/nav_administrador');
            $this->load->view('paginas_administrador/panel_usuario');
            $this->load->view('paginas_administrador/footer_administrador');
        } else {
            redirect("cliente/index", 'refresh');
        }
    }

    public function controlador_crear_usuario() {
        $rut_usuario = $this->input->post("rut_usuario");
        $clave_usuario = "20api20";
        $nombre_usuario = $this->input->post("nombre_usuario");
        $apellido_usuario = $this->input->post("apellido_usuario");
        $telefono_usuario = $this->input->post("telefono_usuario");
        $correo_usuario = $this->input->post("correo_usuario");
        $correo_usuario_min = strtolower($correo_usuario);
        $id_perfil = $this->input->post("estado_usuario");

        if ($this->modelo->modelo_crear_usuario($rut_usuario, $clave_usuario, $nombre_usuario, $apellido_usuario, $telefono_usuario, $correo_usuario, $id_perfil)) {

            $this->load->library('phpmailer_lib');
            $mail = $this->phpmailer_lib->load();

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'mmontoya@sofgem.cl';
            $mail->Password = '';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('mmontoya@sofgem.cl', 'API SofGem');
            $mail->addAddress('mmontoya@sofgem.cl');
            $mail->addCC('' . $correo_usuario_min . '');

            $mail->Subject = 'API SofGem - Bienvenido';
            $mail->isHTML(false);

            $mailContent = 'Bienvenido(a) ' . $nombre_usuario . " " . $apellido_usuario . ' al acceso de API de SofGem ' . "\n \n" . 'Credenciales de acceso: ' . "\n \n" . 'RUT: ' . $rut_usuario . "\n \n" . 'Clave: ' . $clave_usuario . "\n \n" . 'SofGem | Software de Gestion Empresarial';
            $mail->Body = $mailContent;

            if ($mail->send()) {
                echo json_encode(array("mensaje" => "Usuario creado. Correo enviado"));
            } else {
                echo json_encode(array("mensaje" => "Usuario creado. Correo no enviado"));
            }
        } else {
            echo json_encode(array("mensaje" => "Usuario existente"));
        }
    }

    public function controlador_tabla_usuario() {
        if ($this->session->userdata("administrador")) {
            $draw = intval($this->input->get("draw"));
            $rut_usuario = $this->input->post("rut_usuario");
            $listado_usuario = $this->modelo->modelo_tabla_usuario($rut_usuario);
            $data = array();

            foreach ($listado_usuario->result() as $lista) {

                $data[] = array(
                    $lista->id_usuario,
                    $lista->rut_usuario,
                    $lista->nombre_completo_usuario,
                    $lista->telefono_usuario,
                    $lista->correo_usuario,
                    $lista->nombre_perfil,
                );
            }
            $output = array(
                "draw" => $draw,
                "recordsTotal" => $listado_usuario->num_rows(),
                "recordsFiltered" => $listado_usuario->num_rows(),
                "data" => $data
            );
            echo json_encode($output);
            exit();
        } else {
            redirect("cliente/index", 'refresh');
        }
    }

    public function controlador_id_panel_usuario() {
        if ($this->session->userdata("administrador")) {
            $id_usuario = $this->input->post("id_usuario");
            echo json_encode($this->modelo->modelo_id_panel_usuario($id_usuario));
        } else {
            redirect("cliente/index", 'refresh');
        }
    }

    public function controlador_editar_usuario() {

        $id_usuario = $this->input->post("id_usuario");
        $telefono_usuario = $this->input->post("telefono_usuario");
        $correo_usuario = $this->input->post("correo_usuario");
        $id_perfil = $this->input->post("estado_usuario");

        if ($this->modelo->modelo_editar_usuario($id_usuario, $telefono_usuario, $correo_usuario, $id_perfil)) {
            echo json_encode(array("mensaje" => "Actualizacion de usuario exitoso"));
        } else {
            echo json_encode(array("mensaje" => "Error al actualizar usuario"));
        }
    }

    public function cambiar_clave() {
        if ($this->session->userdata("administrador")) {
            $this->load->view('paginas_administrador/header_administrador');
            $this->load->view('paginas_administrador/nav_administrador');
            $this->load->view('paginas_administrador/cambiar_clave');
            $this->load->view('paginas_administrador/footer_administrador');
        } else {
            redirect("cliente/index", 'refresh');
        }
    }

    public function controlador_cambiar_clave() {
        $id_usuario = $this->input->post("id_usuario");
        $clave_nueva = $this->input->post("clave_nueva");

        $rut_usuario = $this->input->post("rut_usuario");
        $correo_usuario = $this->input->post("correo_usuario");

        if ($this->modelo->modelo_cambiar_clave($id_usuario, $clave_nueva)) {

            $this->load->library('phpmailer_lib');
            $mail = $this->phpmailer_lib->load();

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'mmontoya@sofgem.cl';
            $mail->Password = '';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('mmontoya@sofgem.cl', 'Asistencia SofGem');
            $mail->addAddress('mmontoya@sofgem.cl');
            $mail->addCC('' . $correo_usuario . '');

            $mail->Subject = 'API SofGem - Cambio de Clave';
            $mail->isHTML(false);

            $mailContent = 'Cambio de clave manual desde el panel de asistencias de SofGem.' . "\n \n" . 'Credenciales de acceso: ' . "\n \n" . 'RUT: ' . $rut_usuario . "\n \n" . 'Clave nueva (opción de cambiar): ' . $clave_nueva . "\n \n" . 'SofGem | Software de Gestion Empresarial';
            $mail->Body = $mailContent;

            $this->session->sess_destroy();

            if ($mail->send()) {
                echo json_encode(array("mensaje" => "Cambio de clave. Volverás a iniciar sesión"));
            } else {
                echo json_encode(array("mensaje" => "Cambio de clave. Correo de respaldo no enviado"));
            }
        } else {
            echo json_encode(array("mensaje" => "Error al cambiar clave"));
        }
    }

    public function cambiar_datos() {
        if ($this->session->userdata("administrador")) {
            $this->load->view('paginas_administrador/header_administrador');
            $this->load->view('paginas_administrador/nav_administrador');
            $this->load->view('paginas_administrador/cambiar_datos');
            $this->load->view('paginas_administrador/footer_administrador');
        } else {
            redirect("cliente/index", 'refresh');
        }
    }

    public function controlador_cambiar_datos_usuario() {

        $id_usuario = $this->input->post("id_usuario");
        $telefono_usuario = $this->input->post("telefono_usuario");
        $correo_usuario = $this->input->post("correo_usuario");

        if ($this->modelo->modelo_cambiar_datos_usuario($id_usuario, $telefono_usuario, $correo_usuario)) {
            echo json_encode(array("mensaje" => "Cambio de datos exitoso."));
        } else {
            echo json_encode(array("mensaje" => "Error al cambiar datos"));
        }
    }

    //--------------------------------------------------------------------------

    public function recuperar() {
        $this->load->view('paginas_landing/header_principal');
        $this->load->view('paginas_landing/recuperar');
        $this->load->view('paginas_landing/footer_principal');
    }

    public function controlador_recuperar_usuario() {
        $rut_usuario = $this->input->post("rut_usuario");
        $correo_usuario = $this->input->post("correo_usuario");
        $correo_usuario_min = strtolower($correo_usuario);

        $respuesta_usuario = $this->modelo->modelo_recuperar_usuario($rut_usuario, $correo_usuario_min);

        if (count($respuesta_usuario) > 0) {
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            $clave_nueva = substr(str_shuffle($permitted_chars), 4, 4);

            if ($this->modelo->modelo_recuperar_clave_usuario($rut_usuario, $clave_nueva)) {

                $this->load->library('phpmailer_lib');
                $mail = $this->phpmailer_lib->load();

                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'mmontoya@sofgem.cl';
                $mail->Password = '';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                $mail->setFrom('mmontoya@sofgem.cl', 'API SofGem');
                $mail->addAddress('mmontoya@sofgem.cl');
                $mail->addCC('' . $correo_usuario_min . '');

                $mail->Subject = 'API SofGem - Recuperar Clave';
                $mail->isHTML(false);

                $mailContent = 'Recuperacion de cuenta de API de SofGem.' . "\n \n" . 'Credenciales de acceso: ' . "\n \n" . 'RUT: ' . $rut_usuario . "\n \n" . 'Clave nueva (opcion de cambiar): ' . $clave_nueva . "\n \n" . 'SofGem | Software de Gestion Empresarial';
                $mail->Body = $mailContent;

                if ($mail->send()) {
                    echo json_encode(array("mensaje" => "Clave cambiada. Correo enviado"));
                } else {
                    echo json_encode(array("mensaje" => "Clave cambiada. Correo de respaldo no enviado"));
                }
            } else {
                echo json_encode(array("mensaje" => "Error al cambiar clave"));
            }
        } else {
            echo json_encode(array("mensaje" => "Datos incorrectos u inexistentes"));
        }
    }
}
