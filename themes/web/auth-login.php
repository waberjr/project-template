<?php $v->layout("_theme"); ?>

<div class="valign-wrapper height-100">
    <div class="row center">
        <div class="col l6 push-l3 m8 push-m2 s12">
            <div class="row">
                <div class="col s12">
                    <img class="responsive-img col s6 push-s3" src="<?= theme("/assets/images/logo.png") ?>" alt="salesman-logo">
                </div>
            </div>

            <form action="<?php url("/") ?>" method="post">
                <div class="row row-no-space">
                    <div class="input-field col s12">
                        <label for="email">Email*</label>
                        <input type="email" name="email" id="email" value="<?= ($cookie ?? null); ?>" required>
                    </div>
                </div>

                <a href="<?= url("/recuperar") ?>" title="Esqueceu a Senha?" class="right">Esqueceu a senha?</a>

                <div class="row">
                    <div class="input-field col s12">
                        <label for="password">Senha*</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12">
                        <label>
                            <input name="save" type="checkbox" <?= (!empty($cookie) ? "checked" : ""); ?>/>
                            <span class="left">Lembrar e-mail?</span>
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12">
                        <button class="btn col s12" type="submit">Entrar</button>
                    </div>
                </div>

                <a href="<?= url("/registrar") ?>" title="Cadastre-se!">Cadastre-se!</a>
            </form>
        </div>
    </div>
</div>

