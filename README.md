
https://github.com/DarvanneTapayan/inventory_management open for source code
Extensions used: xampp, php vanilla, chatgpt, mysql phpmyadmin, visual studio code, github desktop

Reminders: 
1. Make sure you import the database inventory_managemeny.sql into phpmyadmin.
2. Make sure to paste the source code in the HTDOCS otherwise it won't work.
3. This is not complete yet but you can help me modify and enhance the code.
4. Have fun.

### Inventory Management System User Guide

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------

## Table of Contents
1. **System Overview**
2. **User Roles and Access**
3. **Navigating the System**
4. **Key Functionalities**
   - Managing Products
   - Managing Categories
   - Managing Suppliers
   - Managing Purchase Orders
   - Managing Sales
   - Managing Inventory Adjustments
5. **Logging In and Out**
6. **Accessing User Dashboards**
7. **Common Tasks and Workflows**
8. **Conclusion**

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------

### 1. System Overview
The Inventory Management System is designed to help businesses track and manage their inventory efficiently. It provides functionalities for managing products, categories, suppliers, purchase orders, sales, and inventory adjustments. The system aims to streamline operations and provide real-time insights into inventory levels.

### 2. User Roles and Access
The system has three primary user roles, each with specific access rights:
- **Admin**: Full access to all features, including adding, editing, and deleting products, categories, suppliers, purchase orders, and sales.
- **Manager**: Can manage products, categories, suppliers, and sales but has limited access to purchase orders (view only).
- **Staff**: Limited to viewing products, categories, suppliers, and sales; cannot make changes to inventory or purchase orders.

### 3. Navigating the System
- **Home Page** (`index.php`): This serves as the landing page. If a user is logged in, they will be redirected to their respective dashboard. If not, they will see a prompt to log in.
- **Dashboard**: Each role has its own dashboard that presents relevant functionalities and data.

### 4. Key Functionalities
#### Managing Products
- **Add Product**: Enter product details, including name, description, SKU, price, quantity, and associated category.
- **Edit Product**: Modify existing product information.
- **Delete Product**: Remove a product from the inventory.
- **View Products**: List all products with details and actions available.

#### Managing Categories
- **Add Category**: Create a new category for organizing products.
- **Edit Category**: Change the details of an existing category.
- **Delete Category**: Remove a category from the system (only if no products are associated).
- **View Categories**: List all categories.

#### Managing Suppliers
- **Add Supplier**: Enter supplier details for managing inventory sources.
- **Edit Supplier**: Update supplier information.
- **Delete Supplier**: Remove a supplier from the system.
- **View Suppliers**: List all suppliers.

#### Managing Purchase Orders
- **Add Purchase Order**: Create a new order to restock inventory from suppliers.
- **Edit Purchase Order**: Modify existing purchase orders.
- **Delete Purchase Order**: Remove a purchase order (if not completed).
- **View Purchase Orders**: List all purchase orders with details.

#### Managing Sales
- **Add Sale**: Record a new sale made to a customer.
- **Edit Sale**: Modify existing sale details.
- **Delete Sale**: Remove a sale record.
- **View Sales**: List all sales transactions.

#### Managing Inventory Adjustments
- **Add Inventory Adjustment**: Record adjustments made to inventory levels (e.g., corrections).
- **Edit Inventory Adjustment**: Modify existing adjustments.
- **Delete Inventory Adjustment**: Remove an adjustment record.
- **View Inventory Adjustments**: List all adjustments made.

### 5. Logging In and Out
- **Log In**: Users enter their credentials (username and password) to access the system. After logging in, they are redirected to their respective dashboard based on their role.
- **Log Out**: Users can log out from the system, which will end their session and return them to the home page.

### 6. Accessing User Dashboards
Each user role has its own dashboard:
- **Admin Dashboard**: Full access to all management features.
- **Manager Dashboard**: Access to product, category, and supplier management, with limited access to purchase orders.
- **Staff Dashboard**: Basic access for viewing inventory and sales without editing capabilities.

