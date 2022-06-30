<?php
/*
* 
*/
class AppController
{
    protected $folder;

    public function render($file, array $data = array())
    {
        $view_file = 'views/' . $this->folder . '/' . $file . '.php';

        if (file_exists($view_file)) {
            extract($data);

            ob_start();
            require_once($view_file);
            $content = ob_get_clean();
            require_once('views/application.php');
        } else {
            header('Location: index.php?controller=pages&action=error');
        }
    }
}
