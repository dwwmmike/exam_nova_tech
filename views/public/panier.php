<?php
ob_start();
?>

<div class="panier">

    <h2>
        <td colspan="4">Votre panier</td>
    </h2>

    <div class="panier-desktop">
        <form method="post" action="index.php?action=panier">
            <table>
                <thead>
                <tr>
                    <td>Image</td>
                    <td>Libellé</td>
                    <td>Quantité</td>
                    <td>Prix Unitaire</td>
                    <td>Action</td>
                </tr>
                </thead>

            <?php
            if ($panier) {
                $nbArticles = count($_SESSION['panier']['libelleProduit']);
                if ($nbArticles <= 0)
                    echo "<tr><td>Votre panier est vide </ td></tr>";
                else {
                    for ($i = 0; $i < $nbArticles; $i++) {
                        $imageSess = $_SESSION['panier']['image'][$i];
                        echo "<tr>";
                        echo "<td>" .
                            "<img width=100 src='./assets/images/$imageSess'>" .
                            "</td>";
                        echo "<td>" . htmlspecialchars($_SESSION['panier']['libelleProduit'][$i]) . "</ td>";
                        echo "<td><input type=\"number\" name=\"q[]\" value=\"" . htmlspecialchars($_SESSION['panier']['qteProduit'][$i]) . "\"/></td>";
                        echo "<td>" . htmlspecialchars($_SESSION['panier']['prixProduit'][$i]) . " €</td>";
                        echo '<td><a href="'.htmlspecialchars("index.php?action=panier&method=suppression&l=".rawurlencode($_SESSION['panier']['libelleProduit'][$i])).'">Supprimer</a></td>';
                        echo "</tr>";
                    }
                }
            }
            ?>

        </table>
        <span>
                <input type="submit" value="Rafraichir"/>
                <input type="hidden" name="method" value="refresh"/>
                <a href="index.php?action=supppanier">Vider</a
            </span>
        </form>
    </div>
    <div class="panier-mobile">
        <form method="post" action="index.php?action=panier">
            <?php
            if ($panier) {
                $nbArticles = count($_SESSION['panier']['libelleProduit']);
                if ($nbArticles <= 0)
                    echo "<tr><td>Votre panier est vide </ td></tr>";
                else {
                    for ($i = 0; $i < $nbArticles; $i++) {
                        $imageSess = $_SESSION['panier']['image'][$i];
                        echo "<div class='ligne-item'>";
                        echo "<span>" .
                            "<img  src='./assets/images/$imageSess'>" .
                            "</span>";
                        echo "<span class='ligne-item-desc'>" ;
                        echo "<p>" . htmlspecialchars($_SESSION['panier']['libelleProduit'][$i]) . "</ p>";
                        echo "<p>Quantité : <input type=\"number\" name=\"q[]\" value=\"" . htmlspecialchars($_SESSION['panier']['qteProduit'][$i]) . "\"/></p>";
                        echo "<p>" . htmlspecialchars($_SESSION['panier']['prixProduit'][$i]) . " €</p>";
                        echo '<p><a class="bb" href="'.htmlspecialchars("index.php?action=panier&method=suppression&l=".rawurlencode($_SESSION['panier']['libelleProduit'][$i])).'">Supprimer</a></p>';
                            echo "</span></div>" ;
                        }
                    }
                }
                ?>
            <span >
                <input type="submit" value="Rafraichir"/>
                <input type="hidden" name="method" value="refresh"/>
                <a class="bb" href="index.php?action=supppanier">Vider</a>
            </span>
        </form>
    </div>

    <div class="total">
           
            <span>Total : <strong><?= $montant ?> €</strong></span>
            <?php if(isset($_SESSION['AuthU'])) { ?>
                <input id="prix" type="hidden" value="<?=$montant?>" />
                <input id="email" type="hidden" value="<?=$_SESSION['AuthU']->email?>" />
                <a class="payer" href="#" id="checkout-button">Payer</a>
            <?php } else { ?>
            <a href="index.php?action=compte"><button>Se connecter et payer</button></a>
            <?php }  ?>
    </div>

</div>
<?php
$contenu = ob_get_clean();
require_once('./views/public/templatePublic.php');
?>