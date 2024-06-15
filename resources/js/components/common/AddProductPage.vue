<template>
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
    //this.addProduct();
  },
  methods: {
   
    async addProduct() {
      try {
        const token = localStorage.getItem('token');
        if (!token) {
          this.$router.push({ name: 'login' });
          return;
        }

        const response = await axios.post('/api/add-product', this.newProduct, {
          headers: {
            'Authorization': `Bearer ${token}`
          }
        });

        if (response.data.status) {
          this.products.push(response.data.product);
          this.newProduct = { name: '', discription: '', price: 0, user_id: null }; // Reset form fields
         /// this.showModal = false; // Close modal
        } else {
          console.error('Failed to add product:', response.data.message);
        }
      } catch (error) {
        console.error('Error adding product:', error);
      }
    },
  
  }
};

</script>