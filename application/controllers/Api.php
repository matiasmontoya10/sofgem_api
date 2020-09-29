<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

require APPPATH . '/libraries/RestController.php';
require APPPATH . '/libraries/Format.php';

class Api extends RestController {

    function __construct() {
        parent::__construct();
        $this->load->model("modelo");
    }

    public function api_contactos_tributario_get() {
        $contactos = $this->modelo->modelo_contactos_tributario();
        $this->response($contactos);
    }

    public function api_contacto_tributario_get() {
        if (!$this->get('id')) {
            $this->response(NULL, 400);
        }

        $contacto = $this->modelo->modelo_contacto_tributario($this->get('id'));

        if ($contacto) {
            $this->response($contacto, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
    
    //http://user:pass@localhost/sofgem_api/api/function/
}
