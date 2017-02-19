#include <curlpp/cURLpp.hpp>
#include <curlpp/Options.hpp>
#include <sstream>
#include <string>

string GET (string link)
{
	std::ostringstream os;
	os << curlpp::options::Url (link);

	return os.str ();
}
