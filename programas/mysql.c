#include <mysql/mysql.h>
#include <stdio.h>
#include <string.h>
#include <stdlib.h>

#define DATABASE_HOST "www.zhi.cl"
#define DATABASE_NAME		"test"
#define DATABASE_USERNAME	"root"
#define DATABASE_PASSWORD	"zhi$root$mysql"
MYSQL *mysql1;


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
    if(mysql_real_connect(mysql1, DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME, 0, NULL, 0) == NULL)
    {
    	fprintf(stderr, "%s\n", mysql_error(mysql1));
    }
    else
    {
        printf("Database connection successful.\n");
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
    printf( "Disconnected from database.\n");
}


// Writing The Database

void mysql_write_something (void)
{
   //vector times;   //a vector of alarm times

    if(mysql1 != NULL)
    {
        //Retrieve all data from alarm_times
        if (mysql_query(mysql1, "INSERT INTO PYR (idPYR,PreguntaPYR,RespuestaPYR, hitsPYR \
				) VALUES (   99,\
					'Hello',   \
					'BYE',   \
					99   \
				) \
				"))

        {
            fprintf(stderr, "%s\n", mysql_error(mysql1));
            return;
        }
    }
}

// Read something form DataBase

 int main(int argc, char **argv)
{
 mysql_connect();

    if (mysql1 != NULL)
    {
    		mysql_write_something ();
    		
        if (!mysql_query(mysql1, "SELECT * FROM PYR"))
        {
        	MYSQL_RES *result = mysql_store_result(mysql1);
        	if (result != NULL)
        	{
        		//Get the number of columns
        		int num_rows = mysql_num_rows(result);
        		int num_fields = mysql_num_fields(result);

        		MYSQL_ROW row;			//An array of strings
        		while( (row = mysql_fetch_row(result)) )
        		{
        			if(num_fields >= 2)
        			{
        				char *value_int = row[0];
        				char *value_string = row[1];

        				printf( "Got value %s\n", value_string);
        	        }
        		}
   	            mysql_free_result(result);
        	}
        }

    }

    mysql_disconnect();
  }
  