<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{    
    /**
     * authenticate
     *
     * @return void
     */
    public function authenticate()
    {
        $Users = Users::model()->find("login=:login and active=1", array(":login"=>$this->username));
        
        if($Users->login != $this->username){
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        }else if($Users->password != Users::cryptPassword($this->password)){
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        }else{
            $this->errorCode=self::ERROR_NONE;
            
            $attributeArr = Array();
            $attribute = $Users->attributeLabels();
            foreach($attribute as $id => $name){
                $attributeArr[$id] = $Users->$id;
            }
            unset($attributeArr['password']);
            $this->setState('attribute', $attributeArr);
        }
        
        return !$this->errorCode;
       // return 1;
    }
    
}