<?php
use app\components\MyWidget;
use app\components\MyWidgetBeginEnd;
?>

<h1>MyWidget using ::widget() </h1>
<?= MyWidget::widget(['message' => 'Hello friends!!!!']); ?>

<br>

<h1>MyWidgetBeginEnd using ::begin() ::end()</h1>
<tag></tag>

<?php MyWidgetBeginEnd::begin(); ?>

content that may contain <tag>'s

<?php MyWidgetBeginEnd::end(); ?>
