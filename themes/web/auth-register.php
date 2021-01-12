<?php $v->layout("_theme"); ?>

<div class="valign-wrapper height-100">
    <div class="row center">
        <div class="col l12 top-space-s">
            <div class="row">
                <div class="col s12">
                    <h2>Cadastrar Conta</h2>
                </div>
            </div>

            <form action="<?php url("/registrar") ?>" method="post">
                <div class="row row-no-space">
                    <div class="input-field col m6 s12">
                        <label for="first_name">Nome*</label>
                        <input type="text" name="first_name" id="first_name" required>
                    </div>

                    <div class="input-field col m6 s12">
                        <label for="last_name">Sobrenome</label>
                        <input type="text" name="last_name" id="last_name" required>
                    </div>
                </div>

                <div class="row row-no-space">
                    <div class="input-field col s12">
                        <label for="email">Email*</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <label for="password">Senha*</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12">
                        <button class="btn col s12" type="submit">Entrar</button>
                    </div>
                </div>

                <a href="<?= url("/") ?>" title="Volte a entrar!">Volte a entrar!</a>
            </form>
        </div>
    </div>
</div>
