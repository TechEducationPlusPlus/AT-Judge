#include <map>

map <string, function <string(string)> > langs = {
	{"cpp", 
		
		[](string path)
		{
			return "/usr/bin/g++ " + path + "source.cpp -o " + path + "source.exe -Wall -Wextra -std=c++1z -O2 -lm -static";
		}
	},
	{"c", 
	
		[](string path)
		{
			return "/usr/bin/gcc " + path + "source.c -o " + path + "source.exe -Wall -Wextra -std=c11 -O2 -lm -static";
		}
	},
	{"py", 
	
		[](string path)
		{
			return "echo \"#!/usr/bin/env python\" > new_source.py; cat " + path + "source.py >> new_source.py; mv new_source.py " + path + "source.exe; chmod +x " + path + "source.exe";
		}
	},
};
