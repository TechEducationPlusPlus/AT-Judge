#include <thread>
#include <iostream>
#include <fstream>
#include <sstream>
#include <mysql/mysql.h>

using namespace std;

      ifstream HOST_FILE = ifstream ("../HOST");
      string LINK_JUDGE = string ( (std::istreambuf_iterator<char>(HOST_FILE) ),
                             (std::istreambuf_iterator<char>()        ) );

MYSQL* con = mysql_init (NULL);

#include "submit.hpp"
#include "box.hpp"
#include "lang.hpp"
#include "curl.lib.hpp"
#include "urldecode.hpp"

#include <experimental/filesystem>
namespace fs = std::experimental::filesystem;
#include <regex>

const int concurentThreadsSupported = thread::hardware_concurrency ();
box* free_boxes;
bool* is_free_box;

int getFree ()
{
	for (int i = 0 ; i < concurentThreadsSupported ; i ++)
	{
		if (free_boxes [i].free () and is_free_box [i])
		{
			return i;
		}
	}
	return -1;
}

const string tl_error = "124\n";//"Time limit exceeded\n";
const string signal_11 = "11\n";//"Caught fatal signal 11\n";
const string compile_error = "Compilation error";

void eval (submit curr, size_t boxId)
{
	curr.asEvaluating ();
	is_free_box [boxId] = false;
	//cout << "KUCHE MRUSNO, BACHKAM" << endl;
	try
	{
	//cout << "KUCHE MRUSNO, BACHKAM" << endl;
	//cout << "KUCHE MRUSNO, BACHKAM" << endl;
	const string sourceFile = free_boxes [boxId].getPath (string ("source." + curr.lang).c_str ());
	
	//cout << "KUCHE MRUSNO, BACHKAM" << endl;
	createSourceFile:
	{
		ofstream file (sourceFile.c_str ());
		file << urlDecode (curr.code) << endl;
		cout << sourceFile << "\n";
		cout << urlDecode (curr.code) << endl;
	}
	
	double points = 0;
	double percent = 0;
	bool skip = false;
	string compilelog, log;

	CompileSource:
	{
		compilelog = free_boxes [boxId].doCommand (langs [curr.lang](free_boxes [boxId].getPath ()));
		cout << compilelog << "\n-----------------------------\n";
		cout.flush ();
		//if (not fs::exists (free_boxes [boxId].getPath ("source.exe")))
		//{
		//	skip = true;
		//	log = "[\"" + compile_error + "\", 0]";
		//}
	}
if (!skip)
{
	vector <string> star;
	//cout << "GetTests" << endl;
	GetTests:
	{
		stringstream ss (curr.getTests ());

		while (ss.good ())
		{
			string substr;
			getline (ss, substr, ',');
			star.push_back (substr);
		}
	}

	//cout << "Evaluate" << endl;
	Evaluate:
	{
		for (auto& x : star)
		{
			//cout << "star: " << x << endl;
			string link = curr.task_row [3];
			string  in = regex_replace (curr.task_row [4], regex ("\\*"), x);
			string out = regex_replace (curr.task_row [5], regex ("\\*"), x);
			cout << in << " " << out << "\n";
			{
				stringstream ss;
				ss << "curl " << link << "/" << in << " -o " << boxId << "/in; curl " << link << "/" << out << " -o " << boxId << "/outA";
			//	cout << ss.str () << "\n";
				system (ss.str ().c_str ());
			}
			{
				stringstream ss;
				ss << "cp " << boxId << "/in " << free_boxes [boxId].getPath () << "; cp " << boxId << "/outA " << free_boxes [boxId].getPath ();
			//	cout << ss.str () << "\n";
				system (ss.str ().c_str ());
			}
			string signal;
			{
				{
					stringstream ss;
					ss << "/php_web/AT-Judge/C++/" 
					   << boxId << "/outB";
					signal = free_boxes [boxId].doIsolatedCommand (langs_exec [curr.lang](free_boxes [boxId].getPath ()), string (curr.task_row [9]), string (curr.task_row [10]), string ("in"), ss.str ());
				}
			}
			{
				if (signal == tl_error)
					log += "[\"TL\",0],";
				else if (signal == signal_11)
					log += "[\"11\",0],";
				else
				{
					stringstream ss;
					ss << "http://" << curr.getChecker () << "?type=" << curr.checker [0] << "&link=http%3A%2F%2F" << LINK_JUDGE << "%2FC%2B%2B%2F" << boxId << "&input=in&output1=outA&output2=outB";
					cout << ss.str () << "\n";
					string a;
					log += (a = GET (ss.str ()));
					log += ",";
					a = a.substr (a.find (',') + 1);
					a.erase (a.size () - 1, 1);
					//cout << a << "\n";
					percent += stod (a);
				}
			}
		}
		log.erase (log.size () - 1, 1);
	}
	percent /= star.size ();
	points = stod (curr.task_row [8]) * percent;
}

	//cout << "Delete" << endl;
	Delete:
	{
		system (("rm " + sourceFile).c_str ());
		system (("rm " + string (free_boxes [boxId].getPath ("source.exe"))).c_str ());
		system (("rm " + string (free_boxes [boxId].getPath ("in"))).c_str ());
		system (("rm " + string (free_boxes [boxId].getPath ("outA"))).c_str ());
		system (("rm " + string (free_boxes [boxId].getPath ("outB"))).c_str ());
	}
	curr.updatePoints (points, "[" + log + "]", url_encode (compilelog));
	}
	catch (exception& e)
	{
		cout << "General: " << e.what () << "\n";
	}
	//cout << "#=#=#=#=#=#=#=#=#=#=#=#=#=#=#=#=#=#=#=#=#=#=#=#=#=#=#=#=#=#=#=#=#=#=#=#=#=#=#=" << endl;
	is_free_box [boxId] = !false;
}

