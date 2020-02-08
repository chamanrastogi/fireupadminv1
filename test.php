<?php
//error_reporting(0);
include('includes/initialize.php');
$data = new Mysql_code_genrator();
//---------------blueprint Area------------------//

$table="client";   //-------------table name---------//

$str="$"."str";
$str1="$"."str1";
$str2="$"."str2";
$int="$"."int";
$ints="$"."ints";
$date="$"."date";
$text="$"."text";
$mtext="$"."mtext";
$datetime="$"."datetime";
$date="$"."date";
$enum="$"."enum";

$blueprint_code="
Table :--$table

Mysql Code :--['name',$str,'image',$str,'text',$mtext]

"."Form Code :--".'$fdata->co("input","name",1).$fdata->image("Image Upload","image").$fdata->text("Text","text",1)';
$data->blueprint($table,"includes/blueprint/",$blueprint_code);
$data->createmodel($table,"includes/model/");
//---------------------End The Blueprint Area------------------//

$str=$data->vc(100);
$str1=$data->vc(255);
$str2=$data->vc(500);
$int=$data->int();
$ints=$data->int(20);
$date=$data->date();
$text=$data->text();
$mtext=$data->mtext();
$datetime=$data->datetime();
$date=$data->date();

$val=['Active','Deactive'];
$enum=$data->enum($val);
$status=['status',$enum];
$timestamp=['created',$datetime,'updated',$datetime];
//echo $em;

//-------------------------------------------------------------------------------------------------------------

$main=['name',$str,'image',$str,'text',$mtext];
//$vrs=array_merge($main,$timestamp,$status);
$vrs=array_merge($main,$status);
//print_r($vrs); //-Show the merged array
$ch1=sizeof($vrs);
echo "<strong>Created Table Name:</strong>".ucfirst($table)."<br><strong>No of Fields In Tables Total :</strong>".( $ch1/2). "<br>-----------------------<br>";
//print_r($vrs); //-Show the merged array
//------------------------------------------------Form Maker------------------------------------------------------
$fdata = new formstruck();
$fromx= $fdata->co("input","name",1).$fdata->image("Image Upload","image").$fdata->text("Text","text",1);
//$fromx=$fdata->select("Class","cl_id",'sclass','cl_id',1).$fdata->co("input","name",1).$fdata->image("Image Upload","image");
//--------------------------------------------------End Form Maker---------------------------------------------------------
$data->create($table,$vrs);
$ro=$data->showlist($table,$fromx);
//echo $ro;
$data->cc($table,$fromx);



//$table="result";
//$vrs=['cid',$int,'name',$str,'price',$str,'image',$str,'text',$text,'attr',$str,'created',$datetime,'status',$enum];
//$ch1=sizeof($vrs);
//echo "<strong>Created Table Name:</strong>".ucfirst($table)."<br><strong>No of Fields In Tables Total :</strong>".( $ch1/2). "<br>-----------------------<br>";
//print_r($vrs);
//$data->create($table,$vrs);
//$ro=$data->showlist('tops');
//echo $ro;
//$data->cc($table);

?>
