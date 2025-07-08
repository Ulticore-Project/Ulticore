<?php

class UDPServer extends Worker{

    public $shutdown;

    protected $externalQueue;
    protected $internalQueue;

    public $server, $port, $listen, $serverip;
    public function __construct($server, $port, $listen, $serverip){
        $this->externalQueue = new \Threaded;
        $this->internalQueue = new \Threaded;
        $this->shutdown = false;

        $this->server = $server;
        $this->port = $port;
        $this->listen = $listen;
        $this->serverip = $serverip;

        $this->start();
    }


    public function run(){
        gc_enable();
        ini_set("memory_limit", -1);
        ini_set("display_errors", 1);
        ini_set("display_startup_errors", 1);


        $this->tickProcessor();
    }

    public function shutdown(){
        $this->shutdown = true;
        return true;
    }

    public function pushMainToThreadPacket($buf, $source, $port) {
        $data = [];
        $data['buf'] = $buf;
        $data['source'] = $source;
        $data['$port'] = $port;
        $this->internalQueue[] = igbinary_serialize($data);
    }

    public function readMainToThreadPacket() {
        return $this->internalQueue->shift();
    }
    public function readThreadToMainPacket(&$buf, &$source, &$port) {
        if(count($this->externalQueue) > 0){
            $data = igbinary_unserialize($this->externalQueue->shift());
            $buf = $data['buf'];
            $source = $data['source'];
            $port = $data['$port'];

            return strlen($buf);
        }
        return false;
    }


    public function tickProcessor(){
        $socket = new UDPSocket($this->server, $this->port, $this->listen, $this->serverip);
        if($socket->connected === false){
            console("[SEVERE] Couldn't bind to $this->serverip:" . $this->port, true, true, 0);
            $this->shutdown = true;
        }

        while(!$this->shutdown){
            $start = microtime(true);
            $this->tick($socket);
            $time = microtime(true) - $start;
            if ($time < 0.005) {
                time_sleep_until(microtime(true) + 0.005 - $time);
            }
        }
        $socket->close();
    }

    public function tick($socket){
        //收包
        $buf = "";
        $source = false;
        $port = 1;
        $len = $socket->read($buf, $source, $port);
        if($len !== false and $len !== 0){
            $data = [];
            $data['buf'] = $buf;
            $data['source'] = $source;
            $data['$port'] = $port;
            $this->externalQueue[] = igbinary_serialize($data);
        }

        //Outsourcing
        while(count($this->internalQueue) > 0){
            $data = igbinary_unserialize($this->readMainToThreadPacket());
            $socket->write($data['buf'], $data['source'], $data['$port']);
        }


    }
}
