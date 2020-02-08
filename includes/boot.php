<?php
class Boot
{
	protected static $col=6;

    public static function form_start($action="",$name,$method,$file)
	  {
		  if($file!='')
		  {
			  $c='enctype="multipart/form-data"';
		}else
		  {
			 $c=''; }
	  $x = '<form action="'.$action.'" id="'.$name.'" method="'.$method.'" class="visa-consultation-form" name="'.$name.'" '.$c.' autocomplete="off">';
	  return $x;
	  }
	  public static function form_end()
	  {
	  $x = '</form>';
	  return $x;
	  }
	  public static function msg($message)
	  {
		  $x='';
	  if (!empty($message)): 
     $x = '<div class="alert alert-success">
      '.$message.'
    </div>';
   endif; 
   return $x;
  }
	  public static function submit($lable,$name="")
	  {
	  $x = '<div class="col-md-12 col-xs-12"><div class="request-button">
	  
	  <button type="submit" name="'.$name.'" id="submits" class="btn btn-primary">'.$lable.'<i class="flaticon-next"></i></button>
	  </div></div>';
	  return $x;
	  }
	  public static function check($v)
	  {
		  $re='';
		  if($v==1)
	  {
		  $re='required';
	  }
	  return $re;
		  }
	 public static function disable_check($v)
	  {
		  $re='';
		  if($v==1)
	  {
		  $re='disabled';
	  }
	  return $re;
		  }
		   public static function checkst($v)
	  {
		  $res='';
		  if($v==1)
	  {
		  $res=' <span class="errors">*</span> ';
	  }
	  return $res;
		  }
	  public static function input($lable="", $name="", $value="",$n,$wt,$dt)
	  {
		 $re=self::check($n);
		 $res=self::checkst($n);
		 $dts=self::disable_check($dt);
		 
	  
	  $x = '<div class="col-md-'.$wt.' col-sm-'.self::$col.' col-xs-12"> <label>'.$lable.''.$res.':</label>
       <input type="text"  name="'.$name.'" class="form-control" value="'.$value.'" '. $re.' '.$dts.'></div>';
	  return $x;
	  }
	  public static function input_sm($lable="", $name="", $value="",$n,$dt)
	  {
		 $re=self::check($n);
		 $res=self::checkst($n);
		 $dts=self::disable_check($dt); 
	  
	  $x = '<div class="col-md-3 col-xs-12"> <label>'.$lable.''.$res.':</label>
       <input type="text"  name="'.$name.'" value="'.$value.'" '. $re.' '.$dts.'></div>';
	  return $x;
	  }
	  public static function imagesp($lable="", $name="", $image="",$url,$note,$wt,$n)
	  {
		  $re=self::check($n);
		 $res=self::checkst($n);
	  $img='';
	  $x = '<div class="col-md-'.$wt.' col-sm-'.self::$col.' col-xs-12">
	  <div class="col-md-4">'.$img.'</div>
	  <label>'.$lable.''.$res.':</label>     
      <input type="file"  name="'.$name.'" id="'.$name.'" class="form-control" placeholder="'.$lable.'"  '. $re.'>
	  <div><strong>Note:</strong>'.$note.'</div>
	  </div>';
	  return $x;
	  }
	   public static function email($lable="", $name="", $value="",$n,$wt,$dt)
	  {
		 $re=self::check($n);
		 $res=self::checkst($n);
	  	 $dts=self::disable_check($dt);
	 $x = ' <div class="col-md-'.$wt.' col-sm-'.self::$col.' col-xs-12"><label>'.$lable.''.$res.':</label>
       <input type="email"  name="'.$name.'" class="form-control" value="'.$value.'" '.$re.' '.$dts.'></div>';
	  return $x;
	  }
	  
	  public static function input_hidden($name="", $value="")
	  {	  
	 $x = ' 
       <input type="hidden"  name="'.$name.'" class="form-control" value="'.$value.'" >';
	  return $x;
	  }
	  
