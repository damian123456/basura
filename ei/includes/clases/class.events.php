<?php

class Events {
	// Stores the singleton instance;
	protected static $instance = null;

	protected $events = array();

	// From joomla's dispatcher.php
	public static function getInstance() {
		if (self::$instance === null) {
			self::$instance = new static;
		}
		return self::$instance;
	}

	public function attach($eventName, $callback) {
		if (!isset($this->events[$eventName])) {
			$this->events[$eventName] = array();
		}
		$this->events[$eventName][] = $callback;
	}

	public function trigger($eventName, $data = null) {
		foreach ($this->events[$eventName] as $callback) {
			$callback($eventName, $data);
		}
	}

}
