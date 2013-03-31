<?php

/**
 * Description of Users
 *
 * @author devel
 */
class Users extends CWebUser
{
    public $groups;   
    
    
    
    public function getUserGroupById($id)
    {
        if (isset($this->groups[$id])) {
            return Yii::t('usersgroups', $this->groups[$id]);
        }
        return '';
    }
    
    
}


