/*
 *  dht11.c:
 *	Simple test program to test the wiringPi functions
 *	DHT11 test
 */

#include <wiringPi.h>

#include <stdio.h>
#include <stdlib.h>
#include <stdint.h>
#include <string.h>
#include <stdlib.h>
#include <time.h>
#include <mysql/mysql.h>

#define MAXTIMINGS	85
#define DHTPIN		15
#define SERVER "www.zhi.cl"
#define DATABASE_NAME		"wineberry"
#define DATABASE_USERNAME	"root"
#define DATABASE_PASSWORD	"zhi$root$mysql"

struct dht11{
	int temp;
	int hum;
	int CRC;
};

int contador,dht11_dat[5] = { 0, 0, 0, 0, 0 };
MYSQL *mysql1;

struct dht11 read_dht11_dat()
{
	uint8_t laststate	= HIGH;
	uint8_t counter		= 0;
	uint8_t j		= 0, i;
	struct dht11 result;
	//float	f; /* fahrenheit */
	
	dht11_dat[0] = dht11_dat[1] = dht11_dat[2] = dht11_dat[3] = dht11_dat[4] = 0;

	/* pull pin down for 18 milliseconds */
	pinMode( DHTPIN, OUTPUT );
	digitalWrite( DHTPIN, LOW );
	delay( 18 );
	/* then pull it up for 40 microseconds */
	digitalWrite( DHTPIN, HIGH );
	delayMicroseconds( 40 );
/* prepare to read the pin */
	pinMode( DHTPIN, INPUT );

	/* detect change and read data */
	for ( i = 0; i < MAXTIMINGS; i++ )
	{
		counter = 0;
		while ( digitalRead( DHTPIN ) == laststate )
		{
			counter++;
			delayMicroseconds( 1 );
			if ( counter == 255 )
			{
				break;
			}
		}
		laststate = digitalRead( DHTPIN );

		if ( counter == 255 )
			break;

		/* ignore first 3 transitions */
		if ( (i >= 4) && (i % 2 == 0) )
		{
			/* shove each bit into the storage bytes */
			dht11_dat[j / 8] <<= 1;
			if ( counter > 16 )
				dht11_dat[j / 8] |= 1;
			j++;
		}
	}

	/*
	 * check we read 40 bits (8bit x 5 ) + verify checksum in the last byte
	 * print it out if data is good
	 */
	if ( (j >= 40) &&
	     (dht11_dat[4] == ( (dht11_dat[0] + dht11_dat[1] + dht11_dat[2] + dht11_dat[3]) & 0xFF) ) )
	{
		//f = dht11_dat[2] * 9. / 5. + 32;
		//printf ("Time %d, Data Good\n",(int)time(NULL));
		//fprintf (fp,"%d;",(int)time(NULL));
		//printf( "Humidity = %d.%d %% Temperature = %d.%d *C (%.1f *F)\n", dht11_dat[0], dht11_dat[1], dht11_dat[2], dht11_dat[3], f );
		//fprintf( fp,"%d.%d;%d.%d;%.1f\n", dht11_dat[0], dht11_dat[1], dht11_dat[2], dht11_dat[3], f );
		result.temp = dht11_dat[2];
		result.hum = dht11_dat[0];
		result.CRC = dht11_dat[4];

	}else  {
	//	printf( "Data not good, skip\n" );

	//	f = dht11_dat[2] * 9. / 5. + 32;
	//	printf( "Humidity = %d.%d %% Temperature = %d.%d *C (%.1f *F)\n", dht11_dat[0], dht11_dat[1], dht11_dat[2], dht11_dat[3], f );
	result.temp = -1;
	result.hum = dht11_dat[0];
	result.CRC = dht11_dat[4];
	}
//fclose(fp);
//sprintf(salida,"%d.%d;%d.%d",dht11_dat[0],dht11_dat[1],dht11_dat[2],dht11_dat[3]);
return result;
}

