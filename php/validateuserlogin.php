<?php
class validator{
	

	public $errors=array();

	function validate($data, $rules){
		foreach($rules as $fieldname=>$rule){
			$callbacks = explode('|',$rule);
			foreach($callbacks as $callback){
				
				$this->$callback($fieldname, $data[$fieldname]);
			}
		}
	}

	function required($fieldname, $value){
		if(empty($value)){ 
			$this->errors[$fieldname]="you must enter ".$fieldname;
				}
		elseif($fieldname=="confirmpassword"){
			if($_POST['password']!=$_POST['confirmpassword']){
				$this->errors[$fieldname]="password doesnot match";
			}
		}		
		
			}

	function check($fieldname, $value,$word){
		if($value==$word){ 
			$this->errors[$fieldname]="you must select ".$fieldname;
			
				}
	}
		
	function email($fieldname, $value){
		//$this->errors[$fieldname]="";
		if(empty($value)){ 
			$this->errors[$fieldname]="you must enter ".$fieldname;
				}
		else{
			//if (!preg_match("/^[a-z]([a-z0-9]|[a-z0-9.-_][a-z0-9])+@[a-z0-9]+\.([a-z]{2,4}|[a-z]{2,4}\.[a-z]{2})$/i",trim($mail)))
		$regex="/^[a-z]([a-z0-9]|[a-z0-9.-_][a-z0-9])+@[a-z0-9]+\.([a-z]{2,4}|[a-z]{2,4}\.[a-z]{2})$/i";
		$email_check=preg_match($regex,trim($value));
		if (!$email_check)
			$this->errors[$fieldname]="invalid ".$fieldname;
			
				
					}
		
		}
			
		
	function file($fieldname,$value){
		

		if ($value['error'] > 0)
	{
		
		switch ($value['error'])
		{
			case 1: $this->errors[$fieldname]= 'File exceeded upload_max_filesize';
			break;
			case 2: $this->errors[$fieldname]= 'File exceeded max_file_size';
			break;
			case 3: $this->errors[$fieldname]= 'File only partially uploaded';
			break;
			case 4: $this->errors[$fieldname]= 'No file uploaded';
			break;
			case 6: $this->errors[$fieldname]= 'Cannot upload file: No temp directory specified';
			break;
			case 7: $this->errors[$fieldname]= 'Upload failed: Cannot write to disk';
			break;
		}
		
		
	}
	else{


		$upfile = '/var/www/html/project/image/'.$value['name'] ;

	
		if ($value['type'] != 'image/png' and $value['type'] != 'image/jpeg' )
		{
			 $this->errors[$fieldname]='Problem: file is not an image';
	
		}
		else{
		if (is_uploaded_file($value['tmp_name']))
		{
				if (!move_uploaded_file($value['tmp_name'], $upfile))
				{
					$this->errors[$fieldname]= 'Problem: Could not move file to destination directory';
				 }
				

		}
		}


		
		}
	
	}
	
			




}

?>

