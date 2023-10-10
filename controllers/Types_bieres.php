<?php
class Types_bieres extends Controller
{
    public function index()
    {
        $this->loadModel('Type_biere');
        $typesbieres = $this->Type_biere->getAll();
        $scriptJS = "
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
        const newType_biereNameInput = modalModif.querySelector('#new-typebiere-name'); 
        
        openModalAjoutBtn.addEventListener('click', () => {
            modalAjout.classList.remove('hidden');
        });
        
        closeModalAjoutBtn.addEventListener('click', () => {
            modalAjout.classList.add('hidden');
        });
        
        openModalModifBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                const nomType_biere = btn.parentElement.previousElementSibling.textContent;
                const typebiereId = btn.parentElement.parentElement.querySelector('td:nth-child(1)').textContent;;
                const newType_biereNameInput = document.getElementById('new-typebiere-name');
                const modifType_biereIdInput = document.getElementById('modif-typebiere-id');
        
                newType_biereNameInput.value = nomType_biere;
                modifType_biereIdInput.value = typebiereId;
                
                modalModif.classList.remove('hidden');

            });
        });
        
        closeModalModifBtn.addEventListener('click', () => {
            modalModif.classList.add('hidden');
        });
        
        openModalDeleteBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                const typebiereId = btn.dataset.typebiereId; // Récupérer l'ID à partir de l'attribut de données
                const supprType_biereIdInput = document.getElementById('suppr-typebiere-id');
        
                supprType_biereIdInput.value = typebiereId; // Définir la valeur de l'input avec l'ID dun type de biere
        
                modalDelete.classList.remove('hidden');
            });
        });
        
        closeModalDeleteBtn.addEventListener('click', () => {
            modalDelete.classList.add('hidden');
        });
        
        modalDeleteCancelBtn.addEventListener('click', () => { 
            modalDelete.classList.add('hidden'); 
        });";
        $this->render('index', compact('scriptJS', 'typesbieres'));

    }

    public function ajouterType_biere()
    {
        if (isset($_POST['Nom_Ajout'])) {
            $this->loadModel('Type_biere');
            $this->Type_biere->insert($_POST['Nom_Ajout']);
        }
        $newUrl = PATH . '/types_bieres';
        header("Location: $newUrl");
    }

    public function modifierType_biere()
    {

        if (isset($_POST['Code_Modif']) && isset($_POST['Nom_Modif'])) {
            $this->loadModel('Type_biere');
            $ind = $_POST['Code_Modif'];
            $nom = $_POST['Nom_Modif'];
            $this->Type_biere->modifier($ind, $nom);
            $newUrl = PATH . '/types_bieres';
            header("Location: $newUrl");
        }
    }

    public function supprimerType_biere()
    {

        if (isset($_POST['Code_Suppr'])) {
            $this->loadModel('Type_biere');
            $ind = $_POST['Code_Suppr'];
            $this->Type_biere->supprimer($ind);
            $newUrl = PATH . '/types_bieres';
            header("Location: $newUrl");
        }

    }

}
