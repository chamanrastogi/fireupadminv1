<!-- /.row -->
<?php $temp=Template::find_by_id(1); ?>		
		
	</div>
	<!-- /.main-content -->
</div><!--/#wrapper -->
<footer class="footer" >
			<p class="text-right"><strong>Copyright © <?=date('Y')?> <?=$temp->sitename?></strong></p>
		</footer>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="<?=TP_BACK?>assets/script/html5shiv.min.js"></script>
		<script src="<?=TP_BACK?>assets/script/respond.min.js"></script>
	<![endif]-->
	<!-- 
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="<?=TP_BACK?>assets/scripts/jquery.min.js"></script>
      <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>

<script>
$("#up").dropzone({ url: "upload" });
Dropzone.options.dropzoneForm = {
	acceptedFiles:".pdf",
	maxFilesize:20,
    dictDefaultMessage: "Upload Your PDF Document", 
	dictFallbackMessage: "File Uploaded"
};

</script>
	 <script src="<?=TP_BACK?>assets/scripts/jquery.slugify.js" type="text/javascript"></script>
         <script type="text/javascript" charset="utf-8">
			$().ready(function () {
				
				$('.url').slugify('#cname');
			
				var pigLatin = function(str) {
					return str.replace(/(\w*)([aeiou]\w*)/g, "$2$1ay");
				}
			
				$('#pig_latin').slugify('#cname', {
						slugFunc: function(str, originalFunc) { return pigLatin(originalFunc(str)); } 
					}
				);
			
			}); 
		</script>
	
	
		<!--<![endif]-->
		<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

		<!-- elFinder JS (REQUIRED) -->
		<script src="<?=TP_BACK?>elfinder/js/elfinder.min.js"></script>

		<!-- Extra contents editors (OPTIONAL) -->
		<script src="<?=TP_BACK?>elfinder/js/extras/editors.default.min.js"></script>

		<!-- GoogleDocs Quicklook plugin for GoogleDrive Volume (OPTIONAL) -->
		<!--<script src="js/extras/quicklook.googledocs.js"></script>-->

		<!-- elFinder initialization (REQUIRED) -->
		<script type="text/javascript" charset="utf-8">
			// Documentation for client options:
			// https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
			$(document).ready(function() {
				$('#elfinder').elfinder(
					// 1st Arg - options
					{
						cssAutoLoad : false,               // Disable CSS auto loading
						baseUrl : './',                    // Base URL to css/*, js/*
						url : '<?=TP_BACK?>elfinder/php/connector.minimal.php'  // connector URL (REQUIRED)
						// , lang: 'ru'                    // language (OPTIONAL)
					},
					// 2nd Arg - before boot up function
					function(fm, extraObj) {
						// `init` event callback function
						fm.bind('init', function() {
							// Optional for Japanese decoder "encoding-japanese.js"
							if (fm.lang === 'ja') {
								fm.loadScript(
									[ '//cdn.rawgit.com/polygonplanet/encoding.js/1.0.26/encoding.min.js' ],
									function() {
										if (window.Encoding && Encoding.convert) {
											fm.registRawStringDecoder(function(s) {
												return Encoding.convert(s, {to:'UNICODE',type:'string'});
											});
										}
									},
									{ loadType: 'tag' }
								);
							}
						});
						// Optional for set document.title dynamically.
						var title = document.title;
						fm.bind('open', function() {
							var path = '',
								cwd  = fm.cwd();
							if (cwd) {
								path = fm.path(cwd.hash) || null;
							}
							document.title = path? path + ':' + title : title;
						}).bind('destroy', function() {
							document.title = title;
						});
					}
				);
			});
		</script>
	<script src="<?=TP_BACK?>assets/scripts/modernizr.min.js"></script>
    <script src="<?=TP_BACK?>assets/scripts/image.js"></script>
	<script src="<?=TP_BACK?>assets/plugin/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?=TP_BACK?>assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="<?=TP_BACK?>assets/plugin/nprogress/nprogress.js"></script>
	<script src="<?=TP_BACK?>assets/plugin/sweet-alert/sweetalert.min.js"></script>
	<script src="<?=TP_BACK?>assets/plugin/waves/waves.min.js"></script>
		
	<!-- Sparkline Chart -->
	<script src="<?=TP_BACK?>assets/plugin/chart/sparkline/jquery.sparkline.min.js"></script>
	<script src="<?=TP_BACK?>assets/scripts/chart.sparkline.init.min.js"></script>

	<!-- Percent Circle -->
	<script src="<?=TP_BACK?>assets/plugin/percircle/js/percircle.js"></script>
