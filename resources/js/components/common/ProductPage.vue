<template>
    <div class="col-md-8">
      <div class="card">
        <div class="col-md-4">
          <div class="card-header">User Reports</div>
          <div class="card-header">
            <router-link to="/add-products" class="col-md-8">Add Product</router-link>
           
          </div>
        </div>
  
        <div class="card-body p-2">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Sr. No.</th>
                <th>Product Name</th>
                <th>User Name</th>
                <th>Product Description</th>
                <th>Product Price</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(product, index) in products" :key="product.id">
                <td>{{ index + 1 }}</td>
                <td>{{ product.name }}</td>
                <td>{{ product.user.name }}</td>
                <td>{{ product.discription }}</td>
                <td>{{ product.price }}</td>
                <td><button @click="editProduct(product)">Edit</button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
  
      <b-modal v-model:visible="showModal" title="Add Product">
        <form @submit.prevent="addProduct">
          <div class="form-group">
            <label for="productName">Product Name</label>
            <input type="text" v-model="newProduct.name" class="form-control" id="productName" required>
          </div>
          <div class="form-group">
            <label for="productDescription">Product Description</label>
            <input type="text" v-model="newProduct.discription" class="form-control" id="productDescription" required>
          </div>
          <div class="form-group">
            <label for="productPrice">Product Price</label>
            <input type="number" v-model="newProduct.price" class="form-control" id="productPrice" required>
          </div>
          <div class="form-group">
            <label for="userId">User ID</label>
            <input type="number" v-model="newProduct.user_id" class="form-control" id="userId" required>
          </div>
          <b-button type="submit" variant="primary">Add Product</b-button>
        </form>
      </b-modal>
    </div>
  </template>
  <script>
import axios from 'axios';
import { BButton, BModal } from 'bootstrap-vue-next';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue-next/dist/bootstrap-vue-next.css';

export default {
  components: {
    BButton,
    BModal,
  },
  data() {
    return {
      products: [],
      newProduct: {
        name: '',
        discription: '',
        price: 0,
        user_id: null,
      },
      showModal: false,
    };
  },
  mounted() {
    this.fetchProducts();
  },
  methods: {
    async fetchProducts() {
      try {
        const token = localStorage.getItem('token');
        if (!token) {
          this.$router.push({ name: 'login' });
          return;
        }

        const response = await axios.get('/api/products', {
          headers: {
            'Authorization': `Bearer ${token}`
          }
        });

        if (response.data.status) {
          this.products = response.data.products;
        } else {
          console.error('Failed to fetch products:', response.data.message);
        }
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    },
    async addProduct() {
      try {
        const token = localStorage.getItem('token');
        if (!token) {
          this.$router.push({ name: 'login' });
          return;
        }

        const response = await axios.post('/api/products', this.newProduct, {
          headers: {
            'Authorization': `Bearer ${token}`
          }
        });

        if (response.data.status) {
          this.products.push(response.data.product);
          this.newProduct = { name: '', discription: '', price: 0, user_id: null }; // Reset form fields
          this.showModal = false; // Close modal
        } else {
          console.error('Failed to add product:', response.data.message);
        }
      } catch (error) {
        console.error('Error adding product:', error);
      }
    },
    editProduct(product) {
      // Logic to edit product details
      console.log('Edit Product:', product);
    }
  }
};

</script>
  