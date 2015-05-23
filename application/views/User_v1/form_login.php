<div class="row-fluid">
    <h1 class="hcenter">Bienvenue</h1>
</div>
<br />
<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-md-6">
            <div class="panel panel-default panel-home">
                <div class="panel-heading">
                    <h4>Vous n'etes pas encore inscrit ?</h4>
                </div>
                <div class="panel-body">
                    <p class="block-noir"></p>
                    <p class="block-noir"></p>
                    <p class="block-noir"></p>
                    <p class="block-noir"></p>
                    <br />
                    <p class="hcenter">
                        <a href="<?php echo $form_inscription_uri; ?>">
                            <button class="btn btn-primary">S'inscrire</button>
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default panel-home">
                <div class="panel-heading">
                    <h4>Connectez-vous</h4>
                </div>
                <div class="panel-body">
                    <form action="<?php echo $form_connexion_uri; ?>" method="POST" class="formHome">
                        <br />
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" id="password" name="password" class="form-control" />
                        </div>
                        <br />
                        <div class="hcenter">
                        <button type="submit" class="btn btn-primary">Valider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


