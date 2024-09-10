<template>
    <div class="cart-container">
        <h2>Your Cart</h2>
        <div v-if="cartItems.length > 0" class="cart-items">
            <div v-for="item in cartItems" :key="item.id" class="cart-item">
                <div class="cart-item-details">
                    <img :src="item.product.image" alt="Product Image" class="product-image" />
                    <div class="product-info">
                        <h3>{{ item.product.name }}</h3>
                        <p>Price: ${{ item.product.price }}</p>
                        <p>Total: ${{ item.product.price * item.quantity }}</p>

                        <div class="quantity-control">
                            <label for="quantity">Quantity:</label>
                            <input
                                type="number"
                                v-model.number="item.quantity"
                                @change="updateQuantity(item)"
                                min="1"
                                class="quantity-input"
                            />
                        </div>
                    </div>
                </div>
                <button class="delete-btn" @click="deleteProduct(item.product.id)">Delete</button>
            </div>
            
            <!-- Cart summary -->
            <div class="cart-summary">
                <h3>Total: ${{ calculateTotalPrice() }}</h3>
                <button class="checkout-button" @click="checkout">Checkout</button>
            </div>
        </div>

        <div v-else class="empty-cart">
            <p>Your cart is empty.</p>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import toastr from 'toastr';

export default {
    data() {
        return {
            cartItems: [],
            loading: true,
        };
    },
    mounted() {
        this.fetchCartItems();
    },
    methods: {
        async fetchCartItems() {
            try {
                const response = await axios.get('/cart/items');
                this.cartItems = response.data;
            } catch (error) {
                console.error('Error fetching cart items:', error);
                toastr.error('Failed to fetch cart items. Please try again.');
            } finally {
                this.loading = false;
            }
        },
        async deleteProduct(productId) {
            try {
                const response = await axios.delete(`/cart/items/${productId}`);
                if (response.status === 200) {
                    toastr.success('Product deleted successfully.');
                    this.cartItems = this.cartItems.filter(item => item.product.id !== productId);
                } else {
                    toastr.error('Failed to delete product. Please try again.');
                }
            } catch (error) {
                console.error('Error deleting product:', error);
                toastr.error('Failed to delete product. Please try again.');
            }
        },
        async updateQuantity(item) {
            if (item.quantity < 1) {
                toastr.error('Quantity must be at least 1.');
                return;
            }

            try {
                const response = await axios.patch(`/cart/items/${item.product.id}`, {
                    quantity: item.quantity
                });
                if (response.status === 200) {
                    toastr.success('Quantity updated successfully.');
                    this.fetchCartItems(); 
                } else {
                    toastr.error('Failed to update quantity. Please try again.');
                }
            } catch (error) {
                console.error('Error updating quantity:', error);
                toastr.error('Failed to update quantity. Please try again.');
            }
        },
        calculateTotalPrice() {
            this.totalPrice = this.cartItems.reduce((total, item) => total + item.product.price * item.quantity, 0).toFixed(2);
            return this.totalPrice;
        },
        async checkout() {
            try {

                const response = await axios.post('/cart/checkout');
                if (response.status === 200) {
                    this.cartItems = []; 

                    toastr.success('Checkout successful. Your order has been placed.');

                } else {
                    console.error('Error checking out:', response.data.message);
                    toastr.error('Failed to checkout. Please try again.');
                }
            }catch(error) {
                console.error('Error checking out:', error);
                toastr.error('Failed to checkout. Please try again.');
            }
            toastr.success('Proceeding to checkout...');
            window.location.href = '/cart/checkout'; 

        }
    }
};
</script>

<style scoped>
.cart-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.cart-items {
    margin-top: 20px;
}

.cart-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin-bottom: 15px;
}

.cart-item-details {
    display: flex;
    align-items: center;
}

.product-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    margin-right: 20px;
    border-radius: 8px;
}

.product-info h3 {
    margin: 0;
    font-size: 18px;
    color: #333;
}

.product-info p {
    margin: 5px 0;
    font-size: 14px;
    color: #666;
}

.quantity-control {
    margin-top: 10px;
}

.quantity-input {
    width: 60px;
    padding: 5px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.delete-btn {
    background-color: #ff4d4f;
    color: white;
    border: none;
    padding: 8px 12px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.delete-btn:hover {
    background-color: #ff7875;
}

.cart-summary {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin-top: 20px;
}

.checkout-button {
    background-color: #4caf50;
    color: white;
    border: none;
    padding: 12px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.checkout-button:hover {
    background-color: #45a049;
}

.empty-cart {
    text-align: center;
    padding: 40px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin-top: 20px;
}
</style>
