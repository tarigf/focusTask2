<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Videos</h1>
</div>
    
<div class="card shadow mb-4">
    <div class="card-body">
    
            <h1>CodeIgniter Video Upload</h1>

            <div id="body">
                <p>Select a video file to upload</p>
                <?php
					if (isset($success) && strlen($success)) {
						echo '<div class="success col-md-8">';
						echo '<p>' . $success . '</p>';
						echo '</div>';
					}
					if (isset($errors) && strlen($errors)) {
						echo '<div class="error col-md-8">';
						echo '<p>' . $errors . '</p>';
						echo '</div>';
					}
					if (validation_errors()) {
						echo validation_errors('<div class="error">', '</div>');
					}
                ?>
				<img id="loading" class="loading" src="<?=base_url()?>assets/img/loading.gif"/>
                <?php
					$attributes = array('name' => 'video_upload', 'id' => 'video_upload');
					echo form_open_multipart($this->uri->uri_string(), $attributes);
                ?>
                <p><input name="video_name" id="video_name" readonly="readonly" type="file" /></p>
                <p><input id="btnSubmit" name="video_upload" value="Upload Video" type="submit" /></p>
                <?php
					echo form_close();
                ?>
            </div>

    </div>
</div>
