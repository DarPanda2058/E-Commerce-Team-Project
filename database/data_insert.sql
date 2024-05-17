--insert data into cart
insert into cart values  (1,1);
insert into cart values  (2,3);
insert into cart values  (3,1);
insert into cart values  (4,2);
insert into cart values  (5,4);
insert into cart values  (6,6);


-- insert data into the 'User'
insert into "User" values (10, 'Suchita', 'Acharya', 9876543214, 'Bardiya', 's@gmail.com', 'password123', 'customer', TO_DATE('11/03/2024', 'MM/DD/YYYY'), 1, 1);
insert into "User" values (12, 'Reema', 'Manandhar', 9876543215, 'Pokhara', 'r@gmail.com', 'password456', 'customer', TO_DATE('11/01/2024', 'MM/DD/YYYY'), 1, 2);
insert into "User" values (13, 'Binod', 'Acharya', 9876543216, 'Beni', 'b@gmail.com', 'password789', 'admin', TO_DATE('01/17/2024', 'MM/DD/YYYY'), 1, 3);
insert into "User" values (14, 'Aliza', 'KC', 9876543217, 'Chitwan', 'a@gmail.com', 'password1011', 'trader', TO_DATE('01/09/2024', 'MM/DD/YYYY'), 1, 4);
insert into "User" values (15, 'Ramesh', 'Sharma', 9876543210, 'Dharan', 'r@gmail.com', 'password1213', 'admin', TO_DATE('04/04/2024', 'MM/DD/YYYY'), 1, 5);

--insert data into shop
insert into shop values (101, 'Butchers', 'logo1.png', 'Fashion World', 'info@fashionworld.com', 1, 10);
insert into shop values (102, 'Greengrocer', 'logo2.png', 'Tech Hub', 'info@techhub.com', 1, 14);
insert into shop values (103, 'Fishmonger', 'logo3.png', 'Bookworms Paradise', 'info@bookworms.com', 1, 12);
insert into shop values (104, 'Bakery', 'logo4.png', 'Yumm bakery', 'info@bakenflake.com', 1, 13);
insert into shop values (105,  'Delicatessen', 'logo5.png', 'Delicate Shop', 'info@delicatessen.com',1,15);

-- Insert data into the report
insert into report values (1, 'Monthly sales report', 10);
insert into report values (2, 'Customer feedback report', 12);
insert into report values (3, 'Inventory status report', 13);
insert into report values (4, 'Marketing analysis report', 14);
insert into report values (5, 'Financial performance report', 15);

-- Insert data into the discount 
insert into discount values (1, 10);
insert into discount values (2, 15);
insert into discount values (3, 20);
insert into discount values (4, 25);
insert into discount values (5, 30);

-- Insert data into the product
insert into product values (1, 'Chicken Breast', 500, 'chicken_breast.jpg', 'Meat', 10, 'Fresh chicken breast',TO_DATE('11/03/2024', 'MM/DD/YYYY'), 50, NULL, 1, 101, 1, 1);
insert into product values (2, 'Apple', 100, 'apple.jpg', 'Fruits', 20, 'Fresh apples',TO_DATE('09/03/2024', 'MM/DD/YYYY'), 100, NULL, 1, 102, 2, 2);
insert into product values (3, 'Salmon Fillet', 700, 'salmon_fillet.jpg', 'Seafood', 15, 'Fresh salmon fillet',TO_DATE('10/03/2024', 'MM/DD/YYYY'), 30, NULL, 1, 103, 3, 3);
insert into product values (4, 'Baguette', 150, 'baguette.jpg', 'Bakery', 25, 'Freshly baked baguette',TO_DATE('11/04/2024', 'MM/DD/YYYY'), 40, NULL, 1, 104, 4, 4);
insert into product values (5, 'Lettuce', 50, 'lettuce.jpg', 'Vegetables', 30, 'Fresh lettuce',TO_DATE('11/02/2024', 'MM/DD/YYYY'), 80, NULL, 1, 102, 5, 5);
insert into product values (6, 'Cheese', 50, 'cheese.jpg', 'Dairy Item', 30, 'Fresh Cheese',TO_DATE('11/02/2024', 'MM/DD/YYYY'), 80, NULL, 1, 105, 5, 5);

-- Insert data into the cart_product
insert into cart_product values (1, 1);
insert into cart_product values(5, 2);
insert into cart_product values(2, 3);
insert into cart_product values(3, 4);
insert into cart_product values(4, 5);
insert into cart_product values(6, 6);