	   public static function password($lable="", $name="", $value="",$id,$n)
	  {
		  $re=self::check($n);
		 $res=self::checkst($n);
	  
	$x = ' <div class="col-md-'.self::$col.' col-xs-12"><label>'.$lable.''.$res.':</label>
       <input type="password"  name="'.$name.'" id="'.$id.'" class="form-control" value="'.$value.'" '. $re.'></div>';
	 
	  return $x;
	  }
	     public static function cpassword($lable="", $name="", $value="",$n)
	  {
		  $re=self::check($n);
		 $res=self::checkst($n);
	  
	$x = ' <div class="col-md-'.self::$col.' col-xs-12"><label>'.$lable.''.$res.':</label>
       <input type="password" id="'.$name.'"  name="'.$name.'" class="form-control"  '. $re.'></div>';
	 
	  return $x;
	  }
	  public static function date($lable="", $name="", $value="",$n,$wt, $id="",$dt="")
	  {
		 
		  $re=self::check($n);
		 $res=self::checkst($n);
		 $dts=self::disable_check($dt); 
	  $x = ' <div class="col-md-'.$wt.' col-sm-'.self::$col.' col-xs-12"><label>'.$lable.''.$res.':</label>
       <input type="text" id="'.$id.'"  name="'.$name.'" value="'.$value.'" '. $re.'  '. $dts.' class="datepicker form-control" data-large-mode="true" data-large-default="true" data-default-date="'.$value.'"></div>';
	  return $x;
	  
	  return $x;
	  }
	   public static function date2($lable="", $name="", $value="",$n,$wt, $id="",$dt)
	  {
		  $re=self::check($n);
		 $res=self::checkst($n);
		 $dts=self::disable_check($dt); 
	  $x = ' <div class="col-md-'.$wt.' col-sm-'.self::$col.' col-xs-12"><label>'.$lable.''.$res.':</label>
       <input type="text" id="'.$id.'"  name="'.$name.'" value="'.$value.'" '. $re.' '. $dts.' class="form-control" data-large-mode="true" data-large-default="true" data-default-date="'.$value.'"></div>';
	  return $x;
	  
	  return $x;
	  }
	   public static function textarea($lable="", $name="",$value="",$n,$dt)
	  {
		 $re=self::check($n);
		 $res=self::checkst($n);
		 $dts=self::disable_check($dt); 
	  $x = ' <div class="col-md-12 col-xs-12"><label>'.$lable.''.$res.':</label>
      <textarea name="'.$name.'" '. $re.' '. $dts.'  placeholder="'.$lable.'">'.$value.'</textarea></div>';
	  return $x;
	  
	  return $x;
	  }
	  public static function image_edit($lable="", $name="",$path,$image)
		{
			
		$x = '<div class="col-md-12 col-xs-12">
								<label>'.$lable.'</label>
<div class="col-md-12 col-xs-12">';

	
	 if(file_exists($_SERVER['DOCUMENT_ROOT']."/".MYF.$path))
							{
							
					if($image!='')
{
						
        $x.= '<div align="left"> 
		<img  src="'.BASE_PATH.$path.'"  width="160" height="160"/></div>
                  <div align="left" style="margin-top:20px;"><strong>Remove Image:</strong>
                    <input type="checkbox" name="check_'.$name.'" id="checkbox" value="1" />
                  </div>
                  
                  <input type="hidden" name="tpimg_'.$name.'" value="'.$image.'" >';
							}
							 }else
			{
				$x.= '<div> <img class="thumbnail" src="'.TP_BACK.'assets/images/sample.jpg'.'" width="160" height="160" /></div><br>';
				}
				$x.= '<div class="input-group image-preview">
                               
                        <input type="file" accept="image/png, image/jpeg, image/gif" name="'.$name.'"/> <!-- rename it -->
                  
            </div>
								
							</div></div>';
		return $x;
		}
		public static function Select_sp($lable="",$name="",$last,$value,$n)
	  {
		 $n=1;
		  $re=self::check($n);
		 $res=self::checkst($n);
	  $x = '<div class="col-md-3 col-xs-12">  <label>'.$lable.''.$res.':</label>
	  
	  <select name="'.$name.'" class="form-control" '.$re.'>';
	  if($value!='')
	  {
	  $x.= '<option value="'.$value.'" selected>'.$value.'</option>';
	  }else
	  {
	  $x.= '<option value="0">Select No Of Children...</option>';
	  }
	  while($n != ($last+1))
	  {
		  if($n!=$value)
		  {
	  $x.= '<option value="' . $n . '">' . $n . '</option>';
		  }
      $n++;
	  }
	  
	  $x.= '</select></div>
	 
	  ';
	  return $x;
	  }
		 public static function Select_a($lable="", $name="", $table,$n)
	  {
		 
		    $re=self::check($n);
		 $res=self::checkst($n);
	  $x = '<div class="col-md-'.self::$col.' col-xs-12">  <label>'.$lable.''.$res.':</label>
	  
	  <select name="'.$name.'" class="form-control state" '.$re.'><option value="0">Choose a State...</option>';
	 $tb=$table::find_all();
	  foreach($tb as $rw)
	  {
	  $x.= '<option value="' . $rw->id . '">' . ucfirst($rw->name) . '</option>';
	  }
	  
	  $x.= '</select></div>
	 
	  ';
	  return $x;
	  }
	  public static function Select2($lable="",$xp='',$name="",$table,$mid,$n,$wt,$dt)
	  {
		 
		 $re=self::check($n);
		 $res=self::checkst($n);
		 $dts=self::disable_check($dt); 
	  $x = '<div class="col-md-'.$wt.' col-xs-12"> 
	   <label>'.$lable.''.$res.':</label>
	  
	  <select name="'.$name.'" class="country form-control" '.$dts.'>
	  <option value="">Select '.ucfirst($xp).'</option>';
								if($mid!='')
								{ $rw1=$table::find_by_id($mid);
									$x.='<option selected="selected" value="'.$rw1->id.'">'.ucfirst($rw1->name).'</option>';
									}
                                 $rs=$table::find_all();
								foreach($rs as $rw)
								{
									if($rw->id!=$mid)
								{
                                 $x.='<option value="'.$rw->id.'">'.ucfirst($rw->name).'</option>';
								}
								}
                                $x.='</select></div>
	 
	  ';
	  return $x;
	  }
	  public static function Select_val($lable="",$xp='',$name="",$class,$val,$table,$mid,$n,$wt,$dt)
	  {
		 
		 $re=self::check($n);
		 $res=self::checkst($n);
		 $dts=self::disable_check($dt); 
	  $x = '<div class="col-md-'.$wt.' col-xs-12"> 
	   <label>'.$lable.''.$res.':</label>
	  
	  <select name="'.$name.'" class="'.$class.' form-control" '.$dts.'>
	  <option value="0">Select '.ucfirst($xp).'</option>';
								if($mid!='')
								{ $rw1=$table::find_by_id($mid);
									$x.='<option selected="selected" value="'.$rw1->id.'">'.ucfirst($rw1->name).'</option>';
									}
                                 $rs=$table::find_all();
								foreach($rs as $rw)
								{
									if($rw->id!=$mid)
								{
                                 $x.='<option value="'.$rw->$val.'">'.ucfirst($rw->name).'</option>';
								}
								}
                                $x.='</select></div>
	 
	  ';
	  return $x;
	  }
	  public static function Select_class($lable="",$xp='',$class='',$name="",$table,$mid,$n,$wt,$dt)
	  {
		 
		 $re=self::check($n);
		 $res=self::checkst($n);
		 $dts=self::disable_check($dt); 
	  $x = '<div class="col-md-'.$wt.' col-xs-12"> 
	   <label>'.$lable.''.$res.':</label>
	  
	  <select name="'.$name.'" class="'.$class.' form-control" '.$dts.'>
	  <option value="">Select '.ucfirst($xp).'</option>';
								if($mid!='')
								{ $rw1=$table::find_by_id($mid);
									$x.='<option selected="selected" value="'.$rw1->id.'">'.ucfirst($rw1->name).'</option>';
									}
                                 $rs=$table::find_all();
								foreach($rs as $rw)
								{
									if($rw->id!=$mid)
								{
                                 $x.='<option value="'.$rw->id.'">'.ucfirst($rw->name).'</option>';
								}
								}
                                $x.='</select></div>
	 
	  ';
	  return $x;
	  }
	   public static function Selectajax_class($lable="",$xp='',$class,$name="",$table,$mid,$n,$wt,$dt)
	  {
		 $re=self::check($n);
		 $res=self::checkst($n);
		 $dts=self::disable_check($dt);
		$x = '<div class="col-md-'.$wt.' col-sm-'.self::$col.'  col-xs-12">  <label>'.$lable.''.$res.':</label>
			<select name="'.$name.'" class="'.$class.' form-control" '.$re.' '.$dts.'><option value="">'.$xp.'</option> ';
			
								if($mid!='')
								{ 
								if($mid==0)
								{
									$x.= '<option selected="selected" value="0">--Select '.$lable.'--</option>';
								}
								else
								{
								$rw1=$table::find_by_id($mid);
									$x.='<option selected="selected" value="'.$rw1->id.'">'.ucfirst($rw1->name).'</option>';
								}
									}
                                
                                $x.='</select>
								</div>';
		return $x;
		}
	   public static function Selectajax($lable="",$xp='',$name="",$table,$mid,$n,$wt,$dt)
	  {
		 $re=self::check($n);
		 $res=self::checkst($n);
		 $dts=self::disable_check($dt);
		$x = '<div class="col-md-'.$wt.' col-sm-'.self::$col.'  col-xs-12">  <label>'.$lable.''.$res.':</label>
			<select name="'.$name.'" class="'.$name.' form-control" '.$re.' '.$dts.'><option value="">'.$xp.'</option> ';
			
								if($mid!='')
								{ 
								if($mid==0)
								{
									$x.= '<option selected="selected" value="0">--Select '.$lable.'--</option>';
								}
								else
								{
								$rw1=$table::find_by_id($mid);
									$x.='<option selected="selected" value="'.$rw1->id.'">'.ucfirst($rw1->name).'</option>';
								}
									}
                                
                                $x.='</select>
								</div>';
		return $x;
		}
      public static function Selectajax2($lable="",$xp='',$name="",$table,$mid,$n,$wt,$dt)
	{
		 $re=self::check($n);
		 $res=self::checkst($n);
		 $dts=self::disable_check($dt);
		$x = '<div class="col-md-'.$wt.' col-sm-'.self::$col.' col-xs-12">  <label>'.$lable.''.$res.':</label>
			<select name="'.$name.'" class="'.$name.' form-control" '.$re.' '.$dts.'><option value="">'.$xp.'</option>';
								if($mid!='')
								{ 
								if($mid==0)
								{
									$x.= '<option selected="selected" value="0">--Select '.$lable.'--</option>';
								}
								else
								{
								$rw1=$table::find_by_id($mid);
									$x.='<option selected="selected" value="'.$rw1->id.'">'.ucfirst($rw1->name).'</option>';
								}
									}
                               
                                $x.='</select>
								</div>';
		return $x;
		}
		public static function Selectajax2cc($lable="",$xp='',$name="",$table,$country,$apply,$mid,$n,$wt,$dt)
	{
		   $re=self::check($n);
		 $res=self::checkst($n);
		  $dts=self::disable_check($dt);
		$x = '<div class="col-md-'.$wt.' col-sm-'.self::$col.' col-xs-12">  <label>'.$lable.''.$res.':</label>
			<select name="'.$name.'" class="'.$name.' form-control" '.$re.' '.$dts.'>';
								if($mid!='')
								{ 
								if($mid==0)
								{
									$x.= '<option selected="selected" value="0">--Select '.$lable.'--</option>';
								}
								else
								{
								$rw1=$table::find_by_id($mid);
									$x.='<option selected="selected" value="'.$rw1->id.'">'.ucfirst($rw1->name).'</option>';
								}
									}
                                 
                                $x.='</select>
								</div>';
		return $x;
		}
	  public static function Select($lable="",$labs,$name="", $table,$t,$ids,$n)
	  {
		  echo '<div class="col-md-12 col-xs-12">';
		  if($t!=NULL)
		  {
			 
			  $tb=$table::find_in_not($t);
			  $category=$table::find_by_id($t);
			   $v='<option selected value="'.$t.'">'.ucfirst($category->name).'</option>';
			  }else
		  {
			  $c=new $table();
			 $tb=$table::find_all();
			 $v='<option value="">'.$labs.'</option>';
			  }
		    $re=self::check($n);
		 $res=self::checkst($n);
	  $x = ' <label>'.$lable.''.$res.':</label>
	  
	  <select name="'.$name.'" class="form-control country" id="'.$ids.'" '.$re.'>'.$v;
	 
	  foreach($tb as $rw)
	  {
	  $x.= '<option value="' . $rw->id . '">' . ucfirst($rw->name) . '</option>';
	  }
	  
	  $x.= '</select></div>';

	  return $x;
	  }
	  public static function Select_multi($lable="", $name="", $table,$t,$n)
	  {
		  
		  echo '<div class="col-md-'.self::$col.' col-xs-12">';
		  if($t!=NULL)
		  {
			 
			  $tb=$table::find_in_not($t);
			  $category=$table::find_by_id($t);
			   $v='<option selected value="'.$t.'">'.ucfirst($category->name).'</option>';
			  }else
		  {
			  $c=new $table();
			 $tb=$table::find_all();
			 $v='<option value="">choose a option...</option>';
			  }
		    $re=self::check($n);
		 $res=self::checkst($n);
	  $x = ' <label>'.$lable.''.$res.':</label>
	  
	  <select name="'.$name.'[]" class="form-control" '.$re.' multiple >'.$v;
	 
	  foreach($tb as $rw)
	  {
	  $x.= '<option value="' . $rw->id . '">' . ucfirst($rw->name) . '</option>';
	  }
	  
	  $x.= '</select></div>';

	  return $x;
	  }
	  public static function Selectmulti($lable="",$name="",$table,$id,$rt)
	{
		
	   $re=self::check($rt);
		 $res=self::checkst($rt);
				
		$x = '<div class="col-md-'.self::$col.' col-xs-12">
		 <label>'.$lable.''.$res.':</label>
			<select name="'.$name.'[]" class="form-control" id="'.$id.'" '.$re.' multiple>';
								
                                 $rs=$table::find_all();
								foreach($rs as $rw)
								{
                                 $x.='<option value="'.$rw->id.'">'.ucfirst($rw->name).'</option>';
								}
                                $x.='</select>
								</div>';
		return $x;
		}
	 public static function Selectmulti_edit($lable="",$name="",$table,$id,$mid)
	{
		
		$x = '<div class="col-md-'.self::$col.' col-xs-12"><label>'.$lable.':</label>
			<select name="'.$name.'[]" class="form-control" required id="'.$id.'" multiple>';
								if($mid!='')
								{ $rw1=$table::find_by_in($mid);
								foreach($rw1 as $rwd)
								{
									$x.='<option selected="selected" value="'.$rwd->id.'">'.ucfirst($rwd->name).'</option>';
									
								}}
                                 $rs=$table::find_by_not_in($mid);
								foreach($rs as $rw)
								{
								
                                 $x.='<option value="'.$rw->id.'">'.ucfirst($rw->name).'</option>';
								
								}
                                $x.='</select>
								</div>';
		return $x;
		}
		public static function Select_st($lable="",$name="",$total,$t,$n,$dt)
          {
          $ns=1;
		  
          $re=self::check($n);
          $res=self::checkst($n);
		  $dts=self::disable_check($dt);
          $x = '<div class="col-md-'.self::$col.' col-xs-12"><label>'.$lable.''.$res.':</label>
          <select name="'.$name.'" class="lists form-control"  '.$re.' '.$dts.'>
        ';							
          if($t!='')
          {
			  $ss='';
			   if($t<10)
			  {
				  $ss=0;
				  }
			 $x.='<option selected value="'.$t.'">'.$ss.$t.'</option>';
          while($ns!=$total+1)
          {
			   $s='';
			   if($ns<10)
			  {
				  $s=0;
				  }
			if($t!=$ns)
			{
           $x.='<option value="'.$ns.'">'.$s.$ns.'</option>';
			}
          $ns++;
          }
          }else
          {
          while($ns!=$total+1)
          {
          if($t!=$ns)
          {
			   $s='';
			   if($ns<10)
			  {
				  $s=0;
				  }
           $x.='<option value="'.$ns.'">'.$s.$ns.'</option>';
           }
          $ns++;
          }
          }
          $x.='</select>
          </div>';
          return $x;
          }
		  public static function Select_op($lable="",$name="",$arr,$t,$n,$wt)
          {
          $ns=1;
		  
          $re=self::check($n);
          $res=self::checkst($n);
          $x = '<div class="col-md-'.$wt.' col-sm-'.self::$col.' col-xs-12"><label>'.$lable.''.$res.':</label>
          <select name="'.$name.'" class="lists form-control"  '.$re.'>
          <option value="">Select '.$lable.'</option>';							
         if($t=='')
          {
			  
          foreach($arr as $ass)
          {
			 
           $x.='<option value="'.$ass.'">'.ucfirst($ass).'</option>';
          
          }
          }else
          {
           foreach($arr as $ass)
          {
			  
          if(strtolower($t)==strtolower($ass))
          {
			$x.='<option selected value="'.$t.'">'.ucfirst($t).'</option>';
		  }else
		  {
           $x.='<option value="'.$ass.'">'.ucfirst($ass).'</option>';
		  }
         
          }
          }
          $x.='</select>
          </div>';
          return $x;
          }
	  }

?>
