import './bootstrap';
import { createApp } from 'vue';
import Welcome from './components/Welcome.vue';
import Products from './components/Products.vue';
import AddToCart from './components/AddToCart.vue';
import Checkout  from './components/Checkout.vue';
import About  from './components/About.vue';
import PaymentCancel  from './components/PaymentCancel.vue';
import PaymentSuccess  from './components/PaymentSuccess.vue';
import AdminDashboard  from './components/Admin/AdminDashboard.vue';
import Create  from './components/Admin/Create.vue';
import Update  from './components/Admin/Update.vue';




const app = createApp({});

app.component('welcome', Welcome);
app.component('products', Products);
app.component('cart', AddToCart);
app.component('checkout', Checkout);
app.component('about', About);
app.component('payment-cancel', PaymentCancel);
app.component('payment-success', PaymentSuccess);
app.component('admin-dashboard', AdminDashboard);
app.component('admin-create', Create);
app.component('admin-update', Update);



app.mount('#app');
