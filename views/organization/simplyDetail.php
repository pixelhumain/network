<?php 

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
if($('#breadcum').length)$('#breadcum').html('<i class="fa fa-search fa-2x" style="padding-top: 10px;padding-left: 20px;"></i><i class="fa fa-chevron-right fa-1x" style="padding: 10px 10px 0px 10px;""></i><a href="javascript:;" onclick="reverseToRepertory();">Répertoire</a><i class="fa fa-chevron-right fa-1x" style="padding: 10px 10px 0px 10px;""></i><?php echo addslashes($organization["name"]); ?>');
</script>
<div class="col-xs-12 infoPanel dataPanel">
		<div class="row">
			<div class="col-sm-12 col-xs-12 col-md-12">
	    		<?php 
	    			$params = array(
	    				"organization" => $organization,
						"tags" => $tags, 
						"images" => $images,
						"plaquette" => $plaquette,
						"organizationTypes" => $organizationTypes,
						"countries" => $countries,
						"typeIntervention" => $typeIntervention,
						"NGOCategories" => $NGOCategories,
						"localBusinessCategories" => $localBusinessCategories,
	    				"contextMap" => $contextMap,
	    				"publics" => $public,
	    				"contentKeyBase" => @$contentKeyBase
	    			);
	    			//print_r($params);
	    			$this->renderPartial('../pod/simplyFicheInfo',$params); 
	    		?>
	    	</div>
	    </div>
	 </div>
</div>