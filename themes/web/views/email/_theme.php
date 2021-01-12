<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="<?= theme("/assets/styles.css") ?>"  media="screen,projection"/>
    <title><?= $title ?></title>
</head>
<body>
<table>
    <tr>
        <td>
            <div>
                <?= $v->section("content"); ?>
                <p>Atenciosamente, equipe <?= CONF_SITE_NAME; ?>.</p>
            </div>
            <div>
                <p><?= CONF_SITE_NAME; ?> - <?= CONF_SITE_TITLE; ?></p>
                <p><?= CONF_SITE_ADDR_STREET; ?>
                    , <?= CONF_SITE_ADDR_NUMBER; ?><?= (CONF_SITE_ADDR_COMPLEMENT ? ", " . CONF_SITE_ADDR_COMPLEMENT : ""); ?></p>
                <p><?= CONF_SITE_ADDR_CITY; ?>/<?= CONF_SITE_ADDR_STATE; ?> - <?= CONF_SITE_ADDR_ZIPCODE; ?></p>
            </div>
        </td>
    </tr>
</table>
<!--JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="<?= theme("/assets/scripts.js") ?>"></script>
<?= $v->section("scripts") ?>
</body>
</html>
