#include <stdio.h>
#include <dirent.h>
#include <string.h>
#include <fcntl.h>
#include <stdlib.h>
#include <unistd.h>
#include <time.h>
#include <mysql/mysql.h>

#define SERVER "www.zhi.cl"
#define DATABASE_NAME		"wineberry"
#define DATABASE_USERNAME	"root"
#define DATABASE_PASSWORD	"zhi$root$mysql"

MYSQL *mysql1;

void mysql_connect (void)
{
    //initialize MYSQL object for connections
	mysql1 = mysql_init(NULL);

    if(mysql1 == NULL)
    {
        fprintf(stderr, "%s\n", mysql_error(mysql1));
    }

    //Connect to the database
    if(mysql_real_connect(mysql1, SERVER, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME, 0, NULL, 0) == NULL)
    {
    	fprintf(stderr, "%s\n", mysql_error(mysql1));
    }
}


void mysql_disconnect (void)
{
    mysql_close(mysql1);
}

int Calculo_Moda(int nums[],int total) { //Ojo asume que el arreglo esta ordenado
    int j, i, c, max, mode;
    
    mode  = 0;
    max = 0;
    
for (j=0;j<total;j++){
	c = 0;
	for ( i = j+1; i < total; ++i ) {
		if (nums[j] == nums[i]) {
			c++;
		}
		if ((c>max) && (c!=0)) {
			max = c;
			mode = nums[i];
		}
	}
}
return mode;
}
     
int main (void) {
 DIR *dir;
 struct dirent *dirent;
 char dev[16];      // Dev ID
 char devPath[128]; // Path to device
 char buf[256];     // Data from device
 char tmpData[6];   // Temp C * 1000 reported by device 
 char path[] = "/sys/bus/w1/devices"; 
 
 ssize_t numRead;
  
 dir = opendir (path);
 	//int temp = -1;
	int time_start, time_end,pos_moda;
	char ins[100];
	int temp_array [500];
	int cont = 0;
	int tiempo_muestra = 5; //tiempo durante se toman los datos para enviar a la BD en minutos
	FILE *log;

	log = fopen("/var/log/db18b20.log","a");

	fprintf(log, "Raspberry Pi wiringPi DB18B20 Temperature program %d\n",(int)time(NULL));
	fflush(log);
 
 if (dir != NULL)
 {
  while ((dirent = readdir (dir)))
   // 1-wire devices are links beginning with 28-
   if (dirent->d_type == DT_LNK && 
     strstr(dirent->d_name, "28-") != NULL) { 
    strcpy(dev, dirent->d_name);
    fprintf(log,"\nDevice: %s\n", dev);
   }
        (void) closedir (dir);
        }
 else
 {
  perror ("Couldn't open the w1 devices directory");
  return 1;
 }

        // Assemble path to OneWire device
 sprintf(devPath, "%s/%s/w1_slave", path, dev);
 // Read temp continuously
 // Opening the device's file triggers new reading
 while(1) {
		
		time_start = (int)time(NULL);
		time_end = time_start + 60*tiempo_muestra;
		fprintf(log,"time start = %d; time end = %d\n",time_start,time_end);
		fflush(log);
		
		cont = 0;
		while (time_start <= time_end) 	
 		{ 	
  		int fd = open(devPath, O_RDONLY); //abro archivo para leer temperatura
  		if(fd == -1)
  		{
   			perror ("Couldn't open the w1 device.");
   			return 1;   
  		}
   
  		while((numRead = read(fd, buf, 256)) > 0) 
  		{			  	
   			strncpy(tmpData, strstr(buf, "t=") + 2, 5); 
   			float tempC = strtof(tmpData, NULL);
   			fprintf(log,"time: %d - ",time_start);
   			//fprintf(log,"Device: %s  - ", dev);
   			//fprintf(log,"Contador: %d  - ", cont);    			 
   			fprintf(log,"Temp: %.3f C  \n", tempC / 1000);
   			//printf("%.3f F\n\n", (tempC / 1000) * 9 / 5 + 32); //Temperatura en Farenheid
   			fflush(log);
   			temp_array[cont++] = (int)tempC;
   			//fprintf(log,"temp array : %d\n",temp_array[cont-1]);
  		}
  		close(fd);
  		time_start = (int)time(NULL);
		}
	
	//fprintf(log,"contador %d\n",cont);
	fflush(log);
	
	if (cont > 0){
		//fprintf(log,"En if para insert eb DB %d\n",cont);
		//fflush(log);
		pos_moda = Calculo_Moda(temp_array,cont);
		//fprintf(log,"Despues de Calculo de Moda %d\n",pos_moda);
		//fflush(log);
		sprintf (ins,"insert into Data(infoData,Device_idDevice,timeData) VALUES (%.3f,'2',FROM_UNIXTIME(%d))",(double)pos_moda / 1000,time_end);			
		fprintf(log,"Insertado en la Base de Datos : %s\n",ins);
		fflush(log);
		mysql_connect();
		if(mysql1 != NULL)
		{
			if (mysql_query(mysql1,ins))
			{
			fprintf(log, "%s\n", mysql_error(mysql1));
	  	fflush(log);
			}
  		mysql_disconnect();
  	}else{
  			fprintf(log,"Couldn't connect to DB.");
  			fflush(log);
		}
 } else {
 	//fprintf(log,"Contador %d\n",cont);
 	//fflush(log);
}  
}       /* return 0; --never called due to loop */
}