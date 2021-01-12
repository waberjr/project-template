<?php $v->layout("_theme", ["title" => "Confirme e ative sua conta no ". CONF_SITE_NAME]); ?>

<h2>Seja bem-vindo(a) ao <?= CONF_SITE_NAME ?>, <?= $first_name; ?>.</h2>
<h2>Vamos confirmar seu cadastro?</h2>
<p>O seu  acesso será feito com os seguintes parâmetros: </p>
<p>Email: <b><?= $email; ?></b></p>
<p>Senha: <b><?= CONF_PASSWD_DEFAULT; ?></b> </p>
<p><a title='Confirmar Cadastro' href='<?= $login; ?>'>CLIQUE AQUI PARA CONFIRMAR</a></p>