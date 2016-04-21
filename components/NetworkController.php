<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class NetworkController extends Controller
{
  public $version = "v0.098";
  public $versionDate = "13/04/2016 08:00";
  public $title = "Network";
  public $subTitle = "se connecter à sa commune";
  public $pageTitle = "Network, se connecter à sa commune";
  public static $moduleKey = "network";
  public $keywords = "connecter, réseau, sociétal, citoyen, société, regrouper, commune, network, social";
  public $description = "Network : Connecter a sa commune, reseau societal, le citoyen au centre de la société.";
  public $projectName = "";
  public $projectImage = "/images/CTK.png";
  public $projectImageL = "/images/logo.png";
  public $footerImages = array(
      array("img"=>"/images/logoORD.PNG","url"=>"http://openrd.io"),
      array("img"=>"/images/logo_region_reunion.png","url"=>"http://www.regionreunion.com"),
      array("img"=>"/images/technopole.jpg","url"=>"http://technopole-reunion.com"),
      array("img"=>"/images/Logo_Licence_Ouverte_noir_avec_texte.gif","url"=>"https://data.gouv.fr"),
      array("img"=>'/images/blog-github.png',"url"=>"https://github.com/orgs/pixelhumain/dashboard"),
      array("img"=>'/images/opensource.gif',"url"=>"http://opensource.org/"));
  const theme = "ph-dori";
  public $person = null;
  public $themeStyle = "theme-style11";//3,4,5,7,9
  public $notifications = array();
  //TODO - Faire le tri des liens
  //TODO - Les children ne s'affichent pas dans le menu
  public $toolbarMenuAdd = array(
     array('label' => "My Network", "key"=>"myNetwork",
            "children"=> array(
              //"myaccount" => array( "label"=>"My Account","key"=>"newContributor", "class"=>"new-contributor", "href" => "#newContributor", "iconStack"=> array("fa fa-user fa-stack-1x fa-lg","fa fa-pencil fa-stack-1x stack-right-bottom text-danger")),
              "showContributors" => array( "label"=>"Find People","class"=>"show-contributor","key"=>"showContributors", "href" => "#showContributors", "iconStack"=> array("fa fa-user fa-stack-1x fa-lg","fa fa-search fa-stack-1x stack-right-bottom text-danger")),
              "newInvite" => array( "label"=>"Invite Someone","key"=>"invitePerson", "class"=>"ajaxSV", "onclick" => "", "iconStack"=> array("fa fa-user fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
            )
          ),
    array('label' => "Organisation", "key"=>"organization",
            "children"=> array(
              "addOrganization" => array( "label"=>"Add an Organisation","key"=>"addOrganization", "class"=>"ajaxSV", "onclick"=>"", "iconStack"=> array("fa fa-group fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger"))
            )
          ),
    array('label' => "News", "key"=>"note",
                "children"=> array(
                  "createNews"  => array( "label"=>"Create news", "key"=>"new-news",   "class"=>"new-news", "iconStack"=> array("fa fa-bullhorn fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
                  //"newsStream"  => array( "label"=>"News stream", "key"=>"newsstream", "class"=>"ajaxSV", "onclick"=>"openSubView('News stream', '/network/news/newsstream', null)", "iconStack"=> array("fa fa-list fa-stack-1x fa-lg","fa fa-search fa-stack-1x stack-right-bottom text-danger")),
                  //"newNote"   => array( "label"=>"Add new note",  "class"=>"new-note",    "key"=>"newNote",  "href" => "#newNote",  "iconStack"=> array("fa fa-list fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
                 // "readNote"  => array( "label"=>"Read All notes","class"=>"read-all-notes","key"=>"readNote", "href" => "#readNote", "iconStack"=> array("fa fa-list fa-stack-1x fa-lg","fa fa-share fa-stack-1x stack-right-bottom text-danger")),
                )
          ),
     array('label' => "Event", "key"=>"event",
                "children"=> array(
                  "newEvent" => array( "label"=>"Add new event","key"=>"newEvent",  "class"=>"init-event", "href" => "#newEvent", "iconStack"=> array("fa fa-calendar-o fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
                  "showCalendar" => array( "label"=>"Show calendar","class"=>"show-calendar","key"=>"showCalendar", "href" => "/ph/network/event/calendarview", "iconStack"=> array("fa fa-calendar-o fa-stack-1x fa-lg","fa fa-share fa-stack-1x stack-right-bottom text-danger")),
                )
          ),
     array('label' => "Projects", "key"=>"projects",
                "children"=> array(
                  "newProject" => array( "label"=>"Add new Project","key"=>"newProject", "class"=>"new-project", "href" => "#newProject", "iconStack"=> array("fa fa-cogs fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
                  )
          ),
     array('label' => "Rooms", "key"=>"rooms",
                "children"=> array(
                  "newRoom" => array( "label"=>"Add new Room","key"=>"newRoom", "class"=>"ajaxSV", "onclick"=>"", "iconStack"=> array("fa fa-comments fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
                  )
          )
  );
  public $subviews = array(
    //"news.newsSV",
    //"person.invite",
    //"event.addAttendeesSV"
  );
  public $pages = array(
    
    "default" => array(
      "index"               => array("href" => "/ph/network/default/index", "public" => true),
      "directory"             => array("href" => "/ph/network/default/directory", "public" => true),
      "dir"                  => array("href" => "/ph/network/default/dir", "public" => true),
      "simplydirectory"       => array("href" => "/ph/network/default/simplydirectory", "public" => true),
      "simplydirectory2"       => array("href" => "/ph/network/default/simplydirectory2", "public" => true),
      "agenda"                => array("href" => "/ph/network/default/agenda", "public" => true),
      "news"                  => array("href" => "/ph/network/default/news", "public" => true),
      "home"                  => array("href" => "/ph/network/default/home", "public" => true),
      "add"                   => array("href" => "/ph/network/default/add"),
      "view"                  => array("href" => "/ph/network/default/view", "public" => true),
      "twostepregister"       => array("href" => "/ph/network/default/twostepregister"),
      "switch"               => array("href" => "/ph/network/default/switch"),
    ),
    
    "person"=> array(
        
        "detail"          => array("href" => "/ph/network/person/detail", "public" => true),

    ),
    "organization"=> array(
      "detail"              => array("href"=>"/ph/network/organization/detail", "public" => true),
      "simply"              => array("href"=>"/ph/network/organization/detail", "public" => true),
    ),
    "event"=> array(
      "detail"          => array("href" => "/ph/network/event/detail", "public" => true),
    ),
    "project"=> array(
      "detail"          => array("href" => "/ph/network/project/detail", "public" => true),
      "simply"          => array("href" => "/ph/network/project/detail", "public" => true),
    ),
    
    "document" => array(
      "resized"             => array("href"=> "/ph/network/document/resized", "public" => true),
      "list"                => array("href"=> "/ph/network/document/list"),
      "save"                => array("href"=> "/ph/network/document/save"),
      "deleteDocumentById"  => array("href"=> "/ph/network/document/deleteDocumentById"),
      "removeAndBacktract"  => array("href"=> "/ph/network/document/removeAndBacktract"),
      "getlistbyid"         => array("href"=> "ph/network/document/getlistbyid"),
      "upload"              => array("href"=> "ph/network/document/upload"),
      "delete"              => array("href"=> "ph/network/document/delete")
    ),
    "log"=> array(
      "monitoring" => array("href" => "/ph/network/log/monitoring"),
    ),
    "directory"=> array(
      "simply" => array("href" => "/ph/network/directory/simply"),
    )
  );
  function initPage(){
    
    //managed public and private sections through a url manager
    if( Yii::app()->controller->id == "admin" && !Yii::app()->session[ "userIsAdmin" ] )
      throw new CHttpException(403,Yii::t('error','Unauthorized Access.'));
    $page = $this->pages[Yii::app()->controller->id][Yii::app()->controller->action->id];
    $pagesWithoutLogin = array(
                            //Login Page
                            "person/login", 
                            "person/register", 
                            "person/authenticate", 
                            "person/activate", 
                            "person/sendemail",
                            "person/checkusername",
                            //Document Resizer
                            "document/resized");
    
    $prepareData = true;
    //if (true)//(isset($_SERVER["HTTP_ORIGIN"]) )//&& $_SERVER["REMOTE_ADDR"] == "52.30.32.155" ) //this is an outside call 
    //{ 
      //$host = "meteor.network.org";
      //if (strpos("http://".$host, $_SERVER["HTTP_ORIGIN"]) >= 0 || strpos("https://".$host, $_SERVER["HTTP_ORIGIN"]) >= 0 ){
    if( isset( $_POST["X-Auth-Token"]) && Authorisation::isMeteorConnected( $_POST["X-Auth-Token"] ) ){
      $prepareData = false;
    }
      //} 
    //}
    else if( (!isset( $page["public"] ) )
      && !in_array(Yii::app()->controller->id."/".Yii::app()->controller->action->id, $pagesWithoutLogin)
      && !Yii::app()->session[ "userId" ] )
    {
        Yii::app()->session["requestedUrl"] = Yii::app()->request->url;
        /*if( Yii::app()->request->isAjaxRequest){
          echo "<script type='text/javascript'> loadByHash('#panel.box-login'); </script>";*/
          /*$this->layout = '';
          Rest::json( array("action"=>"loadByHash('#panel.box-login')", "msg"=>"this page is not public, please log in first."  ) );*/
        /*}
        else
          $this->redirect(Yii::app()->createUrl("/".$this->module->id."#panel.box-login"));*/
    }
    if( isset( $_GET["backUrl"] ) )
      Yii::app()->session["requestedUrl"] = $_GET["backUrl"];
    /*if( !isset(Yii::app()->session['logguedIntoApp']) || Yii::app()->session['logguedIntoApp'] != $this->module->id)
      $this->redirect(Yii::app()->createUrl("/".$this->module->id."/person/logout"));*/
    if( $prepareData )
    {
      $this->sidebar1 = array_merge( Menu::menuItems(), $this->sidebar1 );
      $this->person = Person::getPersonMap(Yii::app() ->session["userId"]);
      $this->title = (isset($page["title"])) ? $page["title"] : $this->title;
      $this->subTitle = (isset($page["subTitle"])) ? $page["subTitle"] : $this->subTitle;
      $this->pageTitle = (isset($page["pageTitle"])) ? $page["pageTitle"] : $this->pageTitle;
      $this->notifications = ActivityStream::getNotifications( array( "notify.id" => Yii::app()->session["userId"] ) );
      CornerDev::addWorkLog("network","you@dev.com",Yii::app()->controller->id,Yii::app()->controller->action->id);
    }
  }
  protected function beforeAction($action){
    if( $_SERVER['SERVER_NAME'] == "127.0.0.1" || $_SERVER['SERVER_NAME'] == "localhost" ){
      Yii::app()->assetManager->forceCopy = true;
    }

    $this->manageLog();

    return parent::beforeAction($action);
  }


  protected function afterAction($action){
    return parent::afterAction($action);
  }

  /**
   * Start the log process
   * Bring back log parameters, then set object before action and save it if there is no return
   * If there is return, the method save in session the log object which will be finished and save in db during the method afteraction
   */
  protected function manageLog(){
    //Bring back logs needed
    $actionsToLog = Log::getActionsToLog();
    $actionInProcess = Yii::app()->controller->id.'/'.Yii::app()->controller->action->id;

    //Start logs if necessary
    if(isset($actionsToLog[$actionInProcess])) {

      //To let several actions log in the same time
      if(!$actionsToLog[$actionInProcess]['waitForResult']){
        Log::save(Log::setLogBeforeAction($actionInProcess));
      }else if(isset(Yii::app()->session["logsInProcess"]) && is_array(Yii::app()->session["logsInProcess"])){
        Yii::app()->session["logsInProcess"] = array_merge(
          Yii::app()->session["logsInProcess"],
          array($actionInProcess => Log::setLogBeforeAction($actionInProcess))
        );
      }//just on action logging
      else{
         Yii::app()->session["logsInProcess"] = array($actionInProcess => Log::setLogBeforeAction($actionInProcess));
      }
    }
  }
}