<!-- Chartist Chart -->
	<script src="<?=TP_BACK?>assets/plugin/chart/chartist/chartist.min.js"></script>
	<script src="<?=TP_BACK?>assets/scripts/jquery.chartist.init.min.js"></script>

		<!-- Colorpicker -->
		<script src="<?=TP_BACK?>assets/plugin/colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Toastr -->
	<script src="<?=TP_BACK?>assets/plugin/toastr/toastr.min.js"></script>
	<script src="<?=TP_BACK?>assets/scripts/toastr.demo.min.js"></script>
    <!-- Validator -->
    <!-- Datepicker -->
	<script src="<?=TP_BACK?>assets/plugin/datepicker/js/bootstrap-datepicker.min.js"></script>
	<script src="<?=TP_BACK?>assets/plugin/validator/validator.min.js"></script>
    <!-- Popover -->
	<script src="<?=TP_BACK?>assets/plugin/popover/jquery.popSelect.min.js"></script>

    <!-- Select2 -->
	<script src="<?=TP_BACK?>assets/plugin/select2/js/select2.min.js"></script>

	<!-- Multi Select -->
	<script src="<?=TP_BACK?>assets/plugin/multiselect/multiselect.min.js"></script>

    	<script type="text/javascript" src="<?=TP_BACK?>assets/scripts/loader.js"></script>
    <!-- Demo Scripts -->
	<script src="<?=TP_BACK?>assets/scripts/form.demo.min.js"></script>
    <!-- Data Tables -->
	<script src="<?=TP_BACK?>assets/plugin/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?=TP_BACK?>assets/plugin/datatables/media/js/dataTables.bootstrap.min.js"></script>
<script src="<?=TP_BACK?>assets/plugin/datatables/media/js/dataTables.buttons.min.js"></script>
<script src="<?=TP_BACK?>assets/plugin/datatables/media/js/buttons.flash.min.js"></script>
<script src="<?=TP_BACK?>assets/plugin/datatables/media/js/jszip.min.js"></script>
<script src="<?=TP_BACK?>assets/plugin/datatables/media/js/pdfmake.min.js"></script>
<script src="<?=TP_BACK?>assets/plugin/datatables/media/js/vfs_fonts.js"></script>
<script src="<?=TP_BACK?>assets/plugin/datatables/media/js/buttons.html5.min.js"></script>
<script src="<?=TP_BACK?>assets/plugin/datatables/media/js/buttons.print.min.js"></script>
<script src="<?=TP_BACK?>assets/scripts/datatables.demo.min.js"></script>
    <!-- Lightview -->
    

    <script type="text/javascript" language="javascript" >
	
	
			$(document).ready(function() {
				
				var dataTable = $('#student-paid').DataTable( {
					"processing": true,
					"serverSide": true,
					 dom : 'lBfrtip',
       
		"lengthMenu": [ [10, 25, 50, 100,1000,2000,3000,10000, -1], [10, 25, 50, 100,1000,2000,3000,10000] ],
    	"pageLength": 10,
					
					"ajax":{
						url :"<?=TP_BACK?>resources/student-paid.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
						}
					}
				} );
				
				var dataTable = $('#student-free').DataTable( {
					"processing": true,
					"serverSide": true,
					 dom : 'lBfrtip',
        
		"lengthMenu": [ [10, 25, 50, 100,1000,2000,3000,10000, -1], [10, 25, 50, 100,1000,2000,3000,10000] ],
    "pageLength": 10,
					"ajax":{
						url :"<?=TP_BACK?>resources/student-free.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
						}
					}
				} );
				var dataTable = $('#student-all').DataTable( {
					"processing": true,
					"serverSide": true,
					 dom : 'lBfrtip',
        
		"lengthMenu": [ [10, 25, 50, 100,1000,2000,3000,10000, -1], [10, 25, 50, 100,1000,2000,3000,10000] ],
    "pageLength": 10,
					"ajax":{
						url :"<?=TP_BACK?>resources/student-all.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
						}
					}
				} );
			} );
		</script>
    
    
	<script src="<?=TP_BACK?>assets/plugin/lightview/js/lightview/lightview.js"></script>
<!-- Multi Select -->
	<script src="<?=TP_BACK?>assets/plugin/multiselect/multiselect.min.js"></script>

    	<script type="text/javascript" src="<?=TP_BACK?>assets/scripts/loader.js"></script>
    <!-- Demo Scripts -->
	<script src="<?=TP_BACK?>assets/scripts/main.min.js"></script>
   <script type="text/javascript">
$(document).ready(function()
{

$(".country").change(function()
{

var dataString = 'id='+ $(this).val();
$.ajax
({
type: "POST",
url: "<?=TP_BACK?>resources/ajax_courses.php",
data: dataString,
cache: false,
success: function(html)
{
$(".state").html(html);
} 
});

});

$('.state').change("change",function(){
							   
var dataString = 'id='+ $(this).val();
$.ajax
({
type: "POST",
url: "<?=TP_BACK?>resources/ajax_module.php",
data: dataString,
cache: false,
success: function(html)
{
$(".city").html(html);
} 
});

});



});
</script>
<script type="text/javascript">
$(document).ready(function()
{
	
$(".student").change(function()
{
var dataString = 'id='+ $(this).val();
$.ajax
({
type: "POST",
url: "<?=TP_BACK?>resources/ajax_courses_pur.php",
data: dataString,
cache: false,
success: function(html)
{
$(".student_pur").html(html);
} 
});

});



});
</script>

</body>
</html>