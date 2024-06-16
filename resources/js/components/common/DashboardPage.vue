<template>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">User Reports</div>
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
                        <tr v-for="(user, index) in userDetails" :key="user.id">
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
import { BButton, BModal } from 'bootstrap-vue-next';

export default {
    components: {
        BButton,
        BModal
    },
    data() {
        return {
            userDetails: [],
            isEditModalVisible: false,
            editUserForm: {
                id: null,
                name: '',
                phone: '',
                email: ''
            }
        };
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
                    this.userDetails = response.data.users; // Adjusted to `users` if response is an array
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
                    },
                });

                if (response.data.status) {
                    this.isEditModalVisible = false; // Close the modal                    
                    this.fetchUserDetails(); // Refresh the user details after update
                   
                } else {
                    console.error('Failed to update user details:', response.data.message);
                }
            } catch (error) {
                console.error('Error updating user details:', error);
            }
        }
    }
};
</script>
