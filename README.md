## Project: Production Inventory Management Website

The "Production Inventory Management" website project is designed to manage the production process and control raw materials and products within an inventory system. Below is a detailed description of the process, technologies used, and additional features of the project.

### Process

1. **Product Management Sends Production Request**
   - Product management sends a production request to the raw material manager based on production needs.

2. **Raw Material Management**
   - Receives the production request and checks the quantity of raw materials in stock.
   - If stock is sufficient:
     - Dispatch raw materials to the production workshop.
   - If stock is insufficient:
     - Send a request for raw material replenishment to the supplier.

3. **Supplier**
   - Receives the request and sends raw materials to the raw material warehouse.
   - Raw materials are checked using QR codes:
     - If the materials meet quality standards, they are entered into the raw material inventory.
     - If the materials do not meet quality standards, they are returned to the supplier.

4. **Production Workshop**
   - Receives raw materials from the raw material warehouse and checks the quality and quantity using QR codes:
     - If the materials meet the requirements, production is initiated and the products are entered into the product inventory.
     - If the materials do not meet the requirements, a request is made to return the raw materials to the raw material warehouse.

5. **Product Warehouse**
   - Receives products from the production workshop and checks the quality and quantity using QR codes:
     - If the products meet the requirements, they are entered into the inventory awaiting sale.
     - If the products do not meet the requirements, a destruction report is created.

### QR Code

Each product or raw material through each process is assigned a QR code. This QR code helps to check and track information about the quantity and quality of raw materials and products throughout the management process.

### Additional Features

1. **Chatbox**
   - Integrated chatbox system for seamless communication and coordination between departments. The chatbox supports instant messaging between product management, raw material management, suppliers, production workshops, and product warehouses.

2. **Email Verification**
   - Uses [AbstractAPI](https://www.abstractapi.com/) for email verification. Registration and email changes require verification through email to ensure accurate and secure communication.

3. **User Role Management**
   - The user role management system allows for different access rights based on the user’s role in the system. Roles include:
     - **Product Manager**: Has the authority to send production requests and track request statuses.
     - **Raw Material Manager**: Has the authority to check raw material stock, dispatch materials, and request replenishments.
     - **Supplier**: Has the authority to receive requests and provide raw materials to the raw material warehouse.
     - **Raw Material Warehouse Staff**: Has the authority to check and enter raw materials into inventory.
     - **Production Workshop Staff**: Has the authority to check raw materials, manage production, and enter products into the product inventory.
     - **Product Warehouse Staff**: Has the authority to check and manage products entering the inventory.

### Technologies Used


### Technologies Used

- **Laravel**
  - **Purpose**: Laravel is a powerful PHP framework used to build the core functionality of the web application.
  - **Usage**: 
    - **Backend Development**: Handles the server-side logic, including data processing, business rules, and interactions with the database.
    - **Routing**: Manages the application's routes and directs HTTP requests to the appropriate controllers.
    - **Authentication**: Provides built-in features for user authentication and authorization.
    - **MVC Architecture**: Implements the Model-View-Controller pattern to organize code efficiently and maintain separation of concerns.

- **MySQL**
  - **Purpose**: MySQL is used as the relational database management system to store and manage all the data within the application.
  - **Usage**: 
    - **Data Storage**: Stores structured data including user information, raw material details, production requests, and inventory records.
    - **Queries**: Handles complex queries to retrieve and manipulate data as needed by the application.
    - **Data Integrity**: Ensures data consistency and integrity with transactions and constraints.

- **Livewire**
  - **Purpose**: Livewire is a Laravel library used to create dynamic, interactive user interfaces without needing extensive JavaScript.
  - **Usage**: 
    - **Component-Based Development**: Allows the creation of reusable components that interact with the server-side logic seamlessly.
    - **State Management**: Manages the state of UI components and reflects changes without full page reloads.

- **AbstractAPI**
  - **Purpose**: AbstractAPI is an external service used for email verification to ensure the validity and deliverability of email addresses.
  - **Usage**: 
    - **Email Verification**: Validates email addresses provided by users during registration or updates to prevent errors and ensure reliable communication.
    - **Data Cleaning**: Helps maintain a clean and accurate user database by identifying invalid or risky email addresses.
