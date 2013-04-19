QuickMail ReadMe

************************************************************

QuickMail is provided by McNally Smith College of Music 
under the Terms of the GNU Lesser General Public License. 
For full terms of the license please visit: 
http://www.gnu.org/copyleft/lesser.html 

No warranty expressed or implied.

Devloper: Brian Bierma
Contact: brian.bierma@mcnallysmith.edu

************************************************************

QuickMail Version 1.0

RELEASE NOTES

Initial Release

DESCRIPTION

QuickMail was designed to provide an easy mechanism for users of the CampusVue Faculty Portal to bulk email their students and certain classes. 
Please note that any communication sent via this tool is not recorded in CampusVue as a contact manager activity. 
This tool currently does not support attachments. This decision was made to prevent users from using email as a course management method.

QuickMail is a separate web application that requires its own website. This can be a site dedicated to QuickMail or a
subdirectory of an existing site.

INSTALLATION

Requirements:

PHP 5.3 or later
MS sqlsrv SQL Server Driver (Included with MS PHP)
IIS 7.5
Exchange or other SMTP server

1. Install IIS 7.5 from Server Manager
    a. Go to Roles --> Add Roles --> Web Server
    b. Default values are okay.
2. Install PHP using the Web Platform Installer: http://www.microsoft.com/web/downloads/platform.aspx
    a. Launch the Web Platform Installer, click the "Product" tab at the top
    b. Click the "Add" button for PHP 5.x form the list then click "Install" at the bottom
3. Open php.ini located in C:\Program Files (x86)\PHP\<version number>\php.ini
    a. Locate line 1056 [mail function]
    b. uncomment SMTP and smtp_port by removing the ";"
    c. Enter your mail server details here
    d. ex: SMTP = mymailserver.school.edu
           smtp_port = 25
4. Configure mail server for anonymous relay
    a. Be sure to secure your relay so that only QuickMail (ex: IP Address of web server running QuickMail) can use it.
5. If QuickMail will be a dedicated site:
    a. Extract QuickMail to C:\inetpub\wwwroot
    b. Create site in IIS and set root to above location ie., C:\inetpub\wwwroot\quickmail

CONFIGURATION

Configuration is done through config.php located in the QuickMail root folder. Below is a list of options and their
descriptions. Replace the variables with your school's values between the double quotes.

define('DOMAIN',"myschool.local");
Domain where faculty accounts are located (ie: myschool.local or myschool.edu) This uses an anonymous bind.

define('DB_SREVER',"mydbserver.myschool.local");
Name or ip of server hosting CampusVue database.

define('DB_CATALOG',"campusvue");
Name of CampusVue live database.

define('DB_USER',"mydbuser");
Local SQL user that has read access to DB. note: read access is all that is needed.

define('DB_PASS',"plaintextpassword");
SQL user's password. note: this password is stored in plain text.
It is best practice to set up a user in SQL that has read only access. 

define('REDIRECT',"");
Defines where users will be directed after a failed login, logout or have not yet logged in. Ex: if QuickMail is dedicated site like quickmail.myschool.edu,
it should look like define('REDIRECT',"/");  
However if QuickMail is a sub directory of an existing site, example: tools.myschool.edu/quickmail,
it should look like define('REDIRECT',"/quickmail");

define('DAYS_BEFORE',"5"); 
How many days before a term QuickMail is available. Instructor will be able to login but will not see classes unless within this value.

define('DAYS_AFTER',"10"); 
How many days after a term QuickMail is available. Instructor will be able to login but will not see classes unless within this value.

define('ENABLED',"true"); 
Enables or disables mail function for testing and troubleshooting. Values available are are true or false.

define('SUPPORT_EMAIL',"someone@myschool.edu"); 
Email address a user who supports QuickMail. Can be any email; can also be left blank.

Information should be put in between the double quotes of the config file.

ADDING TO PORTAL

To add QuickMail to portal create a menu item and select "No" for "Launch as Popup." Then under "External Links" add a new 
link and enter the url for QuickMail.