//*****************************************
//*****************************************
//********** CONNECT TO DATABASE **********
//*****************************************
//*****************************************
void mysql_connect (void)
{
    //initialize MYSQL object for connections
	mysql1 = mysql_init(NULL);

    if(mysql1 == NULL)
    {
        fprintf(stderr, "%s\n", mysql_error(mysql1));
        return;
    }

    //Connect to the database
    if(mysql_real_connect(mysql1, SERVER, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME, 0, NULL, 0) == NULL)
    {
    	fprintf(stderr, "%s\n", mysql_error(mysql1));
    }
    else
    {
        //printf("Database connection successful.\n");
    }
}

//**********************************************
//**********************************************
//********** DISCONNECT FROM DATABASE **********
//**********************************************
//**********************************************
void mysql_disconnect (void)
{
    mysql_close(mysql1);
    //printf( "Disconnected from database.\n");
}


int Calculo_Moda(int nums[],int total) {
    int i, j, maxCount, modeValue;
    int tally[total];
    for (i = 0; i < total; i++) {
         tally[nums[i]]++;
    }
    maxCount = 0;
    modeValue = 0;
    for (j = 0; j < total; j++) {
        if (tally[j] > maxCount) {
            maxCount = tally[j];
            modeValue = j;
        }
    }
    return modeValue;
}

int main( void )
{
	//int temp = -1;
	int time_start, time_end,pos_moda;
	char ins[100];
	int temp_array [400];
	int hum_array [400];
	int cont = 0;
	int tiempo_muestra = 5; //tiempo durante se toman los datos para enviar a la BD
	FILE *fp;
	struct dht11 datos;

	fp = fopen("/var/log/dht11.log","a");

	fprintf(fp, "Raspberry Pi wiringPi DHT11 Temperature test program %d\n",(int)time(NULL));

	if ( wiringPiSetup() == -1 )
		exit( 1 );

	while ( 1 )
	{
		//printf (" %d :",contador++);
		time_start = (int)time(NULL);
		time_end = time_start + 60*tiempo_muestra;
		fprintf(fp,"time start = %d; time end = %d\n",time_start,time_end);
		fflush(fp);
		
		cont = 0;
		while (time_start <= time_end)
		{
			datos = read_dht11_dat();
			//printf("temp = %d\n",temp);
			if (datos.temp >= 0) 
			{
				hum_array[cont] = datos.hum;
				temp_array[cont++] = datos.temp;
			}
			delay(1000);
			time_start = (int)time(NULL);
			fprintf(fp,"time_start = %d; temp = %d; humedad = %d\n",time_start,datos.temp,datos.hum);
			fflush(fp);
		}
		if (cont > 0)
		{
			pos_moda = Calculo_Moda(temp_array,cont-1);
			sprintf (ins,"insert into Data(infoData,Device_idDevice,timeData) VALUES (%d,'1',FROM_UNIXTIME(%d))",temp_array[pos_moda],time_end);
			//printf ("%s\n",ins);
			if(mysql1 != NULL)
	    {
	        //Inserta los datos de Temperatura
	        if (mysql_query(mysql1, ins))
	        {
	            fprintf(fp, "%s\n", mysql_error(mysql1));
	            fflush(fp);
	            //return;
	        }
	    }			
			fprintf(fp,"Insertado en la Base de Datos : %s\n",ins);
			fflush(fp);

			pos_moda = Calculo_Moda(hum_array,cont-1);
			sprintf (ins,"insert into Data(infoData,Device_idDevice,timeData) VALUES (%d,'3',FROM_UNIXTIME(%d))",hum_array[pos_moda],time_end);
			//printf ("%s\n",ins);
			if(mysql1 != NULL)
	    {
	        //Inserta los datos de Humedad
	        if (mysql_query(mysql1, ins))
	        {
	            fprintf(fp, "%s\n", mysql_error(mysql1));
	            fflush(fp);
	            //return;
	        }
	    }			
			fprintf(fp,"Insertado en la Base de Datos : %s\n",ins);
			fflush(fp);			
	    mysql_disconnect();
		}else {
			fprintf(fp,"No hay datos\n");
			fflush(fp);
		//printf("retorno funcion read_dht11 : %d\n",read_dht11_dat());
		//delay( 1000 ); /* wait 1sec to refresh */
		}
	}

	return(0);
}
