#include <ctime>
#include <sstream>
#include <string>
#include <chrono>
#include <iomanip>

using namespace std;

string today ()
{
	auto now = chrono::system_clock::now ();
	auto in_time_t = chrono::system_clock::to_time_t (now);

	stringstream ss;
	ss << put_time (localtime (&in_time_t), "%Y/%m/%d");
	return ss.str ();
}
