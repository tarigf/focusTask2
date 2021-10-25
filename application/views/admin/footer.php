        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Tarig Faisal 2021</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?php echo base_url().'admin/logout'; ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>


    <script src="<?php echo base_url().'assets/'; ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url().'assets/'; ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url().'assets/'; ?>vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?php echo base_url().'assets/'; ?>js/sb-admin-2.min.js"></script>
    <script src="<?php echo base_url().'assets/'; ?>vendor/chart.js/Chart.min.js"></script>
    <script src="<?php echo base_url().'assets/'; ?>vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url().'assets/'; ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url().'assets/'; ?>vendor/sweetalert/sweetalert.min.js"></script>
    
  
  <script type="text/javascript">

    $(document).ready(function(){
      

    $('.qualitypick').on('change',function(){ 

      let select = document.getElementById('sspd');
      //alert('changed to:'+ select.value);

      //Have several videos in file, so have to navigate directly
      video = $(this).parent().find("video");
      //Need access to DOM element for some functionality
      videoDOM = video.get(0);
      curtime = videoDOM.currentTime;  //Get Current Time of Video
      source = video.find("source[label="+this.value+"]"); //Copy Source
      console.log(this.value);
      source.remove();                 //Remove the source from select
      video.prepend(source);           //Prepend source on top of options
      videoDOM.load();                    //Reload Video
      videoDOM.currentTime = curtime;  //Continue from video's stop
      videoDOM.play();                 //Resume video
   })
});


//JUST AN EXAMPLE, PLEASE USE YOUR OWN PICTURE!
var imageAddr = "https://www.cashaman.net/assets/imgs/background1.jpg"; 
var downloadSize = 4995374; //bytes

function ShowProgressMessage(msg) {
    if (console) {
        if (typeof msg == "string") {
            console.log(msg);
        } else {
            for (var i = 0; i < msg.length; i++) {
                console.log(msg[i]);
            }
        }
    }
    
    var oProgress = document.getElementById("progress");
    if (oProgress) {
        //var actualHTML = (typeof msg == "string") ? msg : msg.join("<br />");
        //oProgress.innerHTML = actualHTML;
    }
}

function InitiateSpeedDetection() {
    ShowProgressMessage("Loading the image, please wait...");
    window.setTimeout(MeasureConnectionSpeed, 1);
};    

if (window.addEventListener) {
    window.addEventListener('load', InitiateSpeedDetection, false);
} else if (window.attachEvent) {
    window.attachEvent('onload', InitiateSpeedDetection);
}

function MeasureConnectionSpeed() {
    var startTime, endTime;
    var download = new Image();
    download.onload = function () {
        endTime = (new Date()).getTime();
        showResults();
    }
    
    download.onerror = function (err, msg) {
        ShowProgressMessage("Invalid image, or error downloading");
    }
    
    startTime = (new Date()).getTime();
    var cacheBuster = "?nnn=" + startTime;
    download.src = imageAddr + cacheBuster;
    
    function showResults() {
        var duration = (endTime - startTime) / 1000;
        var bitsLoaded = downloadSize * 8;
        var speedBps = (bitsLoaded / duration).toFixed(2);
        var speedKbps = (speedBps / 1024).toFixed(2);
        var speedMbps = (speedKbps / 1024).toFixed(2);

      
        let select = document.getElementById('sspd');

        if( speedMbps >= 2.5){
          select.value = "720p"
        }else{
          select.value = "144p"
        }
        select.dispatchEvent(new Event('change'));
    }
}

</script>
</body>

</html>