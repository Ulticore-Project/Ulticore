## PROJECT DEVELOPMENT IS UNDER PAUSE DUE TO LACK OF DEVELOPMENT USE NOSTALGIACORE!
# Ulticore - A 0.8.1 Server

[![License](https://img.shields.io/github/license/Ulticore-Project/Ulticore)]() [![Contributors](https://img.shields.io/github/contributors/Ulticore-Project/Ulticore)]() [![](https://img.shields.io/github/last-commit/Ulticore-Project/Ulticore)]() [![](https://img.shields.io/github/downloads/Ulticore-Project/Ulticore/total)]() [![](https://img.shields.io/github/stars/Ulticore-Project/Ulticore
)]()

---

## **About Ulticore**  

**Ulticore** is a modernized fork of **Scaxe-Legacy** (itself derived from *NostalgiaCore*, originally based on *PocketMine-MP 1.3.12*), rebuilt to deliver **enhanced performance, stability, and features** for *Minecraft: Pocket Edition Alpha* servers.  

### **Built for a Smooth, Stable Experience**  
While rooted in classic MCPE server software, Ulticore introduces:  
- **Critical bug fixes** – Addressing long-standing crashes and gameplay issues from abandoned predecessors.  
- **Experimental infinite worlds** – Support for expansive terrain generation (≈20MB RAM per loaded world).  
- **Performance optimizations** – Reduced lag, smarter entity handling, and efficient chunk management.
- **New Commands** - Commands such as /oplist and /tick have been added. 

### **Key Improvements Over Legacy Forks**  
| Feature          | Old Forks (e.g., NostalgiaCore) | **Ulticore** |  
|------------------|-------------------------------|--------------|  
| **World Size**   | Limited/finite                | **Pseudo Infinite** |  
| **RAM Usage**    | Unoptimized (high per-world)  | **~20MB/ loaded world** (efficient) |  
| **Stability**    | Frequent crashes              | **Patched exploits & memory leaks** |  
| **Plugin Support** | Fragmented APIs              | **Backward-compatible + new tools** |
| **Network Packets** | Slow IO              | **Asynchronous network I/O** |
| **Tick Processing** | Slow tick processor              | **Improved tick performance** |

### **Optimization Recommendations**  
For best performance:  
- Use the [**world unloader plugin**](https://github.com/Ulticore-Project/ulticore-plugins/blob/main/worldunloader.php) to free RAM from inactive worlds.  
- Limit concurrent infinite worlds (each consumes ≈20MB).  
- Allocate **≥256MB RAM** for small servers, **1024MB** for larger servers.  

### **Why This Matters**  
Ulticore bridges the gap between *old MCPE’s charm* and *modern server demands*—offering:  

🔹 **Nostalgia**: Faithful gameplay for Alpha 0.8.X.  
🔹 **Innovation**: Experimental features like infinite worlds.  
🔹 **Longevity**: A maintained codebase where older forks stagnated.  

**Target Versions**: Primarily *MCPE Alpha 0.8.1*.  

---

### **Technical Footnotes**  
- **RAM Usage**: Lower than predecessors but scales with player count/entities.  
- **Compatibility**: Retains most *PocketMine-MP 1.3.12* plugin APIs while adding new extensions.  


---

## **Why Choose Ulticore?**  

### **A Solution to Fragmentation**  
The Minecraft Pocket Edition Alpha 0.8.1 ecosystem has long suffered from **community fragmentation**. Lots of abandoned server forks, incompatible plugins, and unstable builds have made it difficult for players and developers to maintain a consistent multiplayer experience.  

**Ulticore was born in response.**  

### **Our Goal**  
Ulticore is designed to be the **definitive server software** for MCPE Alpha 0.8.1, unifying the scattered landscape of older forks and plugins under one stable, extensible platform.  

We aim to:   **Replace abandoned and outdated forks** – No more digging through broken, unsupported codebases.   **Standardize plugin development** – A single, well-documented API for all plugins.   **Revive the MCPE 0.8.1 multiplayer scene** – By providing a reliable, feature-rich server for new and old communities alike.  

### **History & Vision**  
Originally inspired by the limitations of early MCPE server software, Ulticore was forked from Scaxe-Legacy to:  
- **Improve stability** – Fewer crashes, better memory management, and smoother gameplay.  
- **Support modern tooling** – Easier setup, better configuration, and compatibility with current dev tools.  
- **Encourage collaboration** – Instead of competing forks, we want one **community-driven** project that evolves over time.  

### **One Ecosystem for All**  
Ulticore isn’t just another fork—it’s a **fresh start** for MCPE Alpha 0.8.1 servers. By consolidating the best features from past projects and adding new improvements, we’re creating a **long-term foundation** for:  
🔹 **Server owners** – A hassle-free way to host 0.8.1 worlds with minimal setup.  
🔹 **Plugin developers** – A stable API that doesn’t break between updates.  
🔹 **Players** – A consistent, lag-free experience with active support.  


## Features

### Core Improvements
- 🚀 New optimized chunk-sending system
- ⚡ Better, faster tickProcessor implementation
- 📡 Asynchronous network I/O for improved performance
- 🌍 Built-in infinite world system (no plugins required)
- ⏰ Tick commands have been added (e.g /tick freeze, /tick unfreeze, /tick status)

### Supported MCPE Versions
- 0.8.0 (fully supported)
- 0.8.1 (fully supported)
- 0.8.2 (experimental support)

## Installation

1. Download [PHP 8.1 Binaries](https://github.com/pmmp/PHP-Binaries/releases?page=6):
   - Make sure to select latest build for your platform (Windows, Linux)
   - At least 128MB of ram (512Mb recommended)

2. Download the latest release from [GitHub Releases](https://github.com/Ulticore-Project/Ulticore/releases)
    - Unzip the Ulticore source code
    - Unzip the PHP binaries you have downloaded into the Ulticore folder

3. Depending on your OS run:
   Linux ```chmod +x start.sh && ./start.sh ```
   
   Windows: Run start.cmd

# Contact us

discord: babymu5k @ discord

# Third-party Libraries/Protocols Used
* __[PHP Sockets](http://php.net/manual/en/book.sockets.php)__
* __[PHP SQLite3](http://php.net/manual/en/book.sqlite3.php)__
* __[PHP BCMath](http://php.net/manual/en/book.bc.php)__
* __[PHP pthreads](https://github.com/krakjoe/pthreads)__ by _[krakjoe](https://github.com/krakjoe)_: Threading for PHP - Share Nothing, Do Everything.
* __[PHP YAML](https://code.google.com/p/php-yaml/)__ by _Bryan Davis_: The Yaml PHP Extension provides a wrapper to the LibYAML library.
* __[LibYAML](http://pyyaml.org/wiki/LibYAML)__ by _Kirill Simonov_: A YAML 1.1 parser and emitter written in C.
* __[mintty](https://code.google.com/p/mintty/)__ : xterm Terminal Emulator
* __[cURL](http://curl.haxx.se/)__: cURL is a command line tool for transferring data with URL syntax
* __[Zlib](http://www.zlib.net/)__: A Massively Spiffy Yet Delicately Unobtrusive Compression Library
* __[Source RCON Protocol](https://developer.valvesoftware.com/wiki/Source_RCON_Protocol)__
* __[UT3 Query Protocol](http://wiki.unrealadmin.org/UT3_query_protocol)__
