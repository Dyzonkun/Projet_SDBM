<?php $Titre = "Articles"?>
<div class="flex md:justify-center mt-20 mb-12">
    <button class="px-6 py-2 mb-2 ml-8 bg-green-500 hover:bg-green-600 text-white rounded transition duration-300 ease-in-out modal-open">Ajouter</button>
    <input type="text" class="w-32 md:w-64 px-4 md:mr-32 py-1 mb-2 ml-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="Rechercher...">
</div>
</div>
<div class="flex justify-center mt-4 mb-64 ">
    <div class="relative overflow-x-auto">
    <table class="md:text-xl text-xs text-left text-gray-500 dark:text-gray-400">
            <thead class="md:text-2xl text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="md:px-6 md:py-3 px-5 py-1">
                    ID
                </th>
                <th scope="col" class="md:px-6 md:py-3 px-5 py-1">
                    Article
                </th>
                <th scope="col" class="md:px-6 md:py-3 px-5 py-1">
                    Prix d'Achat
                </th>
                <th scope="col" class="md:px-6 md:py-3 px-5 py-1">
                    Volume
                </th>
                <th scope="col" class="md:px-6 md:py-3 px-5 py-1">
                    Titrage
                </th>
                <th scope="col" class="md:px-6 md:py-3 px-5 py-1">
                    Marque
                </th>
                <th scope="col" class="md:px-6 md:py-3 px-5 py-1">
                    Couleur
                </th>
                <th scope="col" class="md:px-6 md:py-3 px-5 py-1">
                    Type
                </th>
                <th scope="col" class="md:px-6 md:py-3 px-5 py-1">
                    Actions
                </th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($articles as $article): ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                    data-nom-article="<?= $article['NOM_ARTICLE'] ?>">
                    <td scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?= $article['ID_ARTICLE'] ?></td>
                    <td class="px-6 py-4"><?= $article['NOM_ARTICLE'] ?></td>
                    <td class="px-6 py-4"><?= $article['PRIX_ACHAT'] ?></td>
                    <td class="px-6 py-4"><?= $article['VOLUME'] ?></td>
                    <td class="px-6 py-4"><?= $article['TITRAGE'] ?></td>
                    <td class="px-6 py-4"><?= $article['NOM_MARQUE'] ?></td>
                    <td class="px-6 py-4"><?= $article['NOM_COULEUR'] ?></td>
                    <td class="px-6 py-4"><?= $article['NOM_TYPE'] ?></td>
                    <td class="px-6 py-4">
                        <button class="px-2 py-1 mb-2 sm:mb-0 bg-blue-500 hover:bg-blue-600 text-white rounded modal-modif-open"
                                data-article-id="<?= $article['ID_ARTICLE'] ?>">Modifier
                        </button>
                        <button class="px-2 py-1 bg-red-500 text-white hover:bg-red-600 rounded modal-delete-open"
                                data-article-id="<?= $article['ID_ARTICLE'] ?>">Supprimer
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>

<!-- Fenetre modal ajout -->

<div id="modal-ajout" class="fixed inset-0 flex items-center justify-center hidden z-50">
    <div class="modal-overlay fixed inset-0 bg-black opacity-50"></div>

    <div class="modal-container bg-white w-96 mx-auto p-6 rounded-lg shadow-lg z-50 overflow-y-auto">
        <div class="flex justify-end mb-2">
            <button class="modal-close p-1 bg-gray-300 rounded-full hover:bg-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Contenu de la fenêtre modale -->
        <h2 class="text-2xl font-semibold mb-4">Ajouter un article</h2>
        <form method="POST" action="<?= PATH ?>/articles/ajouterArticle">
            <div class="mb-4">
                <label for="new-articles-name" class="block text-gray-600">Nouvel article:</label>
                <input type="text" id="nom_param" name="Nom_Ajout" class="w-full border rounded-md px-3 py-2 mt-1">
                <label class="block text-gray-600">Prix d'achat:</label>
                <input type="number" id="prix_param" name="Prix_Ajout" step="0.01"
                       class="w-full border rounded-md px-3 py-2 mt-1">
                <label class="block text-gray-600">Volume:</label>
                <input type="number" id="volume_param" name="Volume_Ajout"
                       class="w-full border rounded-md px-3 py-2 mt-1">
                <label class="block text-gray-600">Titrage:</label>
                <input type="number" id="titrage_param" name="Titrage_Ajout" step="0.01"
                       class="w-full border rounded-md px-3 py-2 mt-1">
                <label class="block text-gray-600">Marque:</label>       
                <select name="marque_Ajout" id="id_marque_param" class="w-full border rounded-md px-3 py-2 mt-1">
                    <?php foreach ($marques as $marque): ?>
                        <option value=<?= $marque["ID_MARQUE"] ?>><?= $marque["NOM_MARQUE"] ?></option> <?php endforeach; ?>
                </select>
                <label class="block text-gray-600">Couleur:</label>
                <select name="couleur_Ajout" id="id_couleur_param" class="w-full border rounded-md px-3 py-2 mt-1">
                    <?php foreach ($couleurs as $couleur): ?>
                        <option value=<?= $couleur["ID_COULEUR"] ?>><?= $couleur["NOM_COULEUR"] ?></option> <?php endforeach; ?>
                </select>
                <label class="block text-gray-600">Type:</label>
                <select name="type_Ajout" id="id_type_param" class="w-full border rounded-md px-3 py-2 mt-1">
                    <?php foreach ($types_bieres as $type_biere): ?>
                        <option value=<?= $type_biere["ID_TYPE"] ?>><?= $type_biere["NOM_TYPE"] ?></option> <?php endforeach; ?>
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded">Ajouter</button>
            </div>
        </form>
    </div>
