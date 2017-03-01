//docker run --cidfile=cid -v /home/alex/CodeIT:/foo -w /foo -i --read-only -m 256M --network none pppepito86/judgebox /bin/bash -c ./collision.exe ; echo "y" | rm cid
static int* num;
struct box 
{
	static int getID ()
	{
		if (num == nullptr)
			num = new int (0);
		(*num) ++;
		return (*num) - 1;
	}
	
	int id;
	bool is_free;
	box ()
	{
		id = box::getID ();
		is_free = true;

		//{
		//	char buffer [1024];
		//	sprintf (buffer, "isolate --box-id %d --init", id);
		//	system (buffer);
		//}

		{
			char buffer [1024];
			sprintf (buffer, "mkdir %d", id);
			system (buffer);
		}
		{
			char* buffer = new char [1024];
			sprintf (buffer, "mkdir -p /var/local/lib/isolate/%d/box/", id);
			system (buffer);
		}	
	}
	~box ()
	{
		//{
		//	char buffer [1024];
		//	sprintf (buffer, "isolate --box-id %d --cleanup", id);
		//	system (buffer);
		//}
		delete &id;
		delete &is_free;
	}
	const char* getPath (const char * file = "") const
	{
		{
			char* buffer = new char [1024];
			sprintf (buffer, "/var/local/lib/isolate/%d/box/%s", id, file);
			return (buffer);
		}	
	}
	string doCommand (string cmd)
	{
		is_free = false;
		cmd = cmd + " 2> " + string (this->getPath ("/log"));
		system (cmd.c_str ());
		is_free = true;
		ifstream fin(string (string (this->getPath ("/log"))));
		return string ((std::istreambuf_iterator<char> (fin)), std::istreambuf_iterator<char> ());
	}
	string doIsolatedCommand (string cmd, string timelimit, string memorylimit, string in, string out)
	{
		is_free = false;
		stringstream ss;
		//ss << "isolate --box-id=" << this->id << " " << options << " --run -- " << cmd << " 2> " << string (this->getPath ("log"));
		ss << "docker run --cidfile=cid -v " << this->getPath() << ":/foo -w /foo -i --read-only -m " << memorylimit << " --network none alex/atjudgeimage /bin/bash -c \'cat " << in << " | timeout " << timelimit << " " << cmd << " > " << out << "\' ; echo \"$?\" > log ; echo \"y\" | rm cid";
		cout << ss.str () << " -> isolation command\n";
		cmd = ss.str ();
		system (cmd.c_str ());
		is_free = true;
		ifstream fin(string (string (this->getPath ("/log"))));
		return string ((std::istreambuf_iterator<char> (fin)), std::istreambuf_iterator<char> ());
	}
	bool free () const
	{
		return is_free;
	}
};

