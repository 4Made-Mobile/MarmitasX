<?php
/* @var $this yii\web\View */

$this->title = 'Galego da Marmita';
?>
<div class="site-index">

    <div class="jumbotron">
        <?php if (\Yii::$app->user->isGuest) { ?>
            <h2>Por favor. Faça o Login</h2>
            <p><a class = "btn btn-lg btn-success" href = "index.php?r=site%2Flogin">Login</a></p>
        <?php } else {
            ?>
            <h2>Bem-Vindo</h2>
        <?php }
        ?>
    </div>


</div>
</div>