</div>

<!-- Fenetre modal modif -->

<div id="modal-modif" class="fixed inset-0 flex items-center justify-center hidden z-50">
    <div class="modal-overlay fixed inset-0 bg-black opacity-50"></div>

    <div class="modal-container bg-white w-96 mx-auto p-6 rounded-lg shadow-lg z-50 overflow-y-auto">
        <div class="flex justify-end mb-2">
            <button class="modal-close p-1 bg-gray-300 rounded-full hover:bg-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Contenu de la fenêtre modale -->
        <h2 class="text-2xl font-semibold mb-4">Modifier un article</h2>
        <form method="POST" action="<?= PATH ?>/articles/modifierArticle">
        <div class="mb-4">
                <input type="hidden" name="Code_Modif" id="id_article_modif">
                <label for="new-articles-name" class="block text-gray-600">Nouvel article:</label>
                <input type="text" id="id_nom_modif" name="Nom_Modif" class="w-full border rounded-md px-3 py-2 mt-1">
                <label class="block text-gray-600">Prix d'achat:</label>
                <input type="number" id="id_prix_modif" name="Prix_Modif" step="0.01"
                       class="w-full border rounded-md px-3 py-2 mt-1">
                <label class="block text-gray-600">Volume:</label>
                <input type="number" id="id_volume_modif" name="Volume_Modif"
                       class="w-full border rounded-md px-3 py-2 mt-1">
                <label class="block text-gray-600">Titrage:</label>
                <input type="number" id="id_titrage_modif" name="Titrage_Modif" step="0.01"
                       class="w-full border rounded-md px-3 py-2 mt-1">
                <label class="block text-gray-600">Marque:</label>
                <select name="Marque_Modif" id="id_marque_modif" class="w-full border rounded-md px-3 py-2 mt-1">
                    <?php foreach ($marques as $marque): ?>
                        <option value=<?= $marque["ID_MARQUE"] ?>><?= $marque["NOM_MARQUE"] ?></option> <?php endforeach; ?>
                </select>
                <label class="block text-gray-600">Couleur:</label>
                <select name="Couleur_Modif" id="id_couleur_modif" class="w-full border rounded-md px-3 py-2 mt-1">
                    <?php foreach ($couleurs as $couleur): ?>
                        <option value=<?= $couleur["ID_COULEUR"] ?>><?= $couleur["NOM_COULEUR"] ?></option> <?php endforeach; ?>
                </select>
                <label class="block text-gray-600">Type:</label>
                <select name="Type_Modif" id="id_type_modif" class="w-full border rounded-md px-3 py-2 mt-1">
                    <?php foreach ($types_bieres as $type_biere): ?>
                        <option value=<?= $type_biere["ID_TYPE"] ?>><?= $type_biere["NOM_TYPE"] ?></option> <?php endforeach; ?>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<!-- Fenetre modal suppr -->
<div id="modal-delete" class="fixed inset-0 flex items-center justify-center hidden z-50">
    <div class="modal-overlay fixed inset-0 bg-black opacity-50"></div>

    <div class="modal-container bg-white w-96 mx-auto p-6 rounded-lg shadow-lg z-50 overflow-y-auto">
        <div class="modal-close absolute top-0 right-0 p-4 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>

        <!-- Contenu de la fenêtre modale -->
        <h2 class="text-2xl font-semibold mb-4">Confirmer la suppression</h2>
        <form method="POST" action="<?= PATH ?>/articles/supprimerArticle">
            <p class="mb-4">Êtes-vous sûr de vouloir supprimer cet élément ? Cette action est irréversible.</p>
            <input type="hidden" name="Code_Suppr" id="suppr-article-id">
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded ">Supprimer</button>
                <button type="reset" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded modal-close ml-2 modal-delete-cancel">Annuler</button>
            </div>
        </form>
    </div>
</div>
<script>
    <?= $scriptJS;?>
</script>