create or replace trigger trig_cart
before insert on Cart
for each row
begin
  if :NEW.Cart_ID is null then 
    select seq_cart.NEXTVAL into :NEW.Cart_ID from sys.dual; 
  end if; 
end;

create or replace trigger trig_user
before insert on "User"
for each row
begin
  if :NEW.User_ID is null then 
    select  seq_user.NEXTVAL into :NEW.User_ID from sys.dual; 
  end if; 
end;

create or replace trigger trig_shop
before insert on Shop
for each row
begin
  if :NEW.Shop_ID is null then 
    select  seq_shops.NEXTVAL into :NEW.Shop_ID from sys.dual; 
  end if; 
end;

create or replace trigger trig_report
before insert on Report
for each row
begin
  if :NEW.Report_ID is null then 
    select seq_report.NEXTVAL into :NEW.Report_ID from sys.dual; 
  end if; 
end;

create or replace trigger trig_product
before insert on Product
for each row
begin
  if :NEW.Product_ID is null then 
    select  seq_product.NEXTVAL into :NEW.Product_ID from sys.dual; 
  end if; 
end;

create or replace trigger trig_order
before insert on "Order"
for each row
begin
  if :NEW.Order_ID is null then 
    select  seq_order.NEXTVAL into :NEW.Order_ID from sys.dual; 
  end if; 
end;

create or replace trigger trig_payment
before insert on Payment
for each row
begin
  if :NEW.Payment_ID is null then 
    select  seq_payment.NEXTVAL into :NEW.Payment_ID from sys.dual; 
  end if; 
end;

create or replace trigger trig_collectionslot
before insert on Collection_Slot
for each row
begin
  if :NEW.Slot_ID is null then 
    select  seq_collectionslot.NEXTVAL into :NEW.Slot_ID from sys.dual; 
  end if; 
end;

create or replace trigger trig_review
before insert on Review
for each row
begin
  if :NEW.Review_ID is null then 
    select  seq_review.NEXTVAL into :NEW.Review_ID from sys.dual; 
  end if; 
end;

create or replace trigger trig_wishlist
before insert on Wishlist
for each row
begin
  if :NEW.Wishlist_ID is null then 
    select  seq_wishlist.NEXTVAL into :NEW.Wishlist_ID from sys.dual; 
  end if; 
end;

create or replace trigger trig_discount
before insert on Discount
for each row
begin
  if :NEW.Discount_ID is null then 
    select  seq_discount.NEXTVAL into :NEW.Discount_ID from sys.dual; 
  end if; 
end;






