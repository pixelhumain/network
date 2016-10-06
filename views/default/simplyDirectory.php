<div class="my-main-container col-md-12 no-padding" id="repertory" >
  <div id="dropdown_search" class="col-md-12 container list-group-item"></div>
</div>
<div class="col-md-12 no-padding hide" id="ficheInfoDetail" style="top: 0px;
    opacity: 1;
    display: block;">
</div>

<?php

	$this->renderPartial(@$path."first_step_directory"); ?>

<script type="text/javascript">
  //Icons by default categories
  var linksTagImages = new Object();
  var params = <?php echo json_encode($params) ?>;
  console.log("Params //////////////////");
  console.log(params);
  <?php
    if(isset($params['filter']['linksTag'])){
      foreach($params['filter']['linksTag'] as $key => $val){
        if(isset($val['image'])){?>
        linksTagImages.<?php echo $val['tagParent']; ?> = {};
      <?php
      }
    }
  }
  // echo "console.log(linksTagImages);";
  ?>
  //********** FILTER TYPE ITEM **********
  <?php if(isset($params['request']['searchType']) && is_array($params['request']['searchType'])){ ?>
    // var searchType = <?php echo json_encode($params['request']['searchType']); ?>;
    // var allSearchType = <?php echo json_encode($params['request']['searchType']); ?>;
  <?php } ?>
  //********** FILTERS **********
   console.log(<?php echo json_encode($params) ?>);
  <?php

  $allSearchParams = array("mainTag", "sourceKey", "searchType", "searchTag","searchCategory","searchLocalityNAME","searchLocalityCODE_POSTAL_INSEE","searchLocalityDEPARTEMENT","searchLocalityINSEE","searchLocalityREGION");
  foreach ($allSearchParams as $oneSearchParam) {
    //In params set with value
    if(isset($params['request'][$oneSearchParam]) && is_array($params['request'][$oneSearchParam])){ ?>
    <?php echo "var ".$oneSearchParam;?> = <?php echo json_encode($params['request'][$oneSearchParam]); ?>;
    <?php echo "var all".$oneSearchParam;?> = <?php echo json_encode($params['request'][$oneSearchParam]); ?>;
  <?php
    }//Set with no value
    else{
       echo "var ".$oneSearchParam;?> = [];
       <?php echo "var all".$oneSearchParam;?> = [];
    <?php }
  }?>
  var allElement = new Array();
  var allTags = new Object();
  var allTypes = new Object();
  var indexStepInit = 100;

  //With different pagination params
  <?php if(isset($params['request']['pagination']) && $params['request']['pagination'] > 0){ ?>
    indexStepInit = <?php echo $params['request']['pagination'] ;?>;
  <?php } ?>
  var indexStep = indexStepInit;
  var currentIndexMin = 0;
  var currentIndexMax = indexStep;
  var scrollEnd = false;
  var totalData = 0;
  var timeout = null;
  jQuery(document).ready(function() {
    // addSearchTag("CIGALES");
	if  (location.hash == "")
    	showMap(true);
    else
    	showMap(false);
    // selectScopeLevelCommunexion(levelCommunexion);
    topMenuActivated = true;
    hideScrollTop = true;
    checkScroll();
    var timeoutSearch = setTimeout(function(){ }, 100);

    setTimeout(function(){ $("#input-communexion").hide(300); }, 300);
    $(".moduleLabel").html("<i class='fa fa-connectdevelop'></i> <span id='main-title-menu'>Cartographie des Tiers-Lieux </span> <span class='text-red'>MEL</span>");
    $('.tooltips').tooltip();
    $('.main-btn-toogle-map').click(function(e){ showMap(); });
    $('#breadcum_search').click(function(e){ showMap();    });
    <?php if(isset($params['mode']) && $params['mode'] == "client"){ ?>
    <?php } else { ?>
      $('#searchBarText').keyup(function(e){
          clearTimeout(timeoutSearch);
          timeoutSearch = setTimeout(function(){ startSearch(0, indexStepInit); }, 800);
      });
    <?php } ?>
    /***** CHANGE THE VIEW PARAMS  *****/
    // $('#dropdown_params').show();
    $('#dropdown_paramsBtn').click(function(event){
      event.preventDefault();
      if($('#dropdown_paramsBtn').hasClass('active')){
        $('#dropdown_params').fadeOut();
        $('#dropdown_params').removeClass('col-md-3');
        $('#dropdown_search').removeClass('col-md-9');
        $('#dropdown_search').addClass('col-md-12');
        $('#dropdown_paramsBtn').removeClass('active');
      }
      else{
        $('#dropdown_params').addClass('col-md-3');
        $('#dropdown_params').fadeIn();
        $('#dropdown_search').addClass('col-md-9');
        $('#dropdown_search').removeClass('col-md-12');
        $('#dropdown_paramsBtn').addClass('active');
      }

    });
    /***** CHANGE THE VIEW GRID OR LIST *****/
    $('#grid').hide();
    $('#list').click(function(event){
      event.preventDefault();
      $('#dropdown_search .item').addClass('list-group-item');
      $('.entityTop').removeClass('row');
      $('.entityMiddle').removeClass('row');
      $('.entityBottom').removeClass('row');
      $('.entityTop').addClass('col-md-2');
      $('.entityMiddle').addClass('col-md-12');
      $('.entityBottom').addClass('col-md-4');
      $('#grid').show();
      $('#list').hide();
    });
   $('#grid').click(function(event){
      event.preventDefault();
      $('#dropdown_search .item').removeClass('list-group-item');
      $('#dropdown_search .item').addClass('grid-group-item');
      $('.entityTop').addClass('row');
      $('.entityMiddle').addClass('row');
      $('.entityBottom').addClass('row');
      $('.entityTop').removeClass('col-md-2');
      $('.entityMiddle').removeClass('col-md-12');
      $('.entityBottom').removeClass('col-md-4');
      $('#list').show();
      $('#grid').hide();
    });
    /******** EVENTS ********/

    $('#reset').on('click', function() {
      searchTag = allsearchTag;
      searchLocalityNAME = allsearchLocalityNAME;
      searchCategory = allsearchCategory;
      $('.tagFilter').removeClass('active');
      $('.villeFilter').removeClass('active');
      $('.categoryFilter').removeClass('active');
      startSearch(0, indexStepInit);
    });
    <?php if(isset($params['mode']) && $params['mode'] == "client"){ ?>

        //Charger tous les éléments

    <?php } else{ ?>
      $(".my-main-container").bind("scroll", function _scrollDirectory(){
        if(!loadingData && !scrollEnd){
            var heightContainer = $(".my-main-container")[0].scrollHeight;
            var heightWindow = $(window).height();
            //console.log("scroll : ", scrollEnd, heightContainer, $(this).scrollTop() + heightWindow);
            if(scrollEnd == false){
              var heightContainer = $(".my-main-container")[0].scrollHeight;
              var heightWindow = $(window).height();
              if( ($(this).scrollTop() + heightWindow) >= heightContainer-150){
                // console.log("scroll MAX");
                startSearch(currentIndexMin+indexStep, currentIndexMax+indexStep);
              }
            }
        }
      });
      $(".btn-filter-type").click(function(e){
        var type = $(this).attr("type");
        var index = searchType.indexOf(type);
        if(type == "all" && searchType.length > 1){
          $.each(allSearchType, function(index, value){ removeSearchType(value); }); return;
        }
        if(type == "all" && searchType.length == 1){
          $.each(allSearchType, function(index, value){ addSearchType(value); }); return;
        }
        if (index > -1) removeSearchType(type);
        else addSearchType(type);
      });
      //initBtnToogleCommunexion();
      //$(".btn-activate-communexion").click(function(){
      //  toogleCommunexion();
      //});
    <?php } ?>
    //initBtnScopeList();
    startSearch(0, indexStepInit);
  });
