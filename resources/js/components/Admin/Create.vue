<template>
    <div class="create-container">
      <h2>{{ isEditMode ? 'Edit Product' : 'Create Your Product' }}</h2>
      <div class="product-info">
        <input v-model="product.name" placeholder="Product Name" class="input-field" />
        <input type="file" @change="handleFileUpload" class="input-field" />
        <input v-model="product.description" placeholder="Product Description" class="input-field" />
        <input v-model.number="product.price" placeholder="Product Price" type="number" class="input-field" />
        <button @click="submitProduct" class="create-button">{{ isEditMode ? 'Update Product' : 'Create Product' }}</button>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import toastr from 'toastr';
  
  export default {
    props: ['createProduct'], 
    data() {
      return {
        product: {
          name: this.createProduct ? this.createProduct.name : '',
          description: this.createProduct ? this.createProduct.description : '',
          price: this.createProduct ? this.createProduct.price : null,
          image: null, 
        },
        isEditMode: !!this.createProduct, 
      };
    },
    methods: {
      handleFileUpload(event) {
        const file = event.target.files[0]; 
        this.product.image = file; 
      },
      async submitProduct() {
        if (!this.product.name || !this.product.description || this.product.price === null || (!this.product.image && !this.isEditMode)) {
          toastr.error('All fields are required.');
          return;
        }
  
        const formData = new FormData();
        formData.append('name', this.product.name);
        formData.append('description', this.product.description);
        formData.append('price', this.product.price);
  
        if (this.product.image) {
          formData.append('image', this.product.image);
        }
  
        try {
          if (this.isEditMode) {
            await axios.put(`/admin/products/${this.createProduct.id}`, formData, {
              headers: { 'Content-Type': 'multipart/form-data' },
            });
            toastr.success('Product updated successfully!');
          } else {
            await axios.post('/admin/products', formData, {
              headers: { 'Content-Type': 'multipart/form-data' },
            });
            toastr.success('Product created successfully!');
          }
  
          window.location.href = '/admin/dashboard';
        } catch (error) {
          console.error('Error submitting product:', error);
          toastr.error('Failed to submit product. Please try again.');
        }
      },
    },
  };
  </script>
  
 
  <style scoped>
  .create-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 40px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    margin: 50px auto;
  }
  
  h2 {
    font-size: 2rem;
    color: #333;
    margin-bottom: 20px;
    text-align: center;
  }
  
  .product-info {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 15px;
  }
  
  .input-field {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
    outline: none;
  }
  
  .input-field:focus {
    border-color: #ff5722;
  }
  
  .create-button {
    background-color: #ff5722;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 1rem;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s, transform 0.2s;
    text-decoration: none;
  }
  
  .create-button:hover {
    background-color: #ff3c00;
    transform: scale(1.05);
  }
  
  .create-button:focus {
    outline: none;
    box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.5);
  }
  </style>
  