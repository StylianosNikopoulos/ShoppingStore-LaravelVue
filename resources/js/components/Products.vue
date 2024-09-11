<template>
    <div class="products-list">
        <div v-if="loading" class="loading">
            <p>Loading...</p>
        </div>
        <div v-if="!loading && products.length > 0" class="product-grid">
            <div v-for="product in products" :key="product.id" class="product-item">
                <img :src="product.image" alt="Product Image" class="product-image" />
                <div class="product-details">
                    <h3>{{ product.name }}</h3>
                    <p>{{ product.description }}</p>
                    <p class="price">Price: ${{ product.price }}</p>
                    <button class="add-to-cart-btn" @click="addToCart(product.id)">Add to Cart</button>
                </div>
            </div>
        </div>
        <div v-if="!loading && products.length === 0" class="no-products">
            <p>No products available.</p>
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
                const response = await axios.get('/products');
                this.products = response.data;
            } catch (error) {
                console.error('Error fetching products:', error);
            } finally {
                this.loading = false;
            }
        },
        async addToCart(productId) {
            if (!this.isAuthenticated) {
                toastr.error('Please log in to add items to the cart.');
                return;
            }

            try {
                const response = await axios.get('/cart/add', { 
                    params: {
                        product_id: productId,
                        quantity: 1
                    }
                });

                toastr.success(response.data.message);
            } catch (error) {
                console.error('Error adding product to cart:', error);
                toastr.error('Failed to add product to cart. Please try again.');
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

.add-to-cart-btn {
    background-color: #ff5722;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.add-to-cart-btn:hover {
    background-color: #ff3c00;
}
</style>