### 7. Common Tasks and Workflows
- **Adding a New Product**: Log in > Go to the "Add Product" section > Fill out the product form > Submit.
- **Viewing Sales Reports**: Log in > Navigate to "View Sales" > Analyze the list of sales.
- **Creating a Purchase Order**: Log in > Navigate to "Add Purchase Order" > Select supplier and fill details > Submit.

### 8. Conclusion
This Inventory Management System provides a user-friendly interface for managing various aspects of inventory and sales. By following the guide, users can effectively navigate the system, utilize its functionalities, and maintain organized inventory records. Regular use will lead to better insights and improved inventory management practices.

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------

### Order of Functions Before a User Can Buy a Product

1. **Add Supplier**: Before any products can be added, suppliers need to be registered. Products are typically sourced from suppliers.
   
2. **Add Category**: Define categories for products to maintain organization. Categories are often required when adding a new product.

3. **Add Product**: Once suppliers and categories are established, products can be added to the inventory.

4. **View Products**: Before a user can purchase a product, they must view available products. This function is critical for making informed purchasing decisions.

5. **Add Sale**: When a user decides to buy a product, the sale is registered, reducing stock levels accordingly.

By following this order, you ensure that all necessary data is in place to facilitate a smooth purchasing experience.

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------

### Below are examples of input data for each of the functions, along with brief descriptions of their purposes.

### 1. **Add Product**
- **Purpose**: To enter a new product into the inventory system.
- **Inputs**:
  - **Product Name**: "Chocolate Cake"
  - **Category ID**: 1 (Assuming 1 corresponds to the "Cakes" category)
  - **Description**: "A rich and moist chocolate cake."
  - **SKU**: "CAKE-001"
  - **Price**: 15.99 (Price in your currency)
  - **Quantity in Stock**: 50 (Available stock)
  - **Reorder Level**: 10 (Minimum stock level before reorder)
  - **Supplier ID**: 1 (Assuming this supplier provides the cake)

### 2. **Add Category**
- **Purpose**: To create a new category to organize products.
- **Inputs**:
  - **Category Name**: "Cakes"
  - **Description**: "All types of cakes including chocolate, vanilla, and fruit cakes."

### 3. **Add Supplier**
- **Purpose**: To register a new supplier from whom products can be sourced.
- **Inputs**:
  - **Supplier Name**: "Bakery Supplies Inc."
  - **Contact Name**: "John Doe"
  - **Phone**: "123-456-7890"
  - **Email**: "contact@bakerysupplies.com"
  - **Address**: "123 Bakery Lane, Sweet City, SC 12345"

### 4. **Add Purchase Order**
- **Purpose**: To create a record of a purchase order placed to replenish stock.
- **Inputs**:
  - **Supplier ID**: 1 (Referring to "Bakery Supplies Inc.")
  - **Order Date**: "2024-09-29" (Today's date or the date of the order)
  - **Status**: "Pending" (Order status, e.g., Pending, Completed)
  - **Total Amount**: 159.90 (Total cost of the order)

### 5. **Add Sale**
- **Purpose**: To register a sale transaction when a product is sold.
- **Inputs**:
  - **Sale Date**: "2024-09-29" (Date of the sale)
  - **Customer Name**: "Jane Smith"
  - **Total Amount**: 15.99 (Total sale amount for one chocolate cake)
  - **Status**: "Completed" (Status of the sale)

### 6. **Add Inventory Adjustment**
- **Purpose**: To adjust inventory levels for reasons such as stock discrepancies, returns, or corrections.
- **Inputs**:
  - **Product ID**: 1 (Referring to "Chocolate Cake")
  - **Adjustment Type**: "Increase" (Could also be "Decrease")
  - **Quantity**: 5 (Adding 5 more cakes to stock)
  - **Reason**: "New shipment received"
  - **Adjustment Date**: "2024-09-29" (Date of adjustment)

These examples provide a clear idea of what to input for each function, along with their purposes.

