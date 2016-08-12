<?php
/**
 * Network Module
 *
 * @author Tibor Katelbach <oceatoon@mail.com>
 * @version 0.0.3
 * 
*/

class NetworkModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application
		
		Yii::app()->setComponents(array(
		    'errorHandler'=>array(
		        'errorAction'=>'/'.$this->id.'/error'
		    )
		));
		
		Yii::app()->homeUrl = Yii::app()->createUrl($this->id);
		Yii::app()->theme  = "ph-dori";
		Yii::app()->language = (isset(Yii::app()->session["lang"])) ? Yii::app()->session["lang"] : 'fr';
		Yii::app()->params['networkParams'] = self::getParams(Yii::app()->params['networkParams']);
		// import the module-level models and components
		$this->setImport(array(
			'citizenToolKit.models.*',
			$this->id.'.models.*',
			$this->id.'.components.*',
			$this->id.'.messages.*',
		));
		/*$this->components =  array(
            'class'=>'CPhpMessageSource',
            'basePath'=>'/messages'
        );*/
	}

	public function beforeControllerAction($controller, $action)
	{
		if (parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
	private $_assetsUrl;

	public function getAssetsUrl()
	{
		if ($this->_assetsUrl === null)
	        $this->_assetsUrl = Yii::app()->getAssetManager()->publish(
	            Yii::getPathOfAlias($this->id.'.assets') );
	    return $this->_assetsUrl;
	}
	public function getParams($paramsGet=""){
	//	echo 	Yii::app()->controller->module->viewPath;
      //$pathParams = Yii->controller->module->viewPath.'/default/params/';
      $pathParams = Yii::app()->controller->module->viewPath.'/modules/network/views/default/params/';
      if(isset($paramsGet) && !empty($paramsGet) && is_file($pathParams.$paramsGet.'.json')){
        $json = file_get_contents($pathParams.$paramsGet.'.json');
        $params = json_decode($json, true);
      }
      else{
        $json = file_get_contents($pathParams."default.json");
        $params = json_decode($json, true);
      }
      return $params;
    }

}
