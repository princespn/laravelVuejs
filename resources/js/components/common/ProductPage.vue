<template>
  <div class="col-md-8">
      <div class="card">
          <div class="card-header"> <b-button variant="success" @click="showAddProductModal">Add Product</b-button><span style="float: inline-end;">Product Reports </span>
      
          </div>
          <div class="card-body p-2">
              <table class="table table-bordered table-hover">
                  <thead>
                      <tr>
                          <th>Sr. No.</th>
                          <th>Product Name</th>
                          <th>User Name</th>
                          <th>Product Description</th>
                          <th>Product price</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr v-for="(product, index) in productDetails" :key="product.id">
                          <td>{{ index + 1 }}</td>
                          <td>{{ product.name }}</td>
                          <td>{{ product.user.name }}</td>
                          <td>{{ product.discription }}</td>
                          <td>{{ product.price }}</td>
                          <td>
                              <b-button variant="info" @click="showEditModal(product)">Edit</b-button>
                          </td>
                      </tr>
                  </tbody>
              </table>
          </div>
      </div>
      
      <b-modal v-model="isEditModalVisible" title="Edit Product" hide-footer>
          <form @submit.prevent="updateProduct">
              <div class="form-group">
                  <label for="editProductName">Product Name</label>
                  <input type="text" v-model="editProductForm.name" class="form-control" id="editProductName" required>
              </div>
              <div class="form-group">
                  <label for="editProductdiscription">Product discription</label>
                  <input type="text" v-model="editProductForm.discription" class="form-control" id="editProductdiscription" required>
              </div>
              <div class="form-group">
                  <label for="editProductprice">Product price</label>
                  <input type="number" v-model="editProductForm.price" class="form-control" id="editProductprice" required>
              </div>
              <div class="form-group">
                <label for="saveproduct"></label>
                  <b-button type="submit" class="form-control" variant="primary">Update Product</b-button>
              </div>
          </form>
      </b-modal>
      
    <b-modal v-model="isAddProductModalVisible" title="Add Product" hide-footer>
          <form @submit.prevent="addProduct">
              <div class="form-group">
                  <label for="productName">Product Name</label>
                  <input type="text" v-model="newProductForm.name" class="form-control" id="productName" required>
              </div>
              <div class="form-group">
                <label for="productDescription">Product Description</label>
                <textarea v-model="newProductForm.discription" class="form-control" id="productDescription" required></textarea>
            </div>
              <div class="form-group">
                  <label for="productPrice">Product Price</label>
                  <input type="number" v-model="newProductForm.price" class="form-control" id="productPrice" required>
              </div>
              <div class="form-group">
                <label for="userId">User Name</label>
                <input type="number" v-model="newProductForm.user_id" class="form-control" id="userId" required>
            </div>
             
              <div class="form-group">
                <label for="Addproduct"></label>
                  <b-button type="submit" class="form-control" variant="primary">Add Product</b-button>
              </div>
          </form>
      </b-modal>
  </div>
</template>

  <script>
import axios from 'axios';
import { BButton, BModal } from 'bootstrap-vue-next';

export default {
    components: {
        BButton,
        BModal
    },
    data() {
        return {
          productDetails: [],
            isEditModalVisible: false,
            isAddProductModalVisible: false,
            editProductForm: {
                id: null,
                name: '',
                price: '',
                discription: ''
            },
            newProductForm: {
                name: '',
                discription: '',
                price: 0,
                user_id: null,
            }
        };
    },
    mounted() {
        this.fetchProductDetails();
    },
    methods: {
        async fetchProductDetails() {
            try {
                const token = localStorage.getItem('token');
                if (!token) {
                    this.$router.push('/login');
                    return;
                }

                const response = await axios.get('/api/products', {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                });

                if (response.data.status) {
                    this.productDetails = response.data.products; // Adjusted to `users` if response is an array
                } else {
                    console.error('Failed to fetch product details:', response.data.message);
                }
            } catch (error) {
                console.error('Error fetching product details:', error);
            }
        },
        showEditModal(product) {
            this.editProductForm = { ...product };
            this.isEditModalVisible = true;
        },
        async updateProduct() {
            try {
                const token = localStorage.getItem('token');
                if (!token) {
                    this.$router.push('/login');
                    return;
                }

                const response = await axios.put(`/api/edit-products/${this.editProductForm.id}`, this.editProductForm, {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    },
                });

                if (response.data.status) {
                    this.fetchProductDetails(); // Refresh the user details after update
                    this.isEditModalVisible = false; // Close the modal
                } else {
                    console.error('Failed to update product details:', response.data.message);
                }
            } catch (error) {
                console.error('Error updating product details:', error);
            }
        },
        showAddProductModal() {
            this.newProductForm = { name: '', price: '', discription: '', user_id: null};
            this.isAddProductModalVisible = true;
        },
        async addProduct() {
            try {
                const token = localStorage.getItem('token');
                if (!token) {
                    this.$router.push('/login');
                    return;
                }

                const response = await axios.post('/api/add-products', this.newProductForm, {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                });

                if (response.data.status) {
                    this.isAddProductModalVisible = false; // Close the modal
                    this.fetchProductDetails(); // Refresh the user details after update
                    // Optionally, fetch products to update the product list or handle accordingly
                } else {
                    console.error('Failed to add product:', response.data.message);
                }
            } catch (error) {
                console.error('Error adding product:', error);
            }
        }
    }
};

</script>
  