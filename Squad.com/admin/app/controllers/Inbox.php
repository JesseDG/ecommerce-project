<?php 

class Inbox extends Controller{

    public function index(){

        $retrieveAdmin = $this->model('message');
        $user = $this->model('user');
        $subject = $this->model('subject');
        $query = $retrieveAdmin->where(['recipient_id'=>Controller::admin, 'isReplied'=>Controller::notReplied]);
        $size = sizeof($query);
        $messages = array();
        for($i = 0; $i < $size; $i++){

            $messageID = $query[$i]->msg_id;
            $content = $query[$i]->content;
            $date = $query[$i]->date_sent;

            //Get user email
            $creatorID = $query[$i]->creator_id;
            $queryUser = $user->where(['user_id'=>$creatorID]);
            $userEmail = $queryUser[0]->email;

            //Get subject
            $subjectID = $query[$i]->subject_id;
            $querySubject = $subject->where(['subject_id'=>$subjectID]);
            $subjectName = $querySubject[0]->subject_name;

            $assoc = array('messageID'=>$messageID,'content'=>$content,'date'=>$date,'userEmail'=>$userEmail,'subjectName'=>$subjectName);
            $messages[] = $assoc;

        }

        //retrieve all customer for message
        $user = $this->model('user');
        $query = $user->findAll();

        $this->view('inbox', ['allMessages'=>$messages, 'allUsers'=>$query]);
    }

    public function sendMessage(){

        $subject = $this->model('subject');
        $message = $this->model('message');
        $user = $this->model('user');

        $userEmail = $_POST['user'];
        $subjectName = $_POST['subject'];
        $messageID = $_POST['message'];


        //update message from user
        $queryMessage = $message->where(['msg_id'=>$messageID]);
        $message = $queryMessage[0];
        $message->isReplied = Controller::replied;

        $sql = "UPDATE message SET content = :content, date_sent = :date_sent, creator_id = :creator_id, 
                subject_id = :subject_id, recipient_id = :recipient_id, isReplied = :isReplied WHERE msg_id = :msg_id";

        $query = $message->prepare($sql);
        $query->execute($message->toArray());

        //create message
        $newMessage = $this->model('message');
        $repliedMessage = $_POST['content'];
        $date = date("Y-m-d H:i:s");
        $creator_id = Controller::admin;
            //get subject id
            $querySubject = $subject->where(['subject_name'=>$subjectName]);
        $subjectID = $querySubject[0]->subject_id;
            //get user id
            $queryuser = $user->where(['email'=>$userEmail]);
        $recipientID = $queryuser[0]->user_id;
        $isreplied = Controller::notReplied;

        $newMessage->content = $repliedMessage;
        $newMessage->date_sent = $date;
        $newMessage->creator_id = $creator_id;
        $newMessage->subject_id = $subjectID;
        $newMessage->recipient_id = $recipientID;
        $newMessage->isReplied = $isreplied;

        $newMessage->insert();

    }

    public function compose(){

        $subject = $_POST['subject'];
        //create new subject
        $subjectModel = $this->model('subject');
        $subjectModel->subject_name = $subject;
        $subjectModel->insert();

        //get subject id
        $subjectID = $subjectModel->lastIndex();

        $content = $_POST['content'];
        $user = $this->model('user');
        $sentTo = $_POST['to'];
        $date = date('Y-m-d H:i:s');
        $isReplied = Controller::notReplied;
        $creator = Controller::admin;
        $message = $this->model('message');

        if($sentTo == "Every Customer"){

            $queryUsers = $user->findAll();
            foreach ($queryUsers as $currentUser){

                $userID = $currentUser->user_id;
                $message->content = $content;
                $message->date_sent = $date;
                $message->creator_id = $creator;
                $message->subject_id = $subjectID;
                $message->recipient_id = $userID;
                $message->isReplied = $isReplied;

                $message->insert();
            }
        }
        else{

            $queryUsers = $user->where(['email'=>$sentTo]);
            $userID = $queryUsers[0]->user_id;
            $message->content = $content;
            $message->date_sent = $date;
            $message->creator_id = $creator;
            $message->subject_id = $subjectID;
            $message->recipient_id = $userID;
            $message->isReplied = $isReplied;

            $message->insert();

        }
    }
}

?>