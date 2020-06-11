<?php

namespace app\models;

use app\traits\DataTrait;
use app\components\DataBehavior;
use yii\db\ActiveRecord;

class Users extends Data
{
    use DataTrait;
    
    public $find_first_name;
    public $find_second_name;
    public $find_middle_name;
    public $find_phone;
    public $find_email;
    public $find_address;
    
    public $data_array;
    
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => DataBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => DataBehavior::getTimestamp(),
            ],
            'serialize' => [
                'class' => DataBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['data'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['data'],
                ],
                'value' => function() { return serialize($this->data_array); },
            ],
            'unserialize' => [
                'class' => DataBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => ['data_array'],
                ],
                'value' => function() { return unserialize($this->data); },
            ],
        ];
    }
    
    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'find_first_name' => 'Имя',
            'find_second_name' => 'Фамилия',
            'find_middle_name' => 'Отчество',
            'find_phone' => 'Телефон',
            'find_email' => 'Email',
            'find_address' => 'Адрес',
        ];
    }
    
    /**
     *
     */
    public function setTestData()
    {
        for($i = 1; $i <= 100; $i++) {
            
            $index = rand(2, 6);

            $row = [];
            
            $row['first_name'] = 'first_name_' . $i;
            $row['second_name'] = 'second_name_' . $i;
            if($index > 2) {
                $row['middle_name'] = 'middle_name_' . $i;
            }
            if($index > 3) {
                $row['phone'] = 'phone_' . $i;
            }
            if($index > 4) {
                $row['email'] = 'email_' . $i;
            }
            if($index > 5) {
                $row['address'] = 'address_' . $i;
            }
            
            $this->data_array[$i] = $row;
        }
    }
    
    /**
     * @param $post_users
     */
    public function loadFindData($post_users)
    {
        if(isset($post_users['find_first_name'])) {
            $this->find_first_name = $post_users['find_first_name'];
        }
        if(isset($post_users['find_second_name'])) {
            $this->find_second_name = $post_users['find_second_name'];
        }
        if(isset($post_users['find_middle_name'])) {
            $this->find_middle_name = $post_users['find_middle_name'];
        }
        if(isset($post_users['find_phone'])) {
            $this->find_phone = $post_users['find_phone'];
        }
        if(isset($post_users['find_email'])) {
            $this->find_email = $post_users['find_email'];
        }
        if(isset($post_users['find_address'])) {
            $this->find_address = $post_users['find_address'];
        }
    }
    
    /**
     *
     */
    public function findData()
    {
        $result = [];
        
        if(
            !empty($this->find_first_name) ||
            !empty($this->find_second_name) ||
            !empty($this->find_middle_name) ||
            !empty($this->find_phone) ||
            !empty($this->find_email) ||
            !empty($this->find_address)
        ) {
            
            foreach ($this->data_array as $key => $value) {
    
                $is_valid = false;
                
                if(!empty($this->find_first_name) && isset($value['first_name']) && strripos($value['first_name'], $this->find_first_name)) {
                    $is_valid = true;
                }
                if(!empty($this->find_second_name) && isset($value['second_name']) && strripos($value['second_name'], $this->find_second_name)) {
                    $is_valid = true;
                }
                if(!empty($this->find_middle_name) && isset($value['middle_name']) && strripos($value['middle_name'], $this->find_middle_name)) {
                    $is_valid = true;
                }
                if(!empty($this->find_phone) && isset($value['phone']) && strripos($value['phone'], $this->find_phone)) {
                    $is_valid = true;
                }
                if(!empty($this->find_email) && isset($value['email']) && strripos($value['email'], $this->find_email)) {
                    $is_valid = true;
                }
                if(!empty($this->find_address) && isset($value['address']) && strripos($value['address'], $this->find_address)) {
                    $is_valid = true;
                }
                
                if($is_valid) {
                    $result[$key] = $value;
                }

            }
    
            $this->data_array = $result;
        }
    }
}