# MetaForum
Metaforum is a simple forum website platform for posting thread and comments, there 3 roles which includes user, mod, and admin manually hand coded where the user can post,edit, delete a thread or a reply to another thread or comment, mods has all the regular user privilege and can report a thread/forum and close a thread, admin the same as mod where is notified when a report is made, all of the user interaction such as online status, last created, seen, favorited thread is recorded where the user can see at their profile account page. The frontend page is created to be dynamicly loaded via ajax request using vanilla php as backend



## Quick flow of the App



first user greeted with thread page where user can choose a topic and to read a thread user must sign up


![image](https://user-images.githubusercontent.com/71873035/187727680-7ed3959e-ce5b-42a7-92f4-8d9e7127791b.png)




after signup user has to validate there email and then do a login


![image](https://user-images.githubusercontent.com/71873035/187727839-e1fb23ef-7276-49d1-a228-97e022b90e7d.png)




after creating account user will be greeted, they will pick a topic and then the thread they want to read where the thread will be dynamicly loaded under the menu


![image](https://user-images.githubusercontent.com/71873035/187727909-c6f0ad6b-dede-4b81-bfc2-ef63c104c08b.png)




user can give a heart,read,reply a thread if user a mod/admin they can report a thread or even close a thread that is reported from other mod


![image](https://user-images.githubusercontent.com/71873035/187727993-c6accb16-7b5d-4303-8f6d-4a2940b7476b.png)
![image](https://user-images.githubusercontent.com/71873035/187728537-1d461dfa-ebcf-46bd-a0b6-e42249eabbf2.png)
![image](https://user-images.githubusercontent.com/71873035/187728565-bc23dcba-73f5-433a-8d43-146057428067.png)
![image](https://user-images.githubusercontent.com/71873035/187728604-01bc6893-59f0-4687-901f-990894dd5776.png)




user can also reply,report,edit/delete their reply


![image](https://user-images.githubusercontent.com/71873035/187729080-b9ffb18f-bc9a-4005-b38b-2e9692ed51dd.png)






user can also create their own thread based on topic they choose

![image](https://user-images.githubusercontent.com/71873035/187728676-ec9d4a20-dcdc-40f7-81be-f72ab53153d6.png)

after created :


![image](https://user-images.githubusercontent.com/71873035/187728762-2cb7ebd9-d409-48e4-9224-f77ed1689676.png)
![image](https://user-images.githubusercontent.com/71873035/187728786-f1347529-7440-423e-80eb-4057fa61c805.png)






user can also check their profile which includes some the user data activity where the user can click of a thread/comment they recently posted and will be taken to the section dynamicly


![image](https://user-images.githubusercontent.com/71873035/187728936-9f2ff3ce-0664-421f-b520-a7dc22cbd06b.png)




quick Entity Relation Skema more detail can be seen in the query script
![image](https://user-images.githubusercontent.com/71873035/187731311-81f7d505-c133-43e3-9bd3-b1f2e3857519.png)


Document structure consist of .php files 
where handler handles functionality and non-handler usually includes front page.
databaseHandler.php handles all things database related
utils.php for reoccurring functions


PHP ver
PHP 7.4.13 (cli) (built: Nov 24 2020 12:43:30) ( NTS Visual C++ 2017 x64 )

Database ver
mysql  Ver 15.1 Distrib 10.4.13-MariaDB

web server
XAMPP v3.2.4

library used includes jquery, ajax, bootstrap 4 css



