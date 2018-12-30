<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

//=========== Custom ==============================
define('UPLOAD_DIR', "uploads/");

//=========== Database Table names ================
define('TB_ADMIN', 'admin');

//=========== Task Status =========================
define('ST_ALL',		-1);
define('ST_NEW', 		0);
define('ST_PENDING', 	1);
define('ST_APPROVED', 	2);
define('ST_PURCHASED', 	3);
define('ST_DELETED', 	4);

//=========== Roles ===============================
define('R_DEVELOPER', 1);
define('R_PURCHASE', 2);
define('R_INQUERY', 3);

//=========== custom ===============================
/*
define ('GENDER', serialize (array(
    "male",
    "female"
)));

$ages = array();
for ( $i = 18; $i < 100; $i ++ ) array_push($ages, $i);
define ('AGES', serialize ($ages));

define ('BMONTH', serialize (array(
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August" ,
    "September",
    "October",
    "November",
    "December"
)));

$byears = array();
for ( $i = 1950; $i < intval(date("Y")) + 1; $i ++ ) {
    array_push($byears, $i);
}
define ('BYEAR', serialize ($byears));

 define ('HAIR_COLOR', serialize (array(
     "Bald / Shaved",
     "Black",
     "Blonde",
     "Brown",
     "Grey / White",
     "Light Brown",
     "Red",
     "Changes frequently",
     "Other",
     "Prefer not to say"
 )));

define ('HAIR_LENGTH', serialize (array(
    "Bald",
    "Bald on Top",
    "Shaved",
    "Short",
    "Medium",
    "Long",
    "Other",
    "Prefer not to say"
)));

define ('HAIR_TYPE', serialize (array(
    "Straight",
    "Wavy",
    "Curly",
    "Other",
    "Prefer not to say"
)));

define ('EYE_COLOR', serialize (array(
    "Black",
    "Blue",
    "Brown",
    "Green",
    "Grey",
    "Hazel",
    "Other"
)));

define ('EYE_WEAR', serialize (array(
    "Contacts",
    "Glasses",
    "None",
    "Other",
    "Prefer not to say"
)));

define ('LAST_ACTIVITY', serialize (array(
    "within week",
    "within 1 month",
    "within 3 month",
    "within 6 month",
    "within year"
)));

define ('SORT_BY', serialize (array(
    "Newest member",
    "Photos firsth",
    "Last active",
)));

define ('HEIGHT', serialize (array(
    "4'7\"",
    "4'8\"",
    "4'9\"",
    "4'10\"",
    "4'11\"",
    "5'",
    "5'1\"",
    "5'2\"",
    "5'3\"",
    "5'4\"",
    "5'5\"",
    "5'6\"",
    "5'7\"",
    "5'8\"",
    "5'9\"",
    "5'10\"",
    "5'11\"",
    "6'",
    "6'1\"",
    "6'2\"",
    "6'3\"",
    "6'4\"",
    "6'5\"",
    "6'6\"",
    "6'7\"",
    "6'8\"",
    "6'9",
    "6'10\"",
    "6'11\"",
    "7'",
    "7'1\"",
    "7'2\""
)));

define ('WEIGHT', serialize (array(
    "88 lb",
    "90 lb",
    "93 lb",
    "95 lb",
    "97 lb",
    "99 lb",
    "101 lb",
    "104 lb",
    "106 lb",
    "108 lb",
    "110 lb",
    "112 lb",
    "115 lb",
    "117 lb",
    "119 lb",
    "121 lb",
    "123 lb",
    "126 lb",
    "128 lb",
    "130 lb",
    "132 lb",
    "134 lb",
    "137 lb",
    "139 lb",
    "141 lb",
    "143 lb",
    "146 lb",
    "148 lb",
    "150 lb",
    "152 lb",
    "154 lb",
    "157 lb",
    "159 lb",
    "161 lb",
    "163 lb",
    "165 lb",
    "168 lb",
    "170 lb",
    "172 lb",
    "174 lb",
    "176 lb",
    "179 lb",
    "181 lb",
    "183 lb",
    "185 lb",
    "187 lb",
    "190 lb",
    "192 lb",
    "194 lb",
    "196 lb",
    "198 lb",
    "201 lb",
    "203 lb",
    "205 lb",
    "207 lb",
    "209 lb",
    "212 lb",
    "214 lb",
    "216 lb",
    "218 lb",
    "220 lb",
    "223 lb",
    "225 lb",
    "227 lb",
    "229 lb",
    "231 lb",
    "234 lb",
    "236 lb",
    "238 lb",
    "240 lb",
    "243 lb",
    "245 lb",
    "247 lb",
    "249 lb",
    "251 lb",
    "254 lb",
    "256 lb",
    "258 lb",
    "260 lb",
    "262 lb",
    "265 lb",
    "267 lb",
    "269 lb",
    "271 lb",
    "273 lb",
    "276 lb",
    "278 lb",
    "280 lb",
    "282 lb",
    "284 lb",
    "287 lb",
    "289 lb",
    "291 lb",
    "293 lb",
    "295 lb",
    "298 lb",
    "300 lb",
    "302 lb",
    "304 lb",
    "306 lb",
    "309 lb",
    "311 lb",
    "313 lb",
    "315 lb",
    "317 lb",
    "320 lb",
    "322 lb",
    "324 lb",
    "326 lb",
    "328 lb",
    "331 lb",
    "333 lb",
    "335 lb",
    "337 lb",
    "340 lb",
    "342 lb",
    "344 lb",
    "346 lb",
    "348 lb",
    "351 lb",
    "353 lb",
    "355 lb",
    "357 lb",
    "359 lb",
    "362 lb",
    "364 lb",
    "366 lb",
    "368 lb",
    "370 lb",
    "373 lb",
    "375 lb",
    "377 lb",
    "379 lb",
    "381 lb",
    "384 lb",
    "386 lb",
    "388 lb",
    "390 lb",
    "392 lb",
    "395 lb",
    "397 lb",
    "399 lb",
    "401 lb",
    "403 lb",
    "406 lb",
    "408 lb",
    "410 lb",
    "412 lb",
    "414 lb",
    "417 lb",
    "419 lb",
    "421 lb",
    "423 lb",
    "425 lb",
    "428 lb",
    "430 lb",
    "432 lb",
    "434 lb",
    "437 lb",
    "439 lb",
    "441 lb",
    "443 lb",
    "445 lb",
    "448 lb",
    "450 lb",
    "452 lb",
    "454 lb",
    "456 lb",
    "459 lb",
    "461 lb",
    "463 lb",
    "465 lb",
    "467 lb",
    "470 lb",
    "472 lb",
    "474 lb",
    "476 lb",
    "478 lb",
    "481 lb",
    "483 lb",
    "485 lb"
)));

define ('BODY_TYPE', serialize (array(
    "Petite",
    "Slim",
    "Athletic",
    "Average",
    "Few Extra Pounds",
    "Full Figured",
    "Large and Lovely"
)));

define ('EITHNICITY', serialize (array(
    "Arab (Middle Eastern)",
    "Asian",
    "Black",
    "Caucasian (White)",
    "Hispanic / Latino",
    "Indian",
    "Mixed",
    "Pacific Islander",
    "Other"
)));


define ('COMPLEXION', serialize (array(
    "Very Fair",
    "Fair",
    "Wheatish",
    "Wheatish Brown",
    "Dark",
    "Prefer not to say"
)));

define ('FACIAL_HAIR', serialize (array(
    "Clean Shaven",
    "Sideburns",
    "Mustache",
    "Goatee",
    "Short Beard",
    "Medium Beard",
    "Long Beard",
    "Other"
)));

define ('APPEARANCE', serialize (array(
    "Below average",
    "Average",
    "Attractive",
    "Very attractive"
)));

define ('HEALTH_STATE', serialize (array(
    "Normal",
    "Minor Health Issues",
    "Serious Health Issues",
    "Minor Physical Disability",
    "Major Physical Disability",
    "Prefer not to say"
)));

define ('DRINK', serialize (array(
    "Don't drink",
    "Occasionally drink",
    "Do drink",
    "Prefer not to say"
)));

define ('SMOKE', serialize (array(
    "Do smoke",
    "Don't smoke",
    "Occasionally smoke"
)));

define ('EATING_HABITS', serialize (array(
    "Halal foods always",
    "Halal foods when I can",
    "No special restrictions"
)));

define ('MARITAL_STATUS', serialize (array(
    "Single",
    "Separated",
    "Widowed",
    "Divorced",
    "Other"
)));

define ('HAVE_CHILDREN', serialize (array(
    "No",
    "Yes - don't live at home",
    "Yes - sometimes live at home",
    "Yes - live at home"
)));

define ('CHILDREN_NUMBER', serialize (array(
    "0",
    "1",
    "2",
    "3",
    "4",
    "5",
    "6",
    "7",
    "8",
    "More than 8"
)));

define ('OLDEST_CHILD', serialize (array(
    "0",
    "1",
    "2",
    "3",
    "4",
    "5",
    "6",
    "7",
    "8",
    "9",
    "10",
    "11",
    "12",
    "13",
    "14",
    "15",
    "16",
    "17",
    "18",
    "Older than 18"
)));

define ('YOUNGEST_CHILD', serialize (array(
    "0",
    "1",
    "2",
    "3",
    "4",
    "5",
    "6",
    "7",
    "8",
    "9",
    "10",
    "11",
    "12",
    "13",
    "14",
    "15",
    "16",
    "17",
    "18",
    "Older than 18"
)));

define ('MORE_CHILDREN', serialize (array(
    "YES",
    "NOT SURE",
    "NO"
)));

define ('OCCUPATION', serialize (array(
    "Administrative / Secretarial / Clerical",
    "Advertising / Media",
    "Artistic / Creative / Performance",
    "Construction / Trades",
    "Domestic Helper",
    "Education / Academic",
    "Entertainment / Media",
    "Executive / Management / HR",
    "Farming / Agriculture",
    "Finance / Banking / Real Estate",
    "Fire / law enforcement / security",
    "Hair Dresser / Personal Grooming",
    "IT / Communications",
    "Laborer / Manufacturing",
    "Legal",
    "Medical / Dental / Veterinary",
    "Military",
    "Nanny / Child care",
    "No occupation / Stay at home",
    "Non-profit / clergy / social services",
    "Political / Govt / Civil Service",
    "Retail / Food services",
    "Retired",
    "Sales / Marketing",
    "Self Employed",
    "Sports / recreation",
    "Student",
    "Technical / Science / Engineering",
    "Transportation",
    "Travel / Hospitality",
    "Unemployed",
    "Other"
)));

define ('EMPLOYMENT_STATUS', serialize (array(
    "Student",
    "Part Time",
    "Full Time",
    "Homemaker",
    "Retired",
    "Not Employed",
    "Other",
    "Prefer not to say"
)));

define ('ANNUAL_INCOME', serialize (array(
    "$0 - $30,000 (USD)",
    "$30,001 - $60,000 (USD)",
    "$60,001 - $120,000 (USD)",
    "$120,001 - $180,000 (USD)",
    "$180,001 - $240,000 (USD)",
    "$240,001 - $600,000+ (USD)",
    "Prefer not to say"
)));

define ('HOME_TYPE', serialize (array(
    "Apartment / Flat",
    "Condominium",
    "Farm",
    "House",
    "Town house",
    "Other",
    "Prefer not to say"
)));

define ('LIVING_SITUATION', serialize (array(
    "Live Alone",
    "Live with friends",
    "Live with family",
    "Live with kids",
    "Live with spouse",
    "Other",
    "Prefer not to say"
)));

define ('RESIDENCY_STATUS', serialize (array(
    "Citizen",
    "Permanent Resident",
    "Work Permit",
    "Student Visa",
    "Temporary Visa",
    "Other"
)));

define ('WILLING', serialize (array(
    "Willing to relocate within my country",
    "Willing to relocate to another country",
    "Not willing to relocate",
    "Not sure about relocating"
)));

define ('LOOKING_RELATIONSHIP', serialize (array(
    "Marriage",
    "Friendship"
)));

define ('EDUCATION', serialize (array(
    "Primary (Elementary) School",
    "Middle School / Junior High",
    "High School",
    "Vocational College",
    "Bachelors Degree",
    "Masters Degree",
    "PhD or Doctorate"
)));

define ('LANGUAGES_SPOKEN', serialize (array(
    "Afrikaans",
    "Albanian",
    "Amharic",
    "Armenian",
    "Assyrian",
    "Azerbaijani",
    "Bahasa Malay / Indonesian",
    "Belorussian",
    "Bengali",
    "Berber",
    "Bulgarian",
    "Burmese",
    "Cebuano",
    "Chinese (Cantonese)",
    "Chinese (Mandarin)",
    "Creole",
    "Croatian",
    "Czech",
    "Danish",
    "Dutch",
    "Eritrean",
    "Estonian",
    "Farsi",
    "Finnish",
    "Georgian",
    "Greek",
    "Gujarati",
    "Hausa",
    "Hebrew",
    "Hindi",
    "Hungarian",
    "Icelandic",
    "Iilocano",
    "Indonesian",
    "Inuktitut",
    "Italian",
    "Japanese",
    "Kannada",
    "Kazakh",
    "Khmer",
    "Kirgiz",
    "Korean",
    "Kurdish",
    "Kutchi",
    "Kyrgiz",
    "Laotian",
    "Latvian",
    "Lithuanian",
    "Macedonian",
    "Malagasy",
    "Malayalam",
    "Maldivian",
    "Maltese",
    "Marathi",
    "Mongolian",
    "Nepali",
    "Norwegian",
    "Pashto",
    "Persian",
    "Polish",
    "Portuguese",
    "Quechua",
    "Romanian",
    "Russian",
    "Serbian",
    "Sindhi",
    "Sinhala",
    "Slovak",
    "Slovene",
    "Somali",
    "Swahili",
    "Swedish",
    "Tagalog",
    "Tamil",
    "Telugu",
    "Thai",
    "Tibetan",
    "Tongan",
    "Turkish",
    "Turkmen",
    "Ugaritic",
    "Ukrainian",
    "Uzbek",
    "Vietnamese",
    "Welsh",
    "Other"
)));

define ('RELIGION', serialize (array(
    "Islam - Sunni",
    "Islam - Shiite",
    "Islam - Sufism",
    "Islam - Ahmadiyya",
    "Islam - Other",
    "Willing to revert",
    "Other"
)));

define ('BORN_REVERTED', serialize (array(
    "Born a muslim",
    "Reverted to Islam",
    "Plan to revert to Islam"
)));

define ('RELIGION_VALUE', serialize (array(
    "Very Religious",
    "Religious",
    "Not Religious"
)));

define ('RELIGION_SERVICE', serialize (array(
    "Daily",
    "Only on Jummah / Fridays",
    "Only During Ramadan",
    "Never"
)));

define ('READ_QURAN', serialize (array(
    "Daily",
    "Ocassionally",
    "Only During Ramadan",
    "Only on Jummah / Fridays",
    "Read translated version",
    "Never Read",
    "Prefer not to say"
)));

define ('POLYGAMY', serialize (array(
    "Accept polygamy",
    "Maybe accept polygamy",
    "Don't accept polygamy"
)));

define ('FAMILY_VALUE', serialize (array(
    "Conservative",
    "Moderate",
    "Liberal",
    "Prefer not to say"
)));

define ('PROFILE_CREATOR', serialize (array(
    "Self",
    "Parent",
    "Friend",
    "Brother / Sister",
    "Relative"
)));

define ('FUN_ENTERTAINMENT', serialize (array(
    "Antiques",
    "Astrology",
    "Bars / Pubs / Nightclubs",
    "Board / Card Games",
    "Cars / Mechanics",
    "Collecting",
    "Computers / Internet",
    "Cooking / Food",
    "Dancing",
    "Dinner Parties",
    "Family",
    "Gardening / Landscaping",
    "Investing / Finance",
    "Library",
    "Motorcycles",
    "Museums / Galleries",
    "Music (Playing)",
    "Pets",
    "Photography",
    "Reading",
    "Shopping",
    "TV: Educational / News",
    "Theatre",
    "Video / Online Games",
    "Watching Sports",
    "Other",
    "Art / Painting",
    "Ballet",
    "Beach / Parks",
    "Camping / Nature",
    "Casino / Gambling",
    "Comedy Clubs",
    "Concerts / Live Music",
    "Crafts",
    "Dining Out",
    "Education",
    "Fashion Events",
    "Home Improvement",
    "Karaoke / Sing-along",
    "Meditation",
    "Movies / Cinema",
    "Music (Listening)",
    "News / Politics",
    "Philosophy / Spirituality",
    "Poetry",
    "Science and Technology",
    "Social Causes / Activism",
    "TV: Entertainment",
    "Traveling",
    "Volunteering",
    "Writing"
)));

define ('LIKE_FOOD', serialize (array(
    "American",
    "Cajun / Southern",
    "Caribbean/Cuban",
    "Continental",
    "Eastern European",
    "French",
    "Greek",
    "Italian",
    "Jewish / Kosher",
    "Mediterranean",
    "Middle Eastern",
    "Soul Food",
    "Southwestern",
    "Vegan",
    "Vietnamese",
    "Barbecue",
    "California-Fusion",
    "Chinese / Dim Sum",
    "Deli",
    "Fast Food / Pizza",
    "German",
    "Indian",
    "Japanese / Sushi",
    "Korean",
    "Mexican",
    "Seafood",
    "South American",
    "Thai",
    "Vegetarian / Organic",
    "Other"
)));

define ('LIKE_MUSIC', serialize (array(
    "Alternative",
    "Country / Folk",
    "Jazz / Blues",
    "New Age",
    "R'n'B / Hip Hop",
    "Reggae",
    "Rock",
    "World",
    "Classical / Opera",
    "Dance / Techno",
    "Metal",
    "Pop",
    "Rap",
    "Religious",
    "Soft Rock",
    "Other"
)));

define ('LIKE_SPORT', serialize (array(
    "Aerobics",
    "Archery",
    "Aussie Rules Football",
    "BMX / Mountain Biking",
    "Basketball",
    "Boating / Sailing",
    "Bowling",
    "Canoe / Kayak",
    "Cricket",
    "Darts",
    "Extreme Sports",
    "Fishing",
    "Gym / Weight Training",
    "Hang Gliding / Paragliding",
    "Hockey",
    "Hunting / Shooting",
    "In-line Skating",
    "Jogging / Running",
    "Martial Arts",
    "Mountain / Rock Climbing",
    "Parachuting / BASE Jumping",
    "Pool / Billards",
    "Rugby",
    "Skateboarding",
    "Snowmobiling",
    "Squash / Racquetball",
    "Swimming",
    "Tennis / Badminton",
    "Walking",
    "Wrestling",
    "Other",
    "American Football",
    "Athletics",
    "Auto Racing",
    "Baseball / Softball",
    "Biking",
    "Bodybuilding",
    "Boxing",
    "Canyoning / Caving",
    "Cycling",
    "Diving",
    "Figure Skating",
    "Golf",
    "Gymnastics",
    "Hiking",
    "Horse Riding",
    "Ice Skating / Ice Hockey",
    "Jet / Water Skiing",
    "Lacrosse",
    "Motor Sports",
    "Netball",
    "Polo",
    "Rowing",
    "Scuba Diving / Snorkeling",
    "Skiing / Snowboarding",
    "Soccer",
    "Surfing",
    "Table Tennis",
    "Volleyball",
    "Windsurfing / Kite Boarding",
    "Yoga / Pilates"
)));

define ('CRIMINAL', serialize (array(
    "Homicide",
    "Murder",
    "Abusive Sexual Contact",
    "Manslaughter",
    "Battery",
    "Unlawful Criminal Restraint",
    "Rape",
    "Assault",
    "Domestic Violence",
    "Peonage",
    "Incest",
    "Child Abuse or Neglect",
    "Torture",
    "Trafficking",
    "Sexual Exploitation",
    "Abduction",
    "False Imprisonment",
    "Holding Hostage",
    "Stalking",
    "Kidnapping",
    "Sexual Assault",
    "Slave Trade",
    "Involuntary Servitude"
)));

define ('ADD_AGE', serialize (array(
    "17",
    "16",
    "15",
    "14",
    "13",
    "12",
    "11",
    "9",
    "8",
    "7",
    "6",
    "5",
    "4",
    "3",
    "2",
    "1",
    "<1"
)));

define ('IS_CONVITED', serialize (array(
    "solely, principally, or incidentally engaging in prostitution",
    "a direct or indirect attempt to procure prostitutes or persons for the purpose of prostitution",
    "receiving, in whole or in part, of the proceeds of prostitution"
)));

define ('LANG_ENG', serialize (array(
    "home" => "home",
    "online members" => "online members",
    "matches" => "matches",
    "Search" => "Search",
    "messages" => "messages",
    "activity" => "activity",
    "muslim women" => "muslim women",
    "muslim men" => "muslim men",
    "login" => "login",
    "join free" => "join free",
    "Activity Towards Me" => "Activity Towards Me",
    "Interested In Me" => "Interested In Me",
    "I am Their Favorite" => "I'm Their Favorite",
    "Viewed My Profile" => "Viewed My Profile",
    "My Interests" => "My Interests",
    "My Favorites" => "My Favorites",
    "Profiles I Viewed" => "Profiles I Viewed",
    "Block List" => "Block List",
    "Edit Profile" => "Edit Profile",
    "Profile" => "Profile",
    "Photos" => "Photos",
    "Matches" => "Matches",
    "Hobbies Interests" => "Hobbies & Interests",
    "Personality Questions" => "Personality Questions",
    "Verify Questions" => "Verify Questions",
    "CupidTags" => "CupidTags",
    "IMBRA" => "IMBRA",
    "Account Settings" => "Account Settings",
    "Email Address" => "Email Address",
    "Password" => "Password",
    "Billing" => "Billing",
    "Notifications" => "Notifications",
    "Help" => "Help",
    "Logout" => "Logout",
    "Upload a photo to your profile" => "Upload a photo to your profile",
    "Recent Activity" => "Recent Activity",
    "new messages" => "new messages",
    "new interests" => "new interests",
    "new profile views" => "new profile views",
    "new favorites" => "new favorites",
    "Advanced Search" => "Advanced Search",
    "Seeking" => "Seeking",
    "Age" => "Age",
    "Country" => "Country",
    "State" => "State",
    "Photo" => "Photo",
    "Last Active" => "Last Active",
    "Popular Searches" => "Popular Searches",
    "Yes, profile with a photo" => "Yes, profile with a photo",
    "all users" => "all users",
    "current page" => "current page",
    "My Matches" => "My Matches",
    "Most Popular" => "Most Popular",
    "Latest Photos" => "Latest Photos",
    "In My Area" => "In My Area",
    "New Members" => "New Members",
    "Muslim Women For Marriage Photo Gallery" => "Muslim Women For Marriage Photo Gallery",
    "Improve Matches" => "Improve Matches",
    "See all matches" => "See all matches",
    "Clike here to view user profile" => "Clike here to view user profile",
    "Send a message to" => "Send a message to",
    "Show interest in" => "Show interest in",
    "Add" => "Add",
    "to your favorite" => "to your favorite",
    "Cllick to chat with" => "Cllick to chat with",
    "Members online" => "Members online",
    "current online users" => "current online users",
    "Seeking a" => "Seeking a",
    "From" => "From",
    "Photo" => "Photo",
    "Any" => "Any",
    "There is not any users that matched the search" => "There is not any users that matched the search",
    "all matched users" => "all matched users",
    "Last Login" => "Last Login",
    "Address" => "Address",
    "Saved Search" => "Saved Search",
    "I am seeking a" => "I am seeking a",
    "Age between" => "Age between",
    "Living in" => "Living in",
    "Has photo" => "Has photo?",
    "Their Appearance" => "Their Appearance",
    "Hair color" => "Hair color",
    "Hair length" => "Hair length",
    "Hair type" => "Hair type",
    "Eye color" => "Eye color",
    "Eye wear" => "Eye wear",
    "Height" => "Height",
    "Weight" => "Weight",
    "Body type" => "Body type",
    "Their ethnicity is mostly" => "Their ethnicity is mostly",
    "Complexion" => "Complexion",
    "Consider their appearance as" => "Consider their appearance as",
    "Physical / Health status" => "Physical / Health status",
    "Do they drink" => "Do they drink",
    "Do they smoke" => "Do they smoke",
    "Eating Habits" => "Eating Habits",
    "Marital Status" => "Marital Status",
    "Do they have children" => "Do they have children",
    "Number of children (or below)" => "Number of children (or below)",
    "Youngest child (or above)" => "Youngest child (or above)",
    "Oldest child (or below)" => "Oldest child (or below)",
    "Do they want (more) children" => "Do they want (more) children",
    "Occupation" => "Occupation",
    "Employment status" => "Employment status",
    "Annual Income (or above)" => "Annual Income (or above)",
    "Home type" => "Home type",
    "Living situation" => "Living situation",
    "Residency status" => "Residency status",
    "Willing to relocate" => "Willing to relocate",
    "Nationality" => "Nationality",
    "Education (or above)" => "Education (or above)",
    "Languages spoken" => "Languages spoken",
    "Religion" => "Religion",
    "Born / Reverted" => "Born / Reverted",
    "Religious values" => "Religious values",
    "Attend religious services" => "Attend religious services",
    "Read Qur'an" => "Read Qur'an",
    "Polygamy" => "Polygamy",
    "Family values" => "Family values",
    "Profile creator" => "Profile creator",
    "Create new saved search" => "Create new saved search",
    "search users" => "search users",
    "rename saved search name" => "rename saved search name",
    "edit saved search" => "edit saved search",
    "remove current saved search" => "remove current saved search",
    "Inbox" => "Inbox",
    "Favorites" => "Favorites",
    "My Friends" => "My Friends",
    "New Folder" => "New Folder",
    "Sent" => "Sent",
    "Trush" => "Trush",
    "Create Filter" => "Create Filter",
    "Received" => "Received",
    "Copy checked to" => "Copy checked to",
    "Favorites" => "Favorites",
    "My Friend" => "My Friend",
    "Create new folder" => "Create new folder",
    "Please accept my contact" => "Please accept my contact",
    "delete checked" => "delete checked",
    "Male" => "Male",
    "Female" => "Female",
    "Today" => "Today",
    "days ago" => "days ago",
    "Basic" => "Basic",
    "submit" => "submit",
    "Their Lifestyle" => "Their Lifestyle",
    "Their Background / Cultural Values" => "Their Background / Cultural Values",
    "Save search as" => "Save search as",
    "Yes, only show profiles with a photo" => "Yes, only show profiles with a photo",
    "Saved Searches" => "Saved Searches",
    "You have" => "You have",
    "saved searches" => "saved searches",
    "Copyright" => "Copyright",
    "All rights reserved" => "All rights reserved",
    "" => ""
)));

define ('LANG_ARB', serialize (array(
    "home" => "الصفحة الرئيسية",
    "online members" => "أعضاء الإنترنت",
    "matches" => "اعواد الكبريت",
    "Search" => "بحث",
    "messages" => "رسائل",
    "activity" => "نشاط",
    "muslim women" => "امرأه مسلمه",
    "muslim men" => "رجل مسلم",
    "login" => "تسجيل الدخول",
    "join free" => "انضم مجانا",
    "Activity Towards Me" => "نشاط نحو عني",
    "Interested In Me" => "مهتم بي",
    "I am Their Favorite" => "أنا المفضلة",
    "Viewed My Profile" => "تمت مشاهدة ملفي الشخصي",
    "My Interests" => "اهتماماتي",
    "My Favorites" => "مفضلتي",
    "Profiles I Viewed" => "الملفات الشخصية التي تمت مشاهدتها",
    "Block List" => "قائمة الحظر",
    "Edit Profile" => "تعديل الملف الشخصي",
    "Profile" => "الملف الشخصي",
    "Photos" => "الصور",
    "Matches" => "اعواد الكبريت",
    "Hobbies Interests" => "الهوايات والاهتمامات",
    "Personality Questions" => "أسئلة الشخصية",
    "Verify Questions" => "تحقق من الأسئلة",
    "CupidTags" => "الكلمات",
    "IMBRA" => "IMBRA",
    "Account Settings" => "إعدادت الحساب",
    "Email Address" => "عنوان البريد الإلكتروني",
    "Password" => "كلمه السر",
    "Billing" => "الفواتير",
    "Notifications" => "إخطارات",
    "Help" => "مساعدة",
    "Logout" => "الخروج",
    "Upload a photo to your profile" => "حمل صورة إلى ملفك الشخصي",
    "Recent Activity" => "آخر نشاط",
    "new messages" => "رسائل جديدة",
    "new interests" => "مصالح جديدة",
    "new profile views" => "وجهات النظر الجديدة",
    "new favorites" => "المفضلة الجديدة",
    "Advanced Search" => "البحث المتقدم",
    "Seeking" => "بحث",
    "Age" => "عمر",
    "Country" => "بلد",
    "State" => "حالة",
    "Photo" => "صورة فوتوغرافية",
    "Last Active" => "آخر نشاط",
    "Popular Searches" => "عمليات البحث الشائعة",
    "Yes, profile with a photo" => "نعم، الملف الشخصي مع صورة",
    "all users" => "جميع المستخدمين",
    "current page" => "الصفحه الحاليه",
    "My Matches" => "مبارياتي",
    "Most Popular" => "الأكثر شعبية",
    "Latest Photos" => "أحدث الصور",
    "In My Area" => "في منطقتي",
    "New Members" => "أعضاء جدد",
    "Muslim Women For Marriage Photo Gallery" => "المرأة المسلمة للزواج معرض الصور",
    "Improve Matches" => "تحسين المباريات",
    "See all matches" => "الاطلاع على جميع المباريات",
    "Clike here to view user profile" => "انقر هنا لعرض ملف تعريف المستخدم",
    "Send a message to" => "إرسال رسالة إلى",
    "Show interest in" => "إظهار الاهتمام ب",
    "Add" => "إضافة",
    "to your favorite" => "إلى المفضلة لديك",
    "Cllick to chat with" => "انقر للدردشة مع",
    "Members online" => "الأعضاء على الإنترنت",
    "current online users" => "المستخدمين الحاليين على الإنترنت",
    "Seeking a" => "أبحث عن",
    "From" => "من عند",
    "Photo" => "صورة فوتوغرافية",
    "Any" => "أي",
    "There is not any users that matched the search" => "ليس هناك أي مستخدمين يطابقون البحث",
    "all matched users" => "جميع المستخدمين المتطابقة",
    "Last Login" => "آخر تسجيل دخول",
    "Address" => "عنوان",
    "Saved Search" => "البحث المحفوظ",
    "I am seeking a" => "انا اسعى الى",
    "Age between" => "الذين تتراوح أعمارهم بين",
    "Living in" => "يعيش في",
    "Has photo" => "لديه صورة",
    "Their Appearance" => "مظهرهم",
    "Hair color" => "لون الشعر",
    "Hair length" => "طول الشعر",
    "Hair type" => "نوع الشعر",
    "Eye color" => "لون العين",
    "Eye wear" => "ارتداء العين",
    "Height" => "ارتفاع",
    "Weight" => "وزن",
    "Body type" => "نوع الجسم",
    "Their ethnicity is mostly" => "إن أصلهم العرقي هو في الغالب",
    "Complexion" => "بشرة",
    "Consider their appearance as" => "النظر في مظهرها كما",
    "Physical / Health status" => "الحالة المادية / الصحية",
    "Do they drink" => "هل يشربون",
    "Do they smoke" => "هل يدخنون",
    "Eating Habits" => "عادات الاكل",
    "Marital Status" => "الحالة الحالة الإجتماعية",
    "Do they have children" => "هل لديهم أطفال",
    "Number of children (or below)" => "عدد الأطفال (أو أقل)",
    "Youngest child (or above)" => "أصغر طفل (أو أعلى)",
    "Oldest child (or below)" => "أقدم طفل (أو أقل)",
    "Do they want (more) children" => "هل يريدون (المزيد) الأطفال",
    "Occupation" => "الاحتلال",
    "Employment status" => "الحالة الوظيفية",
    "Annual Income (or above)" => "الدخل السنوي (أو أعلى)",
    "Home type" => "نوع المنزل",
    "Living situation" => "الوضع المعيشي",
    "Residency status" => "الإقامة",
    "Willing to relocate" => "على استعداد للانتقال",
    "Nationality" => "جنسية",
    "Education (or above)" => "التعليم (أو أعلى)",
    "Languages spoken" => "اللغات التي تتكلمها",
    "Religion" => "دين",
    "Born / Reverted" => "مولود / عاد",
    "Religious values" => "القيم الدينية",
    "Attend religious services" => "حضور الخدمات الدينية",
    "Read Qur'an" => "اقرأ القرآن",
    "Polygamy" => "تعدد الزوجات",
    "Family values" => "قيم العائلة",
    "Profile creator" => "الملف الشخصي الخالق",
    "Create new saved search" => "إنشاء بحث جديد محفوظ",
    "search users" => "البحث عن المستخدمين",
    "rename saved search name" => "إعادة تسمية اسم البحث المحفوظ",
    "edit saved search" => "تعديل البحث المحفوظ",
    "remove current saved search" => "إزالة البحث المحفوظ الحالي",
    "Inbox" => "صندوق الوارد",
    "Favorites" => "المفضلة",
    "My Friends" => "أصدقائى",
    "New Folder" => "ملف جديد",
    "Sent" => "أرسلت",
    "Trush" => "التعفن",
    "Create Filter" => "إنشاء فلتر",
    "Received" => "تم الاستلام",
    "Copy checked to" => "تم التحقق من النسخ",
    "Favorites" => "المفضلة",
    "My Friend" => "صديقى",
    "Create new folder" => "إنشاء مجلد جديد",
    "Please accept my contact" => "يرجى قبول الاتصال",
    "delete checked" => "حذف حذف",
    "Male" => "الذكر",
    "Female" => "إناثا",
    "Today" => "اليوم",
    "days ago" => "أيام مضت",
    "Basic" => "الأساسية",
    "submit" => "خضع",
    "Their Lifestyle" => "نمط حياتهم",
    "Their Background / Cultural Values" => "الخلفية / القيم الثقافية",
    "Save search as" => "حفظ البحث باسم",
    "Yes, only show profiles with a photo" => "نعم، عرض الملفات الشخصية فقط مع صورة",
    "Saved Searches" => "الابحاث المحفوظة",
    "You have" => "عندك",
    "saved searches" => "الابحاث المحفوظة",
    "Copyright" => "حقوق النشر",
    "All rights reserved" => "كل الحقوق محفوظة",
    "" => ""
)));
*/

