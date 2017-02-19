#include <mysql/mysql.h>

void print (const char* ID, const int count)
{  
	//printf ("%s\n", ID);
	MYSQL* con = mysql_init (NULL);
	//printf ("%s\n", ID);

	if (con == NULL) 
	{
		fprintf (stderr, "%s\n", mysql_error (con));
		return;
	}
	//printf ("%s\n", ID);

	if (mysql_real_connect (    con, "localhost", "root", "tts2002", 
				"judge",           0,   NULL,         0) == NULL) 
	{
		fprintf (stderr, "%s\n", mysql_error (con));
		mysql_close (con);
		return;
	}  
	//printf ("%s\n", ID);

	MYSQL_RES *res;
	MYSQL_ROW row;

	{
		char buffer [1024];
		sprintf (buffer, "SELECT * FROM Tasks WHERE ID='%s'", ID);

		if (mysql_query (con, buffer)) 
		{
			fprintf (stderr, "%s\n", mysql_error (con));
			mysql_close (con);
			return;
		}
	}
	res = mysql_store_result (con);

	int num_fields = mysql_num_fields (res);
	while ((row = mysql_fetch_row (res)))
	{
		//for(int i = 0 ; i < num_fields ; i ++)
		{
			printf ("%s", row [2]);
			printf ("<br>");
			{
				char buffer [1024];
				sprintf (buffer, "wget \"%s\" -O /tmp/judge_%d.pdf", row [2], count);
				system (buffer);
				printf ("%s<br>", buffer);
			}
			{
				char buffer [1024];
				sprintf (buffer, "pdf2htmlEX \"/tmp/judge_%d.pdf\" \"/tmp/judge_%d.html\"", count, count);
				system (buffer);
				//printf ("%s<br>", buffer);
			}
			int c;
			FILE* file = NULL;
			{
				char buffer [1024];
				sprintf (buffer, "/tmp/judge_%d.html", count);
				printf ("%s<br>", buffer);
				file = fopen (buffer, "r");
			}
			if (file) 
			{
				printf ("Success");
				while ((c = getc (file)) != EOF)
					printf ("%c", c);
				fclose (file);
			}
			else
			{
				printf ("Failed");
			}
			{
				char buffer [1024];
				//sprintf (buffer, "rm ./../../tmp/judge_%d.pdf ./../../tmp/judge_%d.html", count, count);
				//system (buffer);
			}
		}
		//printf ("\n");
	}

	if(res != NULL)
		mysql_free_result (res);

	mysql_close (con);
	return;
}
