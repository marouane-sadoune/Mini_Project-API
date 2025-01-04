# Mini_Project-API


This documentation explains how to set up, test, and publish a Product API using Postman and GitHub.

---

## Step 1: Configure Postman

### 1. Create a Collection
1. Open **Postman**.
2. Click on **New** > **Collection**.
3. Name the collection, e.g., **Product API**.

### 2. Configure API Requests

#### GET /api/products
1. Click on **New Request**.
2. Select the method **GET**.
3. Enter the URL of your local API, e.g., `http://127.0.0.1:8000/api/products`.
4. Save the request in the **Product API** collection.

#### POST /api/products
1. Create a new request with the method **POST**.
2. URL: `http://127.0.0.1:8000/api/products`.
3. Go to the **Body** tab, select **raw**, and choose **JSON**.
4. Add the following sample payload:
   ```json
   {
       "name": "Produit A",
       "price": 10.0
   }
   ```
5. Save the request in the **Product API** collection.

#### PUT /api/products/{id}
1. Create a new request with the method **PUT**.
2. URL: `http://127.0.0.1:8000/api/products/1`.
3. Go to the **Body** tab, select **raw**, and choose **JSON**.
4. Add the following sample payload:
   ```json
   {
       "name": "Produit A Modifié",
       "price": 15.5
   }
   ```
5. Save the request in the **Product API** collection.

#### DELETE /api/products/{id}
1. Create a new request with the method **DELETE**.
2. URL: `http://127.0.0.1:8000/api/products/1`.
3. Save the request in the **Product API** collection.

---

## Step 2: Execute and Validate Requests

1. Launch each request in the **Product API** collection:
   - **GET**: Ensure it returns a list of products.
   - **POST**: Verify that it adds a new product.
   - **PUT**: Confirm that it updates an existing product.
   - **DELETE**: Validate that it deletes the specified product.

2. Check the responses and ensure the API behaves as expected.

---

## Step 3: Generate a Report

1. Open the **Product API** collection in Postman.
2. Click on the **Run** button (Collection Runner).
3. Execute all requests in the collection.
4. Export the results:
   - Choose to export as **JSON** or **HTML** for documentation purposes.

---

## Step 4: Publish the Project on GitHub

### 1. Initialize Git
1. Open a terminal in your project directory.
2. Run the following commands:
   ```bash
   git init
   git add .
   git commit -m "Initial commit"
   ```

### 2. Create a New GitHub Repository
1. Go to [GitHub](https://github.com/).
2. Click on **New** to create a repository.
3. Name your repository, e.g., `product-api`.
4. Follow the instructions to connect your local repository to GitHub:
   ```bash
   git remote add origin https://github.com/username/product-api.git
   git branch -M main
   git push -u origin main
   ```

---

## README Checklist

1. **Setup Instructions**:
   - Include steps to clone the repository, install dependencies, and run the server.
2. **API Endpoints**:
   - Document all API endpoints with example requests and responses.
3. **Testing**:
   - Explain how to use Postman to test the API.
4. **Contribution Guidelines**:
   - Add instructions for contributing to the project.

---

This concludes the documentation for setting up and testing the Product API project.


