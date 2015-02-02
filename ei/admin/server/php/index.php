<?php
$options = array(
    'delete_type' => 'POST',
    'db_host' => 'localhost',
    'db_user' => 'educaidio_user',
    'db_pass' => 'flemita1',
    'db_name' => 'educaidio_db',
    'db_table' => 'galerias_contenido'
);

error_reporting(E_ALL | E_STRICT);
require('UploadHandler.php');

class CustomUploadHandler extends UploadHandler {

    protected function initialize() {
        $this->db = new mysqli(
            $this->options['db_host'],
            $this->options['db_user'],
            $this->options['db_pass'],
            $this->options['db_name']
        );
        parent::initialize();
        $this->db->close();
    }

    protected function handle_form_data($file, $index) {
        $file->id_galeria = @$_REQUEST['id_galeria'][$index];

    }

    protected function handle_file_upload($uploaded_file, $name, $size, $type, $error,
            $index = null, $content_range = null) {
        $file = parent::handle_file_upload(
            $uploaded_file, $name, $size, $type, $error, $index, $content_range
        );
        if (empty($file->error)) {
            $sql = 'INSERT INTO `'.$this->options['db_table']
                .'` (`archivo`,`id_galeria`)'
                .' VALUES (?, ?)';
            $query = $this->db->prepare($sql);
            $query->bind_param(
                'si',
                $file->name,
                $file->id_galeria
            );
            $query->execute();
            $file->id = $this->db->insert_id;
        }
        return $file;
    }

  protected function set_additional_file_properties($file) {
        parent::set_additional_file_properties($file);
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $sql = 'SELECT `id`, `archivo`, `id_galeria` FROM `'
                .$this->options['db_table'].'` WHERE `archivo`=?';
            $query = $this->db->prepare($sql);
            $query->bind_param('s', $file->name);
            $query->execute();
            $query->bind_result(
                $id,
                $archivo,
                $id_galeria
            );
            while ($query->fetch()) {
                $file->id = $id;
                $file->name = $archivo;
                $file->id_galeria = $id_galeria;
            }
        }
		
        $file->delete_url = $this->options['script_url']
            .$this->get_query_separator($this->options['script_url'])
            .'file='.rawurlencode($file->name)
			.'&id_galeria='
				.$id_galeria;
        	$file->delete_type = $this->options['delete_type'];
        	if ($file->delete_type !== 'DELETE') {
            	$file->delete_url .= '&_method=DELETE';
        }
        	if ($this->options['access_control_allow_credentials']) {
            $file->delete_with_credentials = true;
        }
    
    }

    public function delete($print_response = true) {

        $response = parent::delete(false);

        foreach ($response as $name => $deleted) {
 
            //if ($deleted) {
                $sql = 'DELETE FROM `'
                    .$this->options['db_table'].'` WHERE `archivo`=? and `id_galeria`=?';
                $query = $this->db->prepare($sql);
                $query->bind_param(
                'si',
                strtoupper($name),
                $_GET['id_galeria']
            );
                $query->execute();
            //}
        } 
        return $this->generate_response($response, $print_response);
    }

}

$upload_handler = new CustomUploadHandler($options);
