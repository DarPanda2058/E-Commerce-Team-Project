-- Create the 'Cart' table
Create table Cart (
    Cart_ID INT,
    Cart_Quantity INT
);
-- Add primary key constraint for 'Cart_ID'
alter table Cart
add constraint pk_Cart_ID primary key (Cart_ID);


-- Create the 'User' table
Create table "User" (
    User_ID INT,
    User_First_Name VARCHAR(50),
    User_Last_Name VARCHAR(50),
    User_Phone INT unique ,
    User_Address VARCHAR(100),
    User_Email VARCHAR(255),
    User_Password VARCHAR(50) not null,
    User_Type VARCHAR(50),
    User_Created_Time TIMESTAMP,
    User_State INT,
    Cart_ID INT
);
-- Add primary key constraint for 'User_ID'
alter table "User"
add constraint pk_User_ID primary key (User_ID);
-- Add foreign key constraint for 'Cart_ID'
alter table "User"
add constraint fk_Cart_ID foreign key (Cart_ID) references Cart(Cart_ID);


-- Create the 'Shop' table
Create table Shop (
    Shop_ID INT,
    Shop_Category VARCHAR(50),
    Shop_Logo VARCHAR(30),
    Shop_Name VARCHAR(35) not null,
    Shop_Email VARCHAR(255) not null,
    Shop_Status INT,
    User_ID INT
);
-- Add primary key constraint for 'Shop_ID'
alter table Shop
add constraint pk_Shop_ID primary key (Shop_ID);
-- Add foreign key constraint for 'User_ID'
alter table Shop
add constraint fk_User_ID foreign key (User_ID) references "User"(User_ID);


-- Create the 'Report' table
Create table Report (
    Report_ID INT,
    Report_Desc VARCHAR(150),
    User_ID INT
);
-- Add primary key constraint for 'Report_ID'
alter table Report
add constraint pk_Report_ID primary key (Report_ID);
-- Add foreign key constraint for 'User_ID'
alter table Report
add constraint fk_User_IDs foreign key (User_ID) references "User"(User_ID);

-- Create the 'Discount' table
Create table Discount (
    Discount_ID INT,
    Discount_Percentage INT
);
-- Add primary key constraint for 'Discount_ID'
alter table Discount
add constraint pk_Discount_ID primary key (Discount_ID);


-- Create the 'Product' table
Create table Product (
    Product_ID INT,
    Product_Name VARCHAR(50) not null,
    Product_Price INT not null,
    Product_Image VARCHAR(255),
    Product_Category VARCHAR(50),
    Product_Max_Limit INT,
    Product_Details VARCHAR(100),
    Product_Created_Time TIMESTAMP,
    Product_Quantity INT,
    Time_Before_Expiry TIMESTAMP,
    Product_Status INT,
    Shop_ID INT,
    Report_ID INT,
    Discount_ID INT
);
-- Add primary key constraint for 'Product_ID'
Alter table Product
add constraint pk_Product_ID primary key (Product_ID);
-- Add foreign key constraint for 'Shop_ID'
alter table Product
add constraint fk_Shop_ID foreign key (Shop_ID) references Shop(Shop_ID);
-- Add foreign key constraint for 'Report_ID'
alter table Product
add constraint fk_Report_ID foreign key (Report_ID) references Report(Report_ID);
-- Add foreign key constraint for 'Discount_ID'
alter table Product
add constraint fk_Discount_ID foreign key (Discount_ID) references Discount(Discount_ID);


-- Create the 'Cart_Product' table
Create table Cart_Product (
    Cart_ID INT,
    Product_ID INT
);
-- Add foreign key constraint for 'Cart_ID'
alter table Cart_Product
add constraint fk_Cart_IDs foreign key (Cart_ID) references Cart(Cart_ID);
-- Add foreign key constraint for 'Product_ID'
alter table Cart_Product
add constraint fk_Product_ID foreign key (Product_ID) references Product(Product_ID);


