<?php
class Continents extends Controller{
    public function index()
    {
        $this->loadModel('Continent');
        $continents = $this->Continent->getAll();
        $this->render('index', compact('continents'));

    }
}
