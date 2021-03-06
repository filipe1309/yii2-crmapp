<?php

namespace app\controllers;

use Yii;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use app\models\customer\Customer;
use app\models\customer\CustomerRecord;
use app\models\customer\Phone;
use app\models\customer\PhoneRecord;
use yii\filters\AccessControl;

class CustomersController extends Controller 
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['add'],
                        'roles' => ['manager'],
                        'allow' => true
                    ],
                    [
                        'actions' => ['index', 'query'],
                        'roles' => ['user'],
                        'allow' => true
                    ]
                ]
            ]
        ];
    }
    
    public function actionIndex() {
        $records = $this->findRecordsByQuery();
        return $this->render('index', compact('records'));
    }
    
    public function actionAdd()
    {
        $customer = new CustomerRecord;
        $phone = new PhoneRecord;
        
        if ($this->load($customer, $phone, $_POST))
        {
            $this->store($this->makeCustomer($customer, $phone));
            return $this->redirect(['index']);
        }
        
        // stateful magic: both $customer and $phone will be validated at this point
        return $this->render('add', compact('customer', 'phone'));
    }
    
    public function actionQuery() {
        return $this->render('query');
    }
    
    private function findRecordsByQuery()
    {
        $number = Yii::$app->request->get('phone_number');
        $records = $this->getRecordsByPhoneNumber($number);
        $dataProvider = $this->wrapIntoDataProvider($records);
        return $dataProvider;
    }
    
    private function getRecordsByPhoneNumber($number)
    {
        $phone_record = PhoneRecord::findOne(['number' => $number]);
        if (!$phone_record)
            return [];
        $customer_record = CustomerRecord::findOne($phone_record->customer_id);
        if (!$customer_record)
            return [];
        return [$this->makeCustomer($customer_record, $phone_record)];
    }
    
    private function wrapIntoDataProvider($data)
    {
        return new ArrayDataProvider(
            [
                'allModels' => $data,
                'pagination' => false
            ]
        );
    }
    
    private function load(CustomerRecord $customer, PhoneRecord $phone, array $post)
    {
        return $customer->load($post)
            and $phone->load($post)
            and $customer->validate()
            and $phone->validate(['number']);
    }
    
    /**
     * Convert Customer model to CustomerRecord model and save in the database
     * 
     * @param Customer $customer
     */
    private function store(Customer $customer)
    {
        $customer_record = new CustomerRecord();
        $customer_record->name = $customer->name;
        $customer_record->birth_date = $customer->birth_date->format('Y-m-d');
        $customer_record->notes = $customer->notes;
        
        $customer_record->save();
        
        foreach ($customer->phones as $phone) {
            $phone_record = new PhoneRecord;
            $phone_record->number = $phone->number;
            $phone_record->customer_id = $customer_record->id;
            $phone_record->save();
        }
    }
    
    /**
     * Convert CustomerRecord model to Customer model and return the Customer
     * 
     * @param CustomerRecord $customer_record
     * @param PhoneRecord $phone_record
     * @return Customer
     */
    private function makeCustomer(
        CustomerRecord $customer_record,
        PhoneRecord $phone_record
    )
    {
        $name = $customer_record->name;
        $birth_date = new \DateTime($customer_record->birth_date);
        
        $customer = new Customer($name, $birth_date);
        $customer->notes = $customer_record->notes;
        $customer->phones[] = new Phone($phone_record->number);
        
        return $customer;
    }
}
