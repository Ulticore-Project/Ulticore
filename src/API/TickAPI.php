<?php

class TickAPI{
    private $server;

    function __construct(){
        $this->server = ServerAPI::request();
    }

    public function init(){
        $this->server->api->console->register("tick", "<freeze|unfreeze|status|resume> [time]", [$this, "commandHandler"]);
    }
    
    public function commandHandler($cmd, $params, $issuer, $alias){
        switch(strtolower($params[0] ?? "")){
            case "freeze":
            case "pause":
                $this->server->freezeTicks();
                return "Ticks frozen";
                
            case "unfreeze":
            case "resume":
                $this->server->unfreezeTicks();
                return "Ticks resumed";
                
            case "status":
                return "Ticks are currently " . ($this->server->isTicksFrozen() ? "FROZEN" : "RUNNING". "@ ". $this->server->getTPS() . " TPS") . 
                    " (Total ticks: {$this->server->ticks})";
                
            default:
                return "Usage: /tick <freeze|unfreeze|status|resume>";
        }
    }
}