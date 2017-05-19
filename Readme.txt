    Exposition Hall Booking System
    ==============================


	Pre-Requirements
	-----------------
	
			1. PHP version 5.4 or newer is recommended.
			2. MySQL (5.1+) 
			3. Google Map API key [ if you are running in Localhost]
			4. PHPUnit (4.8 or later is recommended) 
			   (You can install using Composer composer global require "phpunit/phpunit=4.8.*")
			
	How To Install The application
    ------------------------------

			1. Copy Source files into web server document directory ( Ex. project/src/ to /var/www/htdocs/path)
			2. Enter MySQL DB database credentials in database config file (path: /application/config/database.php)
			3. Enter SMTP [Email] credentials in config file (path: /application/config/config.php)
			4. Import db.sql file in desired database  
			5. Thats it! you can open application viwe installed location like https://hall-reservation.herokuapp.com/  
	
    Demo (Herokuapp)
    ---------------------
			Herokuapp URL:- https://hall-reservation.herokuapp.com/#/

    How To Use (Overview)
    ---------------------
	  	

			1. Open the application url via browser Ex. https://hall-reservation.herokuapp.com/
			2. You can see google map with Event markers. Click on any marker (Ex Event 1).  In bottom, 
			   "Book your place" button will appear in green color. 
			3. Click on "Book your place" button, it will take you to Exposition hall virtual map. There, 
			   you can see Free stands and booked stands details. 
			4. If you want book available stall, click on "Reserve" Button and fill the details in pop up (All mandatory). 
			5. After successful reservation it will alert with message and you can see booked status on stand. 
			6. For sending User email report, access URL like this https://hall-reservation.herokuapp.com/#/admin/email 
			
	
	How To Fill Test Data ( Maps, Virtual Map and Stand Details]
    ---------------------
			 There is no admin panel developed for this application. So right now we need to fill data directly into database. 
			 Locations - In this table, you can enter Event and map details
			 Stands    - This table will keep all stand information. Here we need to link locations id. 


    Feedback to Improve
	-------------------
			1. Event Location can be  searchable by city or area
			2. Login system needed for both business user and admin.  So that admin can upload map, stand details. 
			   Business user no need to give details each time when booking the stand. 
			3. Payment gateway can be done on bookings. 
			4. We can add booking cancel feature. 
			5. After event, report email can be send throught admin panel
			
			
	How to unit test the application
	---------------------------
			1. go to application/test and run phpunit
			2. If you want to run a single test case file: phpunit models/Category_model_test.php
			3. Coverage can be view in https://hall-reservation.herokuapp.com/application/tests/build/coverage/
			
	KNOWN SECURITY ISSUE
	---------------------------
			User email report sending functionality is not protected with Authendication. 
			So anyone can send email and 
			
	
	
	
	


