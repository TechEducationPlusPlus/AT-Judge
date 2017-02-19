
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

		{
			char buffer [1024];
			sprintf (buffer, "isolate --box-id %d --init", id);
			system (buffer);
		}

		{
			char buffer [1024];
			sprintf (buffer, "mkdir %d", id);
			system (buffer);
		}
	}
	~box ()
	{
		{
			char buffer [1024];
			sprintf (buffer, "isolate --box-id %d --cleanup", id);
			system (buffer);
		}
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
	string doIsolatedCommand (string cmd, string options = "")
	{
		is_free = false;
		stringstream ss;
		ss << "isolate --box-id=" << this->id << " " << options << " --run -- " << cmd << " 2> " << string (this->getPath ("log"));
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

