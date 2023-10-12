<main>
<?php $Titre = "Fabricants"?>
    <div class="flex sm:justify-center mt-4 mb-4">
    <button class="modal-open px-4 py-2 mb-2 ml-2 bg-green-500 hover:bg-green-600 text-white rounded-md transition duration-300 ease-in-out" id="">Ajouter</button>
    <input type="text" class="w-24 sm:w-32 px-2 sm:mr-2 py-1 mb-2 ml-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500" placeholder="Rechercher...">
</div>
<div class="flex justify-center mt-4 mb-64">
<div class="relative overflow-x-auto">
<table class="sm:text-xl text-xs text-left text-gray-500 dark:text-gray-400">
    <thead class="sm:text-2xl text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="sm:px- sm:py-1 md:px-3 md:py-1">ID</th>
            <th scope="col" class="sm:px-2 sm:py-2 md:px-3 md:py-1">Fabricant</th>
            <th scope="col" class="sm:px-2 sm:py-2 md:px-3 md:py-1">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($fabricants as $fabricant): ?>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?= $fabricant['ID_FABRICANT'] ?></td>
                <td class="md:px-3 px-2 py-2"><?= $fabricant['NOM_FABRICANT'] ?></td>
                <td class="md:px-3 px-2 py-2">
                <button class="modal-modif-open px-2 py-1 mb-2 sm:mb-0 bg-blue-500 hover:bg-blue-600 text-white rounded" data-fabricant-id="<?= $fabricant['ID_FABRICANT'] ?>">Modifier</button>
                <button class="modal-delete-open px-2 py-1 bg-red-500 text-white hover:bg-red-600 rounded" data-fabricant-id="<?= $fabricant['ID_FABRICANT'] ?>">Supprimer</button>
                        </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


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
        <h2 class="text-2xl font-semibold mb-4">Ajouter un fabricant</h2>
        <form method="POST" action="<?= PATH ?>/fabricants/ajouterFabricant">
            <div class="mb-4">
                <label for="Nom_Ajout" class="block text-gray-600">Nom du fabricant:</label>
                <input type="text" id="Nom_Ajout" name="Nom_Ajout" class="w-full border rounded-md px-3 py-2 mt-1">
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
        <h2 class="text-2xl font-semibold mb-4">Modifier un fabricant</h2>
        <form method="POST" action="<?= PATH ?>/fabricants/modifierFabricant">
            <div class="mb-4">
                <label for="new-fabricant-name" class="block text-gray-600">Nouveau nom du fabricant:</label>
                <input type="text" id="new-fabricant-name" name="Nom_Modif" class="w-full border rounded-md px-3 py-2 mt-1">
                <input type="hidden" name="Code_Modif" id="modif-fabricant-id">
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
        <form method="POST" action="<?= PATH ?>/fabricants/supprimerFabricant">
        <p class="mb-4">Êtes-vous sûr de vouloir supprimer cet élément ? Cette action est irréversible.</p>
        <input type="hidden" name="Code_Suppr" id="suppr-fabricant-id">
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded ">Supprimer</button>
            <button type="reset" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded modal-close ml-2 modal-delete-cancel">Annuler</button>
        </div>
    </div>
</div>

        </main>
