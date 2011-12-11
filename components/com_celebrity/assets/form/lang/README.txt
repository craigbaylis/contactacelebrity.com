The new Locale setup requires .json (JavaScript Object Notation) files.

The current syntax is:
{ //must be at the start of the file
	"cascade" : "en-US" //tells the loader to load en-US.json with this file
	"definitions" : {	//The definitions to load
		"key1" : "value1",		//eg: "required" : "This field is required.",
		"key2" : "value2"
	}
} //must be at end of file with out a ;

eg: en-TT.json
{
	"cascade" : "en-US",
	"definitions" : {
		"required" : "This field is required.",
		"digit" : "Please enter a valid integer."
	}
}

/****************************************************************************/
Meanings and Uses:

Cascade: Allows for multiple language files to be loaded in succession, like walking down a set of stairs.
The order of loading starts at the first file loaded, to the internal alerts found in FormCheck.js
Where each file fills in the missing keys from the previous one loaded.
So if en-TT cascades to en-US which cascades to en-EN
The results would be en-TT overwrites en-US definitions, which overwrites en-EN definitions.
EG:
en-TT.json = "cascade" : "en-US", "definitions" : { "required" : "1", "digit" : "2" }
en-US.json = "cascade": "en-EN", "definitions" : { "required" : "3", "alpha" : "4" }
en-EN.json = "definitions" : { "required" : "5", "digit" : "6", "alpha" : "7", "checkbox" : "8" }

The result would be
"required" : "1",	//en-TT
"digit": "2",		//en-TT
"alpha": "4",		//en-US
"checkbox" : "8"	//en-EN

The new system allows for an developer to utilize PHP files to define locale definitions from a database
utilizing the php json_encode(array)
See: http://php.net/manual/en/function.json-encode.php for details.