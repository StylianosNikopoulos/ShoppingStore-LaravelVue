<template>
    <div class="checkout-container">
        <h2>Checkout</h2>

        <div class="user-info">
            <h3>Enter Your Info</h3>
            <form @submit.prevent="handleSubmit">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" v-model="user.name" id="name" required />
                </div>
                <div class="form-group">
                    <label for="country">Country:</label>
                    <input type="text" v-model="user.country" id="country" required />
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" v-model="user.address" id="address" required />
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" v-model="user.email" id="email" required />
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="tel" v-model="user.phone" id="phone" required />
                </div>
                <div class="checkout-summary">
                    <h3>Total Price: ${{ totalPrice }}</h3>
                    <button type="button" id="checkout-button" class="buy-now-button">Buy Now</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import toastr from 'toastr';
import { loadStripe } from '@stripe/stripe-js';

export default {
    data() {
        return {
            user: {
                name: '',
                country: '',
                address: '',
                email: '',
                phone: ''
            },
            cartItems: [],
            totalPrice: 0
        };
    },
    mounted() {
        this.fetchCartItems();
        this.setupStripe();
    },
    methods: {
        async fetchCartItems() {
            try {
                const response = await axios.get('/cart/items');
                console.log('Fetched cart items:', response.data); 
                this.cartItems = response.data;
                this.calculateTotalPrice();
            } catch (error) {
                console.error('Error fetching cart items:', error);
                toastr.error('Failed to fetch cart items. Please try again.');
            }
        },
        calculateTotalPrice() {
            this.totalPrice = (this.cartItems.reduce((total, item) => total + item.product.price * item.quantity, 0) ).toFixed(2);
        },
        async setupStripe() {
            const stripe = await loadStripe('pk_test_51PlrUvBlT4Q7uMDZXImXsCrl7avLwEZcU6HZJp7NW1YSmZC8d2vWP7ghVL1MGzjxgOcIPWvRMExdzWjMBRaz3NCi00Wp4tPtZ2');
            
            document.getElementById('checkout-button').addEventListener('click', async () => {
                try {
                    const response = await axios.post('/api/stripe/create-checkout-session', {
                        user: this.user,
                        totalPrice: this.totalPrice,
                        cartItems: this.cartItems
                    });

                    if (response.data.error) {
                        toastr.error(response.data.error);
                        return;
                    }

                    const { error } = await stripe.redirectToCheckout({ sessionId: response.data.id });

                    if (error) {
                        console.error('Error redirecting to Checkout:', error);
                        toastr.error('Failed to redirect to checkout. Please try again.');
                    }
                } catch (error) {
                    console.error('Error during checkout:', error);
                    toastr.error('Failed to checkout. Please try again.');
                }
            });
        }
    }
};
</script>






<style scoped>
.checkout-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

.user-info {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

h3 {
    margin-top: 0;
    font-size: 20px;
    color: #333;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-size: 14px;
    color: #666;
}

.form-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

.checkout-summary {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
}

.buy-now-button {
    background-color: #4caf50;
    color: white;
    border: none;
    padding: 12px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.buy-now-button:hover {
    background-color: #45a049;
}
</style>
