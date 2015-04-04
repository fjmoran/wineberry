#! /bin/sh
# /etc/init.d/dht11

### BEGIN INIT INFO
# Provides:	zhi
# Required-Start: $remote_fs
# Required-Stop:	$remote_fs
# Default-Start:	2 3 4 5
# Default-Stop:		0 1 6
# Short-Description: Simple script to start a program at boot.
# Description:		Program to start sensing with DHT11 sensor
### END INIT INFO

case $1 in
	start)
		echo "Starting DHT11"
		/usr/local/bin/dht11
		;;
	stop)
		killall dht11
		;;
	*)
		echo "use /etc/init.d/dht11 {start|stop}"
		exit 1
		;;
esac
	
exit 0	