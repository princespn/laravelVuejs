<template>
    <div class="wrapper d-flex h-100">
        <LeaftMenue></LeaftMenue>
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-end align-items-center">
                <!-- search form -->
                <form @submit.prevent="searchUsers" class="col-xl-4 col-md-auto col-lg-auto mb-0 me-xl-3" role="search">
                    <div class="input-group">
                        <input type="text" v-model="searchQuery" class="form-control" placeholder="search here">
                        <button type="submit" class="btn"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>

            <div class="pageTitle pt-3 pb-3 md-pt-0">
                <h3 class="md-mb-0">Users</h3>
            </div>

            <div class="card-body p-2">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>User Name</th>
                            <th>User Phone</th>
                            <th>User Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(user, index) in filteredUsers" :key="user.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.phone }}</td>
                            <td>{{ user.email }}</td>
                            <td>
                                <b-button variant="info" @click="showEditModal(user)">Edit</b-button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <b-modal v-model="isEditModalVisible" title="Edit User" hide-footer>
            <form @submit.prevent="updateUser">
                <div class="form-group">
                    <label for="editUserName">User Name</label>
                    <input type="text" v-model="editUserForm.name" class="form-control" id="editUserName" required>
                </div>
                <div class="form-group">
                    <label for="editUserPhone">User Phone</label>
                    <input type="text" v-model="editUserForm.phone" class="form-control" id="editUserPhone" required>
                </div>
                <div class="form-group">
                    <label for="editUserEmail">User Email</label>
                    <input type="email" v-model="editUserForm.email" class="form-control" id="editUserEmail" required>
                </div>
                <div class="form-group">
                    <b-button type="submit" class="form-control" variant="primary">Update User</b-button>
                </div>
            </form>
        </b-modal>
    </div>
</template>
<script>
import axios from 'axios';
import LeaftMenue from './LeaftMenue.vue';
import { BButton, BModal } from 'bootstrap-vue-next';

export default {
    components: {
        BButton,
        BModal,
        LeaftMenue
    },
    data() {
        return {
            userDetails: [],
            searchQuery: '',
            isEditModalVisible: false,
            editUserForm: {
                id: null,
                name: '',
                phone: '',
                email: ''
            }
        };
    },
    computed: {
        filteredUsers() {
            if (this.searchQuery.trim() === '') {
                return this.userDetails;
            }
            const search = this.searchQuery.toLowerCase();
            return this.userDetails.filter(user =>
                user.name.toLowerCase().includes(search) ||
                user.email.toLowerCase().includes(search)
            );
        }
    },
    mounted() {
        this.fetchUserDetails();
    },
    methods: {
        async fetchUserDetails() {
            try {
                const token = localStorage.getItem('token');
                if (!token) {
                    this.$router.push('/login');
                    return;
                }

                const response = await axios.get('/api/user-details', {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                });

                if (response.data.status) {
                    this.userDetails = response.data.users;
                } else {
                    console.error('Failed to fetch user details:', response.data.message);
                }
            } catch (error) {
                console.error('Error fetching user details:', error);
            }
        },
        showEditModal(user) {
            this.editUserForm = { ...user };
            this.isEditModalVisible = true;
        },
        async updateUser() {
            try {
                const token = localStorage.getItem('token');
                if (!token) {
                    this.$router.push('/login');
                    return;
                }

                const response = await axios.put(`/api/user-profile/${this.editUserForm.id}`, this.editUserForm, {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                });

                if (response.data.status) {
                    this.isEditModalVisible = false;
                    this.fetchUserDetails();
                } else {
                    console.error('Failed to update user details:', response.data.message);
                }
            } catch (error) {
                console.error('Error updating user details:', error);
            }
        },
        searchUsers() {
            // This method is intentionally left empty
            // as the search functionality is handled
            // by the computed property `filteredUsers`
        }
    }
};
</script>
