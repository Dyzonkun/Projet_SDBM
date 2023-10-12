<?php
class Payss extends Controller {
    public function index() {
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
        
        openModalAjoutBtn.addEventListener('click', () => {
            modalAjout.classList.remove('hidden');
        });
        
        closeModalAjoutBtn.addEventListener('click', () => {
            modalAjout.classList.add('hidden');
        });
        
        openModalModifBtns.forEach((btn, index) => {
            btn.addEventListener('click', () => {
                const nomPays = btn.parentElement.parentElement.querySelector('td:nth-child(2)').textContent;
                const IdPays = btn.parentElement.parentElement.querySelector('td:nth-child(1)').textContent;
                const nomContinent = btn.parentElement.parentElement.querySelector('td:nth-child(3)').textContent;
                const newPaysNameInput = document.getElementById('new-pays-name');
                const newPaysdIdInput = document.getElementById('modif-pays-id');
                const newContinentNameSelect = document.getElementById('new-continent-name')
                newPaysNameInput.value = nomPays;
                newPaysdIdInput.value = IdPays;
                
                const continentOptions = newContinentNameSelect.querySelectorAll('option');
                for (let option of continentOptions) {
                    if (option.textContent === nomContinent) {
                        option.selected = true;
                        break;
                    }
                }

                modalModif.classList.remove('hidden');
            });
        });
        
        closeModalModifBtn.addEventListener('click', () => {
            modalModif.classList.add('hidden');
        });
        
        openModalDeleteBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                const IdPays = btn.parentElement.parentElement.querySelector('td:nth-child(1)').textContent;
                const newPaysdIdInput = document.getElementById('suppr-pays-id');
                newPaysdIdInput.value = IdPays;
                modalDelete.classList.remove('hidden');
            });
        });
        
        closeModalDeleteBtn.addEventListener('click', () => {
            modalDelete.classList.add('hidden');
        });
        
        modalDeleteCancelBtn.addEventListener('click', () => {
            modalDelete.classList.add('hidden');
        });";
        $this->loadModel('Pays');
        $paysModel = $this->Pays;
        $paysModel->getConnection();
        $payss = $paysModel->obtenirNomContinent();
        $this->loadModel('Continent');
        $continents = $this->Continent->getAll("NOM_CONTINENT asc");
        $this->render('index', compact('payss', 'continents', 'scriptJS'));
    }

    public function ajouterPays() {
        if (isset($_POST['Ajout_Pays']) && isset($_POST['Ajout_Continent'])) {  
            $this->loadModel('Pays');
            $nomPays = $_POST['Ajout_Pays'];
            $idContinent = $_POST['Ajout_Continent'];
            $this->Pays->inserer($nomPays, $idContinent);
        } 
            $newUrl = PATH.'/payss';
            header("Location: $newUrl");     
    }

    public function modifierPays() {
        if (isset($_POST['Code_Modif']) && isset($_POST['Pays_Modif']) && isset($_POST['Continent_Modif'])) {
            $this->loadModel('Pays'); 
            $idPays = $_POST['Code_Modif'];
            $nomPays = $_POST['Pays_Modif'];
            $idContinent = $_POST['Continent_Modif'];
            $this->Pays->modifier($idPays, $nomPays, $idContinent);
            $newUrl = PATH . '/payss'; 
            header("Location: $newUrl");
        }
    }

    public function supprimerPays() {
        if (isset($_POST['Code_Suppr'])) {
            $this->loadModel('Pays');
            $id = $_POST['Code_Suppr'];
            $this->Pays->supprimer($id);
            $newUrl = PATH . '/payss';
            header("Location: $newUrl");
        }
    }
}