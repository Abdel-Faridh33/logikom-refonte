




    <div class="mobile-menu-overlay"></div>

    <div class="mobile-menu-container" style="">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>
            
            <form action="recherche.php" method="get" class="mobile-search">
                <label for="mobile-search" class="sr-only">Recherche</label>
                <input type="search" class="form-control" name="q" id="mobile-search" placeholder="Recherche..." required>
                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
            </form>

            <ul class="nav nav-pills-mobile nav-border-anim" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab" role="tab" aria-controls="mobile-menu-tab" aria-selected="true" style="color: white;">Menu</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="mobile-menu-tab" role="tabpanel" aria-labelledby="mobile-menu-link">
                    <nav class="mobile-nav">
                        <ul class="mobile-menu">
                            <li class="">
                                <a href="index.php" class="sf-with-ul"><b>Accueil</b></a>   
                            </li>
                                
<?php

    $select_grande_cat0 = $lock->query('SELECT * FROM commerce_categorie_grande ORDER BY Id ');

    $z = 0;
    while ( $select_grande_cat = $select_grande_cat0->fetch() ) {
        
        $z++;              

        echo '
                            <li class="">
                                <a href="#" onclick="menu('.$z.')" class="sf-with-ul"><b>'.$select_grande_cat['Nom'].'</b></a>   
                            </li>

        ';

        

echo '
        <div class="" id="sous_cat'.$z.'" style="position: fixed; background: white; top: 0px; left: 0px; width: 100%; height: 100%; z-index: 9995; display: none;">
            <div onclick="menu_ferme('.$z.')" id="close'.$z.'" style="text-align: right; padding-top:10px; padding-right: 10px;"><h3>x</h3></div>
                    <div style="text-align: center"><h3>'.$select_grande_cat['Nom'].'</h3></div>
                    <table class="table" style="width: 100%;">
                    ';
                                

        $select_cat0 = $lock->prepare('SELECT * FROM commerce_categorie WHERE Grande = ? ORDER BY Id ');
        $select_cat0->execute(array($select_grande_cat['Id']));

       
        while ( $select_cat = $select_cat0->fetch() ) {
                            

            echo '
                                <tr style="border-bottom-color: silver">
                                    <td style="padding: 10px 15px;"><a href="categorie.php?index='.$select_cat['Id'].'&cat='.$select_cat['Grande'].'&token='.sha1($z.time().$z).'" class="sf-with-ul"><b>'.$select_cat['Nom'].'</b></a></td>  
                                </tr>

            ';

            
        }


                echo '</table>
                    </div>';

    }


        echo '

                            <li class="">
                                <a href="contact.php" class="sf-with-ul"><b>Contact</b></a>   
                            </li>

                            <li class="">
                                <a href="#signin-modal" class="dropdown-toggle" data-toggle="modal" >Connexion</a>  
                            </li>
        ';


    if (isset($_SESSION['admin'])) {

        include_once('lien-admin-mobile.php'); 
    } 

?>                              
                                
                            
                        </ul>
                    </nav><!-- End .mobile-nav -->
                </div><!-- .End .tab-pane -->
            </div><!-- End .tab-content -->

            <div class="social-icons">
                <a href="https://www.facebook.com/profile.php?id=61559178477106&mibextid=LQQJ4d" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>

                <a href="https://wa.me/22997170427" class="social-icon" target="_blank" title="WhatsApp"><i class="icon-whatsapp"></i></a>

                <a href="tel:+22997170427" class="social-icon" target="_blank" title="Appel direct"><i class="icon-phone"></i></a>

                <a href="mailto:contact@logikom.com" class="social-icon" target="_blank" title="Message email"><i class="icon-comment-o"></i></a>
            </div>
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->

<script type="text/javascript">
    
    // $('.mobile-menu-overlay, .mobile-menu-close').on('click', function (e) {
    //     $('body').removeClass('mmenu-active');
    //     $('.menu-toggler').removeClass('active');
    //     e.preventDefault();
    // });
    function menu(i) {
        
        $('#sous_cat'+i).show();
    }

    function menu_ferme(i) {
        
        $('#sous_cat'+i).hide();
    }
</script>