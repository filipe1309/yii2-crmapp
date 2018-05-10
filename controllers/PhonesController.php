<?php

namespace app\controllers;

use app\utilities\SubmodelController;

/**
 * PhonesController implements the CRUD actions for PhoneRecord model.
 */
class PhonesController extends SubmodelController
{
    public $recordClass = 'app\models\customer\PhoneRecord';
    public $relationAttribute = 'customer_id';
}
