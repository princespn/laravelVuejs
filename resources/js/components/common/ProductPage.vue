<template>
    <div class="wrapper d-flex h-100">
        <LeaftMenue></LeaftMenue>
        <div class="container-fluid px-4">
            <div class="pageTitle pt-3 pb-3 md-pt-0">
                <h3 class="md-mb-0">Products</h3>

                <div class="d-flex justify-content-end align-items-center">
                    <!-- search form -->
                    <form @submit.prevent="searchproducts" class="col-xl-4 col-md-auto col-lg-auto mb-0 me-xl-3" role="search">
                        <div class="input-group">
                            <input type="text" v-model="searchQuery" class="form-control" placeholder="search here">
                            <button type="submit" class="btn"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                
                    <button id="generateReport" type="button" @click="showAddProductModal" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalGenerateReport">
                      Add Product
                    </button>
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
                        <tr v-for="(product, index) in filteredProducts" :key="product.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ product.name }}</td>
                            <td>{{ product.user.name }}</td>
                            <td>{{ truncate(product.discription, 20) }}</td>
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
                    <label for="editProductDescription">Product Description</label>
                    <input type="text" v-model="editProductForm.discription" class="form-control" id="editProductDescription" required>
                </div>
                <div class="form-group">
                    <label for="editProductPrice">Product Price</label>
                    <input type="number" v-model="editProductForm.price" class="form-control" id="editProductPrice" required>
                </div>
                <div class="form-group">
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
                    <b-button type="submit" class="form-control" variant="primary">Add Product</b-button>
                </div>
            </form>
        </b-modal>
    </div>
</template>

<script>
import axios from 'axios';
import { BButton, BModal } from 'bootstrap-vue-next';
import LeaftMenue from './LeaftMenue.vue';

export default {
    components: {
        BButton,
        BModal,
        LeaftMenue
    },
    data() {
        return {
            productDetails: [],
            searchQuery: '',
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
    computed: {
        filteredProducts() {
            if (this.searchQuery.trim() === '') {
                return this.productDetails;
            }
            const search = this.searchQuery.toLowerCase();
            return this.productDetails.filter(product =>
                product.name.toLowerCase().includes(search) ||
                product.discription.toLowerCase().includes(search) ||
                product.user.name.toLowerCase().includes(search)
            );
        }
    },
    mounted() {
        this.fetchProductDetails();
    },
    methods: {
        truncate(text, length) {
            if (text.length > length) {
                return text.substring(0, length) + '...';
            }
            return text;
        },
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
            this.newProductForm = { name: '', price: '', discription: '', user_id: null };
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
                } else {
                    console.error('Failed to add product:', response.data.message);
                }
            } catch (error) {
                console.error('Error adding product:', error);
            }
        },
        searchproducts() {
            // This method is intentionally left empty
            // as the search functionality is handled
            // by the computed property `filteredProducts`
        }
    }
};
</script>
