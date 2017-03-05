#include <map>

map <string, function <string(string)> > langs = {
	{"cpp", 
		
		[](string path)
		{
			return "timeout 30s /usr/bin/g++ " + path + "source.cpp -o " + path + "source.exe -Wall -Wextra -std=c++1z -O2 -lm -static";
		}
	},
	{"c", 
	
		[](string path)
		{
			return "timeout 30s /usr/bin/gcc source.c -o source.exe -Wall -Wextra -std=c11 -O2 -lm -static";
		}
	},
	{"py", 
	
		[](string path)
		{
			return "";
		}
	},
};

map <string, function <string(string)> > langs_exec = {
	{"cpp", 
		
		[](string path)
		{
			return "./source.exe";
		}
	},
	{"c", 
	
		[](string path)
		{
			return "./source.exe";
		}
	},
	{"py", 
	
		[](string path)
		{
			return "python source.py";
		}
	},
};
