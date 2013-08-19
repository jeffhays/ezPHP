<?php
namespace ez\core;
use SessionHandlerInterface;

class session implements SessionHandlerInterface {
	
	private $path;
	
	public function open($path, $name){
	  $this->path = $path;
	  if(!is_dir($this->path)){
	    mkdir($this->path, 0777);
	  }
	
	  return true;
	}
	
	public function close(){
	  return true;
	}
	
	public function read($id){
	  return (string)@file_get_contents("$this->path/sess_$id");
	}
	
	public function write($id, $data){
	  return file_put_contents("$this->path/sess_$id", $data) === false ? false : true;
	}
	
	public function destroy($id){
		$file = "$this->path/sess_$id";
		if(file_exists($file)){
		  unlink($file);
		}
		
		return true;
	}
	
	public function gc($maxlifetime){
		foreach (glob("$this->path/sess_*") as $file) {
	    if(filemtime($file) + $maxlifetime < time() && file_exists($file)) {
        unlink($file);
	    }
		}
		
		return true;
	}
	
}