#include "trim"

int main ()
{
	LINK_JUDGE = trim (LINK_JUDGE);
	free_boxes = new box [concurentThreadsSupported];
	is_free_box = new bool [concurentThreadsSupported];
	for (int i = 0 ; i < concurentThreadsSupported ; i ++)
		is_free_box [i] = true;
	if (con == NULL) 
	{
		fprintf (stderr, "%s\n", mysql_error (con));
		throw "Failed";
	}
	if (mysql_real_connect (    con, "localhost", "root", "tts2002", 
				"judge",           0,   NULL,         0) == NULL) 
	{
		fprintf (stderr, "%s\n", mysql_error (con));
		mysql_close (con);
		throw "Failed";
	}  
	bool to_print = true;
	while (true)
	{
		MYSQL_RES *res;
		MYSQL_ROW row;

		{
			char buffer [1024];
			sprintf (buffer, "SELECT * FROM `Submissions` WHERE `Points` IS NULL");

			if (mysql_query (con, buffer)) 
			{
				fprintf (stderr, "%s\n", mysql_error (con));
				mysql_close (con);
				throw "Failed";
			}
		}
		res = mysql_store_result (con);

		//int num_fields = mysql_num_fields (res);
		while ((row = mysql_fetch_row (res)))
		{
			to_print = true;
			while (getFree () == -1)
			{
				if (to_print)
				{
					cout << "waiting for core ...\n";
					to_print = false;
				}
			}
			to_print = true;
			cout << "Free core + avaible task ...\n";
			thread t1 (eval, submit (row [0], row [1], row [2], row [3], row [4], row [5]), getFree ());
			t1.detach ();
			system ("sleep 0.5s");
		}
		if (to_print)
		{
			cout << "no submissions ...\n";
			to_print = false;
			system ("sleep 5s");
		}

		if(res != NULL)
			mysql_free_result (res);
	}

	mysql_close (con);
}
