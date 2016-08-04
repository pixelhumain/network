<?php 
if(!isset($_GET["renderPartial"])){
	$cssAnsScriptFilesModule = array(
		'/plugins/x-editable/css/bootstrap-editable.css',
		'/plugins/wysihtml5/bootstrap3-wysihtml5/bootstrap3-wysihtml5.css',
		'/plugins/wysihtml5/bootstrap3-wysihtml5/bootstrap3-wysihtml5-editor.css',
		'/plugins/x-editable/js/bootstrap-editable.js',
		'/plugins/wysihtml5/bootstrap3-wysihtml5/wysihtml5x-toolbar.min.js',
		'/plugins/wysihtml5/bootstrap3-wysihtml5/bootstrap3-wysihtml5.min.js',
		'/plugins/wysihtml5/wysihtml5.js'
	);
	
	HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule ,Yii::app()->theme->baseUrl."/assets");
	
	
	$cssAnsScriptFilesModule = array(
		'/js/dataHelpers.js',
		'/js/postalCode.js'
	);
	HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule , $this->module->assetsUrl);

?>
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" />
<script type="text/javascript">
    $('head').append('<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/jquery-editable/css/jquery-editable.css" rel="stylesheet" />');
    $.fn.poshytip={defaults:null};
</script>
<script>
if($('#breadcum').length)$('#breadcum').html('<i class="fa fa-search fa-2x" style="padding-top: 10px;padding-left: 20px;"></i><i class="fa fa-chevron-right fa-1x" style="padding: 10px 10px 0px 10px;""></i><a href="javascript:;" onclick="reverseToRepertory();">Répertoire</a><i class="fa fa-chevron-right fa-1x" style="padding: 10px 10px 0px 10px;""></i><?php echo addslashes($element["name"]); ?>');
</script>
<?php 
		if($type != City::CONTROLLER)
			$this->renderPartial('../pod/headerEntity', array("entity"=>$element, "type" => $type)); 
	
		Menu::element($element,$type);
		$this->renderPartial('../default/panels/toolbar'); 
//End isset renderPartial
}
?>
<?php if(!isset($_GET["renderPartial"])){ ?>
<div class="col-md-12 padding-15" id="pad-element-container">
<?php } ?>
	<div class="col-xs-12 infoPanel dataPanel">
			<div class="row">
				<div class="col-sm-12 col-xs-12 col-md-8 no-padding" >
		    		<?php 
		    			$params = array(
		    				"element" => $element,
							"tags" => $tags, 
							"images" => array("profil"=>array($element["profilImageUrl"])),
							"elementTypes" => $listTypes,
							"countries" => $countries,
							"typeIntervention" => $typeIntervention,
							"NGOCategories" => $NGOCategories,
							"localBusinessCategories" => $localBusinessCategories,
		    				"contextMap" => @$contextMap,
		    				"publics" => $public,
		    				"contentKeyBase" => "profil"
		    			);
		    			$this->renderPartial('../pod/ficheInfoElement',$params); 
		    		?>
		    	</div>
			    <div class="col-md-4 no-padding">
					<div class="col-md-12 col-xs-12">
						<?php   $this->renderPartial('../pod/usersList', array(  $controller => $element,
																"users" => $members,
																"userCategory" => Yii::t("common","COMMUNITY"), 
																"contentType" => $type,
																"countStrongLinks" => $countStrongLinks,
																"countLowLinks" => $countLowLinks,
																"admin" => false	));
						?>
			    	</div>
				</div>
			</div>
		 </div>
	</div>
<?php if(!isset($_GET["renderPartial"])){ ?>
</div>
<script type="text/javascript">
var elementLinks = <?php echo isset($element["links"]) ? json_encode($element["links"]) : "''"; ?>;
var contextMap = [];
	
jQuery(document).ready(function() {
	setTimeout(function () {
		// Cette fonction s'exécutera dans 5 seconde (1000 millisecondes)
		$.ajax({
			url: baseUrl+"/"+moduleId+"/element/getalllinks/type/<?php echo $type ?>/id/<?php echo (string)$element["_id"] ?>",
			type: 'POST',
			data:{ "links" : elementLinks },
			async:false,
			dataType: "json",
			complete: function () {},
			success: function (obj){
				console.log("conntext/////");
				console.log(obj);
				Sig.restartMap();
				Sig.showMapElements(Sig.map, obj);	
				contextMap = obj;	
			},
			error: function (error) {
				console.log("error findGeoposByInsee");
				callbackFindByInseeError(error);	
				$("#iconeChargement").hide();	
			}
		});	
	}, 1000);
});

function showElementPad(type){
	var mapUrl = { 	"detail": 
						{ 
							"url"  : "element/detail/type/<?php echo $controller ?>/id/<?php echo (string)$element["_id"] ?>", 
							"hash" : "element.detail.type.<?php echo $controller ?>.id.<?php echo (string)$element["_id"] ?>",
							"data" : null
						} ,
					"news": 
						{ 
							"url"  : "news/index/type/<?php echo $type ?>/id/<?php echo (string)$element["_id"] ?>?isFirst=1", 
							"hash" : "news.index.type.<?php echo $type ?>.id.<?php echo (string)$element["_id"] ?>",
							"data" : null
						} ,
					"directory": 
						{ "url"  : "element/directory/type/<?php echo $type ?>/id/<?php echo (string)$element["_id"] ?>?tpl=directory2", 
						  "hash" : "element.directory.type.<?php echo $type ?>.id.<?php echo (string)$element["_id"] ?>",
						  "data" : {"links":contextMap}
						} ,
					"gallery" :
						{ 
							"url"  : "gallery/index/type/<?php echo $type ?>/id/<?php echo (string)$element["_id"] ?>", 
							"hash" : "gallery.index.type.<?php echo $type ?>.id.<?php echo (string)$element["_id"] ?>",
							"data" : null
						}
					}

	var url  = mapUrl[type]["url"];
	var hash = mapUrl[type]["hash"];
	var data = mapUrl[type]["data"];
	console.log(data);
	$("#pad-element-container").hide(200);
	$.blockUI({
				message : "<h4 style='font-weight:300' class='text-dark padding-10'><i class='fa fa-spin fa-circle-o-notch'></i><br>Chargement en cours ...</span></h4>"
			});
	
	ajaxPost('#pad-element-container',baseUrl+'/'+moduleId+'/'+url+"?renderPartial=true", 
			data,
			function(){ 
				history.pushState(null, "New Title", "#" + hash);
				$("#pad-element-container").show(200);
				$.unblockUI();
			},"html");
}
</script>
<?php } ?>