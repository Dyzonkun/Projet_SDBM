<?php
class Articles extends Controller{
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
        const newArticleNameInput = modalModif.querySelector('#new-article-name'); 
        
        openModalAjoutBtn.addEventListener('click', () => {
            modalAjout.classList.remove('hidden');
        });
        
        closeModalAjoutBtn.addEventListener('click', () => {
            modalAjout.classList.add('hidden');
        });
        
        openModalModifBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                const id_article = btn.parentElement.parentElement.querySelector('td:nth-child(1)').textContent;
                const nom_article = btn.parentElement.parentElement.querySelector('td:nth-child(2)').textContent;
                const prix_achat = btn.parentElement.parentElement.querySelector('td:nth-child(3)').textContent;
                const volume = btn.parentElement.parentElement.querySelector('td:nth-child(4)').textContent;
                const titrage = btn.parentElement.parentElement.querySelector('td:nth-child(5)').textContent;
                const Newid_article = document.getElementById('id_article_modif');
                const Newnom_article = document.getElementById('id_nom_modif');
                const Newprix_achat = document.getElementById('id_prix_modif');
                const Newvolume = document.getElementById('id_volume_modif');
                const Newtitrage = document.getElementById('id_titrage_modif');
                Newid_article.value = id_article;
                Newnom_article.value = nom_article;
                Newprix_achat.value = prix_achat;
                Newvolume.value = volume;
                Newtitrage.value = titrage;

                modalModif.classList.remove('hidden');

            });
        });
        
        closeModalModifBtn.addEventListener('click', () => {
            modalModif.classList.add('hidden');
        });
        
        openModalDeleteBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                const id_Article = btn.parentElement.parentElement.querySelector('td:nth-child(1)').textContent;
                const new_id_Article = document.getElementById('suppr-article-id');
                new_id_Article.value = id_Article;
                modalDelete.classList.remove('hidden');
            });
        });
        
        closeModalDeleteBtn.addEventListener('click', () => {
            modalDelete.classList.add('hidden');
        });
        
        modalDeleteCancelBtn.addEventListener('click', () => { 
            modalDelete.classList.add('hidden'); 
        });";
        $this->loadModel('Article');
        $article = $this->Article;
        $article->getConnection();
        $articles = $article->obtenirArticle();

        $this->loadModel('Marque');
        $marques = $this->Marque->getAll('NOM_MARQUE asc');

        $this->loadModel('Couleur');
        $couleurs = $this->Couleur->getAll('NOM_COULEUR asc');

        $this->loadModel('Type_biere');
        $types_bieres = $this->Type_biere->getAll('NOM_TYPE asc');


        $this->render('index', compact('scriptJS', 'articles', 'marques', 'couleurs', 'types_bieres'));

    }

    public function ajouterArticle()
    {
        if (isset($_POST['Nom_Ajout'])&& isset($_POST['Prix_Ajout'])&& isset($_POST['Volume_Ajout']) && isset($_POST['Titrage_Ajout']) && isset($_POST['marque_Ajout']) && isset($_POST['couleur_Ajout']) && isset($_POST['type_Ajout']) ) {
            $this->loadModel('Article');
            $articleAjout = $_POST['Nom_Ajout'];
            $prixAjout = $_POST['Prix_Ajout'];
            $volumeAjout = $_POST['Volume_Ajout'];
            $titrageAjout = $_POST['Titrage_Ajout'];
            $marqueAjout = $_POST['marque_Ajout'];
            $couleurAjout = $_POST['couleur_Ajout'];
            $typeAjout = $_POST['type_Ajout'];
            $this->Article->inserer($articleAjout, $prixAjout, $volumeAjout, $titrageAjout, $marqueAjout, $couleurAjout, $typeAjout);
        }
        $newUrl = PATH . '/articles';
        header("Location: $newUrl");
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

    public function modifierArticle()
    {
        if (isset ($_POST['Code_Modif']) && isset($_POST['Nom_Modif']) && isset($_POST['Prix_Modif'])&& isset($_POST['Volume_Modif']) && isset($_POST['Titrage_Modif']) && isset($_POST['Marque_Modif']) && isset($_POST['Couleur_Modif']) && isset($_POST['Type_Modif'])) {
            $this->loadModel('Article');
            $codeModif = $_POST['Code_Modif'];
            $articleModif = $_POST['Nom_Modif'];
            $prixModif = $_POST['Prix_Modif'];
            $volumeModif = $_POST['Volume_Modif'];
            $titrageModif = $_POST['Titrage_Modif'];
            $marqueModif = $_POST['Marque_Modif'];
            $couleurModif = $_POST['Couleur_Modif'];
            $typeModif = $_POST['Type_Modif'];

            $this->Article->modifier($codeModif, $articleModif, $prixModif, $volumeModif, $titrageModif,  $marqueModif, $couleurModif, $typeModif );
        }
        $newUrl = PATH . '/articles';
        header("Location: $newUrl");
    }
}