function startSearch(indexMin, indexMax){
     console.log("startSearch", indexMin, indexMax, indexStep);
    $("#listTagClientFilter").html('spiner');
    if(loadingData) return;
    loadingData = true;

    // console.log("loadingData true");
    indexStep = indexStepInit;
    var name = $('#searchBarText').val();
    if(typeof indexMin == "undefined") indexMin = 0;
    if(typeof indexMax == "undefined") indexMax = indexStep;
    currentIndexMin = indexMin;
    currentIndexMax = indexMax;
    if(indexMin == 0 && indexMax == indexStep) {
      totalData = 0;
      mapElements = new Array();
    }
    // if(name.length>=3 || name.length == 0){
      var locality = "";
      communexionActivated=true;
      levelCommunexion = 1;
      if(communexionActivated){
        if(levelCommunexion == 1) locality = inseeCommunexion;
        if(levelCommunexion == 2) locality = cpCommunexion;
        if(levelCommunexion == 3) locality = cpCommunexion.substr(0, 2);
        if(levelCommunexion == 4) locality = inseeCommunexion;
        if(levelCommunexion == 5) locality = "";
      }
      autoCompleteSearch(name, locality, indexMin, indexMax);
}
function addSearchType(type){
  var index = searchType.indexOf(type);
  if (index == -1) {
    searchType.push(type);
    $(".search_"+type).removeClass("fa-circle-o");
    $(".search_"+type).addClass("fa-check-circle-o");
  }
}
function removeSearchType(type){
  var index = searchType.indexOf(type);
  if (index > -1) {
    searchType.splice(index, 1);
    $(".search_"+type).removeClass("fa-check-circle-o");
    $(".search_"+type).addClass("fa-circle-o");
  }
}
function addSearchCategory(category){
  console.log('add'+category+' dans '+searchCategory);
  var index = searchCategory.indexOf(category);
  if (index == -1) searchCategory.push(category);
  // var index = searchCategory.indexOf(category);
  // if (index == -1) {
  //   //Ajoute tous les tags des catégories
  //   $('.checkbox[data-parent="'+category+'"]').each(function(){
  //     addSearchTag($(this).attr("value"));
  //   });
  //   // searchCategory.push(category);
  //   $('.categoryFilter[value="'+category+'"]').addClass('active');
  //   // console.log($('.checkbox[data-parent="'+category+'"]'));
  //   $('.checkbox[data-parent="'+category+'"]').prop( "checked", true );
  // }
  if($('.checkbox[data-parent="'+category+'"]').length){
    $('.checkbox[data-parent="'+category+'"]').each(function(){
      addSearchTag($(this).attr("value"));
    });
  }
}
function removeSearchCategory(category){
  console.log('remove '+category+' dans '+searchCategory);
  var index = searchCategory.indexOf(category);
  if (index > -1) searchCategory.splice(index, 1);
  if($('.checkbox[data-parent="'+category+'"]').length){
    $('.checkbox[data-parent="'+category+'"]').each(function(){
      removeSearchTag($(this).attr("value"));
    });
  }
  // var index = searchCategory.indexOf(category);

  // if (index > -1) {
  //   //Masquer tous les tags des catégories
  //   $('.checkbox[data-parent="'+category+'"]').each(function(){
  //     removeSearchTag($(this).attr("value"));
  //   });
  //   searchCategory.splice(index, 1);
  //   $('.categoryFilter[value="'+category+'"]').removeClass('active');
  //   $('.checkbox[data-parent="'+category+'"]').prop( "checked", false );
  // }
}
function addSearchTag(tag){
  var index = searchTag.indexOf(tag);
  if (index == -1) {
    searchTag.push(tag);
    $('.tagFilter[value="'+tag+'"]').addClass('active');
    $('.tagFilter[value="'+tag+'"]').prop("checked", true );
  }
}
function removeSearchTag(tag){
  var index = searchTag.indexOf(tag);
  if (index > -1) {
    searchTag.splice(index, 1);
    $('.tagFilter[value="'+tag+'"]').removeClass('active');
    $('.tagFilter[value="'+tag+'"]').prop("checked", false );
  }
}

