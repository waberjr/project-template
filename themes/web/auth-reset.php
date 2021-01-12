<?php $v->layout("_theme"); ?>

<div class="valign-wrapper height-100">
    <div class="row center">
        <div class="col s12">
            <div>
                <h2>Criar Nova Senha</h2>
                <p>Informe e repita uma nova senha para recuperar seu acesso.</p>
            </div>

            <form action="<?= url("/recuperar/resetar") ?>" method="post">
                <input type="hidden" name="code" value="<?= $code; ?>"/>

                <div class="row">
                    <div class="input-field col s12">
                        <label for="password">Nova Senha</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <label for="password_re">Repita a Nova Senha</label>
                        <input type="password" name="password_re" id="password_re" required>
                    </div>
                </div>

                <button class="btn col s12 bottom-space-s" name="submit" type="submit">Alterar Senha</button>
                <a href="<?= url("/") ?>">Volte a entrar</a>
            </form>
        </div>
    </div>
</div>
