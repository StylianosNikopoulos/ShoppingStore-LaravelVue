<template>
    <div>
        <div class="dashboard-container">
            <h2>Admin Panel</h2>
            <button class="create" @click="CreateProduct">Add New Product</button>
        </div>
        <div class="products-list">
            <div v-if="loading" class="loading">
                <p>Loading products...</p>
            </div>
            <div v-if="!loading && products.length > 0" class="product-grid">
                <div v-for="product in products" :key="product.id" class="product-item">
                    <img :src="product.image" alt="Product Image" class="product-image" />
                    <div class="product-details">
                        <h3>{{ product.name }}</h3>
                        <p>{{ product.description }}</p>
                        <p class="price">Price: ${{ product.price }}</p>
                        <button class="update" @click="UpdateProduct(product.id)">Update Product</button>
                        <hr>
                        <button class="delete" @click="confirmDeleteProduct(product.id)">Delete Product</button>
                    </div>
                </div>
            </div>

            <div v-if="!loading && products.length === 0" class="no-products">
                <p>No products available.</p>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import toastr from 'toastr';

export default {
    props: {
        initialProducts: {
            type: Array,
            default: () => []
        }
    },
    data() {
        return {
            isAuthenticated: window.isAuthenticated || false,
            products: this.initialProducts,
            loading: this.initialProducts.length === 0,
        };
    },
    mounted() {
        if (this.products.length === 0) {
            this.fetchProducts();
        }
    },
    methods: {
        async fetchProducts() {
            try {
                const response = await axios.get('/api/products');
                this.products = response.data;
            } catch (error) {
                // console.error('Error fetching products:', error);
                // toastr.error('Failed to fetch products.');
            } finally {
                this.loading = false;
            }
        },
        CreateProduct() {
            window.location.href = '/admin/create'; 
        },
        UpdateProduct(productId) {
            window.location.href = `/admin/update/${productId}`; 
        },

        async confirmDeleteProduct(productId) {
            if (confirm('Are you sure you want to delete this product?')) {
                try {
                    await axios.delete(`/admin/products/${productId}`); 
                    toastr.success('Product deleted successfully.');
                } catch (error) {
                    // console.error('Error deleting product:', error);
                    // toastr.error('Failed to delete product.');
                }finally {
                    this.fetchProducts(); 
                }
            }
        }
    }
};
</script>


<style scoped>
.products-list {
    padding: 20px;
    background-color: #f9f9f9;
}

.loading, .no-products {
    text-align: center;
    padding: 20px;
    font-size: 16px;
    color: #666;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
}

.product-item {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 15px;
    transition: transform 0.3s;
}

.product-item:hover {
    transform: scale(1.02);
}

.product-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-bottom: 1px solid #ddd;
}

.product-details {
    padding: 15px;
}

.product-details h3 {
    margin: 0;
    font-size: 18px;
    color: #333;
}

.product-details p {
    margin: 10px 0;
    font-size: 14px;
    color: #666;
}

.price {
    font-weight: bold;
}

.create,
.update,
.delete {
    background-color: rgb(8, 247, 36);
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.create:hover,
.update:hover {
    background-color: #45a049;
}

.delete {
    background-color: #dc3545;
}

.delete:hover {
    background-color: #c82333;
}

.dashboard-container {
    display: flex; 
    flex-direction: column; 
    align-items: center; 
    text-align: center; 
    margin: 0 auto; 
}

h2 {
    font-size: 2rem; 
    font-weight: bold; 
    color: #333; 
    margin-bottom: 20px; 
}

.create {
    display: inline-block; 
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

.create:hover {
    background-color: #f63900; 
    transform: scale(1.05); 
}

.create:focus {
    outline: none;
    box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.5); 
}

</style>
