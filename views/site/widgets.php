<?php
use app\components\MyWidget;
?>

<h1>MyWidget using ::widget() </h1>
<?= MyWidget::widget(['message' => 'Hello friends!!!!']); ?>
