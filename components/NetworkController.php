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
    "admin" => array(
      "index"     => array("href" => "/ph/network/admin"),
      "directory" => array("href" => "/ph/network/admin/directory"),
      "switchto"  => array("href" => "/ph/network/admin/switchto"),
      "delete"    => array("href" => "/ph/network/admin/delete"),
      "activateuser"  => array("href" => "/ph/network/admin/activateuser"),
      "importdata"    => array("href" => "/ph/network/admin/importdata"),
      "previewdata"    => array("href" => "/ph/network/admin/previewdata"),
      "importinmongo"    => array("href" => "/ph/network/admin/importinmongo"),
      "assigndata"    => array("href" => "/ph/network/admin/assigndata"),
      "checkdataimport"    => array("href" => "/ph/network/admin/checkdataimport"),
      "openagenda"    => array("href" => "/ph/network/admin/openagenda"),
      "checkventsopenagendaindb"    => array("href" => "/ph/network/admin/checkventsopenagendaindb"),
      "importeventsopenagendaindb"    => array("href" => "/ph/network/admin/importeventsopenagendaindb"),
      "checkgeocodage"   => array("href" => "/ph/network/admin/checkgeocodage"),
      "getentitybadlygeolocalited"   => array("href" => "/ph/network/admin/getentitybadlygeolocalited"),
      "getdatabyurl"   => array("href" => "/ph/network/admin/getdatabyurl"),
      "adddata"    => array("href" => "/ph/network/admin/adddata"),
      "adddataindb"    => array("href" => "/ph/network/admin/adddataindb"),
      "createfileforimport"    => array("href" => "/ph/network/admin/createfileforimport"),
      "sourceadmin"    => array("href" => "/ph/network/admin/sourceadmin"),
      "checkcities"    => array("href" => "/ph/network/admin/checkcities"),
    ),
    "adminpublic" => array(
      "index"    => array("href" => "/ph/network/adminpublic/index"),
    ),
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
    ),
    "search"=> array(
      "getmemberautocomplete" => array("href" => "/ph/network/search/getmemberautocomplete"),
      "getshortdetailsentity" => array("href" => "/ph/network/search/getshortdetailsentity"),
      "index"                 => array("href" => "/ph/network/search/index"),
      "mainmap"               => array("href" => "/ph/network/default/mainmap", "public" => true)
    ),
    "rooms"=> array(
      "index"    => array("href" => "/ph/network/rooms/index"),
      "saveroom" => array("href" => "/ph/network/rooms/saveroom"),
      "editroom" => array("href" => "/ph/network/rooms/editroom"),
    ),
    "gantt"=> array(
      "index"            => array("href" => "/ph/network/gantt/index", "public" => true),
      "savetask"         => array("href" => "/ph/network/gantt/savetask"),
      "removetask"       => array("href" => "/ph/network/gantt/removetask"),
      "generatetimeline" => array("href" => "/ph/network/gantt/generatetimeline"),
      "addtimesheetsv"   => array("href" => "/ph/network/gantt/addtimesheetsv"),
    ),
    "need"=> array(
        "index" => array("href" => "/ph/network/need/index", "public" => true),
        "description" => array("href" => "/ph/network/need/dashboard/description"),
        "dashboard" => array("href" => "/ph/network/need/dashboard"),
        "detail" => array("href" => "/ph/network/need/detail", "public" => true),
        "saveneed" => array("href" => "/ph/network/need/saveneed"),
        "updatefield" => array("href" => "/ph/network/need/updatefield"),
        "addhelpervalidation" => array("href" => "/ph/network/need/addhelpervalidation"),
        "addneedsv" => array("href" => "/ph/network/need/addneedsv"),
      ),
    "person"=> array(
        "login"           => array("href" => "/ph/network/person/login",'title' => "Log me In"),
        "sendemail"       => array("href" => "/ph/network/person/sendemail"),
        "index"           => array("href" => "/ph/network/person/dashboard",'title' => "My Dashboard"),
        "authenticate"    => array("href" => "/ph/network/person/authenticate",'title' => "Authentication"),
        "dashboard"       => array("href" => "/ph/network/person/dashboard"),
        "detail"          => array("href" => "/ph/network/person/detail", "public" => true),
        "follows"         => array("href" => "/ph/network/person/follows"),
        "disconnect"      => array("href" => "/ph/network/person/disconnect"),
        "register"        => array("href" => "/ph/network/person/register"),
        "activate"        => array('href' => "/ph/network/person/activate"),
        "updatesettings"        => array('href' => "/ph/network/person/updatesettings"),
        "validateinvitation" => array('href' => "/ph/network/person/validateinvitation", "public" => true),
        "logout"          => array("href" => "/ph/network/person/logout"),
        'getthumbpath'    => array("href" => "/ph/network/person/getThumbPath"),
        'getnotification' => array("href" => "/person/getNotification"),
        'changepassword'  => array("href" => "/person/changepassword"),
        'changerole'      => array("href" => "/person/changerole"),
        'checkusername'   => array("href" => "/person/checkusername"),
        "invite"          => array("href" => "/ph/network/person/invite"),
        "invitation"      => array("href" => "/ph/network/person/invitation"),
        "updatefield"     => array("href" => "/person/updatefield"),
        "update"          => array("href" => "/person/update"),
        "getuserautocomplete" => array('href' => "/person/getUserAutoComplete"),
        'checklinkmailwithuser'   => array("href" => "/ph/network/checklinkmailwithuser"),
        'getuseridbymail'   => array("href" => "/ph/network/getuseridbymail"),
        "getbyid"         => array("href" => "/ph/network/person/getbyid"),
        "getorganization" => array("href" => "/ph/network/person/getorganization"),
        "updatename"      => array("href" => "/ph/network/person/updatename"),
        
        "chooseinvitecontact"=> array('href'    => "/ph/network/person/chooseinvitecontact"),
        "sendmail"=> array('href'   => "/ph/network/person/sendmail"),
        
        //Init Data
        "clearinitdatapeopleall"  => array("href" =>"'/ph/network/person/clearinitdatapeopleall'"),
        "initdatapeopleall"       => array("href" =>"'/ph/network/person/initdatapeopleall'"),
        "importmydata"            => array("href" =>"'/ph/network/person/importmydata'"),
        "about"                   => array("href" => "/person/about"),
        "data"                    => array("href" => "/person/scopes"),
        "directory"               => array("href" => "/ph/network/city/directory", "public" => true, "title"=>"My Directory", "subTitle"=>"My Network : People, Organizations, Events"),
    ),
    "organization"=> array(
      "addorganizationform" => array("href" => "/ph/network/organization/addorganizationform",
                                     'title' => "Organization", 
                                     "subTitle"=>"Découvrez les organization locales",
                                     "pageTitle"=>"Organization : Association, Entreprises, Groupes locales"),
      "save"             => array("href" => "/ph/network/organization/save",
                                     'title' => "Organization", 
                                     "subTitle"=>"Découvrez les organization locales",
                                     "pageTitle"=>"Organization : Association, Entreprises, Groupes locales"),
      "update"              => array("href" => "/ph/network/organization/update",
                                     'title' => "Organization", 
                                     "subTitle"=>"Découvrez les organization locales",
                                     "pageTitle"=>"Organization : Association, Entreprises, Groupes locales"),
      "getbyid"             => array("href" => "/ph/network/organization/getbyid"),
      "updatefield"         => array("href" => "/ph/network/organization/updatefield"),
      "join"                => array("href" => "/ph/network/organization/join"),
      "sig"                 => array("href" => "/ph/network/organization/sig"),
      //Links // create a Link controller ?
      "addneworganizationasmember"  => array("href" => "/ph/network/organization/AddNewOrganizationAsMember"),
      //Dashboards
      "dashboard"           => array("href"=>"/ph/network/organization/dashboard"),
      "dashboardmember"     => array("href"=>"/ph/network/organization/dashboardMember"),
      "dashboard1"          => array("href"=>"/ph/network/organization/dashboard1"),
      "directory"           => array("href"=>"/ph/network/organization/directory", "public" => true),
      "disabled"            => array("href"=>"/ph/network/organization/disabled"),
      "detail"              => array("href"=>"/ph/network/organization/detail", "public" => true),
      "simply"              => array("href"=>"/ph/network/organization/detail", "public" => true),
      "addmember"           => array("href"=>"/ph/network/organization/addmember"),
    ),
    "event"=> array(
      "save"            => array("href" => "/ph/network/event/save"),
      "update"          => array("href" => "/ph/network/event/update"),
      "saveattendees"   => array("href" => "/ph/network/event/saveattendees"),
      "removeattendee"  => array("href" => "/ph/network/event/removeattendee"),
      "dashboard"       => array("href" => "/ph/network/event/dashboard"),
      "detail"          => array("href" => "/ph/network/event/detail", "public" => true),
      "delete"          => array("href" => "ph/network/event/delete"),
      "updatefield"     => array("href" => "ph/network/event/updatefield"),
      "calendarview"    => array("href" => "ph/network/event/calendarview"),
      "eventsv"         => array("href" => "ph/network/event/eventsv" , "public" => true),
      "directory"       => array("href"=>"/ph/network/event/directory", "public" => true),
      "addattendeesv"   => array("href"=>"/ph/network/event/addattendeesv")
    ),
    "project"=> array(
      "edit"            => array("href" => "/ph/network/project/edit"),
      "get"          => array("href" => "/ph/network/project/get"),
      "save"            => array("href" => "/ph/network/project/save"),
      "update"            => array("href" => "/ph/network/project/update"),
      "savecontributor" => array("href" => "/ph/network/project/savecontributor"),
      "dashboard"       => array("href" => "/ph/network/project/dashboard"),
      "detail"          => array("href" => "/ph/network/project/detail", "public" => true),
      "simply"          => array("href" => "/ph/network/project/detail", "public" => true),
      "removeproject"   => array("href" => "/ph/network/project/removeproject"),
      "editchart"       => array("href" => "/ph/network/project/editchart"),
      "updatefield"     => array("href" => "/ph/network/project/updatefield"),
      "projectsv"       => array("href" => "/ph/network/project/projectsv"),
      "addcontributorsv" => array("href" => "/ph/network/project/addcontributorsv"),
      "addchartsv"      => array("href" => "/ph/network/project/addchartsv"),
      "directory"       => array("href"=>"/ph/network/project/directory", "public" => true)
    ),
    "job"=> array(
      "edit"    => array("href" => "/ph/network/job/edit"),
      "public"  => array("href" => "/ph/network/job/public"),
      "save"    => array("href" => "/ph/network/job/save"),
      "delete"  => array("href" => "/ph/network/job/delete"),
      "list"    => array("href" => "/ph/network/job/list"),
    ),
    "pod" => array(
      "slideragenda" => array("href" => "/ph/network/pod/slideragenda", "public" => true),
      "photovideo"   => array("href" => "ph/network/pod/photovideo"),
      "fileupload"   => array("href" => "ph/network/pod/fileupload"),
    ),
    "gallery" => array(
      "index"        => array("href" => "ph/network/gallery/index"),
      "removebyid"   => array("href" => "ph/network/gallery/removebyid"),
    ),
    "link" => array(
      "removemember"        => array("href" => "/ph/network/link/removemember"),
      "removecontributor"   => array("href" => "/ph/network/link/removecontributor"),
      "disconnect"        => array("href" => "/ph/network/link/disconnect"),
      "connect"           => array("href" => "/ph/network/link/connect"),
      "follow"           => array("href" => "/ph/network/link/follow"),
      "validate"          => array("href" => "/ph/network/link/validate"),
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
    "survey" => array(
      "index"       => array("href" => "/ph/network/survey/index", "public" => true),
      "entries"     => array("href" => "/ph/network/survey/entries", "public" => true),
      "savesession" => array("href" => "/ph/network/survey/savesession"),
      "savesurvey"  => array("href" => "/ph/network/survey/savesurvey"),
      "delete"      => array("href" => "/ph/network/survey/delete"),
      "addaction"   => array("href" => "/ph/network/survey/addaction"),
      "moderate"    => array("href" => "/ph/network/survey/moderate"),
      "entry"       => array("href" => "/ph/network/survey/entry", "public" => true ),
      "graph"       => array("href" => "/ph/network/survey/graph"),
      "textarea"    => array("href" => "/ph/network/survey/textarea"),
      "editlist"    => array("href" => "/ph/network/survey/editList"),
      "multiadd"    => array("href" => "/ph/network/survey/multiadd"),
      "close"       => array("href" => "/ph/network/survey/close")
    ),
    "discuss"=> array(
      "index" => array( "href" => "/ph/network/discuss/index", "public" => true),
    ),
    "comment"=> array(
      "index"        => array( "href" => "/ph/network/comment/index", "public" => true),
      "save"         => array( "href" => "/ph/network/comment/save"),
      'abuseprocess' => array( "href" => "/ph/network/comment/abuseprocess"),
      "testpod"      => array("href" => "/ph/network/comment/testpod")
    ),
    "action"=> array(
       "addaction"   => array("href" => "/ph/network/action/addaction"),
    ),
    "notification"=> array(
      "getnotifications"          => array("href" => "/ph/network/notification/get"),
      "marknotificationasread"    => array("href" => "/ph/network/notification/remove"),
      "markallnotificationasread" => array("href" => "/ph/network/notification/removeall"),
    ),
    "gamification"=> array(
      "index" => array("href" => "/ph/network/gamification/index"),
    ),
    "graph"=> array(
      "viewer" => array("href" => "/ph/network/graph/viewer"),
    ),
    "log"=> array(
      "monitoring" => array("href" => "/ph/network/log/monitoring"),
    ),
    "stat"=> array(
      "createglobalstat" => array("href" => "/ph/network/stat/createglobalstat"),
    ),
    "directory"=> array(
      "simply" => array("href" => "/ph/network/directory/simply"),
    ),
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

