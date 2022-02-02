<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novatech</title>
    <link rel="stylesheet" href="./assets/css/templatePublic.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>    
<script src="./assets/js/scriptStripe.js"></script>

</head>
<body>
<header>
    <!-- MOBILE ------------------------------------------------------------------------>



    <div class="mobile-container">
        <div class="topnav">
            <div class="rowing-nav">
                <a href="#home" class="active">
                    <img src="./assets/images/logo.png" alt="Image du logo Nova Tech"
                                                    width="80px"></a>
                <a href="index.php"><h1>NovaTech</h1></a>
            </div>
            <input type="text" placeholder="Rechercher"/>
            <button><em class="fab fa-searchengin"></em></button>
            <div id="myLinks">
                <a href="index.php">Accueil</a>
                <a href="index.php?action=pc_gamers">PC Gamers</a>
                <a href="index.php?action=pc_portables">PC Portables</a>
                <a href="index.php?action=components">Composants</a>
                <?php if (isset($_SESSION['AuthU'])) { ?>
                    <a href="index.php?action=loguout">Deconnexion</a>
                <?php } else { ?>
                    <a href="index.php?action=loginU">Connexion</a>
                <?php } ?>
            </div>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
            <a class="icon icon2" href="index.php?action=compte"><i class="fas fa-user-alt"></i></a>
            <a href="index.php?action=panier" class="panier-logo icon icon3">
                <i class="fas fa-shopping-basket"></i>
                <?php if (isset($_SESSION['panier']) && count($_SESSION['panier']['qteProduit']) > 0) { ?>
                    <span class="panier-qteProduit"> <?= array_sum($_SESSION['panier']['qteProduit']); ?> </span>
                <?php } ?>
            </a>

        </div>
    </div>

    <script>
        function myFunction() {
            var x = document.getElementById("myLinks");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
        }
    </script>
    <!-- --------------------------------------------------------------------------- -->
    <nav class="navMenu">
        <a href="index.php"><img src="./assets/images/logo.png" alt="Image du logo Nova Tech" width="120px"></a>

        <div class="topmenuNav">

            <!-- <span class="search">
                <input type="text"/>
                <button><em class="fab fa-searchengin"></em></button>
            </span> -->
            <form action="<?php $_SERVER["PHP_SELF"];?>" method="post" class="input-group">
        <div class="search">
                <input class="searchTerm" type="search" name="search" id="search" placeholder="Rechercher">
                <button type="submit" class="searchButton" name="soumis"><i class="fas fa-search"></i></button>
            </div>
        </form>
            
            <a href="index.php?action=compte"><i class="fas fa-user-alt"></i></a>
            <a href="index.php?action=panier" class="panier-logo">
                <i class="fas fa-shopping-basket"></i>
                <?php if (isset($_SESSION['panier']) && count($_SESSION['panier']['qteProduit']) > 0) { ?>
                    <span class="panier-qteProduit"> <?= array_sum($_SESSION['panier']['qteProduit']); ?> </span>
                <?php } ?>
            </a>

        </div>
        <div class="menuNav">
            <a href="index.php">Accueil</a>
            <a href="index.php?action=pc_gamers">PC Gamers</a>
            <a href="index.php?action=pc_portables">PC Portables</a>
            <a href="index.php?action=components">Composants</a>
            <?php if (isset($_SESSION['AuthU'])) { ?>
                <a href="index.php?action=loguout">Deconnexion</a>
            <?php } else { ?>
                <a href="index.php?action=loginU">Connexion</a>
            <?php } ?>

        </div>

    </nav>
</header>
<main>
    <?= $contenu; ?>
</main>

