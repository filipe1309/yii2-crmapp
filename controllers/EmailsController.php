<?php

namespace app\controllers;

use app\utilities\SubmodelController;

/**
 * EmailsController implements the CRUD actions for EmailRecord model.
 */
class EmailsController extends SubmodelController
{
    public $recordClass = 'app\models\customer\EmailRecord';
}
