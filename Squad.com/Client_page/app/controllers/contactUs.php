<?php

	class contactUs extends Controller
	{
		public function index()
		{

            $this->view('contactUs', []);
		}
        
        public function sendMessage(){
            
            $array = $this->getMessages($_SESSION['user']);
            $this->view('inboxAdmin', ['data'=>$array,'user'=>$_SESSION['user']]);
        }

        public function getMessages($email){
            $messages = $this->model('message');
            $subjects = $this->model('subject');
            $user = $this->model('user');
            $userEmail = $email;
            //retrieve user id
            $queryID = $user->where(['email'=>$userEmail]);

            $queryMessage = $messages->where(['recipient_id' => $queryID[0]->user_id, 'isReplied' => Controller::notReplied]);

            $arrData = array();

            foreach ($queryMessage as $message) {

                $messageID = $message->msg_id;
                $content = $message->content;
                $date = $message->date_sent;
                $subjectID = $message->subject_id;
                //get subject name
                $querySubject = $subjects->where(['subject_id' => $subjectID]);
                $subjectName = $querySubject[0]->subject_name;
                $assoc = array('msgID' => $messageID, 'content' => $content, 'date' => $date, 'subjectID' => $subjectID, 'subjectName' => $subjectName);

                $arrData[] = $assoc;
            }

                return $arrData;
 
        }

        public function getSubject($id,$email){

            $message = $this->model('message');
            $subject = $this->model('subject');
            $user = $this->model('user');

            //get user id
            $queryID = $user->where(['email'=>$email]);
            $userID = $queryID[0]->user_id;

            //get subject iD
            $query = $message->where(['msg_id'=>$id]);
            $subjectID = $query[0]->subject_id;

            //update message to seen
            $message = $query[0];
            $message->isReplied = "2";

            $sql = "UPDATE message SET content = :content, date_sent = :date_sent, creator_id = :creator_id, subject_id = :subject_id,recipient_id = :recipient_id,isReplied = :isReplied where msg_id = :msg_id";

            $query = $message->prepare($sql);
            $query->execute($message->toArray());

            //get subject name
            $querySubjectName = $subject->where(['subject_id'=>$subjectID]);
            $subjectName = $querySubjectName[0]->subject_name;

            $arr = array('id'=>$subjectID,'name'=>$subjectName);
            echo json_encode($arr);

        }

        public function compose(){

            $subject = $this->model('subject');
            $message = $this->model('message');
            $user = $this->model('user');

            //create subject
            $subject->subject_name = $_POST['subjectName'];
            $subject->insert();

            //retrieve last subject id inserted
            $subjectID = $subject->lastIndex();

            //create date
            $date = date("Y-m-d H:i:s");

            //get creator
            $userPost = $_POST['user'];
            $queryUser = $user->where(['email'=>$userPost]);
            $userId = $queryUser[0]->user_id;

            //get content
            $content = $_POST['content'];

            $message->content = $content;
            $message->date_sent = $date;
            $message->creator_id = $userId;
            $message->subject_id = $subjectID;
            $message->recipient_id = Controller::admin;
            $message->isReplied = Controller::notReplied;

            $message->insert();

            echo 'sucess';

        }

        public function reply(){

            $subject = $this->model('subject');
            $message = $this->model('message');

            $msgID = $_POST['messageID'];

            //update previous message to replied

            $replyingMsg = $this->model('message');
            $query = $replyingMsg->where(['msg_id'=>$msgID]);
            $replyingMsg = $query[0];
            $replyingMsg->isReplied = Controller::replied;
            $sql = "UPDATE message SET content = :content, date_sent = :date_sent, creator_id = :creator_id, subject_id = :subject_id,recipient_id = :recipient_id,isReplied = :isReplied where msg_id = :msg_id";
            $queryExec = $replyingMsg->prepare($sql);
            $queryExec->execute($replyingMsg->toArray());

            //create date
            $date = date("Y-m-d H:i:s");

            //get creator through the previous message

            $query = $message->where(['msg_id'=>$msgID]);
            $recipientTOcreator = $query[0]->recipient_id;

            //get content
            $content = $_POST['content'];

            //get subject id
            $subjectName = $_POST['subjectName'];
            $queryS_id = $subject->where(['subject_name'=>$subjectName]);
            $s_id = $queryS_id[0]->subject_id;

            $newMessage = $this->model('message');

            $newMessage->content = $content;
            $newMessage->date_sent = $date;
            $newMessage->creator_id = $recipientTOcreator;
            $newMessage->subject_id = $s_id;
            $newMessage->recipient_id = Controller::admin;
            $newMessage->isReplied = Controller::notReplied;

            $newMessage->insert();

        }

        public function getCount($email){

            $message = $this->model('message');
            $user = $this->model('user');

            $queryID = $user->where(['email'=>$email]);
            $id = $queryID[0]->user_id;

            $query = $message->where(['recipient_id'=>$id,'isReplied'=>Controller::notReplied]);

            $size = sizeof($query);

            echo $size;

        }
	}
?>