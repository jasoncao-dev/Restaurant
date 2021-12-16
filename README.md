# Restaurant
The restuarant app was created for ASE 230 by Trung Robert and Blake.
It uses PHP and JS to run a site we call FooDash. when the site is first
loaded the user is presented with the ability to see the restaurants and
see what they have to offer but can not order from them. If someone attempts
placing an order before signing in it will redirect them to the sign in page.
 
the URL to reach the test site is: https://foodash-test.herokuapp.com/

if you want to test the admin account you can log in as email= admin@foodash.com password= 12345678



![](./screenshots/home_nolog.png)
![](./screenshots/detail_nolog.png)



After you log in you will be able to add orders to your cart and check out from the cart page.
While signed in you are also able to view your user profile and edit the information of the user.
you will also be able to check out your cart. this works because the order id is stored in the sessions data
and when you check out your cart it marks a flag in the order_lists table to say its closed and creates a 
new blank order that it then stores in sessions replacing the old one. 
![](./screenshots/home_logged.png)
![](./screenshots/detail_logged.png)
![](./screenshots/cart.png)
![](./screenshots/cart_logged.png)



Another functionality is being able to sign in as an admin. This will allow you to edit the pages
by adding and removing restaurants as well as adding, deleting, and modifying menu items for each
restaurant. As with normal users, the admin is also able to view and edit their profile information.



![](./screenshots/admin_index.png)
![](./screenshots/admin_index_model.png)
![](./screenshots/admin_detail.png)
