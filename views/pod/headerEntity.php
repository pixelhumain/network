<?php 
$cssAnsScriptFilesTheme = array(
	//X-editable
	'/assets/plugins/x-editable/css/bootstrap-editable.css',
	'/assets/plugins/x-editable/js/bootstrap-editable.js' , 
	//DatePicker
	'/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js' ,
	'/assets/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.fr.js' ,
	'/assets/plugins/bootstrap-datepicker/css/datepicker.css',
	
	//DateTime Picker
	'/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js' , 
	'/assets/plugins/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.fr.js' , 
	'/assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css',
	//Wysihtml5
	'/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.css',
	'/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysiwyg-color.css',
	'/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js' , 
	'/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5.js' , 
	'/assets/plugins/wysihtml5/wysihtml5.js',
	
	'/assets/plugins/moment/min/moment.min.js',
	'/assets/plugins/Chart.js/Chart.min.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme);
$cssAnsScriptFilesModule = array(
	//Data helper
	'/js/dataHelpers.js',
	'/js/postalCode.js',
	'/js/activityHistory.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
$cssAnsScriptFilesModuleSS = array(
	'/plugins/Chart.js/Chart.min.js',
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModuleSS,Yii::app()->theme->baseUrl."/assets");
?>
<style>
	/*.headerEntity{
		margin-top:-10px;

		background-image: url("<?php echo $this->module->assetsUrl; ?>/images/bg/wavegrid.png");
		background-repeat: repeat;
		
		moz-box-shadow: 0px 2px 4px -1px #656565;
		-webkit-box-shadow: 0px 2px 4px -1px #656565;
		-o-box-shadow: 0px 2px 4px -1px #656565;
		box-shadow: 0px 2px 4px -1px #656565;
		filter: progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=180, Strength=4);
	}*/

	.headerEntity{
		/*margin: 0px;*/
			background-image: url("<?php echo $this->module->assetsUrl; ?>/images/bg/dda-connexion-lines.jpg");
			background-repeat: repeat;
			background-size: 100%;
		-moz-box-shadow: 0px 2px 4px -1px #656565;
		-webkit-box-shadow: 0px 2px 4px -1px #656565;
		-o-box-shadow: 0px 2px 4px -1px #656565;
		box-shadow: 0px 0px 4px -1px #656565;
		filter: progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=180, Strength=4);
		border-radius: 0px;
		margin-top:-10px;
		padding-bottom: 60px
	}

	.headerEntity .thumbnail{
		margin-bottom:0px;
		max-height:150px;
		display:inline;
	}
	.headerEntity .lbl-entity-name{
		font-size:24px;
	}
	.headerEntity .lbl-entity-locality{
		font-size:14px;
	}
	.headerEntity hr{
		border-top: 1px solid rgba(186, 186, 186, 0.5);
		margin-top:7px;
		margin-bottom:7px;

	}
	.headerEntity .label.tag{
		margin-top:3px;
		margin-left:3px;

	}
	.box-ajaxTools{
		margin-top: -70px;
	}
	.box-ajaxTools .btn.tooltips, 
	.box-ajaxTools .btn.tooltips.active{
		margin-right:10px;
		margin-top:15px;
		border-radius: 10px !important;
	}
	.tag{
		cursor: pointer;
	}



	@media screen and (max-width: 1024px) {
		.headerEntity .lbl-entity-name{
			font-size:20px;
		}
		.headerEntity .lbl-entity-locality{
			font-size:13px;
		}
	}
		progress[value] {
    /* Get rid of the default appearance */
    appearance: none;   
    /* This unfortunately leaves a trail of border behind in Firefox and Opera. We can remove that by setting the border to none. */
    border: none;
    /* Add dimensions */
	width: 100%; height: 20px;
    /* Although firefox doesn't provide any additional pseudo class to style the progress element container, any style applied here works on the container. */
    background-color: whiteSmoke;
    border-radius: 3px;
    box-shadow: 0 2px 3px rgba(0,0,0,.5) inset;
    /* Of all IE, only IE10 supports progress element that too partially. It only allows to change the background-color of the progress value using the 'color' attribute. */
    color: royalblue;
    position: relative;
	}
	/*
	Webkit browsers provide two pseudo classes that can be use to style HTML5 progress element.
	-webkit-progress-bar -> To style the progress element container
	-webkit-progress-value -> To style the progress element value.
	*/
	
	progress[value]::-webkit-progress-bar {
	    background-color: whiteSmoke;
	    border-radius: 3px;
	    box-shadow: 0 2px 3px rgba(0,0,0,.5) inset;
	}
	
	progress[value]::-webkit-progress-value {
	    position: relative;
	    
	    background-size: 35px 20px, 100% 100%, 100% 100%;
	    border-radius:3px;
	    
	    /* Let's animate this */
	    animation: animate-stripes 5s linear infinite;
	}
	
	@keyframes animate-stripes { 100% { background-position: -100px 0; } }
	
	/* Firefox provides a single pseudo class to style the progress element value and not for container. -moz-progress-bar */
	progress[value]::-moz-progress-bar {
	    /* Gradient background with Stripes */
	    background-image:
	    -moz-linear-gradient( 135deg,
		    transparent,
		    transparent 33%,
		    rgba(0,0,0,.1) 33%,
		    rgba(0,0,0,.1) 66%,
		    transparent 66%),
	    -moz-linear-gradient( top,
	        rgba(255, 255, 255, .25),
	        rgba(0,0,0,.2)),
	    -moz-linear-gradient( left, #09c, #f44);    
	    background-size: 35px 20px, 100% 100%, 100% 100%;
	    border-radius:3px;
	    /* Firefox doesn't support CSS3 keyframe animations on progress element. Hence, we did not include animate-stripes in this code block */
	}
	
	.progressStyle::-webkit-progress-value
	{
	    /* Gradient background with Stripes */
	    background-image:
	    -webkit-linear-gradient( 135deg,
	        transparent,
		    transparent 33%,
		    rgba(0,0,0,.1) 33%,
		    rgba(0,0,0,.1) 66%,
		    transparent 66%),
	    -webkit-linear-gradient( top,
	        rgba(255, 255, 255, .25),
	        rgba(0,0,0,.2)),
	    -webkit-linear-gradient( left, #09c, #ff0);
	}
</style>

<div class="row headerEntity bg-light">

		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 padding-10 center">
			<?php   
				if(@$entity["profilMediumImageUrl"] && !empty($entity["profilMediumImageUrl"]))
					$images=array("profil"=> array($entity["profilMediumImageUrl"]));
				else 
					$images="";	
				$this->renderPartial('../pod/fileupload', array("itemId" => $entity["_id"],
																  "type" => $type,
																  "contentId" => Document::IMG_PROFIL,
																  "editMode" => false,
																  "image" => $images)); 
			
			//	$profilThumbImageUrl = Element::getImgProfil(@$entity, "profilMediumImageUrl", $this->module->assetsUrl);
			?>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-8">

			<div class="col-lg-12 col-md-12 col-sm-12 no-padding">
				<div class="col-md-12 no-padding margin-top-15">
					<span class="lbl-entity-name">
						<i class="fa fa-<?php echo Element::getFaIcon($type); ?>"></i> <?php echo @$entity["name"]; ?>
					</span>
				</div>
				<div class="col-md-12 no-padding no-padding margin-bottom-10">
					<span class="lbl-entity-locality text-red">
						<i class="fa fa-globe"></i> 
						<?php echo @$entity["address"]["addressLocality"].", ".
									@$entity["address"]["postalCode"].", ".
									@$entity["address"]["addressCountry"]; ?>
					</span>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding hidden-xs">
				<?php echo substr(@$entity["shortDescription"], 0, 140);
						if(strlen(@$entity["shortDescription"])>140) echo "...";
				 ?>
			</div>


		</div>
		<?php 
			$colXS = "3";
			if(!isset($entity["tags"]) && !isset($entity["gamification"])) $colXS = "3 hidden";
		?>
		<div class="col-lg-3 col-md-3 col-sm-<?php echo $colXS; ?> col-xs-12 pull-right padding-10">
			<?php if(isset($entity["tags"]) || isset($entity["gamification"])){ ?>
			<div class="col-lg-12 col-md-12 col-sm-12 no-padding">
				<span class="tag label label-warning pull-right">
					<?php echo  @$entity["gamification"]['total'] ? 
								@$entity["gamification"]['total'] :
								"0"; 
					?> pts
				</span>
				<?php if(isset($entity["tags"])){ ?>
					<?php $i=0; foreach($entity["tags"] as $tag){ if($i<6) { $i++;?>
					<div class="tag label label-danger pull-right" data-val="<?php echo  $tag; ?>">
						<i class="fa fa-tag"></i> <?php echo  $tag; ?>
					</div>
					<?php }} ?>
				<?php } ?>
			</div>
			<?php } ?>
		</div>
</div>
<?php 
Menu::element($entity,$type);
$this->renderPartial('../default/panels/toolbar');
if(!@$_GET["renderPartial"]){ 
?>
<div class="col-md-12 padding-15" id="pad-element-container">

<script type="text/javascript">
var elementLinks = <?php echo isset($entity["links"]) ? json_encode($entity["links"]) : "''"; ?>;
var contextMapEntity = [];
var element = <?php echo isset($entity) ? json_encode($entity) : "''"; ?>;
console.log(elementLinks);
jQuery(document).ready(function() {
	setTimeout(function () {
		// Cette fonction s'exécutera dans 5 seconde (1000 millisecondes)
		$.ajax({
			url: baseUrl+"/"+moduleId+"/element/getalllinks/type/<?php echo $type ?>/id/<?php echo (string)$entity["_id"] ?>",
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
				contextMapEntity = obj;	
				$(".communityBtn").removeClass("hide");
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
							"url"  : "element/detail/type/<?php echo $type ?>/id/<?php echo (string)$entity["_id"] ?>?", 
							"hash" : "element.detail.type.<?php echo $type ?>.id.<?php echo (string)$entity["_id"] ?>",
							"data" : null
						} ,
					"news": 
						{ 
							"url"  : "news/index/type/<?php echo $type ?>/id/<?php echo (string)$entity["_id"] ?>?isFirst=1&", 
							"hash" : "news.index.type.<?php echo $type ?>.id.<?php echo (string)$entity["_id"] ?>",
							"data" : null
						} ,
					"directory": 
						{ "url"  : "element/directory/type/<?php echo $type ?>/id/<?php echo (string)$entity["_id"] ?>?tpl=directory2&", 
						  "hash" : "element.directory.type.<?php echo $type ?>.id.<?php echo (string)$entity["_id"] ?>",
						  "data" : {"links": contextMapEntity, "element":element}
						} ,
					"gallery" :
						{ 
							"url"  : "gallery/index/type/<?php echo $type ?>/id/<?php echo (string)$entity["_id"] ?>?", 
							"hash" : "gallery.index.type.<?php echo $type ?>.id.<?php echo (string)$entity["_id"] ?>",
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
	
	ajaxPost('#pad-element-container',baseUrl+'/'+moduleId+'/'+url+"renderPartial=true", 
			data,
			function(){ 
				history.pushState(null, "New Title", "#" + hash);
				$("#pad-element-container").show(200);
				$.unblockUI();
			},"html");
}
</script>
<?php } ?>