<?php
/**
 * DefaultController.php
 *
 * OneScreenApp for Communecting people
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 14/03/2014
 */
class DefaultController extends NetworkController {

    
  protected function beforeAction($action)
	{
    parent::initPage();      
		return parent::beforeAction($action);
  }

  /**
   * Home page
   */
  public function actionIndex($src) 
  {
	Yii::app()->params['networkParams'] = self::getParams($src);
    $this->layout = "//layouts/mainDirectory";
    $this->render("indexDirectory", array("get"=> $src));
  }

  public function actionSimplyDirectory() 
  {
    //$params = self::getParams(@$_GET['params']);

    $this->layout = "//layouts/mainDirectory";
    $this->render("simplyDirectory");
  }

  public function actionSimplyDirectory2() 
  {
    $this->layout = "//layouts/mainDirectory";
    $this->render("dir/simplyDirectory2");
  }

  public function actionLang() 
  {
    $this->render("index");
  }

  public function actionHome() 
  {

    $params = self::getParams();

    $this->layout = "//layouts/mainDirectory";
    $this->renderPartial("home", array("params" => $params));
  }
  
  public function actionLogin() 
  {
    $this->layout = "//layouts/mainSearch";
    $this->renderPartial("login");
  }

  public function actionView($page,$dir=null,$layout=null) 
  {
    if(@$dir){
      
      if( strpos($dir,"docs") !== false )
        $dir = "../".$dir;

      if(strpos($dir,"|")){
        $dir=str_replace("|", "/", $dir);
      }
      $page = $dir."/".$page;
	
    }
    if(Yii::app()->request->isAjaxRequest || $layout=="empty"){
      $this->layout = "//layouts/empty";
      echo $this->renderPartial($page, null,true);
    }
    else {
      //$this->sidebar2 = Menu::$infoMenu;
      $this->render($page);
    }
  }
  
    public function actionSwitch($lang)
    {
        $this->layout = "//layouts/empty";
        Yii::app()->session["lang"] = $lang;
        $this->redirect(Yii::app()->createUrl("/".$this->module->id));
    }

    public function getParams($paramsGet=""){
	//   echo Yii::app()->controller->module->viewPath;
      $pathParams = Yii::app()->controller->module->viewPath.'/default/params/';
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