<div class="container">
	<div class="col-xl-6">
		<form method="post" action="<?php echo base_url('Home/upload'); ?>" enctype="multipart/form-data">
			<div class="form-group">
				<label>Image : </label>
				<input type="file" name="files[]" class="form-control" multiple="">
			</div>
			<input type="submit" class="btn btn-info">
		</form>
	</div>
</div>



On controller:-
function upload()
	{			
		$this->load->library('upload');
		$count = count($_FILES['files']['name']);

		for($i=0;$i<$count;$i++)
		{  
			$_FILES['file']['name'] = $_FILES['files']['name'][$i];
			$_FILES['file']['type'] = $_FILES['files']['type'][$i];
			$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
			$_FILES['file']['error'] = $_FILES['files']['error'][$i];
			$_FILES['file']['size'] = $_FILES['files']['size'][$i];

			$config['upload_path'] = './img/'; 
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['max_size'] = '5000';
			// $config['file_name'] = $_FILES['file']['name'][$i];
			$this->upload->initialize($config);
			$this->upload->do_upload('file');
			$uploadData = $this->upload->data();
			$filename = $uploadData['file_name'];        
			$qry=$this->db->insert("upload",array("files"=>$filename));
		}
		redirect('Home');
	}
