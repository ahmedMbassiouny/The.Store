-- INSERT INTO USERS TABLES SOME DATA
INSERT INTO Users (username, password, email, phone, role) VALUES ('Hossam', 1234, 'Hossam@customer.com', '1234567890', 'customer'); 
INSERT INTO Users (username, password, email, phone, role) VALUES ('Hossam', 1234, 'Hossam@admin.com', '1234567890', 'admin'); 
INSERT INTO Users (username, password, email, phone, role) VALUES ('Ahmed_Bassiouny', 1234, 'Ahmed_Bassiouny@customer.com', '1234567890', 'customer'); 
INSERT INTO Users (username, password, email, phone, role) VALUES ('Ahmed_Bassiouny', 1234, 'Ahmed_Bassiouny@admin.com', '1234567890', 'admin'); 
INSERT INTO Users (username, password, email, phone, role) VALUES ('Hazem_Ahmed', 1234, 'Hazem_Ahmed@customer.com', '1234567890', 'customer'); 
INSERT INTO Users (username, password, email, phone, role) VALUES ('Hazem_Ahmed', 1234, 'Hazem_Ahmed@admin.com', '1234567890', 'admin'); 
INSERT INTO Users (username, password, email, phone, role) VALUES ('Ahmed_Makboul', 1234, 'Ahmed_Makboul@customer.com', '1234567890', 'customer'); 
INSERT INTO Users (username, password, email, phone, role) VALUES ('Ahmed_Makboul', 1234, 'Ahmed_Makboul@admin.com', '1234567890', 'admin'); 
INSERT INTO Users (username, password, email, phone, role) VALUES ('Omar', 1234, 'Omar@customer.com', '1234567890', 'customer'); 
INSERT INTO Users (username, password, email, phone, role) VALUES ('Omar', 1234, 'Omar@admin.com', '1234567890', 'admin'); 
INSERT INTO Users (username, password, email, phone, role) VALUES ('Ahmed', 1234, 'Ahmed@customer.com', '1234567890', 'customer'); 
INSERT INTO Users (username, password, email, phone, role) VALUES ('Ahmed', 1234, 'Ahmed@admin.com', '1234567890', 'admin'); 

-- Categories Table
INSERT INTO Categories (categoryName, imgURL) VALUES ('Electronics', 'https://i.pinimg.com/564x/58/58/24/585824c2e5540f4312435d72221dc436.jpg');
INSERT INTO Categories (categoryName, imgURL) VALUES ('Jewelery', 'https://i.pinimg.com/564x/58/70/7f/58707f4e5d0d410bab480be0d887af20.jpg');
INSERT INTO Categories (categoryName, imgURL) VALUES ("Men's Clothing", 'https://i.pinimg.com/564x/45/44/5f/45445f8fc2b2a4e824be2aa6249af3ef.jpg');
INSERT INTO Categories (categoryName, imgURL) VALUES ("Women's Clothing", 'https://i.pinimg.com/564x/54/a4/31/54a43102e72680eb0cea51c0b28bde6e.jpg');


-- Products Table

-- jewelwery 2
INSERT INTO Products (productName, description, price, stockQuantity, categoryID, imgURL)
VALUES ('John Hardy 5mm Legends Naga Bracelet', 
'According to Balinese legend, Naga, the water dragon, symbolizes protection and prosperity. From our Legends Collection, Naga imbues this artisan-made bracelet (5mm) with unmistakable meaning. Its blue sapphire eyes and shimmering black sapphire mesmerize. Wear facing inward to be bestowed with love and abundance, or outward for protection. Wear it alone or as part of a stack.', 
1250.99, 
8,
 2,
 "https://knar.com/wp-content/uploads/2020/05/John-Hardy-HRD02558-Reference-No-BBS601884BLSBNXM-main.jpg");
 
 INSERT INTO Products (productName, description, price, stockQuantity, categoryID, imgURL)
VALUES ('John Hardy Legends Naga Drop Earrings', 
'According to Balinese legend, Naga, the water dragon, symbolizes protection and prosperity. From our Legends Collection, Naga imbues these artisan-made earrings with unmistakable meaning. Earring measures 55.5mm long.', 
800.00, 
10,
 2,
 "https://knar.com/wp-content/uploads/2021/07/John_Hardy_EBS60241BSP_Main.jpg");
 
  INSERT INTO Products (productName, description, price, stockQuantity, categoryID, imgURL)
VALUES ('Fabergé Heritage White Gold Royal Blue Enamel Petite Pendant', 
'The Heritage collection draws inspiration from Fabergé’s historical masterpieces. Traditional materials and complex traditional techniques, such as the delicate art of guilloché enameling and hand-engraving, make up the signature elements of this colourful and opulent collection.', 
7900.00, 
3,
 2,
 "https://knar.com/wp-content/uploads/2022/09/Faberge-Necklace_213FP1351.jpg");
 -- electronics
   INSERT INTO Products (productName, description, price, stockQuantity, categoryID, imgURL)
VALUES ('Apple iPhone 14 Pro Max', 
'Apple iPhone 14 Pro Max (256 GB) - Deep Purple - Physical Dual Sim, Bluetooth, Wi-Fi, USB, NFC', 
67200.00, 
50,
 1,
 "https://m.media-amazon.com/images/I/71yzJoE7WlL._AC_SX679_.jpg");
 
    INSERT INTO Products (productName, description, price, stockQuantity, categoryID, imgURL)
VALUES ('Samsung Galaxy S23 Ultra', 
'Samsung Galaxy S23 Ultra, Mobile Phone, Dual SIM, 5G, Android Smartphone, 256GB - 12 GB RAM, Lavender, 1 Year Manufacturer Warranty', 
47999.00, 
50,
 1,
 "https://m.media-amazon.com/images/I/7169yB5EVCL._AC_SX679_.jpg");
 
     INSERT INTO Products (productName, description, price, stockQuantity, categoryID, imgURL)
VALUES ('Samsung Galaxy M52', 
'Samsung Galaxy M52 - Dual SIM, 8GB RAM, 128GB, 5G - White - 1 year Warranty', 
11999.99, 
50,
 1,
 "https://m.media-amazon.com/images/I/612o96Hxi-L._AC_SY879_.jpg");
 
 -- men 
 
 
 
 
 