function addSearchVille(ville){
  var index = searchLocalityNAME.indexOf(ville);
  if (index == -1) {
    searchLocalityNAME.push(ville);
    $('.villeFilter[value="'+ville+'"]').addClass('active');
    $('.villeFilter[value="'+ville+'"]').prop("checked", true );
  }
}
function removeSearchVille(ville){
  var index = searchLocalityNAME.indexOf(ville);
  if (index > -1) {
    searchLocalityNAME.splice(index, 1);
    $('.villeFilter[value="'+ville+'"]').removeClass('active');
    $('.villeFilter[value="'+ville+'"]').prop("checked", false );
  }
}

var loadingData = false;
var mapElements = new Array();
var tagsFilter = new Array();
var mix = "";
<?php if(isset($params['mode']) && $params['mode'] == 'client') { ?>
  mix = "mix";
<?php } ?>
function autoCompleteSearch(name, locality, indexMin, indexMax){
    var levelCommunexionName = { 1 : "INSEE",
                             2 : "CODE_POSTAL_INSEE",
                             3 : "DEPARTEMENT",
                             4 : "REGION"
                           };
    // console.log("levelCommunexionName", levelCommunexionName[levelCommunexion]);
    // locality = "RENNES";
    var searchBy = levelCommunexionName[levelCommunexion];
    // searchBy = "NAME";
    console.log("searchLocalityNAME : ",searchLocalityNAME);
    console.log("searchLocalityCODE_POSTAL_INSEE : ",searchLocalityCODE_POSTAL_INSEE);
    console.log("searchLocalityDEPARTEMENT : ",searchLocalityDEPARTEMENT);
    console.log("searchLocalityINSEE : ",searchLocalityINSEE);
    console.log("searchLocalityREGION : ",searchLocalityREGION);
    console.log("searchTag : ",searchTag);
    console.log("searchCategory : ",searchCategory);

    //To merge Category and tags which are finally all tags
    var searchTagGlobal = [];
    if (undefined !== searchTag && searchTag.length)$.merge(searchTagGlobal,searchTag);
    if (undefined !== searchCategory && searchCategory.length)$.unique($.merge(searchTagGlobal,searchCategory));
    console.log("searchTagGlobal : "+searchTagGlobal);
    var data = {
      "name" : name,
      "locality" : "xxxx",
      "searchType" : searchType,
      "searchTag" : searchTagGlobal,
      "searchLocalityNAME" : searchLocalityNAME,
      "searchLocalityCODE_POSTAL_INSEE" : searchLocalityCODE_POSTAL_INSEE,
      "searchLocalityDEPARTEMENT" : searchLocalityDEPARTEMENT,
      "searchLocalityINSEE" : searchLocalityINSEE,
      "searchLocalityREGION" : searchLocalityREGION,
      "searchBy" : searchBy,
      "indexMin" : indexMin,
      "indexMax" : indexMax,
      "sourceKey" : sourceKey,
      "mainTag" : mainTag
    };
    //console.log("loadingData true");
    loadingData = true;

    str = "<i class='fa fa-circle-o-notch fa-spin'></i>";
    $(".btn-start-search").html(str);
    $(".btn-start-search").addClass("bg-azure");
    $(".btn-start-search").removeClass("bg-dark");
    //$("#dropdown_search").css({"display" : "inline" });
    if(indexMin > 0)
    $("#btnShowMoreResult").html("<i class='fa fa-spin fa-circle-o-notch'></i> Recherche en cours ...");
    else
    $("#dropdown_search").html("<center><span class='search-loaderr text-dark' style='font-size:20px;'><i class='fa fa-spin fa-circle-o-notch'></i> Recherche en cours ...</span></center>");
    if(isMapEnd)
      $.blockUI({
        message : "<h1 class='homestead text-red'><i class='fa fa-spin fa-circle-o-notch'></i><span class='text-dark'> En cours ...</span></h1>"
      });
    $.ajax({
      type: "POST",
          url: baseUrl+"/" + moduleId + "/search/simplyautocomplete",
          data: data,
          dataType: "json",
          error: function (data){
             console.log("error");
             console.dir(data);
          },
          success: function(data){
            if(!data.res){ toastr.error(data.content); }
            else
            {
              var countData = 0;
              $.each(data.res, function(i, v) { if(v.length!=0){ countData++; } });

              totalData += countData;

              str = "";
              var city, postalCode = "";
              var mapElements = new Array();
              allTags = data.filters;
              //parcours la liste des résultats de la recherche
              $.each(data.res, function(i, o) {
                  var typeIco = i;
                  var ico = mapIconTop["default"];
                  var color = mapColorIconTop["default"];
                  // mapElements.push(o);
                  // allElement.push(o);


                  typeIco = o.type;
                  ico = ("undefined" != typeof mapIconTop[typeIco]) ? mapIconTop[typeIco] : mapIconTop["default"];
                  color = ("undefined" != typeof mapColorIconTop[typeIco]) ? mapColorIconTop[typeIco] : mapColorIconTop["default"];

                  htmlIco ="<i class='fa "+ ico +" text-"+color+"'></i>";
                  if("undefined" != typeof o.profilThumbImageUrl && o.profilThumbImageUrl != ""){
                    var htmlIco= "<img width='80' height='80' alt='' class='img-circle bg-"+color+"' src='"+baseUrl+o.profilThumbImageUrl+"'/>";
                  }

                  // o.profilImageUrl = "/upload/communecter/network/Alimentation/fa-cutlery505719fabnone.png";
                  // o.profilMarkerImageUrl = "/upload/communecter/network/Alimentation/thumb/profil-marker.png";
                  // o.profilThumbImageUrl = "/upload/communecter/network/Alimentation/thumb/profil-resized.png";
                  city="";
                  var postalCode = o.cp
                  if (o.address != null) {
                    city = o.address.addressLocality;
                    postalCode = o.cp ? o.cp : o.address.postalCode ? o.address.postalCode : "";
                  }

                  //console.dir(o);
                  var id = getObjectId(o);
                  var tagsClasses = "";
                  var insee = o.insee ? o.insee : "";
                  type = o.type;
                  if(type=="citoyen") type = "person";

                  //Consolidate types
                  if(type != "undefined" && type != null){
                    if(typeof allTypes[type] != "undefined"){
                      allTypes[type] = allTypes[type] + 1;
                    }
                    else{
                      allTypes[type] = 1;
                    }
                  }
                  var url = "javascript:"; //baseUrl+'/'+moduleId+ "/default/simple#" + o.type + ".detail.id." + id;
                  var url = baseUrl+'/'+moduleId+ "/default/dir#" + type + ".simply.id." + id;
                 // var onclick = 'loadByHash("#organization.simply.id.' + id + '");';
                  var onclick = 'getAjaxFiche("#element.detail.type.'+o.typeSig+'.id.'+id+'");';
                  var onclickCp = "";
                  var target = " target='_blank'";
                  var dataId = "";
                  if(type == "city"){
                    url = "javascript:"; //#main-col-search";
                    onclick = 'setScopeValue($(this))'; //"'+o.name.replace("'", "\'")+'");';
                    onclickCp = 'setScopeValue($(this));';
                    target = "";
                    dataId = o.name; //.replace("'", "\'");
                  }
                  var tags = "";
                  var find = false;
                  if(typeof o.tags != "undefined" && o.tags != null){
                    $.each(o.tags, function(key, value){
                      if(value != ""){
                        //Display info in item
                        tags +=   "<a href='javascript:' class='badge bg-red btn-tag tagFilter' value='"+ value +"'>#" + value + "</a>";
                        // manageTagFilter("#"+value);
                        //Consolidate tags
                        // if(typeof allTags[value] != "undefined"){
                        //   allTags[value] = allTags[value] + 1;
                        // }
                        // else{
                        //   allTags[value] = 1;
                        // }
                        //Default Image adn color
                        if(find == false && value in linksTagImages == true){
                          find = true;
                          // $.each(linksTagImages[value], function(key2, value2){
                          //   o[key2] = value2;
                          // });
                          o.typeSig = value;
                          o.type = "organizations";
                        }
                        //Filter Client (Attention erreur firefox js)
                        // tagsClasses += ' '+value.replace("/[^A-Za-z0-9]/", "", value) ;
                      }
                    });
                  }
                  mapElements.push(o);
                  contextMap.push(o);
                  // console.log(tagsClasses);
                  var name = typeof o.name != "undefined" ? o.name : "";
                  var website = typeof o.url != "undefined" ? o.url : "";
                  var postalCode = (typeof o.address != "undefined" &&
                            typeof o.address.postalCode != "undefined") ? o.address.postalCode : "";

                  if(postalCode == "") postalCode = typeof o.cp != "undefined" ? o.cp : "";
                  var cityName = (typeof o.address != "undefined" &&
                          typeof o.address.addressLocality != "undefined") ? o.address.addressLocality : "";

                  var fullLocality = postalCode + " " + cityName;
                  var description = (typeof o.shortDescription != "undefined" &&
                            o.shortDescription != null) ? o.shortDescription : "";
                  if(description == "") description = (typeof o.description != "undefined" &&
                                     o.description != null) ? o.description : "";
                  description = "";
                  if(o.profilMediumImageUrl != "undefined" && o.profilMediumImageUrl != "")
                  	pathmedium = baseUrl+o.profilMediumImageUrl;
                  else
                  	pathmedium = "<?php echo $this->module->assetsUrl ?>/images/thumbnail-default.jpg";
                  shortDescription = (typeof o.shortDescription != "undefined" &&
                                     o.shortDescription != null) ? o.shortDescription : "";

                  var startDate = (typeof o.startDate != "undefined") ? "Du "+dateToStr(o.startDate, "fr", true, true) : null;
                  var endDate   = (typeof o.endDate   != "undefined") ? "Au "+dateToStr(o.endDate, "fr", true, true)   : null;
                  /***** VERSION SIMPLY *****/
                  str += "<div id='"+id+"' class='row list-group-item item searchEntity "+mix+" "+tagsClasses+" "+fullLocality+"' >";
                  <?php if(isset($params['result']['displayImage']) && $params['result']['displayImage']) { ?>
                  	str += '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 padding-10 center">'+
				  				'<img class="img-responsive thumbnail" src="'+pathmedium+'">'+
				  			'</div>';
                    <?php } ?>
                   // str += "<div class='entityTop col-md-2' onclick='"+onclick+"'>";
                      //  str += "<img class='image' src='http://paniersdumarais.weebly.com/uploads/1/4/6/5/1465996/5333680.jpg' />";
                    //str += "</div>";

                    str += "<div class='entityMiddle col-md-5 name' onclick='"+onclick+"'>";
                        str += "<a class='entityName text-dark'>" + name + "</a><br/>";
                        if(website != "" && website != " ")
                        str += "<i class='fa fa-desktop fa_url'></i><a href='"+website+"' target='_blank'>"+website+"</a><br/>";
                        <?php if(isset($params['result']['fullLocality']) && $params['result']['fullLocality']) { ?>
                          if(fullLocality != "" && fullLocality != " ")
                          str += "<a href='"+url+"' onclick='"+onclickCp+"'"+target+ ' data-id="' + dataId + '"' + "  class='entityLocality'><i class='fa fa-home'></i> " + fullLocality + "</a><br/>";
                        <?php } ?>
                    str += "</div>";

                    <?php if(isset($params['result']['displayType']) && $params['result']['displayType']) { ?>
                      str += "<div class='entityMiddle col-md-2 type '>";
                        typeIco = "";
                         str += htmlIco+"" + typeIco + "";
                      str += "</div>";
                    <?php } ?>
                    <?php if(isset($params['result']['displayShortDescription']) && $params['result']['displayShortDescription']) { ?>
						str += "<div class='entityMiddle col-md-5 type '>";
                        str += 		shortDescription;
						str += "</div>";
                       <?php } ?>

                    target = "";
                    // str += "<div class='row entityMiddle fullLocality'>";

                    //   <?php if(isset($params['result']['datesEvent']) && $params['result']['datesEvent']) { ?>
                    //     // str += "<hr>";
                    //     str += "<div class='row entityMiddle datesEvent'>";
                    //     if(startDate != null)
                    //     str += "<a href='"+url+"' onclick='"+onclick+"'"+target+"  class='entityDate bg-azure badge'><i class='fa fa-caret-right'></i> " + startDate + "</a>";
                    //     if(endDate != null)
                    //     str += "<a href='"+url+"' onclick='"+onclick+"'"+target+"  class='entityDate bg-azure badge'><i class='fa fa-caret-right'></i> " + endDate + "</a>";
                    //     str += "</div>";
                    //   <?php } ?>
                    // str += "</div>";
                    str += "<div class='entityBottom col-md-5'>";
                      <?php if( isset( Yii::app()->session['userId'] ) ) { ?>
                      isFollowed=false;
                      if(typeof o.isFollowed != "undefined" )
                        isFollowed=true;
                      if(type!="city" && id != "<?php echo Yii::app()->session['userId']; ?>")
                      str += "<a href='javascript:;' class='btn btn-default btn-sm btn-add-to-directory bg-white tooltips followBtn'" +
                            'data-toggle="tooltip" data-placement="left" data-original-title="Suivre"'+
                            " data-ownerlink='follow' data-id='"+id+"' data-type='"+type+"' data-name='"+name+"' data-isFollowed='"+isFollowed+"'>"+
                                "<i class='fa fa-chain'></i>"+ //fa-bookmark fa-rotate-270
                              "</a>";
                      <?php } ?>
                      str += "<hr>";
                      if(tags=="") tags = "<a href='#' class='badge bg-red btn-tag'>#</a>";
                      str += tags;
                    str += "</div>";
                  str += "</div>";
              }); //end each
              if(str == "") {
                  $(".btn-start-search").html("<i class='fa fa-search'></i>");
                  if(indexMin == 0){
                    //ajout du footer
                    var msg = "Aucun résultat";
                    if(name == "" && locality == "") msg = "<h3 class='text-dark'><i class='fa fa-3x fa-keyboard-o'></i><br> Préciser votre recherche pour plus de résultats ...</h3>";
                    str += '<div class="center" id="footerDropdown">';
                    str += "<hr style='float:left; width:100%;'/><label style='margin-bottom:10px; margin-left:15px;' class='text-dark'>"+msg+"</label><br/>";
                    str += "</div>";
                    $("#dropdown_search").html(str);
                    $("#searchBarText").focus();
                  }
              }
              else
              {
                //ajout du footer

                  str += '</div><div class="center col-md-12" id="footerDropdown">';
                  str += "<hr style='float:left; width:100%;'/><label id='countResult' class='text-dark'></label><br/>";
                  <?php if(isset($params['mode']) && $params['mode'] != "client"){ ?>
                    str += '<button class="btn btn-default" id="btnShowMoreResult"><i class="fa fa-angle-down"></i> Afficher plus de résultat</div></center>';
                    str += "</div>";
                  <?php } ?>
                //si on n'est pas sur une première recherche (chargement de la suite des résultat)
                if(indexMin > 0){
                  //on supprime l'ancien bouton "afficher plus de résultat"
                  $("#btnShowMoreResult").remove();
                  //on supprimer le footer (avec nb résultats)
                  $("#footerDropdown").remove();
                  //on calcul la valeur du nouveau scrollTop
                  var heightContainer = $(".my-main-container")[0].scrollHeight - 180;

                  //on affiche le résultat à l'écran
                  $("#dropdown_search").append(str);

                //si on est sur une première recherche
                }else{
                  //on affiche le résultat à l'écran
                  $("#dropdown_search").html(str);
                  //on scroll pour coller le haut de l'arbre au menuTop
                  // $(".my-main-container").scrollTop(95);
                }

                //On met à jour les filtres
                <?php if(isset($params['mode']) && $params['mode'] == "client"){ ?>
                  loadClientFilters(allTypes, allTags);
                <?php } else{ ?>
                  loadServerFilters(allTypes, allTags);
                <?php } ?>
                //on affiche par liste par défaut
                $('#list').click();
                //remet l'icon "loupe" du bouton search
                $(".btn-start-search").html("<i class='fa fa-search'></i>");

                //active le chargement de la suite des résultat au survol du bouton "afficher plus de résultats"
                //(au cas où le scroll n'ait pas lancé le chargement comme prévu)
                $("#btnShowMoreResult").mouseenter(function(){
                  if(!loadingData){
                    startSearch(indexMin+indexStep, indexMax+indexStep);
                    $("#btnShowMoreResult").mouseenter(function(){});
                  }
                });

                //initialise les boutons pour garder une entité dans Mon répertoire (boutons links)
                // initBtnLink();
              } //end else (str=="")
              //signal que le chargement est terminé
              // console.log("loadingData false");
              loadingData = false;
              <?php if(isset($params['mode']) && $params['mode'] == "client"){ ?>
               loadClientFeatures();
              <?php } else{ ?>
                loadServerFeatures();
              <?php } ?>
              //quand la recherche est terminé, on remet la couleur normal du bouton search
              $(".btn-start-search").removeClass("bg-azure");
            }
            // console.log("scrollEnd ? ", scrollEnd, indexMax, countData , indexMin);

            //si le nombre de résultat obtenu est inférieur au indexStep => tous les éléments ont été chargé et affiché
            if(indexMax - countData > indexMin){
              $("#btnShowMoreResult").remove();
              scrollEnd = true;
            }else{
              scrollEnd = false;
            }
           //affiche les éléments sur la carte
            Sig.showMapElements(Sig.map, mapElements);
           //on affiche le nombre de résultat en bas
            var s = "";
            var length = ($( "div.searchEntity" ).length);
            if(length > 1) s = "s";
            $("#countResult").html(length+" résultat"+s);
            $.unblockUI();
          }
    });
  }

  function setSearchValue(value){
    $("#searchBarText").val(value);
    startSearch(0, 100);
  }
  function manageTagFilter(tag){
    var index = tagsFilter.indexOf(tag);
    if (index > -1) {
      tagsFilter.splice(index, 1);
    }
    else{
      tagsFilter.push(tag);
    }
  }

  function loadServerFeatures(){

  }
  function loadServerFilters(types,tags){
    var displayLimit = 10;
    var classToHide = "";
    var i = 0;

    var breadcum  = "";
    //All desacactivate
    $('.villeFilter').prop("checked", false );
    $('.tagFilter').prop("checked", false );
    $('.categoryFilter').prop("checked", false );
    //One by One Tag
    $.each(searchTag, function(index, value){
      //Display
      $('.tagFilter[value="'+value+'"]').prop("checked", true );
      if($('.tagFilter[value="'+value+'"]').length)breadcum = breadcum+"<span class='label label-danger tagFilter' value='"+value+"'>"+$('.tagFilter[value="'+value+'"]').attr("data-label")+"</span> ";
      //Open menu
      manageCollapse(value,true);
    });
    $.each(searchLocalityNAME, function(index, value){
      //Display
      $('.villeFilter[value="'+value+'"]').prop("checked", true );
      //Open menu
      manageCollapse(value,true);
    });
    //One by One Category
    $.each(searchCategory, function(index, value){
      $('.categoryFilter[value="'+value+'"]').prop( "checked", true );
      // $('.tagFilter[data-parent="'+value+'"]').prop("checked", true );
      // breadcum = breadcum+"#"+value+", ";
      breadcum = breadcum+"<span class='label label-danger categoryFilter' value='"+value+"'>"+value+"</span> ";
      // manageCollapse(value,true);
    });
    if(breadcum != ""){
      $('#breadcum').html('<i id="breadcum_search" class="fa fa-search fa-2x" style="padding-top: 10px;padding-left: 20px;"></i><i class="fa fa-chevron-right fa-1x" style="padding: 10px 10px 0px 10px;""></i>'+breadcum+'<i class="fa fa-chevron-right fa-1x" style="padding: 10px 10px 0px 10px;""></i><label id="countResult" class="text-dark"></label>');
    }
    else{
      $('#breadcum').html('<i class="fa fa-search fa-2x" style="padding-top: 10px;padding-left: 20px;"></i><i class="fa fa-chevron-right fa-1x" style="padding: 10px 10px 0px 10px;""></i><label id="countResult" class="text-dark"></label>');
    }

    $(".tagFilter").off().click(function(e){
      var tag = $(this).attr("value");
      var index = searchTag.indexOf(tag);
      if(tag == "all"){
        searchTag = [];
        $('.tagFilter[value="all"]').addClass('active');
        startSearch(0, indexStepInit);
        return;
      }
      else{
        $('.tagFilter[value="all"]').removeClass('active');
      }
      if (index > -1) removeSearchTag(tag);
      else addSearchTag(tag);
      startSearch(0, indexStepInit);
    });
    $(".villeFilter").off().click(function(e){
      var ville = $(this).attr("value");
      var index = searchLocalityNAME.indexOf(ville);
      if(ville == "all"){
        searchLocalityNAME = [];
        $('.villeFilter[value="all"]').addClass('active');
        startSearch(0, indexStepInit);
        return;
      }
      else{
        $('.villeFilter[value="all"]').removeClass('active');
      }
      if (index > -1) removeSearchVille(ville);
      else addSearchVille(ville);
      startSearch(0, indexStepInit);
    });
    $(".categoryFilter").off().click(function(e){
      var category = $(this).attr("value");
      ;
      if($(this).is(':checked') == false){
        removeSearchCategory(category);
      }
      else{
        addSearchCategory(category);
      }
      startSearch(0, indexStepInit);
    });
  }
  // function loadClientFilters(types, tags){
  //   var displayLimit = 10;
  //   var classToHide = "";
  //   var i = 0;
  //   $("#listTypesClientFilter").html(' ');
  //   $.each(types, function(index, value){
  //     i+=1;
  //     $("#listTypesClientFilter").append('<div class="checkbox typeHidden '+classToHide+'"><input type="checkbox" value=".'+index+'"/><label>'+index+' ('+value+')</label></div>');
  //     if(i == displayLimit)classToHide = "hidden";
  //   });
  //   if(i > 10)$("#listTypesClientFilter").append('<div id="moreTypes"><i class="fa fa-plus fa-2x"></i></div>');
  //   $("#moreTypes").click(function(){
  //      $(".typeHidden").removeClass("hidden");
  //      $("#moreTypes").hide();
  //   });
  //   i=0;
  //   classToHide = "";
  //   $("#listTagClientFilter").html(' ');
  //   $.each(tags, function(index, value){
  //     i+=1;
  //     $("#listTagClientFilter").append('<div class="checkbox tagHidden '+classToHide+'"><input type="checkbox" value=".'+index+'"/><label>#'+index+' ('+value+')</label></div>');
  //     if(i == displayLimit)classToHide = "hidden";
  //   });
  //   if(i > 10)$("#listTagClientFilter").append('<div id="moreTag"><i class="fa fa-plus fa-2x"></i></div>');
  //   $("#moreTag").click(function(){
  //      $(".tagHidden").removeClass("hidden");
  //      $("#moreTag").hide();
  //   });
  //   loadClientFeatures();
  // }
  function getAjaxFiche(url, breadcrumb){
	$("#ficheInfoDetail").empty();
	if(location.hash == ""){
	    history.pushState(null, "New Title", url);
    }
    if(isMapEnd){
		pathTitle="Cartographie";
		pathIcon = "map-marker";
	    showMap();
    }
    else{
	    pathTitle="Annuaire";
	    pathIcon = "list";
    }
    isEntityView=true;
	url='/'+url.replace( "#","" ).replace( /\./g,"/" );
    $("#ficheInfoDetail").removeClass("hide");
    $("#repertory").fadeOut();
    $.blockUI({
				message : "<h4 style='font-weight:300' class='text-dark padding-10'><i class='fa fa-spin fa-circle-o-notch'></i><br>Chargement en cours ...</span></h4>"
	});
    getAjax('#ficheInfoDetail', baseUrl+'/'+moduleId+url,
    	function(){
	    $.unblockUI();
	    $(".panel-group .panel-default").fadeOut();
	    console.log(contextData);
	    if(breadcrumb){
		    if($(".lastElementBreadcrumb").length > 0)
		    	$(".lastElementBreadcrumb").remove();
		    $html= "<li class='lastElementBreadcrumb' style='margin-left:15px;'><i class='fa fa-level-up' style='transform:rotate(90deg);'></i> <a href='javascript:;' onclick='getAjaxFiche(\"#element.detail.type."+contextData.typeSig+".id."+contextData._id.$id+"\")'>"+contextData.name+"</a></li>"+
					"</div>";
			$(".breadcrumbVertical").append($html);

	    } else {
			$html="<div class='panel panel-back padding-5'>"+
					"<ol class='breadcrumbVertical'><li><a href='javascript:;' onclick='reverseToRepertory();'><i class='fa fa-"+pathIcon+"'> </i> "+pathTitle+"</a></li>"+
						"<li><i class='fa fa-level-up' style='transform:rotate(90deg);'></i> <a href='javascript:;' onclick='getAjaxFiche(\"#element.detail.type."+contextData.typeSig+".id."+contextData._id.$id+"\", true)'>"+contextData.name+"</a></li>"+
					"</div>";
			$(".panel-group").append($html);
		}
    },"html");
  }
  function reverseToRepertory(){
	  if(isMapEnd){
	    showMap();
    }
	isEntityView=false;
    $("#ficheInfoDetail").addClass("hide");
    $("#repertory").fadeIn();
    $(".panel-group .panel-default").fadeIn();
    $(".panel-group .panel-back").hide();
	history.replaceState(null, '', window.location.href.split('#')[0]);
    Sig.restartMap();
	Sig.showMapElements(Sig.map, contextMap);

  }

</script>
