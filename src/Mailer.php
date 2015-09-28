<?php

namespace kevdotbadger\StupidMailer;

use Swift_MailTransport;
use Swift_Message;
use Swift_Mailer;

class Mailer {
	
	private $transport;
	private $from;
	private $recipients = array();
	private $subject;
	private $content;
	private $message;
	
	/**
	* Set the from part of an email
	*
	* @param string $from 
	* @return Mailer
	* @author Kevin Ruscoe
	*/
	public function setFrom($from){
		$this->from = $from;
		
		return $this;
	}
	
	/**
	* Set a single recipient
	*
	* @param string $email 
	* @param string $name 
	* @return Mailer
	* @author Kevin Ruscoe
	*/
	public function setRecipient($email, $name){
		$this->recipients[$email] = $name;
		
		return $this;
	}
	
	/**
	* Set an array of recipients
	*
	* @param array $recipients 
	* @return void Mailer
	* @author Kevin Ruscoe
	*/
	public function setRecipients($recipients){
				
		foreach( $recipients as $email => $name ){
			$this->setRecipient($email, $name);
		}
		
		return $this;
	}
	
	/**
	* Set the subject
	*
	* @param string $subject 
	* @return Mailer
	* @author Kevin Ruscoe
	*/
	public function setSubject($subject){
		$this->subject = $subject;
		
		return $this;
	}
	
	/**
	* Add content to an email
	*
	* @param string $content 
	* @return Mailer
	* @author Kevin Ruscoe
	*/
	public function addContent($content){
		$this->content = $content;
		
		return $this;
	}
	
	/**
	* Send email
	*
	* @return boolean
	* @author Kevin Ruscoe
	*/
	public function send(){
				
		$this->transport = Swift_MailTransport::newInstance();
		$this->message = Swift_Message::newInstance();
		
		$this->message->setFrom($this->from);
		
		$this->message->setTo($this->recipients);
				
		$this->message->setSubject($this->subject);
		$this->message->setBody($this->content);
		
		$mailer = Swift_Mailer::newInstance($this->transport);
				
		return $mailer->send($this->message);
		
	}
	
}

?>
