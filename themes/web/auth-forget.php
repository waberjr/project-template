<?php $v->layout("_theme"); ?>

<div class="valign-wrapper height-100">
    <div class="row center">
        <div class="col l12">
            <div class="row">
                <div class="col s12">
                    <h2>Recuperar Senha</h2>
                    <p>Informe seu e-mail para receber um link de recuperação.</p>
                </div>
            </div>

            <form action="<?php url("/recuperar") ?>" method="post">
                <div class="row">
                    <div class="input-field col s12">
                        <label for="email">Email*</label>
                        <input type="email" name="email" id="email" value="<?= ($email ?? null); ?>" required>
                    </div>
                </div>

                <button class="btn col s12 bottom-space-s" type="submit">Enviar</button>
                <a href="<?= url("/") ?>">Volte a entrar</a>
            </form>
        </div>
    </div>
</div>

