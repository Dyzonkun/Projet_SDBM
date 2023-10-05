<?php
abstract class Controller{
    public function loadModel(string $model){
        require_once(ROOT.'models/'.$model.'.php');
        $this->$model = new $model();
    }

    public function render(string $fichier, array $data = []){
        extract($data);

        // Démarre le buffer de sortie
        ob_start();

        require_once(ROOT. 'views/'.strtolower(get_class($this)).'/'.$fichier.'.php');
        //contenu stocker dans $content
        $content = ob_get_clean();

        // template :
        require_once(ROOT. 'views/layout/default.php');
    }
}