-- Create the 'Collection_Slot' table
Create table Collection_Slot (
    Slot_ID INT,
    Collection_Day VARCHAR(9),
    Collection_Start_Time TIMESTAMP,
    Collection_End_Time TIMESTAMP
);
-- Add primary key constraint for 'Slot_ID'
alter table Collection_Slot
add constraint pk_Slot_ID primary key (Slot_ID);


-- Creating the 'Order' table
Create table "Order" (
    Order_ID INT,
    Order_Quantity INT,
    Order_Date TIMESTAMP,
    Cart_ID INT,
    Slot_ID INT,
    Report_ID INT
);
-- Add primary key constraint for 'Order_ID'
alter table "Order"
add constraint pk_Order_ID primary key (Order_ID);
-- Add foreign key constraint for 'Cart_ID'
alter table "Order"
add constraint fk_CART_ID_ORDER foreign key (Cart_ID) references Cart(Cart_ID);
-- Add foreign key constraint for 'Slot_ID'
alter table "Order"
add constraint fk_Slot_ID foreign key (Slot_ID) references Collection_Slot(Slot_ID);
-- Add foreign key constraint for 'Report_ID'
alter table "Order"
add constraint fk_Report_IDs foreign key (Report_ID) references Report(Report_ID);


-- Create the 'Order_Product' table
CREATE TABLE Order_Product (
    Order_ID INT NOT NULL,
    Product_ID INT NOT NULL
);
-- Add foreign key constraint for 'Order_ID'
alter table Order_Product
add constraint fk_Order_ID foreign key (Order_ID) references "Order"(Order_ID);
-- Add foreign key constraint for 'Product_ID'
alter table Order_Product
add constraint fk_Products_ID foreign key (Product_ID) references Product(Product_ID);


-- Create the 'User_Order' table
Create table User_Order (
    User_ID INT,
    Order_ID INT
);
-- Add foreign key constraint for 'User_ID'
alter table User_Order
add constraint fk_Users_ID foreign key (User_ID) references "User"(User_ID);
-- Add foreign key constraint for 'Order_ID'
alter table User_Order
add constraint fk_Orders_ID foreign key (Order_ID) references "Order"(Order_ID);


-- Create the 'Payment' table
Create table Payment (
    Payment_ID INT,
    Payment_Date TIMESTAMP,
    Payment_Amount INT,
    Order_ID INT
);
-- Add primary key constraint for 'Payment_ID'
alter table Payment
add constraint pk_Payment_ID primary key (Payment_ID);
-- Add foreign key constraint for 'Order_ID'
alter table Payment
add constraint fk_Orderss_ID foreign key (Order_ID) references "Order"(Order_ID);


-- Create the 'Review' table
Create table Review (
    Review_ID INT,
    Review_Desc VARCHAR(150),
    Review_Rating INT,
    Product_ID INT
);
-- Add primary key constraint for 'Review_ID'
alter table Review
add constraint pk_Review_ID primary key (Review_ID);
-- Add foreign key constraint for 'Product_ID'
alter table Review
add constraint fk_PRODUCT_ID_REVIEW foreign key (Product_ID) references Product(Product_ID);


-- Create the 'Wishlist' table
Create table Wishlist (
    Wishlist_ID INT,
    Wishlist_Quantity INT
);
-- Add primary key constraint for 'Wishlist_ID'
alter table Wishlist
add constraint pk_Wishlist_ID primary key (Wishlist_ID);


-- Create the 'Wishlist_Product' table
Create table Wishlist_Product (
    Wishlist_ID INT,
    Product_ID INT
);
-- Add foreign key constraint for 'Wishlist_ID'
alter table Wishlist_Product
add constraint fk_Wishlist_ID foreign key (Wishlist_ID) references Wishlist(Wishlist_ID);
-- Add foreign key constraint for 'Product_ID'
alter table Wishlist_Product
add constraint fk_Product_ids foreign key (Product_ID) references Product(Product_ID);










