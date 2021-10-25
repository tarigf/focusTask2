<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class Admin extends CI_Controller{

    //variable for storing error message
    private $error;
    //variable for storing success message
    private $success;

    function __construct(){
        parent::__construct();
         //load this to validate the inputs in upload form
         $this->load->library('form_validation');
    }

    //appends all error messages
    private function handle_error($err) {
        $this->error .= $err . "\r\n";
    }

    //appends all success messages
    private function handle_success($succ) {
        $this->success .= $succ . "\r\n";
    }

    public function upload() {

        if ($this->input->post('video_upload')) {
            //set preferences
            //file upload destination
            $upload_path = './uploads/';
            $config['upload_path'] = $upload_path;
            //allowed file types. * means all types
            $config['allowed_types'] = 'wmv|mp4|avi|mov';
            //allowed max file size. 0 means unlimited file size
            $config['max_size'] = '0';
            //max file name size
            $config['max_filename'] = '255';
            //whether file name should be encrypted or not
            $config['encrypt_name'] = True;
            //store video info once uploaded
            $video_data = array();
            //check for errors
            $is_file_error = FALSE;
            //check if file was selected for upload
            if (!$_FILES) {
                $is_file_error = TRUE;
                $this->handle_error('Select a video file.');
            }
            //if file was selected then proceed to upload
            if (!$is_file_error) {
                //load the preferences
                $this->load->library('upload', $config);
                //check file successfully uploaded. 'video_name' is the name of the input
                if (!$this->upload->do_upload('video_name')) {
                    //if file upload failed then catch the errors
                    $this->handle_error($this->upload->display_errors());
                    $is_file_error = TRUE;
                } else {
                    //store the video file info
                    $video_data = $this->upload->data();
                }
            }
            // There were errors, you have to delete the uploaded video
            if ($is_file_error) {
                if ($video_data) {
                    $file = $upload_path . $video_data['file_name'];
                    if (file_exists($file)) {
                        unlink($file);
                    }
                }
            } else {
                $newName = strtok($video_data['file_name'],'.');

                $data['video_name'] = $video_data['file_name'];
                $data['video_path'] = $upload_path;
                $data['video_type'] = $video_data['file_type'];

                $this->m_vid->insert_data(array('path'=>'uploads','name'=>$newName,'type'=>$video_data['file_type']),'video');
                $this->convert($video_data['file_name'],$newName);
                $this->handle_success('Video was successfully uploaded to direcoty <strong>' . $upload_path . '</strong>.');
            }
        }
        //load the error and success messages
        $data['errors'] = $this->error;
        $data['success'] = $this->success;
        //load the view along with data

        $this->load->view('admin/header');
        $this->load->view('admin/dashboard',$data);
        $this->load->view('admin/footer');

    }

    public function index(){

        $videos_list = $this->m_vid->get_data('video');
        $data['videos'] = $videos_list;

        //print_r($videos_list);exit;
        $this->load->view('admin/header');
        $this->load->view('admin/video_list',$data);
        $this->load->view('admin/footer');
    }
    public function play($id) {

        $videos_list = $this->m_vid->find_data(array('id'=>$id),'video');
        $data['videos'] = $videos_list;
        $vid_type = substr($videos_list[0]['type'], strpos($videos_list[0]['type'], "/") + 1);

        $video_path = $videos_list[0]['name'].".".$vid_type;
        //echo $video_path;exit;
        $this->load->library('VideoStream');
        $stream = new VideoStream();
        $stream->setPath('uploads/'.$video_path);
        $stream->start();
    }
    public function play720($id) {

        $videos_list = $this->m_vid->find_data(array('id'=>$id),'video');
        $data['videos'] = $videos_list;
        $vid_type = 'webm';

        $video_path = $videos_list[0]['name']."-720.".$vid_type;
        //echo $video_path;exit;
        $this->load->library('VideoStream');
        $stream = new VideoStream();
        $stream->setPath('uploads/'.$video_path);
        $stream->start();
    }
    public function play144($id) {

        $videos_list = $this->m_vid->find_data(array('id'=>$id),'video');
        $data['videos'] = $videos_list;
        $vid_type = 'webm';

        $video_path = $videos_list[0]['name']."-144.".$vid_type;
        //echo $video_path;exit;
        $this->load->library('VideoStream');
        $stream = new VideoStream();
        $stream->setPath('uploads/'.$video_path);
        $stream->start();
    }

    public function convert($file_name,$newName){
        //scale=-1:720
        //scale=640:480
	    //shell_exec("ffmpeg -i uploads/".$file_name." -vf scale=720:-1  uploads/".$newName."-720.mp4 &");
	    //shell_exec("ffmpeg -i uploads/".$file_name." -vf scale=144:-1 uploads/".$newName."-144.mp4 &");
	    shell_exec("ffmpeg -i uploads/".$file_name." -vf scale=720:576:force_original_aspect_ratio=decrease,pad=720:576:(ow-iw)/2:(oh-ih)/2,setsar=1 uploads/".$newName."-720.webm");
	    shell_exec("ffmpeg -i uploads/".$file_name." -vf scale=176:144:force_original_aspect_ratio=decrease,pad=176:144:(ow-iw)/2:(oh-ih)/2,setsar=1 uploads/".$newName."-144.webm");
        
    }
}
?>