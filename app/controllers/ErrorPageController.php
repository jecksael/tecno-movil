<?php
class ErrorPageController extends BaseController
{
    public $path_inicio;

    public function __construct()
    {
        $this->path_inicio = '';
    }

    public function index()
    {
        $this->render('error');
    }
}

?>
