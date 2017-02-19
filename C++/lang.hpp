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
	{"cs", 
	
		[](string path)
		{
			return "/usr/bin/mcs " + path + "source.cs";
		}
	},
};
