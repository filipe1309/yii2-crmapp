<?php
echo \yii\widgets\ListView::widgets(
    [
        'options' => [
            
        ],
        'itemView' => '_customer',
        'dataProvider' => $records
    ]
);