<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo @$Titre; ?></title>
    <link rel="stylesheet" href="./dist/style.css">
</head>
<body class="bg-orange-100">
<header>
    <div class="bg-zinc-950 py-5">
        <!-- Menu principal (écrans larges) au centre -->
        <ul class="hidden md:flex space-x-6 justify-center">
            <li><a href="<?= PATH ?>/home" class="text-white hover:text-gray-400">Accueil</a></li>
            <li><a href="<?= PATH ?>/continents" class="text-white hover:text-gray-400">Continents</a></li>
            <li><a href="#" class="text-white hover:text-gray-400">Pays</a></li>
            <li><a href="#" class="text-white hover:text-gray-400">Fabricants</a></li>
            <li><a href="<?= PATH ?>/couleurs" class="text-white hover:text-gray-400">Couleurs</a></li>
            <li><a href="<?= PATH ?>/types_bieres" class="text-white hover:text-gray-400">Types de Bières</a></li>
            <li><a href="<?= PATH ?>/articles" class="text-white hover:text-gray-400">Nos Articles</a></li>
        </ul>
        <nav class="container mx-auto flex justify-between items-center">
            <!-- Nom du site pour petits écrans (mobiles) -->
            <div class="md:hidden">
                <a href="#" class="text-white text-2xl font-semibold ml-4">Société des bières du monde</a>
            </div>
            <!-- Menu hamburger pour les écrans étroits à droite -->
            <div class="md:hidden ml-auto mr-4">
                <button id="menu-toggle" class="text-white hover:text-gray-400">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6">
                        <path d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </nav>
        <!-- Menu déroulant pour les écrans étroits -->
        <div id="menu" class="md:hidden text-left hidden">
            <ul class="py-4 space-y-2">
                <li><a href="<?= PATH ?>/home" class="text-white block px-4 py-2">Accueil</a></li>
                <li><a href="<?= PATH ?>/continent" class="text-white block px-4 py-2">Continents</a></li>
                <li><a href="#" class="text-white block px-4 py-2">Pays</a></li>
                <li><a href="#" class="text-white block px-4 py-2">Fabricants</a></li>
                <li><a href="<?= PATH ?>/couleurs" class="text-white block px-4 py-2">Couleurs</a></li>
                <li><a href="<?= PATH ?>/types_bieres" class="text-white block px-4 py-2">Types de Bières</a></li>
                <li><a href="<?= PATH ?>/articles" class="text-white hover:text-gray-400">Nos Articles</a></li>
            </ul>
        </div>
    </div>
</header>
<?php echo $content; ?>
<footer>
<div class="bg-zinc-950 p-6 text-center text-white">
    <span>© 2023 Copyright</span>
  </div>
</footer>
<script>
    const menuToggle = document.getElementById('menu-toggle');
    const menu = document.getElementById('menu');
    
    menuToggle.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>
</body> 
</html>