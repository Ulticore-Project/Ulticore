#!/bin/bash

echo -e "version\nstop\n" | bin/php7/bin/php -dphar.readonly=0 PocketMine-MP.php --no-wizard --disable-ansi --disable-readline --debug.level=2

log_file="console.log"
output=$(cat "$log_file")

if [ $(grep -c "ERROR\|CRITICAL\|EMERGENCY" <<< "$output") -ne 0 ]; then
	echo Server log contains error messages, changing build status to failed
	exit 1
else
	echo Server running correctly
fi

echo All tests passed