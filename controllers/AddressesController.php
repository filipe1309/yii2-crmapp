<?php

namespace app\controllers;

use app\utilities\SubmodelController;

/**
 * AddressesController implements the CRUD actions for AddressRecord model.
 */
class AddressesController extends SubmodelController
{
    public $recordClass = 'app\models\customer\AddressRecord';
}
