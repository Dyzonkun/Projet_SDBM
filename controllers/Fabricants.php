<?php
class Fabricants extends Controller{
    public function index()
    {
        $this->loadModel('Fabricant');
        $fabricants = $this->Fabricant->getAll();
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
        const newFabricantNameInput = modalModif.querySelector('#new-fabricant-name');
        
        openModalAjoutBtn.addEventListener('click', () => {
            modalAjout.classList.remove('hidden');
        });
        
        closeModalAjoutBtn.addEventListener('click', () => {
            modalAjout.classList.add('hidden');
        });
        
        openModalModifBtns.forEach((btn) => {
            btn.addEventListener('click', () => {

                const nomFabricant = btn.parentElement.previousElementSibling.textContent;
                const fabricantId = btn.dataset.fabricantId;
                const newFabricantNameInput = document.getElementById('new-fabricant-name');
                const modifFabricantIdInput = document.getElementById('modif-fabricant-id');
        
                newFabricantNameInput.value = nomFabricant;
                modifFabricantIdInput.value = fabricantId;

                modalModif.classList.remove('hidden');
            });
        });
        
        closeModalModifBtn.addEventListener('click', () => {
            modalModif.classList.add('hidden');
        });
        
        openModalDeleteBtns.forEach((btn) => {
            btn.addEventListener('click', () => {

                const fabricantId = btn.dataset.fabricantId; // Récupérer l'ID à partir de l'attribut de données
                const supprFabricantIdInput = document.getElementById('suppr-fabricant-id');
        
                supprFabricantIdInput.value = fabricantId; // Définir la valeur de l'input avec l'ID du fabricant
        
                modalDelete.classList.remove('hidden');
            });
        });
        
        closeModalDeleteBtn.addEventListener('click', () => {
            modalDelete.classList.add('hidden');
        });
        
        modalDeleteCancelBtn.addEventListener('click', () => { 
            modalDelete.classList.add('hidden'); 
        });";
        $this->render('index', compact('scriptJS', 'fabricants'));
    }

    public function ajouterFabricant(){

        if (isset($_POST['Nom_Ajout'])) {
                $this->loadModel('Fabricant');
                $this->Fabricant->insert($_POST['Nom_Ajout']);
        }
        $newUrl = PATH.'/fabricants';
        header("Location: $newUrl");

    }

    public function modifierFabricant(){

        if (isset($_POST['Code_Modif']) && isset($_POST['Nom_Modif'])) {
                $this->loadModel('Fabricant');
                $ind = $_POST['Code_Modif'];
                $nom = $_POST['Nom_Modif'];
                $this->Fabricant->update($ind,$nom);
        }
        $newUrl = PATH.'/fabricants';
        header("Location: $newUrl");

    }

    public function supprimerFabricant(){

        if (isset($_POST['Code_Suppr'])) {
                $this->loadModel('Fabricant');
                $ind = $_POST['Code_Suppr'];
                $this->Fabricant->delete($ind);
        }
        $newUrl = PATH.'/fabricants';
        header("Location: $newUrl");

    }
}