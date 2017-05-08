## Today I learn, updated 8 MAY 2017

From the following sources: 

https://ctrlq.org/code/20005-publish-json-google-spreadsheets



http://blog.pamelafox.org/2013/06/exporting-google-spreadsheet-as-json.html


https://coderwall.com/p/duapqq/use-a-google-spreadsheet-as-your-json-backend

code: https://gist.github.com/yeungon/60c7506357c7b495349e5702783b5f20


I realise that Google Docs can be used as a database system for archiving JSON or XML data.

Furthermore, as far as I known, Google Script can be used to customize JS file for interacting with Google Apps services such as Google Docs or Sheet.

What's next to me? 

Have a go with PHP as usual and JS as well.


I frequently use Google Spreadsheets as a lightweight database, by setting up some columns, encouraging my colleagues to update it, and subscribing to notifications of changes. Then I export the spreadsheet as JSON and update a json file in our codebase. Sometimes I also just use the jsonp output of a published spreadsheet, but if I'm worried about performance or the information getting mis-updated, then I'll use the export-and-update approach. In order to export it as JSON, I used to use a Google Spreadsheets Gadget but now that those are deprecated, I use a Google Apps Script.

Here are the steps for using the script:

Create a new spreadsheet, and put your data in columns. Give each column a name, and choose carefully. Since this name will be used for JSON keys, the best names are lowercase, whitespace-less, and descriptive. Freeze the first row with the column names. The image below shows a spreadsheet of books on my reading list: 
 

Go to Tools -> Script Editor, and it will open up a code editing interface in another window.
 

Paste the JavaScript from this gist into the code editor. 
 

Reload the spreadsheet and notice a new menu shows up called "Export JSON". Click on that, and you'll see three options:
Export JSON for this sheet (with default configuration)
Export JSON for all sheets (with default configuration)
Configure export (where you can change the default configuration and what you want to export.)

 

Once you click one of the export options, it will process for a few seconds and popup a textbox with the exported JSON. Now you can do whatever you'd like with that!

So there you have it. If you make any improvements to the script to make it more flexible or easier to use or better in any way, please let me know in the comments.
