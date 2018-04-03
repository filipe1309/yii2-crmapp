<?php
echo \yii\widgets\ListView::widget(
    [
        'options' => [
            
        ],
        'itemView' => '_customer',
        'dataProvider' => $records
    ]
);
