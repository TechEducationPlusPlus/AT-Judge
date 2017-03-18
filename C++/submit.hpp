
struct submit
{
	string id;
	string contestId;
	string taskId;
	string userId;
	string code;
	string lang;
	MYSQL_ROW checker;
	MYSQL_ROW task_row;
	/*
	UPDATE `Submissions` SET `Points` = points WHERE `ID` = id;
	*/
	submit (string _1, string _2, string _3, string _4, string _5, string _6)
	{
		id = _1;
		contestId = _2;
		taskId = _3;
		userId = _4;
		code = _5;
		lang = _6;
		MYSQL_RES *res;
		{
			char buffer [1024];
			sprintf (buffer, "SELECT * FROM `Tasks` WHERE `ID`='%s'", taskId.c_str ());

			if (mysql_query (con, buffer)) 
			{
				mysql_close (con);
			}
		}
		res = mysql_store_result (con);
		task_row = mysql_fetch_row (res);
		
		{
			char buffer [1024];
			sprintf (buffer, "SELECT * FROM `Checker` WHERE `ID`='%s'", task_row [6]);

			if (mysql_query (con, buffer)) 
			{
				mysql_close (con);
			}
		}
		res = mysql_store_result (con);
		checker = mysql_fetch_row (res);
	}
	void updatePoints (int points, string log, string compile)
	{
		MYSQL_RES *res;
		MYSQL_ROW row;

		{
			char buffer [1024];
			sprintf (buffer, "UPDATE `Submissions` SET `CompileLog`='%s', `Log`='%s', `Points`=%d WHERE `ID`=%s", compile.c_str (), log.c_str (), points, id.c_str ());

			if (mysql_query (con, buffer)) 
			{
				mysql_close (con);
			}
		}
		printf ("Update: ID=%s Points=%d Log=\"%s\" Compiler:\"%s\"\n", id.c_str (), points, log.c_str (), compile.c_str ());
	}

	void asEvaluating ()
	{
		MYSQL_RES *res;
		MYSQL_ROW row;

		{
			char buffer [1024];
			sprintf (buffer, "UPDATE `Submissions` SET `IsEvaluating`=1 WHERE `ID`=%s", id.c_str ());

			if (mysql_query (con, buffer)) 
			{
				mysql_close (con);
			}
		}

	}

	string getChecker ()
	{
		return string ("localhost:49152");
		try
		{
			return checker [1];
		}
		catch (...)
		{
			cout << "getChecker (): return checker [1]; : exception" << endl;
		}
	}

	string getTests ()
	{
		try
		{
			return task_row [7];
		}
		catch (...)
		{
			cout << "getTests (): return task_row [7]; : exception" << endl;
		}
	}
};
