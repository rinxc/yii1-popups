<?php

/**
 * This is the model class for table "admin_users".
 *
 * The followings are the available columns in table 'admin_users':
 * @property integer $id_admin_users
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property integer $id_admin_organization
 * @property string $department
 * @property string $post
 * @property string $login
 * @property string $password
 * @property boolean $active
 * @property boolean $del_status
 *
 * The followings are the available model relations:
 * @property AdminUsersRoles[] $adminUsersRoles
 * @property AdminOrganization $idAdminOrganization
 */
class AdminUsers extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'admin_users';
    }
    
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_admin_organization, name, surname, login, password, id_admin_users_subsystem', 'required'),
            array('id_admin_organization, active, del_status, only_view, forbid_personal_data, id_admin_users_subsystem, admin_user', 'numerical', 'integerOnly'=>true),
            array('name, surname, patronymic, post, login, password', 'length', 'max'=>50),
            array('only_view, forbid_personal_data', 'length', 'min'=>1),
            array('password', 'length', 'min'=>5),
            //array('login', 'unique'),
            array('login', 'uniqueLogin'),
            array('login', 'match', 'pattern' => "/^[A-Za-z0-9_]+$/", 'message'=> Yii::t('admin', 'Логин должен содержать только латинские буквы или цифры.')),
            array('login', 'length', 'min'=>4),
            array('department', 'length', 'max'=>100),
            array('del_status, only_view, forbid_personal_data', 'default', 'value' => 0),
            array('del_status', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_admin_users, name, surname, patronymic, id_admin_organization, filter_settings, admin_user, department, post, login, password, active, only_view, forbid_personal_data, del_status', 'safe', 'on'=>'search'),
        );
    }
    
    public function uniqueLogin($attribute,$params=array())
    {
        if(!$this->hasErrors())
        {
            $params['criteria']=array(
                'condition'=>'login=:login',
                'params'=>array(':login' => $this->login),
            );
            $validator=CValidator::createValidator('unique',$this,$attribute,$params);
            $validator->validate($this,array($attribute));
        }
    }
    
    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            //'AdminUsersRoles' => array(self::HAS_MANY, 'AdminUsersRoles', 'id_admin_users', 'alias'=>'aur'),
            'AdminOrganization' => array(self::BELONGS_TO, 'AdminOrganization', 'id_admin_organization', 'alias'=>'ao'),
            'AdminUsersSubsystem' => array(self::BELONGS_TO, 'AdminUsersSubsystem', 'id_admin_users_subsystem', 'alias'=>'aus'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_admin_users'            => Yii::t('admin', 'ID'),
            'name'                      => Yii::t('admin', 'Имя'),
            'surname'                   => Yii::t('admin', 'Фамилия'),
            'patronymic'                => Yii::t('admin', 'Отчество'),
            'id_admin_organization'     => Yii::t('admin', 'Организация'),
            'id_admin_users_subsystem'  => Yii::t('admin', 'Уровень доступа'),
            'department'                => Yii::t('admin', 'Отдел'),
            'post'                      => Yii::t('admin', 'Должность'),
            'login'                     =>  Yii::t('admin', 'Логин'),
            'password'                  =>  Yii::t('admin', 'Пароль'),
            'active'                    =>  Yii::t('admin', 'Состояние'), // состояние активен, отключен
            'only_view'                 =>  Yii::t('admin', 'Только просмотр'), // Запрещено редактирование
            'forbid_personal_data'      =>  Yii::t('admin', 'Не отображать личные данные пациента'), // Запрещено редактирование
            'del_status'                =>  Yii::t('admin', 'Удален'), // 0 - нет, 1 - удалён
            'filter_settings'           =>  Yii::t('admin', 'Настройки фильтра'), 
            'admin_user'                =>  Yii::t('admin', 'Администратор системы'), 
        );
    }
    protected function afterFind()
    {
        parent::afterFind();
        
        return true;
    }
    
    
    protected function beforeSave()
    {
        if($this->isNewRecord){
           // $this->id_admin_users = Yii::app()->user->attribute['id_admin_users'];
             $this->date_reg = Helpers::getDateTime($this->date_reg,1);
        }else{
            unset($this->date_reg);
        }
        
        parent::beforeSave();
        
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
        $criteria->alias = 'au';
        $criteria->together = true;
        
        $criteria->with = array(
            'AdminOrganization',
            'AdminUsersSubsystem'
        );
        
        $criteria->addCondition('au.del_status=0');
        
        $criteria->compare('au.id_admin_users_subsystem', $this->id_admin_users_subsystem);
        $criteria->compare('au.login', trim($this->login), true);
        $criteria->compare('au.name', trim($this->name),true);
        $criteria->compare('au.surname', trim($this->surname),true);
        $criteria->compare('au.patronymic', trim($this->patronymic),true);
        $criteria->compare('au.admin_user', trim($this->admin_user));
        $criteria->compare('au.id_admin_organization', $this->id_admin_organization);
        $criteria->compare('au.active', $this->active);
        
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => 'au.date_reg DESC',
            ),
            'pagination'=>($_GET['itemsCount'] == 'all') ? false : (array('pageSize'=> ($_GET['itemsCount'] > 0) ? intval($_GET['itemsCount']) : Yii::app()->params['pageSize'])),
        ));
    }
    
    
    public static function GetItem($id)
    {
        if(empty($id)){
            return false;
        }
        
        $criteria = new CDbCriteria();
        
        $criteria->addCondition("au.id_admin_users=".$id);
        
        $criteria->alias = 'au';
        $criteria->together = true;
        
        $criteria->with = array(
            'AdminOrganization' => Array(
                'with' => Array('AdminSubsystem'),
            ),
        );
        return AdminUsers::model()->find($criteria);
    }
    
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
    
    
    public static function GetActive($id='all')
    {
        $arr = Array(
            1 =>  Yii::t('admin', 'Активен'),
            0 =>  Yii::t('admin', 'Не активен')
        );
        
        if($id != 'all' or $id === 0 or $id > 0){
            return '<span class="label label-'. (($id == 0) ? 'danger' : 'success').'">' . $arr[$id]. '</span>';
        }else{
            return $arr;
        }
    }
    
    
    public static function GetFIO($model){
        return Helpers::CImplode(Array(
                    $model->surname,
                    (($model->name != "") ? mb_substr($model->name, 0, 1, "UTF-8")."." : ""),
                    (($model->patronymic != "") ? mb_substr($model->patronymic, 0, 1, "UTF-8")."." : ""),
                    (($model->login != "") ? " (". $model->login.")" : ""),
                ), " ");
    }
}
