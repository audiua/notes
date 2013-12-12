<?php 
class WebUser extends CWebUser {
    private $_model = null;
 
    function getRole() {
        if($author = $this->getModel()){
            // в таблице User есть поле role
            return $author->role;
        }
    }
 
    private function getModel(){
        if (!$this->isGuest && $this->_model === null){
            $this->_model = Author::model()->findByPk($this->id, array('select' => 'role'));
        }
        return $this->_model;
    }
}