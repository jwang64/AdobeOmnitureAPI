# AdobeOmnitureAPI
Adobe Marketing Cloud Omniture API

How to use:

1. Obtain your username and your secret from Adobe Omniture
2. Substitute your username and secret for the values in GetAPIData and apiDataless section
3. Create a new file that will include the "path/to/MethodCaller.php"
4. Create a MethodCaller object, then you'll be able to call the different methods.

Creating a Report:

There are several examples that you can base creating a report on
Do note that the tests will not be able to function unless the report suite is correct.
The data you desire has to be in a certain format.
It generally follows:
"element":"evar49"

You will use the setReportID function with the data required in order to get Adobe to create the report.
To retrieve the report, you will need the ID from the setReportID method and input it into the getReportData method
The getReportData will return the data, but it's up to you on how you would like to see the data.

