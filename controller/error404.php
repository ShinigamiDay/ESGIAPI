<?php

Class error404Controller Extends baseController {

    public function index()
    {
            $this->registry->template->blog_heading = '404 Not Found';
            $this->registry->template->show('error404');
    }

}
