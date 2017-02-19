#include <C++/curl.hpp>
#include <C++/json.hpp>
#include <C++/fcgi/contest_api.hpp>
#include <C++/today.hpp>
#include <fstream>

#include <rapidjson/document.h>
#include <rapidjson/writer.h>
#include <rapidjson/stringbuffer.h>

using namespace rapidjson;
using namespace std;

void contest (Process& proc)
{
	cout << "<head><TITLE>Contest</TITLE>\n";
	fstream fin ("./help_files/removeParams.js");
	string b;
	getline (fin, b);
	cout << b << "\n</head>";
	std::string json = get_results::to_json (std::string("http://localhost:3000/quiz/results/") + proc.query_string ["id"]);

    Document d;
    d.Parse (json.c_str ());
	const rapidjson::Value& V = d;
	for (Value::ConstMemberIterator iter = V.MemberBegin () ; iter != V.MemberEnd (); ++ iter)
	{
		user_points [iter->name.GetString ()]["total"]["total"] -= user_points [iter->name.GetString ()][proc.query_string ["id"]]["total"];
		user_points [iter->name.GetString ()][proc.query_string ["id"]]["total"] = iter->value.GetInt ();
		user_points [iter->name.GetString ()][proc.query_string ["id"]]["total"] = iter->value.GetInt ();
		user_points [iter->name.GetString ()]["total"]["total"] += user_points [iter->name.GetString ()][proc.query_string ["id"]]["total"];
		cout << iter->name.GetString() << "\t" << iter->value.GetInt() << "<br>\n";
		user_certs [iter->name.GetString ()]
			       [contest_mapping [proc.query_string ["id"]].first] = 
		certify (
					today (),
					contest_mapping [proc.query_string ["id"]].first,
					user_points [iter->name.GetString ()][proc.query_string ["id"]]["total"] / 
					contest_mapping [proc.query_string ["id"]].second * 100,
					users [iter->name.GetString ()],
					cert_number ++	
				);
//		cout << "New cert: " << 
//								user_certs [iter->name.GetString ()]
//										   [contest_mapping [proc.query_string ["id"]]].get (); 
	}
	cout << R"(
<script>
	window.history.back ();
</script>)";
}
