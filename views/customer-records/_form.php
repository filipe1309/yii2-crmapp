<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\customer\CustomerRecord */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="customer-record-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birth_date')->textInput() ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>
    
    <?php if (!$model->isNewRecord):?>
        <h2>Phones</h2>
        <?= \yii\grid\GridView::widget([
                'dataProvider' => new \yii\data\ActiveDataProvider([
                'query' => $model->getPhones(),
                'pagination' => false
            ]),
            'columns' => [
                'number',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'controller' => 'phones',
                    'header' => Html::a(
                        '<i class="glyphicon glyphicon-plus"></i>&nbsp;Add New',
                        ['phones/create', 'relation_id' => $model->id]
                    ),
                    'template' => '{update}{delete}',
                ],
            ]
        ]);?>
        
        <h2>Addresses</h2>
        <?= \yii\grid\GridView::widget([
                'dataProvider' => new \yii\data\ActiveDataProvider([
                'query' => $model->getAddresses(),
                'pagination' => false
            ]),
            'columns' => [
                'purpose',
                'country',
                'city',
                'received_name',
                'postal_code',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'controller' => 'addresses',
                    'header' => Html::a(
                        '<i class="glyphicon glyphicon-plus"></i>&nbsp;Add New',
                        ['addresses/create', 'relation_id' => $model->id]
                    ),
                    'template' => '{update}{delete}',
                ],
            ]
        ]);?>
        
        <h2>Emails</h2>
        <?= \yii\grid\GridView::widget([
                'dataProvider' => new \yii\data\ActiveDataProvider([
                'query' => $model->getEmails(),
                'pagination' => false
            ]),
            'columns' => [
                'address',
                'purpose',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'controller' => 'emails',
                    'header' => Html::a(
                        '<i class="glyphicon glyphicon-plus"></i>&nbsp;Add New',
                        ['emails/create', 'relation_id' => $model->id]
                    ),
                    'template' => '{update}{delete}',
                ],
            ]
        ]);?>
    <?php endif?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
