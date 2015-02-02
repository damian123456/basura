<?
class Upload{
	private $fieldname;
	public $filename;
	public $tmp_name;
	public $type;
	public $size;
	public $error_num;
	public $error_msg;

	function __construct($fieldname){
		$this->fieldname = $fieldname;
		$this->tmp_name = $_FILES[$fieldname]['tmp_name'];
		if(is_uploaded_file($this->tmp_name)){
			if($this->tmp_name) {
				$this->filename = $_FILES[$fieldname]['name'];
				$this->type = $_FILES[$fieldname]['type'];
				$this->size = $_FILES[$fieldname]['size'];
				$this->error_num = $_FILES[$fieldname]['error'];
				return true;
			}
		} else {
			$this->error_num = 1001;
		}
		$this->error_check();
		return false;
	}

	function error(&$error_num=null,&$error_msg=null){
		$error_msg = $this->error_msg;
		$error_num = $this->error_num;
		if(empty($error_msg)){
			return false;
		}
		return true;
	}

	private function error_check(){
		if(trim($this->error_num)==''){
			$error_msg = "##NG_ERR_NO_FILE_SPECIFIED##";
			$this->error_msg = $error_msg;
			return 1;
		}
		switch($this->error_num){
			case UPLOAD_ERR_OK:
				$error_msg = '';
				$this->error_msg = $error_msg;
				return 0;
				break;
			case UPLOAD_ERR_INI_SIZE:
			case UPLOAD_ERR_FORM_SIZE:
				$size = min($this->return_bytes(ini_get('post_max_size')),$this->return_bytes(ini_get('upload_max_filesize')));
				$bytes = min((int)$_REQUEST['MAX_FILE_SIZE'],$size);
				$error_msg = "#NG_ERR_FILE_SIZE_CANT_BE_GREATER_THAN## ".$this->getSizeStr($bytes);
				break;
			case UPLOAD_ERR_PARTIAL:
				$error_msg = "##NG_ERR_UPLOAD_CANCELED##";
				break;
			case UPLOAD_ERR_NO_FILE:
				$error_msg = "##NG_ERR_NO_FILE_SPECIFIED##";
				break;
			case UPLOAD_ERR_NO_TMP_DIR:
			case UPLOAD_ERR_CANT_WRITE:
				$error_msg = "##NG_ERR_CANT_WRITE_FILE##";
				break;
			case 1001:
				$error_msg = "##NG_ERR_POSSIBLE_HACK_ATTEMPT##";
				break;
		}
		$this->error_msg = $error_msg;
		return 1;
	}


	private function getSizeStr($size){
		if ($size <= 1024) {
			return $size . ' bytes';
		} else {
			if ($size >= pow(1024, 4)) {
				return round($size/pow(1024, 4), 2) . ' Tb';
			} elseif ($size >= pow(1024, 3)) {
				return round($size/pow(1024, 3), 2) . ' Gb';
			} elseif ($size >= pow(1024, 2)) {
				return round($size/pow(1024, 2), 2) . ' Mb';
			} else {
				return round($size/1024, 2) . ' Kb';
			}
		}
	}

	private function return_bytes($val){
		$val = trim($val);
		$last = strtolower($val[strlen($val)-1]);
		switch($last) {
			case 'g':
				$val *= 1024;
			case 'm':
				$val *= 1024;
			case 'k':
				$val *= 1024;
		}
		return $val;
	}
}
?>
