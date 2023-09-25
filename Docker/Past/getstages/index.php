<?php 
include_once 'include/lib/libPage.php';

class PageIndex extends Page
{
    protected function afficherContent()
    {
        ?>
        <header>
            <h1>Stage BTS</h1>
            <p><em>Bienvenue sur la page de gestion des stages</em></p>
            <hr />
        </header>
        <?php
    }
}

$page = new PageIndex();
$page->run();
?>

