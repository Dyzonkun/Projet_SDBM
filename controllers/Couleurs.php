<?php
class Couleurs extends Controller{
    public function index()
    {
        $this->loadModel('Couleur');
        $couleurs = $this->Couleur->getAll();
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
        const newCouleurNameInput = modalModif.querySelector('#new-couleur-name'); 
        
        openModalAjoutBtn.addEventListener('click', () => {
            modalAjout.classList.remove('hidden');
        });
        
        closeModalAjoutBtn.addEventListener('click', () => {
            modalAjout.classList.add('hidden');
        });
        
        openModalModifBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                const nomCouleur = btn.parentElement.previousElementSibling.textContent;
                const couleurId = btn.dataset.couleurId;
                const newCouleurNameInput = document.getElementById('new-couleur-name');
                const modifCouleurIdInput = document.getElementById('modif-couleur-id');
        
                newCouleurNameInput.value = nomCouleur;
                modifCouleurIdInput.value = couleurId;
                
                modalModif.classList.remove('hidden');

            });
        });
        
        closeModalModifBtn.addEventListener('click', () => {
            modalModif.classList.add('hidden');
        });
        
        openModalDeleteBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                const couleurId = btn.dataset.couleurId; // Récupérer l'ID à partir de l'attribut de données
                const supprCouleurIdInput = document.getElementById('suppr-couleur-id');
        
                supprCouleurIdInput.value = couleurId; // Définir la valeur de l'input avec l'ID du couleur
        
                modalDelete.classList.remove('hidden');
            });
        });
        
        closeModalDeleteBtn.addEventListener('click', () => {
            modalDelete.classList.add('hidden');
        });
        
        modalDeleteCancelBtn.addEventListener('click', () => { 
            modalDelete.classList.add('hidden'); 
        });";
        $this->render('index', compact('scriptJS','couleurs'));

    }

    public function ajouterCouleur(){
        if(isset($_POST['Nom_Ajout'])){
            $this->loadModel('Couleur');
            $this->Couleur->insert($_POST['Nom_Ajout']);
        }
        $newUrl = PATH.'/couleurs';
        header("Location: $newUrl");
    }
    public function modifierCouleur() {

        if (isset($_POST['Code_Modif']) && isset($_POST['Nom_Modif'])) {
            $this->loadModel('Couleur');
            $ind = $_POST['Code_Modif'];
            $nom = $_POST['Nom_Modif'];
            $this->Couleur->modifier($ind, $nom);
            $newUrl = PATH . '/couleurs';
            header("Location: $newUrl");
        }
    }
    public function supprimerCouleur(){

        if(isset($_POST['Code_Suppr'])){
            $this->loadModel('Couleur');
            $ind = $_POST['Code_Suppr'];
            $this->Couleur->supprimer($ind);
            $newUrl = PATH . '/couleurs';
            header("Location: $newUrl");
        }

    }

}
