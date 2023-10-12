<?php
class Marques extends Controller{
    public function index()
    {
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
        const newMarqueNameInput = modalModif.querySelector('#new-marque-name');
        
        openModalAjoutBtn.addEventListener('click', () => {
            modalAjout.classList.remove('hidden');
        });
        
        closeModalAjoutBtn.addEventListener('click', () => {
            modalAjout.classList.add('hidden');
        });
        
        openModalModifBtns.forEach((btn, index) => {
            btn.addEventListener('click', () => {
                const nomMarque = btn.parentElement.parentElement.querySelector('td:nth-child(2)').textContent;
                const IdMarque = btn.parentElement.parentElement.querySelector('td:nth-child(1)').textContent;
                const nomFabricant = btn.parentElement.parentElement.querySelector('td:nth-child(3)').textContent;
                const nomPays = btn.parentElement.parentElement.querySelector('td:nth-child(4)').textContent;
                const newMarqueNameInput = document.getElementById('new-marque-name');
                const newMarquedIdInput = document.getElementById('modif-marque-id');
                const newFabricantNameSelect = document.getElementById('fabricantID');
                const newPaysNameSelect = document.getElementById('paysID');

                newMarqueNameInput.value = nomMarque;
                newMarquedIdInput.value = IdMarque;

                const FabricantOptions = newFabricantNameSelect.options;
                newFabricantNameSelect.selectedIndex = 0;
                for (let i = 0; i<FabricantOptions.length;i++) {
                    if (FabricantOptions[i].textContent === nomFabricant) {
                        newFabricantNameSelect.selectedIndex = i;
                        break;
                    }
                }

                const PaysOptions = newPaysNameSelect.options;
                for (let i = 0; i<PaysOptions.length;i++) {
                    if (PaysOptions[i].textContent === nomPays) {
                        newPaysNameSelect.selectedIndex = i;
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

                const marqueId = btn.dataset.marqueId; 
                const supprMarqueIdInput = document.getElementById('suppr-marque-id');
        
                supprMarqueIdInput.value = marqueId; 
        
                modalDelete.classList.remove('hidden');
            });
        });
        
        closeModalDeleteBtn.addEventListener('click', () => {
            modalDelete.classList.add('hidden');
        });
        
        modalDeleteCancelBtn.addEventListener('click', () => { 
            modalDelete.classList.add('hidden'); 
        });";

        $this->loadModel('Marque');
        $marque = $this->Marque;
        $marque->getConnection();
        $marques = $marque->getAll_with_pays_and_fabricant_null();

        $this->loadModel('Fabricant');
        $fabricants=$this->Fabricant->getAll('NOM_FABRICANT asc');

        $this->loadModel('Pays');
        $payss=$this->Pays->getAll('NOM_PAYS asc');

        


        $this->render('index', compact('scriptJS', 'marques','fabricants','payss'));
    }

     public function ajouterMarque(){


         if ((isset($_POST['Ajout_Marque']))&&(isset($_POST['Ajout_Pays']))) {
                $this->loadModel('Marque');

                $nom= $_POST['Ajout_Marque'];
                $idFab=$_POST['Ajout_Fabricant'];
                $idPays=$_POST['Ajout_Pays'];

                if($idFab==="NULL"){
                    $this->Marque->insert($nom, null, $idPays);
                }else{
                $this->Marque->insert($nom, $idFab, $idPays);
                }
                 }

        $newUrl = PATH.'/marques';
        header("Location: $newUrl");

    }

    public function modifierMarque(){

        if (isset($_POST['Code_Modif']) && isset($_POST['Nom_Modif'])&& isset($_POST['Pays_Modif'])) {
                $this->loadModel('Marque');
                $ind = $_POST['Code_Modif'];
                $nom = $_POST['Nom_Modif'];
                $fab = $_POST['Fabricant_Modif'];
                $pays = $_POST['Pays_Modif'];
            if($fab==="NULL"){
                $this->Marque->update($ind,$nom,null,$pays);
            }else{
                $this->Marque->update($ind,$nom,$fab,$pays);
            }
        $newUrl = PATH.'/marques';
        header("Location: $newUrl");
        }
    }

    public function supprimerMarque(){

        if (isset($_POST['Code_Suppr'])) {
                $this->loadModel('Marque');
                $ind = $_POST['Code_Suppr'];
                $this->Marque->delete($ind);
        }
        $newUrl = PATH.'/marques';
        header("Location: $newUrl");

    }
}
