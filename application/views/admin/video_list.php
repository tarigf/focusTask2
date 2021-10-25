<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Videos</h1>
</div>
    
<div class="card shadow mb-4">
    <div class="card-body">
            <?php 
                foreach($videos as $video){
            ?>
            <div class="row">
                <div class="col-md-8">
                    <h1 id="progress"></h1>
                    <div class='vidcontainer vid embed-responsive embed-responsive-16by9'>
                        <select id="sspd" class='qualitypick' autocomplete='off'>
                            <option value="HD" selected>HD</option>
                            <option value="720p">720p</option>
                            <option value="144p">144p</option>
                        </select>

                        <video preload="metadata" x-webkit-airplay="allow" width="320" height="320" controls class="embed-responsive-item" >
                            <source label="HD" src="<?php echo base_url().'admin/play/'.$video['id']?>" type="<?=$video['type']?>">
                            <source label="720p" src="<?php echo base_url().'admin/play720/'.$video['id']?>" type="video/webm">
                            <source label="144p" src="<?php echo base_url().'admin/play144/'.$video['id']?>" type="video/webm">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
                <div class="col-md-4">
                    
                </div>
            </div>
            <hr class="sidebar-divider my-0">

            <?php } ?>
    </div>
</div>
