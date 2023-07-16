<?php
function getURL()
{
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
        $url = "https";
    else {
        $url = "http";
    }
    // ASSEMBLAGE DE L'URL
    $url .= "://";
    $url .= $_SERVER['HTTP_HOST'];
    $url .= $_SERVER['REQUEST_URI'];
    $splitURL = explode('boutique-en-ligne', $url);
    $splitURL2 = explode('/', $splitURL[1]);
    return [$splitURL, $splitURL2];
}
require_once('config.php');
//On fait ça pour ne pas avoir a faire 2 headers pour l'index et les autre pages php
if (getURL()[0][1] === '/index.php' || getURL()[0][1] === '/') {
    includeHeader($bdd, './', './php/', './maquette/'); //si on est sur l'index, les redirections seront ça
} else {
    includeHeader($bdd, '../', '../php/', '../maquette/'); //si on n'est pas sur l'index, les redirections seront ça
}

function includeHeaderr($bdd, $index, $urlPHP, $urlMaquette)
{
?>
    <header id="allHeader">
        <nav>
            <div class="nav1">
                <!-- LE LOGO -->
                <a href="<?= $index ?>"><img id="logo" src="<?= $urlMaquette ?>logo-removebg.png"></a>
                <!-- LA SEARCH BAR -->
                <div class="search ">
                    <form class="d-flex" role="search" method="GET">
                        <input class="form-control me-2" type="text" id="search-bar" name="search" placeholder="Rechercher...">
                    </form>
                    <!-- la div ou on affiche les resultat de la barre de recherche -->
                    <div id="result"></div>

                </div>
                <div class="links">
                    <?php if (isset($_SESSION['user'])) { ?>
                        <a href="<?= $urlPHP ?>panier.php"><i class="fa-solid fa-cart-shopping fa-2xl" style="color: #000000;"></i></a>
                        <a href="<?= $urlPHP ?>profil.php"><i class="fa-solid fa-user fa-2xl" style="color: #000000;"></i></a>
                    <?php } else { ?>
                        <a href="<?= $urlPHP ?>connexion.php"><i class="fa-solid fa-right-to-bracket fa-2xl" style="color: #000000;"></i></a>
                        <a href="<?= $urlPHP ?>inscription.php"><i class="fa-solid fa-user-plus fa-2xl" style="color: #000000;"></i></a>
                    <?php } ?>
                </div>
            </div>
            <!-- AFFICHAGE DES CATEGORIES ET DES SOUS CATEGORIES DYNAMIQUEMENT -->
            <div>
                <ul id="menu-demo2">
                    <?php
                    $requestCategory = $bdd->prepare('SELECT * FROM categorie');
                    $requestCategory->execute();
                    $resultCategory = $requestCategory->fetchAll(PDO::FETCH_ASSOC); ?>
                    <li><a href="<?= $urlPHP ?>categories.php">Toutes les Categories </a></li>
                    <?php foreach ($resultCategory as $categorie) {
                        $categorieId = $categorie['idCat'];
                        $categorieNom = $categorie['titreCat']; ?>
                        <li>
                            <a href="<?= $urlPHP ?>categories.php?category=<?= $categorieId ?>"><?= $categorieNom; ?></a>
                            <ul><?php
                                $requestSubCategory = $bdd->prepare('SELECT * FROM souscategorie WHERE id_parent = ?');
                                $requestSubCategory->execute([$categorieId]);
                                $resultSubCategory = $requestSubCategory->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($resultSubCategory as $Subcategorie) {
                                    $subCategorieId = $Subcategorie['id'];
                                    $subCategorieNom = $Subcategorie['titreSousCat']; ?>
                                    <li><a href="<?= $urlPHP ?>categories.php?subCategory=<?= $subCategorieId ?>"><?= $subCategorieNom; ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
    </header>

<?php } ?>

<?php
function includeHeader($bdd, $index, $urlPHP, $urlMaquette)
{
?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= $index ?>"><img id="logo" src="<?= $urlMaquette ?>logo-removebg.png"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php
                    $requestCategory = $bdd->prepare('SELECT * FROM categorie');
                    $requestCategory->execute();
                    $resultCategory = $requestCategory->fetchAll(PDO::FETCH_ASSOC); ?>
                    <li class="nav-item"><a class="nav-link" href="<?= $urlPHP ?>categories.php">Toutes les catégories</a></li>
                    <?php foreach ($resultCategory as $categorie) {
                        $categorieId = $categorie['idCat'];
                        $categorieNom = $categorie['titreCat']; ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="<?= $urlPHP ?>categories.php?category=<?= $categorieId ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?= $categorieNom; ?>
                            </a>
                            <ul class="dropdown-menu">
                                <?php
                                $requestSubCategory = $bdd->prepare('SELECT * FROM souscategorie WHERE id_parent = ?');
                                $requestSubCategory->execute([$categorieId]);
                                $resultSubCategory = $requestSubCategory->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($resultSubCategory as $Subcategorie) {
                                    $subCategorieId = $Subcategorie['id'];
                                    $subCategorieNom = $Subcategorie['titreSousCat']; ?>
                                    <li><a class="dropdown-item" href="<?= $urlPHP ?>categories.php?subCategory=<?= $subCategorieId ?>"><?= $subCategorieNom; ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <div class="search">
                        <form class="d-flex" role="search" method="GET">
                            <input class="form-control me-2" type="text" id="search-bar" name="search" placeholder="Rechercher...">
                        </form>
                        <div id="result"></div>
                    </div>
                    <?php if (isset($_SESSION['user'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= $urlPHP ?>panier.php"><i class="fa-solid fa-cart-shopping fa-2xl" style="color: #000000;"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= $urlPHP ?>profil.php"><i class="fa-solid fa-user fa-2xl" style="color: #000000;"></i></a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= $urlPHP ?>connexion.php"><i class="fa-solid fa-right-to-bracket fa-2xl" style="color: #000000;"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= $urlPHP ?>inscription.php"><i class="fa-solid fa-user-plus fa-2xl" style="color: #000000;"></i></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
<?php } ?>