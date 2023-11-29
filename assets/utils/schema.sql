-- drop tables Users, Categories,  Products, Orders, OrderDetails, Promocode
use sa1_proj_db;
-- Users Table
CREATE TABLE Users (
    userID INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255),
    password VARCHAR(255), -- Should be Hashed for security
    email VARCHAR(255),
    phone VARCHAR(20),
    DateOfCreation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    role ENUM('customer', 'admin')
);
-- Adding the dataofcreation to the users table

-- ALTER TABLE Users
-- ADD COLUMN DateOfCreation TIMESTAMP DEFAULT CURRENT_TIMESTAMP;

-- Categories Table
CREATE TABLE Categories (
    categoryID INT PRIMARY KEY AUTO_INCREMENT,
    categoryName VARCHAR(255),
    imgURL VARCHAR(255)
);


-- Products Table
CREATE TABLE Products (
    productID INT PRIMARY KEY AUTO_INCREMENT,
    productName VARCHAR(255),
    description TEXT,
    price DECIMAL(10, 2),
    stockQuantity INT,
    numSales INT DEFAULT 0,
    categoryID INT,
    FOREIGN KEY (CategoryID) REFERENCES Categories(CategoryID)
);
-- Adding the dataofcreation to the users table

ALTER TABLE Products
ADD COLUMN imgURL varchar(255);

-- Orders Table
CREATE TABLE Orders (
    orderID INT PRIMARY KEY AUTO_INCREMENT,
    userID INT,
    orderDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    totalAmount DECIMAL(10, 2),
    address1 VARCHAR(255),
    address2 VARCHAR(255),
    additionalPhone VARCHAR(20),
    additionalEmail VARCHAR(255),
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

-- OrderDetails Table
CREATE TABLE OrderDetails (
    orderDetailID INT PRIMARY KEY AUTO_INCREMENT,
    orderID INT,
    productID INT,
    quantity INT,
    subtotal DECIMAL(10, 2),
    FOREIGN KEY (OrderID) REFERENCES Orders(OrderID),
    FOREIGN KEY (ProductID) REFERENCES Products(ProductID)
);

-- Promocode Table
CREATE TABLE Promocode (
    promocode VARCHAR(255) PRIMARY KEY,
    -- discount DECIMAL(3, 2)
    discount INT CHECK (discount >= 0 AND discount <= 100)
);
ALTER TABLE Promocode
MODIFY COLUMN discount INT CHECK (discount >= 0 AND discount <= 100);
