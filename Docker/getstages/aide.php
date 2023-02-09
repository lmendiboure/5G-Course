<?php 
include_once 'include/lib/libPage.php'; 

class PageAide extends Page
{
    protected function afficherContent()
    {
        
        ?>
        <header>
            <h1>Aide</h1>
            <p><em>Bienvenue sur la FAQ</em></p>
        </header>
        <hr />
        <section>
            <h1>Entreprise</h1>
            
            <article>
                <h2>Comment rechercher une entreprise ?</h2>
                <p>
                    Si vous voulez rechercher une entreprise, vous devez aller sur la page " Entreprise ", pour cliquer sur le bouton " Rechercher une entreprise ". Il vous est alors fourni trois critères. Utilisez-les afin de pouvoir trouver les entreprises qui correspondent à vos choix.
                </p>
            </article>
            
            <article>
                <h2>Comment ajouter une entreprise ?</h2>
                <p>
                    Pour ajouter une entreprise, rendez-vous sur la page " Entreprise ", où vous devez cliquer sur le bouton " Ajouter une entreprise ". Vous devrez ensuite ajouter les informations concernant l’entreprise. Toutes les informations ne sont pas obligatoires, mais il est conseillé d’en fournir un maximum pour renseigner les futurs stagiaires sur les entreprises référencées.
                </p>
            </article>
            
            <article>
                <h2>Comment afficher ou enlever une information concernant l'entreprise ?</h2>
                <p>
                    En allant sur la page " Entreprise ", vous pouvez voir les entreprises déjà référencées. Vous pouvez alors remarquer que certaines informations concernant l'entreprise sont absentes. Vous pouvez cependant les afficher grâce à la liste déroulante : choisissez l'information que vous voulez afficher puis cliquez sur le bouton " Ajouter ".
                    Si vous voulez enlever une information, il vous suffit de cliquer sur le moins situé à l'entête de la colonne représentant l'information concerné.
                </p>
            </article>
            
            <article>
                <h2>N'y a t-il pas une autre solution pour voir ces informations ?</h2>
                <p>
                    Bien sûr, vous pouvez cliquer sur l’icone <span class="fake_bouton icon_voir"></span> pour voir toutes les informations concernant l'entreprise que vous avez sélectionné.
                </p>
            </article>
            
            <article>
                <h2>Comment puis-je supprimer une entreprise ?</h2>
                <p>
                    Rien de plus simple, il vous suffit de cliquer sur l'icone <span class="fake_bouton icon_supprimer"></span> qui se situe sur la deuxième colonne " Opération ".<br />
                    <span class="important">Faites bien attention de ne pas vous tromper de ligne !</span>
                </p>
            </article>
            
            <article>
                <h2>Et si je veux modifier une information fausse ?</h2>
                <p>
                    Cliquez sur l'icone <span class="fake_bouton icon_modifier"></span>, puis changer le(s) information(s) que vous voulez. Vous pourrez par la même occasion renseigner une information manquante si vous en avez la possibilité.
                </p>
            </article>
        </section>
        <hr />
        <section>
            <h1>Stagiaire</h1>
            
            <article>
                <h2>Comment rechercher un stagiaire ?</h2>
                <p>
                    Tout d'abord, dirigez-vous sur la page " Stagiaire ". Cliquez ensuite sur le bouton " Rechercher un stagiaire existant ". Vous aurez alors quatre listes déroulantes. Vous pourrez alors choisir, pour chaque champ, l'information voulue.
                </p>
            <article>
            </article>
                <h2>Comment inscrire un étudiant à un stage ?</h2>
                <p>
                    Pour cela, vous devez vous rendre sur la page " Inscription ". Ensuite, vous devrez remplir un formulaire contenant diverses informations concernant le stage de l’étudiant, comme par exemple l’entreprise ou encore le professeur qui s’occupera du stage de l’étudiant.
                    Vous pouvez aussi le faire à partir de la page " Entreprise " : cliquez sur la poignée de main située sur la première colonne " Opération ", et le formulaire d'inscription s'affichera avec le nom de l'entreprise pré-rentré.
                </p>
            <article>
            </article>
                <h2>Comment peut-on voir les informations des stagiaires ?</h2>
                <p>
                    Sur la liste qui s'affiche sur la page " Stagiaire ", ou en cliquant sur l'icone <span class="fake_bouton icon_voir"></span>.
                </p>
            <article>
            </article>
                <h2>Comment peut-on supprimer un stagiaire ?</h2>
                <p>
                    Comme pour une entreprise : cliquez sur l'icone <span class="fake_bouton icon_supprimer"></span> présente sur la page " Stagiaire ".
                </p>
            <article>
            </article>
                <h2>Et pour modifier le contenu d'un champ, pareil que pour les entreprises ?</h2>
                <p>
                    Tout juste !
                </p>
            </article>
        </section>
        <?php
    }
}

$page = new PageAide();
$page->run();

?>

