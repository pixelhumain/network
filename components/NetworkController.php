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
  public $subTitle = "Annuaire";
  public $pageTitle = "Network, Annuaire";
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
      "simplydirectory"       => array("href" => "/ph/network/default/simplyDirectory", "public" => true),
      "simplydirectory2"       => array("href" => "/ph/network/default/simplyDirectory2", "public" => true),
      "directory2"       => array("href" => "/ph/network/default/directory2", "public" => true),
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
	"element"=> array(
      "detail"          => array("href" => "/ph/network/element/detail", "public" => true),
      "getalllinks"     => array("href" => "/ph/network/element/getalllinks"),
      "simply"          => array("href" => "/ph/network/element/simply", "public" => true),
       "directory"       => array("href" => "/ph/network/element/directory", "public" => true),
      "directory2"       => array("href" => "/ph/network/element/directory2", "public" => true),
    ),
    "gantt"=> array(
      "index"            => array("href" => "/ph/network/gantt/index", "public" => true),
      "savetask"         => array("href" => "/ph/network/gantt/savetask"),
      "removetask"       => array("href" => "/ph/network/gantt/removetask"),
      "generatetimeline" => array("href" => "/ph/network/gantt/generatetimeline"),
      "addtimesheetsv"   => array("href" => "/ph/network/gantt/addtimesheetsv"),
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
    "notification"=> array(
      "getnotifications"          => array("href" => "/ph/network/notification/get"),
      "marknotificationasread"    => array("href" => "/ph/network/notification/remove"),
      "markallnotificationasread" => array("href" => "/ph/network/notification/removeall"),
    ),
    "city"=> array(
      "index"               => array("href" => "/ph/network/city/index", "public" => true),
      "detail"              => array("href" => "/ph/network/city/detail", "public" => true),
      "dashboard"           => array("href" => "/ph/network/city/dashboard", "public" => true), 
      "directory"           => array("href" => "/ph/network/city/directory", "public" => true, "title"=>"City Directory", "subTitle"=>"Find Local Actors and Actions : People, Organizations, Events"),
      'statisticpopulation' => array("href" => "/ph/network/city/statisticpopulation", "public" => true),
      'getcitydata'         => array("href" => "/ph/network/city/getcitydata", "public" => true),
      'getcityjsondata'     => array("href" => "/ph/network/city/getcityjsondata", "public" => true),
      'statisticcity'       => array("href" => "/ph/network/city/statisticcity", "public" => true),
      'getcitiesdata'       => array("href" => "/ph/network/city/getcitiesdata"),
      'opendata'            => array("href" => "/ph/network/city/opendata","public" => true),
      'getoptiondata'       => array("href" => "/ph/network/city/getoptiondata"),
      'getlistoption'       => array("href" => "/ph/network/city/getlistoption"),
      'getpodopendata'      => array("href" => "/ph/network/city/getpodopendata"),
      'addpodopendata'      => array("href" => "/ph/network/city/addpodopendata"),
      'getlistcities'       => array("href" => "/ph/network/city/getlistcities"),
      'creategraph'         => array("href" => "/ph/network/city/creategraph"),
      'graphcity'           => array("href" => "/ph/network/city/graphcity"),
      'updatecitiesgeoformat' => array("href" => "/ph/network/city/updatecitiesgeoformat","public" => true),
      'getinfoadressbyinsee'  => array("href" => "/ph/network/city/getinfoadressbyinsee"),
    ),
    "news"=> array(
      "index"   => array( "href" => "/ph/network/news/index", "public" => true,'title' => "Fil d'actualités - N.E.W.S", "subTitle"=>"Nord.Est.West.Sud","pageTitle"=>"Fil d'actualités - N.E.W.S"),
      "latest"  => array( "href" => "/ph/network/news/latest"),
      "save"    => array( "href" => "/ph/network/news/save"),
      "detail"    => array( "href" => "/ph/network/news/detail"),
      "delete"    => array( "href" => "/ph/network/news/delete"),
      "updatefield"    => array( "href" => "/ph/network/news/updatefield"),
      "extractprocess" => array( "href" => "/ph/network/news/extractprocess"),
      "moderate" => array( "href" => "/ph/network/news/moderate"),
    ),
	 "gallery" => array(
      "index"        => array("href" => "ph/network/gallery/index"),
      "removebyid"   => array("href" => "ph/network/gallery/removebyid"),
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

