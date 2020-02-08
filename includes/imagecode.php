  if($type=='edit')
{ 
$rw=self::find_by_id($id);
     $f=SITE_ROOT.DS.$rw->image_path();
	
		if(file_exists($f))
		{
		
	  $n=explode('.',$data->image);	 
	
	 unlink(SITE_ROOT.DS.$rw->image_path());	
		}
    
	 $file=$_FILES['image']["tmp_name"];
	 $imgname=$_FILES['image']['name'];	 
     $n=explode('.',$_FILES['image']['name']);
	 $manager = new ImageManager(array('driver' => 'gd'));
	 $image = $manager->make($file)->save(SITE_ROOT.DS.$data->image_path().$imgname); 
  
	  $data->image=$imgname;	 
	 }