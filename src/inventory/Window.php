<?php

const WINDOW_CHEST = 0;
const WINDOW_WORKBENCH = 1;
const WINDOW_FURNACE = 2;
const WINDOW_STONECUTTER = 3;

class Window{

	private $server;

	public function __construct(){
		$this->server = ServerAPI::request();
	}
}