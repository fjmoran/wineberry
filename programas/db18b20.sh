#! /bin/sh
# /etc/init.d/db18b20

### BEGIN INIT INFO
# Provides:	zhi_db18b20
# Required-Start: $remote_fs
# Required-Stop:	$remote_fs
# Default-Start:	2 3 4 5
# Default-Stop:		0 1 6
# Short-Description: Simple script to start a program at boot.
# Description:		Program to start sensing with DHT11 sensor
### END INIT INFO

case $1 in
	start)
		echo "Starting DB18B20"
		/usr/local/bin/db18b20
		;;
	stop)
		killall db18b20
		;;
	*)
		echo "use /etc/init.d/db18b20 {start|stop}"
		exit 1
		;;
esac
	
exit 0	