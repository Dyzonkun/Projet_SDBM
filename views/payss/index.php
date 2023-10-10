<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="./dist/style.css">
</head>
<body>
<?php $Titre = "Pays"?>
<div class="flex sm:justify-center mt-4 mb-4">
    <button class="px-4 py-2 mb-2 ml-2 bg-green-500 hover:bg-green-600 text-white rounded-md transition duration-300 ease-in-out modal-open">Ajouter</button>
    <input type="text" class="w-24 sm:w-32 px-2 sm:mr-2 py-1 mb-2 ml-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="Rechercher...">
</div>
<div class="flex justify-center mt-4 mb-64">
    <div class="relative overflow-x-auto">
        <table class="sm:text-xl text-xs text-left text-gray-500 dark:text-gray-400">
            <thead class="sm:text-2xl text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="sm:px- sm:py-1 md:px-3 md:py-1">
                        ID
                    </th>
                    <th scope="col" class="sm:px-2 sm:py-2 md:px-3 md:py-1">
                        Pays
                    </th>
                    <th scope="col" class="sm:px-2 sm:py-3 md:px-3 md:py-1">
                        Continent
                    </th>
                    <th scope="col" class="sm:px-2 sm:py-2 md:px-3 md:py-1">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($payss as $pays): ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?= $pays['ID_PAYS'] ?></td>
                        <td class="md:px-3 px-2 py-2"><?= $pays['NOM_PAYS'] ?></td>
                        <td class="md:px-3 px-2 py-2"><?= $pays['NOM_CONTINENT'] ?></td>
                        <td class="md:px-3 px-2 py-2">
                        <button class="px-2 py-1 mb-2 sm:mb-0 bg-blue-500 hover:bg-blue-600 text-white rounded modal-modif-open">Modifier</button>
                            <button class="px-2 py-1 bg-red-500 text-white hover:bg-red-600 rounded modal-delete-open">Supprimer</button>
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
        <h2 class="text-2xl font-semibold mb-4">Ajouter un pays</h2>
        <form method="POST" action="<?= PATH ?>/payss/ajouterPays">
            <div class="mb-4">
                <label for="pays" class="block text-gray-600">Nom du pays:</label>
                <input type="text" id="pays" name="Ajout_Pays"class="w-full border rounded-md px-3 py-2 mt-1">
            </div>
            <div class="mb-4">
                <label for="ajout_continent" class="block text-gray-600">Nom du continent:</label>
                <select id="continent-select" name="Ajout_Continent" class="w-full border rounded-md px-3 py-2 mt-1">
                <?php foreach($continents as $continent): ?>
                <option value=<?= $continent['ID_CONTINENT'] ?>><?= $continent['NOM_CONTINENT'] ?></option>
                <?php endforeach ?>
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
        <h2 class="text-2xl font-semibold mb-4">Modifier un pays</h2>
        <form method="POST" action="<?= PATH ?>/payss/modifierPays">
            <div class="mb-4">
                <label for="new-pays-name" class="block text-gray-600">Nouveau nom du pays:</label>
                <input type="text" id="new-pays-name" name="Pays_Modif" class="w-full border rounded-md px-3 py-2 mt-1">
            </div>
            <div class="mb-4">
                <label for="continent_modif" class="block text-gray-600">Nouveau continent:</label>
                <select name="Continent_Modif" id="new-continent-name" class="w-full border rounded-md px-3 py-2 mt-1">
                <?php foreach($continents as $continent): ?>
                <option value=<?= $continent['ID_CONTINENT'] ?>><?= $continent['NOM_CONTINENT'] ?></option>
                <?php endforeach ?>
                </select>
                <input type="hidden" name="Code_Modif" id="modif-pays-id">
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
    <form method="POST" action="<?= PATH ?>/payss/supprimerPays">
        <p class="mb-4">Êtes-vous sûr de vouloir supprimer cet élément ? Cette action est irréversible.</p>
        <input type="hidden" name="Code_Suppr" id="suppr-pays-id">
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded ">Supprimer</button>
            <button type="reset" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded modal-close ml-2 modal-delete-cancel">Annuler</button>
        </div>
    </form>
    </div>
</div>
<script>
    <?= $scriptJS ?>
</script>
</body>
</html>
