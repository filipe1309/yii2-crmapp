<?php

namespace app\models\customer;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property string $id
 * @property string $purpose
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $street
 * @property string $building
 * @property string $apartment
 * @property string $received_name
 * @property string $postal_code
 * @property int $customer_id
 *
 * @property Customer $customer
 */
class AddressRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id'], 'required'],
            [['customer_id'], 'integer'],
            [['id', 'purpose', 'country', 'state', 'city', 'street', 'building', 'apartment', 'received_name', 'postal_code'], 'string', 'max' => 255],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'purpose' => 'Purpose',
            'country' => 'Country',
            'state' => 'State',
            'city' => 'City',
            'street' => 'Street',
            'building' => 'Building',
            'apartment' => 'Apartment',
            'received_name' => 'Received Name',
            'postal_code' => 'Postal Code',
            'customer_id' => 'Customer ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
}
