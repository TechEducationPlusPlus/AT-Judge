void get_certs (Process& proc)
{
	ifstream fin ("./certs_templ.html");
	string output; getline (fin, output);
	string user = proc.query_string ["email"];
	output.replace (output.find("$USER$"), 6, user);
	string certs = "";
////for (auto& y : user_certs)
////{
////	cout << y.first << "\n";
////	for (auto& x : y.second)
////		cout << "boza: " << x.first << "\n";
////}

    for (auto& y : user_certs [user])
    {
//    	cout << y.first << "\n";
    	certs +=
    		"<a href='/.cgi?type=verify_cert&id=" + y.second.id + "'><h2>" + y.second.course + "</h2></a><br>";
    }
    output.replace (output.find("$CERTS$"), 7, certs);
    cout << output << "\n";
}
