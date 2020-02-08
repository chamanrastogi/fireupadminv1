<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }


$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS,DB_NAME) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */
 $table=ucfirst($_POST['action']);
 $url=$_POST['action'];
 $filen="ajax_".$table.".php";
 $consss=0;

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 =>'id', 
	1 =>'username', 
	2 =>'fullname'
	
);

// getting total number records without any search


$sql = "SELECT * ";
$sql.=" FROM users";
$query=mysqli_query($conn, $sql) or die("ajax_user.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql = "SELECT * ";
$sql.=" FROM users WHERE 1=1";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( name LIKE '".$requestData['search']['value']."%' ";   
    $sql.=" OR full_name LIKE '".$requestData['search']['value']."%' "; 	
	$sql.="  )";	
}
$query=mysqli_query($conn, $sql) or die("ajax_user.php: get employees");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($conn, $sql) or die("ajax_user.php: get employees");

$data = array();
$row= array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
		$nestedData=array(); 		

$st='<a href="javascript:confirmDelete(';
$end=')" class="btn btn-danger btn-circle btn-xs waves-effect waves-light"><i class="ico fa fa-trash"></i></a>';
$ro=User::find_by_id($row['id']);	
$img=SITE_ROOT.DS.BASE_FOLDER.UPLOAD_PATH.$url.DS.$ro->avatar;	
if(file_exists($img))
{
	
	if($ro->avatar!='')
	{
	 $img=BASE_PATH.DS.BASE_FOLDER.UPLOAD_PATH.$url.DS.$ro->avatar;
	}else
	{
		$img=BASE_PATH.DS.BASE_FOLDER.UPLOAD_PATH.'sample.jpg';
		}
}else
{
	$img=BASE_PATH.DS.BASE_FOLDER.UPLOAD_PATH.'sample.jpg';
	}
$code=TP_BACK_SIDE.'user/delete/'.$ro->id;			
$nestedData[] = $ro->id;
$nestedData[] = ucfirst($ro->full_name);
$nestedData[] = '<a  class="item-gallery lightview" data-lightview-group="group" href="'.$img.'">
                    <img src="'.$img.'"  class="img-polaroid" width="60" height="60" border="0"></a>';
$nestedData[] = '<a href="'.TP_BACK_SIDE.$url.'/status/'.$ro->id.'"  style="color:blue">'.$ro->status.'</a>';
$nestedData[] = '<a href="'.TP_BACK_SIDE.'user/edit/'.$ro->id.'" class="btn btn-info btn-circle btn-xs waves-effect waves-light">
				       <i class="ico fa fa-pencil "></i></a>'.$st."'$code'".$end;
$nestedData[] = '';

$data[] = $nestedData;
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
