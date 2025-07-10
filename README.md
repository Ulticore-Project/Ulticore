# Proto14

[![License](https://img.shields.io/github/license/babymu5k/Proto14)]() [![Contributors](https://img.shields.io/github/contributors/babymu5k/Proto14)]() [![](https://img.shields.io/github/last-commit/babymu5k/Proto14)]() [![](https://img.shields.io/github/downloads/babymu5k/Proto14/total)]() [![](https://img.shields.io/github/stars/babymu5k/Proto14
)]()

Proto14 is a fork of Scaxe-Legacy (which was itself a fork of NostalgiaCore, based on PocketMine-MP 1.3.12), featuring new content additions and bug fixes. This server software is designed to support older Minecraft: Pocket Edition versions with enhanced performance and features. along with bugfixes and experimental infinite world generation. Each loaded world takes ∼ 20Mbs of Ram (infinite worlds). We recommend using a world unloader plugin to ensure optimal performance.

## Features

### Core Improvements
- 🚀 New optimized chunk-sending system
- ⚡ Better, faster tickProcessor implementation
- 📡 Asynchronous network I/O for improved performance
- 🌍 Built-in infinite world system (no plugins required)
- Tick commands have been added (e.g /tick freeze, /tick unfreeze, /tick status)

### Supported MCPE Versions
- 0.8.0 (fully supported)
- 0.8.1 (fully supported)
- 0.8.2 (experimental support)

## Installation

1. Download [PHP 8.1 Binaries](https://github.com/pmmp/PHP-Binaries/releases?page=6):
   - Make sure to select latest build for your platform (Windows, Linux)
   - At least 128MB of ram (512Mb recommended)

2. Download the latest release from [GitHub Releases](https://github.com/babymu5k/Proto14/releases)
    - Unzip the Proto14 source code
    - Unzip the PHP binaries you have downloaded into the Proto14 folder

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
