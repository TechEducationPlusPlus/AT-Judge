#include <fcgio.h>
#include <fcgi_config.h>
#include <iostream>
#include <fstream>
#include <sstream>
#include <stdlib.h>

using namespace std;

#include <C++/fcgi/params.hpp>
#include <C++/fcgi/base.hpp>

void Throw (string a)
{
	cout << a << "\n";
}

Process proc;

#include "diff"
#include "trim"
#include "curlpp.cpp"

int main(void) {
	unsigned int count = 0;
    // Backup the stdio streambufs
    streambuf * cin_streambuf  = cin.rdbuf();
    streambuf * cout_streambuf = cout.rdbuf();
    streambuf * cerr_streambuf = cerr.rdbuf();

    FCGX_Request request;

    FCGX_Init();
    FCGX_InitRequest(&request, 0, 0);

    while (FCGX_Accept_r(&request) == 0) {
		count ++;
		int num = count;
        fcgi_streambuf cin_fcgi_streambuf(request.in);
        fcgi_streambuf cout_fcgi_streambuf(request.out);
        fcgi_streambuf cerr_fcgi_streambuf(request.err);

        cin.rdbuf(&cin_fcgi_streambuf);
        cout.rdbuf(&cout_fcgi_streambuf);
        cerr.rdbuf(&cerr_fcgi_streambuf);

        proc.set_args (request.envp);

       cout << "Content-type: text/plain\r\n"
             << "\r\n";
		if (proc.query_string ["type"] == "diff")
		{
			string out1 = GET (proc.query_string ["link"] + "/" + proc.query_string ["output1"]);
			string out2 = GET (proc.query_string ["link"] + "/" + proc.query_string ["output2"]);
			trim (out1); trim (out2);
			if (out1 == out2)
				cout << "[\"OK\",1]";
			else
				cout << "[\"WA\",0]";
			continue;
		}
    }

    // restore stdio streambufs
    cin.rdbuf(cin_streambuf);
    cout.rdbuf(cout_streambuf);
    cerr.rdbuf(cerr_streambuf);

    return 0;
}
