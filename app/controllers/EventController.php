<?php
 
class EventController extends ControllerBase {

   public function beforeExecuteRoute(){ // function ที่ทำงานก่อนเริ่มการทำงานของระบบทั้งระบบ
      $this->checkAuthen();
   } 
         
   public function indexAction(){
        $eve = Event::find();
        $this->view->event = $eve;
   }

   public function addeventAction(){
    if($this->request->isPost()){
      $name = trim($this->request->getPost('eventname')); // รับค่าจาก form
      $date = trim($this->request->getPost('eventdate')); // รับค่าจาก form
      $detail = trim($this->request->getPost('eventdetail')); // รับค่าจาก form
      $photoUpdate='';
      if($this->request->hasFiles() == true){
              $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
              $uploads = $this->request->getUploadedFiles();
        
               $isUploaded = false;			
               foreach($uploads as $upload){
                   if(in_array($upload->gettype(), $allowed)){					
                    $photoName=md5(uniqid(rand(), true)).strtolower($upload->getname());
                    $path = '../public/img/'.$photoName;
                    ($upload->moveTo($path)) ? $isUploaded = true : $isUploaded = false;
                   }
               }             
               if($isUploaded){
                $photoUpdate=$photoName ;
            }  
        }   
      $eve = new Event();
      $eve->eventname=$name;
      $eve->eventdate=$date;
      $eve->eventdetail=$detail;
      $eve->eventpicture=$photoUpdate;
      $eve->save();

      $this->response->redirect('event');
      
      }
  }

  public function editeventAction($id){
    if($this->request->isPost()){
        $name = trim($this->request->getPost('eventname')); // รับค่าจาก form
        $date = trim($this->request->getPost('eventdate')); // รับค่าจาก form
        $detail = trim($this->request->getPost('eventdetail')); // รับค่าจาก form
        $photoUpdate='';
        if($this->request->hasFiles() == true){
                $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                $uploads = $this->request->getUploadedFiles();
         
                 $isUploaded = false;			
                 foreach($uploads as $upload){
                     if(in_array($upload->gettype(), $allowed)){					
                      $photoName=md5(uniqid(rand(), true)).strtolower($upload->getname());
                      $path = '../public/img/'.$photoName;
                      ($upload->moveTo($path)) ? $isUploaded = true : $isUploaded = false;
                     }
                 }             
                 if($isUploaded){
                     $photoUpdate=$photoName ;
                 }  
          }
        $eve = Event::findFirst($id);
        $eve->eventname=$name;
        $eve->eventdate=$date;
        $eve->eventdetail=$detail;
        $eve->eventpicture=$photoUpdate;
        $eve->save();
  
        $this->response->redirect('event');
        
    }
    $eve = Event::findFirst($id);
    $this->view->event = $eve;
  }

  public function deleteeventAction($id)
  {
      $delete = Event::findFirst($id);
      $delete->delete();
      $this->response->redirect('event');
  }

}
  