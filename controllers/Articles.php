<?php
class Articles extends Controller{
    public function index()
    {
        $this->loadModel('Article');
        $articles = $this->Article->getAll();
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
        const newArticleNameInput = modalModif.querySelector('#new-article-name'); 
        
        openModalAjoutBtn.addEventListener('click', () => {
            modalAjout.classList.remove('hidden');
        });
        
        closeModalAjoutBtn.addEventListener('click', () => {
            modalAjout.classList.add('hidden');
        });
        
        openModalModifBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                const nomArticle = btn.parentElement.previousElementSibling.textContent;
                const articleId = btn.dataset.articleId;
                const newArticleNameInput = document.getElementById('new-article-name');
                const modifArticleIdInput = document.getElementById('modif-article-id');
        
                newArticleNameInput.value = nomArticle;
                modifArticleIdInput.value = articleId;
                
                modalModif.classList.remove('hidden');

            });
        });
        
        closeModalModifBtn.addEventListener('click', () => {
            modalModif.classList.add('hidden');
        });
        
        openModalDeleteBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                const articleId = btn.dataset.articleId; // Récupérer l'ID à partir de l'attribut de données
                const supprArticleIdInput = document.getElementById('suppr-article-id');
        
                supprArticleIdInput.value = articleId; // Définir la valeur de l'input avec l'ID de l'article
        
                modalDelete.classList.remove('hidden');
            });
        });
        
        closeModalDeleteBtn.addEventListener('click', () => {
            modalDelete.classList.add('hidden');
        });
        
        modalDeleteCancelBtn.addEventListener('click', () => { 
            modalDelete.classList.add('hidden'); 
        });";
        $this->render('index', compact('scriptJS','articles'));

    }

    public function ajouterArticle(){
        if(isset($_POST['Nom_Ajout'])){
            $this->loadModel('Article');
            $this->Article->insert($_POST['Nom_Ajout']);
        }
        $newUrl = PATH.'/articles';
        header("Location: $newUrl");
    }
    public function modifierArticle() {

        if (isset($_POST['Code_Modif']) && isset($_POST['Nom_Modif'])) {
            $this->loadModel('Article');
            $ind = $_POST['Code_Modif'];
            $nom = $_POST['Nom_Modif'];
            $this->Article->modifier($ind, $nom);
            $newUrl = PATH . '/articles';
            header("Location: $newUrl");
        }
    }
    public function supprimerArticle(){

        if(isset($_POST['Code_Suppr'])){
            $this->loadModel('Article');
            $ind = $_POST['Code_Suppr'];
            $this->Article->supprimer($ind);
            $newUrl = PATH . '/articles';
            header("Location: $newUrl");
        }

    }

}