<footer>
    <div class="footer-gray">
        <div class="footer-custom">
            <div class="footer-lists">
                <div class="footer-list-wrap">
                    <h6 class="ftr-hdr">Contactez-nous:</h6>
                    <ul class="ftr-links-sub">
                        <li>06-00-00-00-00</li>
                        <li><a href="index.php?action=contact">Contact</a></li>
                    </ul>
                    <!-- <h6 class="ftr-hdr">International</h6>
                    <ul class="ftr-links-sub">
                      <li><a href="http://www.art.fr" rel="nofollow">France</a></li>
                      <li><a href="https://www.art.co.uk" rel="nofollow">United Kingdom</a></li>
                    </ul> -->
                </div>
                <!--/.footer-list-wrap-->
                <div class="footer-list-wrap">
                    <h6 class="ftr-hdr">Informations:</h6>
                    <ul class="ftr-links-sub">
                        <li><a href="/help/talktous.html" rel="nofollow">Condition Generales de vente</a></li>
                        <li><a href="/help/placingorders.html" rel="nofollow">Payer en 3X sans frais</a></li>
                        <li><a href="/help/shipping.html" rel="nofollow">Livraison</a></li>
                        <li><a href="/help/shippingreturns.html" rel="nofollow">Retrait en magasin</a></li>
                        <li><a href="/help/faq.html" rel="nofollow">FAQs</a></li>
                    </ul>
                </div>
                <div class="footer-list-wrap">
                    <h6 class="ftr-hdr">NovaTech:</h6>
                    <ul class="ftr-links-sub">
                        <li><a href="index.php?action=about" rel="nofollow">A propos</a></li>
                        <li><a href="index.php?action=legalment" rel="nofollow">Mentions légales</a></li>
                        <li><a href="/asp/landing/artistrising" rel="nofollow">Charte de protection des données</a></li>
                        <li><a href="/~/art-for-business" rel="nofollow">Presse</a></li>
                        <li><a href="http://affiliates.art.com/index.aspx" rel="nofollow">Recrutement</a></li>
                    </ul>
                </div>
                <!--/.footer-list-wrap-->
                <div class="footer-list-wrap">
                    <h6 class="ftr-hdr">Mon compte:</h6>
                    <ul class="ftr-links-sub">
                        <art:content rule="!loggedin">
                            <li class="ftr-Login"><span class="link login-trigger">Acceder à mon compte</span></li>
                            <li><span class="link"
                                      onclick="link('/asp/secure/your_account/track_orders-asp/_/posters.htm')">Suivis de mes commandes</span>
                            </li>
                        </art:content>
                    </ul>
                </div>
                <!--/.footer-list-wrap-->
            </div>
            <!-- /.footer-lists-->
            <div class="footer-email">
                <h6 class="ftr-hdr">Nos magasins NovaTech:</h6>
                <img src="./assets/images/mag-foot.webp" alt="Image du logo Nova Tech" width="50%">
                <div class="ftr-email-privacy-policy"></div>
            </div>
            <!--/.footer-email-->
            <div class="footer-social">
                <h6 class="ftr-hdr">Suivez-nous:</h6>
                <ul>
                    <li>
                        <a href="https://www.facebook.com/art.com" title="Facebook"
                           onclick="_gaq.push(['_trackSocial', 'Facebook', 'Follow', 'Footer', 'undefined', 'True']);">
                            <img width="24" height="24" alt="Like us on Facebook"
                                 src="http://cache1.artprintimages.com/images/jump_pages/rebrand/footer/fb.png">
                        </a>
                    </li>
                    <li>
                        <a href="https://plus.google.com/108089796661280870153" title="Google+"
                           onclick="_gaq.push(['_trackSocial', 'GooglePlus', 'Follow', 'Footer', 'undefined', 'True']);">
                            <img width="24" height="24" alt="Follow us on Google+"
                                 src="http://cache1.artprintimages.com/images/jump_pages/rebrand/footer/gplus.png">
                        </a>
                    </li>
                    <li>
                        <a href="https://pinterest.com/artdotcom/" target="_blank">
                            <img width="24" height="24" alt="Follow us on Pinterest"
                                 src="http://cache1.artprintimages.com/images/jump_pages/rebrand/footer/pin-badge.png">
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="http://instagram.com/artdotcom/">
                            <img width="24" height="24" alt="Follow us on Instagram"
                                 src="http://cache1.artprintimages.com/images/jump_pages/rebrand/footer/instagram-badge.png">
                        </a>
                    </li>
                    <li>
                        <a href="https://www.twitter.com/artdotcom" title="Twitter"
                           onclick="_gaq.push(['_trackSocial', 'Twitter', 'Follow', 'Footer', 'undefined', 'True']);">
                            <img width="67" alt="Follow us on Twitter"
                                 src="http://cache1.artprintimages.com/images/jump_pages/rebrand/footer/twitter.png">
                        </a>
                    </li>
                </ul>
            </div>
            <!--/.footer-social-->
            <div class="footer-legal">
                <p>&copy; NovaTech.com Inc. Tous droits réservés NovaTech. | <a href="/help/privacy-policy.html"
                                                                                rel="nofollow">Privacy Policy</a> | <a
                            href="/help/terms-of-use.html" rel="nofollow">Terms of Use</a> | <a
                            href="/help/terms-of-sale.html" rel="nofollow">Terms of Sale</a></p>
                <p>NovaTech.com, You+Art, and Photos [to] Art are trademarks or registered trademarks of Art.com
                    Inc.</p>
                <p>Various aspects of this website are covered by issued US patent No. 7,973,796 and other pending
                    patent applications.</p>
            </div>
            <!--/.footer-legal-->
            <div class="footer-payment">
                <ul>
                    <li class="ftr-stella">
                        <span title="Stella Service"
                              onclick="openLink('http://www.stellaservice.com/profile/Art.com/')"></span>
                    </li>
                    <li>
                        <span onclick="clickTrack(); return false;" onmouseover="this.style.cursor='pointer'"><img
                                    border="0" alt="HACKER SAFE certified sites prevent over 99.9% of hacker crime."
                                    src="https://images.scanalert.com/meter/www.art.com/31.gif"></span>
                    </li>
                    <li class="ftr-bbb">
                        <span title="BBB"
                              onclick="openLink('http://www.bbb.org/raleigh-durham/business-reviews/art-suppliers/artcom-inc-in-raleigh-nc-5001914')"></span>
                    </li>
                </ul>
            </div>
            <!--/.footer-payment-->
        </div>
        <!--/.footer-custom-->
    </div>
    <!--/.footer-gray-->
</footer>
</body>
</html>