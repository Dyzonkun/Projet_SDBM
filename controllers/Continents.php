<?php
class Continents extends Controller{
    public function index()
    {
        $this->loadModel('Continent');
        $continents = $this->Continent->getAll();
        
        $scriptJS="
        const modalAjout = document.getElementById('modal-ajout');
        const modalModif = document.getElementById('modal-modif');
        const modalDelete = document.getElementById('modal-delete');
        const openModalAjoutBtn = document.querySelector('.modal-open');
        const closeModalAjoutBtn = modalAjout.querySelector('.modal-close');
        const openModalModifBtns = document.querySelectorAll('.modal-modif-open');
        const closeModalModifBtn = modalModif.querySelector('.modal-close');
        const openModalDeleteBtns = document.querySelectorAll('.modal-delete-open');
        const closeModalDeleteBtn = modalDelete.querySelector('.modal-close');
        const modalDeleteCancelBtn = modalDelete.querySelector('.modal-delete-cancel');
        const newContinentNameInput = modalModif.querySelector('#new-continent-name'); 
        
        openModalAjoutBtn.addEventListener('click', () => {
            modalAjout.classList.remove('hidden');
        });
        
        closeModalAjoutBtn.addEventListener('click', () => {
            modalAjout.classList.add('hidden');
        });
        
        openModalModifBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                const nomContinent = btn.parentElement.previousElementSibling.textContent;
                const continentId = btn.dataset.continentId;
                const newContinentNameInput = document.getElementById('new-continent-name');
                const modifContinentIdInput = document.getElementById('modif-continent-id');
        
                newContinentNameInput.value = nomContinent;
                modifContinentIdInput.value = continentId;
                
                modalModif.classList.remove('hidden');

            });
        });
        
        closeModalModifBtn.addEventListener('click', () => {
            modalModif.classList.add('hidden');
        });
        
        openModalDeleteBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                const continentId = btn.dataset.continentId; 
                const supprContinentIdInput = document.getElementById('suppr-continent-id');
        
                supprContinentIdInput.value = continentId;
        
                modalDelete.classList.remove('hidden');
            });
        });
        
        closeModalDeleteBtn.addEventListener('click', () => {
            modalDelete.classList.add('hidden');
        });
        
        modalDeleteCancelBtn.addEventListener('click', () => { 
            modalDelete.classList.add('hidden'); 
        });";

        $this->render('index', compact('scriptJS', 'continents'));
    }
    
    public function ajouterContinent(){

        if (isset($_POST['Nom_Ajout'])) {
                $this->loadModel('Continent');
                $this->Continent->inserer($_POST['Nom_Ajout']);
        }
        $newUrl = PATH.'/continents';    
        header("Location: $newUrl");
    
    }

    public function modifierContinent() {

        if (isset($_POST['Code_Modif']) && isset($_POST['Nom_Modif'])) {
            $this->loadModel('Continent');
            $ind = $_POST['Code_Modif'];
            $nom = $_POST['Nom_Modif'];
            $this->Continent->modifier($ind, $nom);
            $newUrl = PATH . '/continents';
            header("Location: $newUrl");
        }
    }

    public function supprimerContinent() {
        if (isset($_POST['Code_Suppr'])) {
            $this->loadModel('Continent');
            $id = $_POST['Code_Suppr'];
            $this->Continent->supprimer($id);
            $newUrl = PATH . '/continents';
            header("Location: $newUrl");
        }
    }
}