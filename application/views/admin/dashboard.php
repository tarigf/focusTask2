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
						
						//traditional video play - less than HTML5
						// echo '<object width="500" height="500">
						//         <param name="src" value="' . $video_path . '/' . $video_name . '">
						//         <param name="autoplay" value="false">
						//         <param name="controller" value="true">
						//         <param name="bgcolor" value="#333333">
						//         <embed type="' . $video_type . '" src="' . $video_path . '/' . $video_name . '" autostart="false" loop="false" width="338" height="300" controller="true" bgcolor="#333333"></embed>
						//      </object>';

						// //HTML5 video play
						// echo '<video width="320" height="240" controls>
						//   <source src="' . $video_path . '/' . $video_name . '" type="' . $video_type . '">
						//   Your browser does not support the video tag.
						//   </video>';
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
                <?php
					$attributes = array('name' => 'video_upload', 'id' => 'video_upload');
					echo form_open_multipart($this->uri->uri_string(), $attributes);
                ?>
                <p><input name="video_name" id="video_name" readonly="readonly" type="file" /></p>
                <p><input name="video_upload" value="Upload Video" type="submit" /></p>
                <?php
					echo form_close();
                ?>
            </div>

    </div>
</div>
