<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id_users
 * @property string $login
 * @property string $password
 * @property integer $active
 * @property integer $id_users_groups
 */
class Users extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('login, password, active, id_users_groups', 'required'),
            array('active, id_users_groups', 'numerical', 'integerOnly'=>true),
            array('login', 'length', 'max'=>100),
            array('password', 'length', 'max'=>50),
            array('id_users_groups', 'in', 'range' => array_keys(Users::UsersGroup())),
			array('active', 'in', 'range' => array_keys(Users::GetActive())),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_users, login, password, active, id_users_groups', 'safe', 'on'=>'search'),
            array('login', 'match', 'pattern' => "/^[A-Za-z0-9_]+$/", 'message'=> Yii::t('admin', 'Логин должен содержать только латинские буквы или цифры.')),
            array('login', 'length', 'min'=>4),
            array('login', 'unique'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_users'        => Yii::t('users','ID'),
            'login'           => Yii::t('users','Логин'),
            'password'        => Yii::t('users','Пароль'),
            'active'          => Yii::t('users','Статус'),
            'id_users_groups' => Yii::t('users','Группа доступа'),
        );
    }

    protected function beforeSave()
    {
        parent::beforeSave();
        
        if($this->password){
            $this->password = Users::cryptPassword($this->password);
        }
        return true;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->alias = 'u';

        
        $criteria->compare('u.login', trim($this->login), true);
        $criteria->compare('u.active', $this->active);
        $criteria->compare('u.id_users_groups', $this->id_users_groups);
        
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => 'u.id_users_groups ASC',
            ),
        ));
    }

    public function GetActive($id=null)
    {
        $arr = Array(
            0 =>  Yii::t('users', 'Не активен'),
            1 =>  Yii::t('users', 'Активен')
        );
        return ($id != null) ? $arr[$id] : $arr;
    }


    public function UsersGroup($id=null)
    {
        $arr = Array(
            1 =>  Yii::t('users', 'Администратор'),
        );
        return ($id != null) ? $arr[$id] : $arr;
    }
    
    public function cryptPassword($password)
    {
        //return password_hash($password, PASSWORD_ARGON2I);
        return md5($password);
    }
    
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Users the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
