<?php

namespace app\models;

use app\traits\DataTrait;
use app\components\DataBehavior;
use yii\db\ActiveRecord;

class Books extends Data
{
    use DataTrait;
    
    public $find_name;
    public $find_author;
    public $find_publication_date;
    
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
            'find_name' => 'Наименование',
            'find_author' => 'Автор',
            'find_publication_date' => 'Дата публикации',
        ];
    }
    
    /**
     *
     */
    public function setTestData()
    {
        for($i = 1; $i <= 100; $i++) {
    
            $index = rand(2, 3);
    
            $row = [];
            
            $row['name'] = 'name_' . $i;
            $row['author'] = 'author_' . $i;
            if($index > 2) {
                $row['publication_date'] = 'publication_date_' . $i;
            }
    
            $this->data_array[$i] = $row;
        }
    }
    
    /**
     * @param $post_books
     */
    public function loadFindData($post_books)
    {
        if(isset($post_books['find_name'])) {
            $this->find_name = $post_books['find_name'];
        }
        if(isset($post_books['find_author'])) {
            $this->find_author = $post_books['find_author'];
        }
        if(isset($post_books['find_publication_date'])) {
            $this->find_publication_date = $post_books['find_publication_date'];
        }
    }
    
    /**
     *
     */
    public function findData()
    {
        $result = [];
        
        if(
            !empty($this->find_name) ||
            !empty($this->find_author) ||
            !empty($this->find_publication_date)
        ) {
            
            foreach ($this->data_array as $key => $value) {
                
                $is_valid = false;
                
                if(!empty($this->find_name) && isset($value['name']) && strripos($value['name'], $this->find_name)) {
                    $is_valid = true;
                }
                if(!empty($this->find_author) && isset($value['author']) && strripos($value['author'], $this->find_author)) {
                    $is_valid = true;
                }
                if(!empty($this->find_publication_date) && isset($value['publication_date']) && strripos($value['publication_date'], $this->find_publication_date)) {
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