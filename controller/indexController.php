<?php

Class indexController Extends baseController {
    public function index() {
            $this->registry->template->welcome = 'Bienvenue';
            $this->registry->template->show('index');
    }
}