-- Insert data into the collection_slot
insert into collection_slot values(200, 'Wednesday', TO_DATE('2024-04-01 08:00:00', 'YYYY-MM-DD HH24:MI:SS'), TO_DATE('2024-04-01 10:00:00', 'YYYY-MM-DD HH24:MI:SS'));
insert into collection_slot values(201, 'Friday', TO_DATE('2024-04-02 09:00:00', 'YYYY-MM-DD HH24:MI:SS'), TO_DATE('2024-04-02 11:00:00', 'YYYY-MM-DD HH24:MI:SS'));
insert into collection_slot values(202, 'Wednesday', TO_DATE('2024-04-03 10:00:00', 'YYYY-MM-DD HH24:MI:SS'), TO_DATE('2024-04-03 12:00:00', 'YYYY-MM-DD HH24:MI:SS'));
insert into collection_slot values(203, 'Friday', TO_DATE('2024-04-04 11:00:00', 'YYYY-MM-DD HH24:MI:SS'), TO_DATE('2024-04-04 13:00:00', 'YYYY-MM-DD HH24:MI:SS'));
insert into collection_slot values(204, 'Friday', TO_DATE('2024-04-05 12:00:00', 'YYYY-MM-DD HH24:MI:SS'), TO_DATE('2024-04-05 14:00:00', 'YYYY-MM-DD HH24:MI:SS'));


-- Insert data into the order table
insert into "Order" values (1, 5, TO_TIMESTAMP('2024-04-03 11:30:00', 'YYYY-MM-DD HH24:MI:SS'), 1, 200, 1);
insert into "Order" values (2, 3, TO_TIMESTAMP('2024-04-05 14:45:00', 'YYYY-MM-DD HH24:MI:SS'), 2, 201, 2);
insert into "Order" values (3, 2, TO_TIMESTAMP('2024-04-08 10:20:00', 'YYYY-MM-DD HH24:MI:SS'), 3, 200, 3);
insert into "Order" values (4, 4, TO_TIMESTAMP('2024-04-10 12:10:00', 'YYYY-MM-DD HH24:MI:SS'), 4, 201, 4);
insert into "Order" values (5, 1, TO_TIMESTAMP('2024-04-12 13:55:00', 'YYYY-MM-DD HH24:MI:SS'), 5, 200, 5);
insert into "Order" values (6, 5, TO_TIMESTAMP('2024-04-12 13:55:00', 'YYYY-MM-DD HH24:MI:SS'), 6, 200, 5);

-- Insert data into the order_product
insert into order_product values (1, 1);
insert into order_product values (2, 2);
insert into order_product values (3, 3);
insert into order_product values (4, 4);
insert into order_product values (5, 5);

-- Insert data into the user_order
insert into user_order values (10, 1);
insert into user_order values (12, 2);
insert into user_order values (13, 3);
insert into user_order values (14, 4);
insert into user_order values (15, 5);

-- Insert data into the payment
insert into payment values (101, TO_TIMESTAMP('2024-04-10 13:30:00', 'YYYY-MM-DD HH24:MI:SS'), 50,1);
insert into payment values (102, TO_TIMESTAMP('2024-03-19 14:45:00', 'YYYY-MM-DD HH24:MI:SS'), 75,2);
insert into payment values (103, TO_TIMESTAMP('2024-04-29 15:20:00', 'YYYY-MM-DD HH24:MI:SS'), 100,3);
insert into payment values (104, TO_TIMESTAMP('2024-03-01 16:10:00', 'YYYY-MM-DD HH24:MI:SS'), 120,4);
insert into payment values (105, TO_TIMESTAMP('2024-02-05 17:00:00', 'YYYY-MM-DD HH24:MI:SS'), 90,5);

-- Insert data into the review
insert into review values (1, 'Exceptional quality, highly recommended!', 5, 1);
insert into review values (2, 'Average product quality, potential for enhancement.', 3, 2);
insert into review values (3, 'Impressive service and prompt delivery.', 4, 3);
insert into review values (4, 'Not satisfied with the product.', 2, 4);
insert into review values (5, 'Exceptional experience, will definitely return!', 5, 5);

-- Insert data into the wishlist
insert into wishlist values (500, 1);
insert into wishlist values (501, 2);
insert into wishlist values (502, 3);
insert into wishlist values (503, 1);
insert into wishlist values (504, 2);

-- Insert data into the wishlist_product
insert into wishlist_product values (500, 1);
insert into wishlist_product values (501, 2);
insert into wishlist_product values (502, 3);
insert into wishlist_product values (503, 4);
insert into wishlist_product values (504, 5);





















