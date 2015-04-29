<?php

Class blogController Extends baseController {

    public function index() {
        $this->registry->template->show('blog');
    }

    public function page($args) {
        var_dump($args);
        exit;
        $this->registry->template->welcome="dfdsf";
        $this->registry->template->show('index');
    }

    public function add() {
        $this->registry->template->welcome="page add";
        $this->registry->template->show('add');
    }
}