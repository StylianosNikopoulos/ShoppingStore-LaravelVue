import './bootstrap';
import { createApp } from 'vue';
import Welcome from './components/Welcome.vue';
import Products from './components/Products.vue';
import AddToCart from './components/AddToCart.vue';
import Checkout  from './components/Checkout.vue';
import About  from './components/About.vue';
import AdminDashboard  from './components/AdminDashboard.vue';
import PaymentCancel  from './components/PaymentCancel.vue';
import PaymentSuccess  from './components/PaymentSuccess.vue';


const app = createApp({});

app.component('welcome', Welcome);
app.component('products', Products);
app.component('cart', AddToCart);
app.component('checkout', Checkout);
app.component('about', About);
app.component('admin-dashboard', AdminDashboard);
app.component('payment-cancel', PaymentCancel);
app.component('payment-success', PaymentSuccess);

app.mount('#app');
