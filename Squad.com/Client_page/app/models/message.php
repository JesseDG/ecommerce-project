<?php

class message extends PDOLayer {
	
    public $content;
    public $date_sent;
    public $creator_id;
    public $subject_id;
    public $recipient_id;
    public $isReplied;
    
    
    public function __construct(){
		PDOLayer::__construct();
	}
    
    
}

?>