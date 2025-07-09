# **PocketMine Plugin Development Cheat Sheet**  
*(For Proto 14 server API version 12.2, PHP 8.1+)*  

---

## **1. Basic Plugin Structure**  
### **Required Metadata (Header Comment)**  
```php
/*
__PocketMine Plugin__
name=MyPlugin
description=Does something cool
version=1.0
author=YourName
class=MyPlugin
apiversion=12.2  // Must match server API
*/
```

### **Class Skeleton**  
```php
class MyPlugin implements Plugin {  
    private $api;  

    public function __construct(ServerAPI $api, $server = false) {  
        $this->api = $api;  
    }  

    public function init() {  
        // Register commands/events here  
        console("[MyPlugin] Loaded!");  
    }  

    public function __destruct() {}  
}  
```

---

## **2. Handling Commands**  
### **Register a Command**  
```php
public function init() {  
    $this->api->console->register("test", "Example command", [$this, "handleCommand"]);  
}  

public function handleCommand($cmd, $args, $issuer, $alias) {  
    if ($issuer instanceof Player) {  
        return "Hello, " . $issuer->username . "!";  
    }  
    return "Hello, Console!";  
}  
```

### **Whitelist a Command**  
```php
$this->api->ban->cmdWhitelist("test");  // Bypasses command blocks  
```

---

## **3. Handling Events**  
### **Common Events & Data Structures**  
| Event            | Data Access                 | Example Usage                          |  
|------------------|-----------------------------|----------------------------------------|  
| `player.join`    | `$data->username`           | `$player = $this->api->player->get($data->username)` |  
| `player.quit`    | `$data->player` or `$data->username` | `$this->api->chat->broadcast($player->username . " left!")` |  
| `player.move`    | `$data->x`, `$data->z`      | `if ($data->x > 100) { ... }`          |  
| `block.place`    | `$data->player`, `$data->block` | `$player->sendChat("You placed " . $data->block->getName())` |  

### **Example: Player Join Message**  
```php
public function init() {  
    $this->api->addHandler("player.join", [$this, "onJoin"]);  
}  

public function onJoin($data) {  
    $player = $this->api->player->get($data->username);  
    $this->api->chat->broadcast("§aWelcome, " . $player->username . "!");  
}  
```

---

## **4. Working with Configs**  
### **Create/Save Config**  
```php
public function init() {  
    $configPath = $this->api->plugin->createConfig($this, [  
        "welcome-message" => "§aWelcome to the server!",  
        "max-players" => 20  
    ]);  
}  
```

### **Read/Modify Config**  
```php
$config = $this->api->plugin->readYAML($configPath . "config.yml");  
$config["max-players"] = 30;  
$this->api->plugin->writeYAML($configPath . "config.yml", $config);  
```

---

## **5. Player & World Manipulation**  
### **Teleport a Player**  
```php
$player->teleport(new Position(100, 70, 200, $this->api->level->getDefault()));  
```

### **Load/Generate a World**  
```php
if (!$this->api->level->loadLevel("world2")) {  
    $this->api->level->generateLevel("world2");  
}  
```

### **Send Messages**  
```php
$player->sendChat("Hello!");  
$this->api->chat->broadcast("Server restarting soon!");  
```

---

## **6. Plugin Dependencies**  
```php
class MyPlugin implements Plugin, OtherPluginRequirement {  
    public function getRequiredPlugins() {  
        return [  
            new RequiredPluginEntry("EconomyAPI", "2.0"),  
            new RequiredPluginEntry("Essentials")  
        ];  
    }  
}  
```

---

## **7. Debugging Tips**  
1. **Log to Console**:  
   ```php
   console("[MyPlugin] Debug: " . print_r($data, true));  
   ```  
2. **Check Variable Types**:  
   ```php
   if (is_object($data)) { ... }  
   ```  
3. **Test Events**:  
   - Use `/plugins` to verify loading.  
   - Check server logs for errors.  

---

## **8. Packaging & Distribution**  
### **As `.php` File**  
- Just drop in `plugins/` folder.  

### **As `.phar` (Recommended)**  
1. Create structure:  
   ```
   MyPlugin/  
   ├── src/MyPlugin.php  
   └── plugin.cfg  
   ```  
2. `plugin.cfg`:  
   ```ini
   name=MyPlugin  
   mainFile=MyPlugin.php  
   version=1.0  
   ```  
3. Run:  
   ```bash
   cd MyPlugin && zip -r ../MyPlugin.phar *  
   ```

---

### **Final Notes**  
✅ **Do**:  
- Use `implements Plugin` (not `extends`).  
- Check API version compatibility.  
- Handle errors gracefully.  

❌ **Don’t**:  
- Use deprecated methods.  
- Assume event data structure (always verify).  

This covers 90% of plugin needs! For advanced features, study the InfWorld plugin or Proto API directly. 🚀