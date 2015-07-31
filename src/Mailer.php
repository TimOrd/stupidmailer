<?php

namespace kevdotbadger\StupidMailer;

use Swift_MailTransport;
use Swift_Message;
use Swift_Mailer;

class Mailer {
	
	private $transport;
	private $from;
	private $recipient = array();
	private $subject;
	private $content;
	private $message;
	
	public function setFrom($from){
		$this->from = $from;
		
		return $this;
	}
	
	public function setRecipient($recipient){
		$this->recipient[] = $recipient;
		
		return $this;
	}
	
	public function setSubject($subject){
		$this->subject = $subject;
		
		return $this;
	}
	
	public function addContent($content){
		$this->content = $content;
		
		return $this;
	}
	
	public function send(){
		
		$this->transport = Swift_MailTransport::newInstance();
		$this->message = Swift_Message::newInstance();
		
		$this->message->setFrom($this->from);
		
		foreach( $this->recipient as $recipient){
			$this->message->setTo($recipient);
		}
		
		$this->message->setSubject($this->subject);
		$this->message->setBody($this->content);
		
		$mailer = Swift_Mailer::newInstance($this->transport);
				
		return $mailer->send($this->message);
		
	}
	
}

?>