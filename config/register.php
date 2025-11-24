

<!-- Sign in / Register Modal -->
    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill nav-border-anim" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Connexion</a>
                                </li>
<?php 

    if (isset($_SESSION['role']) AND $_SESSION['role'] == 1 ) {


            echo '

                                <li class="nav-item">
                                    <a class="nav-link" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Inscription</a>
                                </li>';
    }

?>
                                
                            </ul>
                            <div class="tab-content" id="tab-content-5">


                                <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
<?php 

    if (!isset($_SESSION['admin'])) {

        echo '
                                    <form action="" id="form_register" autocomplete="off">
                                        <div class="form-group">
                                            <label for="singin-email">Adresse email *</label>
                                            <input type="email" class="form-control" id="admin_user" name="singin-email" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="singin-password">Mot de passe *</label>
                                            <input type="password" class="form-control" id="password" name="singin-password" required>
                                        </div>

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>Connecter</span>

                                                <i class="icon-long-arrow-right" id="connecter_fleche"></i> 
                                                <span class="spinner-grow" id="connexion_en_cours" style="display: none;"> </span>

                                            </button>
                                        </div>

                                        <div style="text-align: center;"> <br> <a href="" id="lien_passe_oublie" style="color: #0b577ded;" > <b>Mot de passe oublié ?</b> </a> </div>
                                    </form>



                                    <form action="" id="form_mot_passe" style="display: none;">
                                        <div class="form-group">
                                            <label for="singin-email">Adresse email *</label>
                                            <input type="email" class="form-control" id="adresse_oublie_user" name="singin-email" required>
                                        </div>

                                        <div class="form-footer">
                                            <button type="submit" id="btn_form_mot_passe" class="btn btn-outline-primary-2">
                                                <span>Vérifié</span>

                                                <i class="icon-long-arrow-right" id="connecter_fleche"></i> 
                                                <span class="spinner-grow" id="connexion_en_cours" style="display: none;"> </span>

                                            </button>
                                        </div>

                                        <div style="text-align: center;"> <br> <a href="" id="lien_connexion" style="color: #0b577ded;" > <b>Déjà un compte ?</b> </a> </div>

                                    </form>



                                    <form action="" id="form_confimartion_mot_passe" autocomplete="off" style="display: none;">
                                        <div class="form-group">
                                            <label for="singin-email">Nouveau mot de passe *</label>
                                            <input type="text" class="form-control" id="new_password" name="" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="singin-email">Code de confirmation *</label>
                                            <input type="number" class="form-control" id="code_confirmation" name="" required>
                                        </div>

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>Valider</span>

                                                <i class="icon-long-arrow-right" id="connecter_fleche"></i> 
                                                <span class="spinner-grow" id="connexion_en_cours" style="display: none;"> </span>

                                            </button>
                                        </div>

                                    </form>

        ';
    }else {

        echo '
                <div class="form-footer">
                    <button class="btn btn-primary"  id="form_register_deconnecter">
                        <span>Déconnecter</span>
                        <i class="icon-long-arrow-left"></i>
                    </button>
                </div>
        ';
    }  


?>                                    
                                </div>

<?php 

    if (isset($_SESSION['role']) AND $_SESSION['role'] == 1 ) {


            echo '
                            <div class="tab-pane fade show" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                
                                    <form action="" id="form_inscription" autocomplete="off">
                                        <div class="form-group">
                                            <label for="nom_user">Nom *</label>
                                            <input type="text" class="form-control" id="nom_user" name="nom_user" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="prenom_user">Prénoms *</label>
                                            <input type="text" class="form-control" id="prenom_user" name="prenom_user" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="email_user">Adresse email *</label>
                                            <input type="email" class="form-control" id="email_user" name="email_user" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="pass_user">Mot de passe *</label>
                                            <input type="text" class="form-control" id="pass_user" name="pass_user" required>
                                        </div>

                                        <div class="form-footer">

                                            <button type="submit" class="btn btn-outline-primary-2" id="inscription_valider">
                                                <span>Valider</span>
                                                <i class="icon-long-arrow-right" id="connecter_fleche"></i> 
                                            </button>

                                            <button class="btn btn-outline-primary-2" id="inscription_en_cours" style="display: none;">
                                                <span>Valider</span>
                
                                                <span class="spinner-grow"  > </span>
                                            </button>
                                        </div>
                                    </form>


                            </div> ';
}

?>   
                        </div><!-- End .form-tab -->
                    </div><!-- End .form-box -->
                </div><!-- End .modal-body -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </div><!-- End .modal -->
