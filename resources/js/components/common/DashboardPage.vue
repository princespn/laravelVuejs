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
                            <td>{{ 1 + index }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.phone }}</td>
                            <td>{{ user.email }}</td>
                            <td><button @click="editUser(user)">Edit</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            userDetails: []
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
                    this.userDetails = response.data.users; // Adjusted to `users` if response is an array
                } else {
                    console.error('Failed to fetch user details:', response.data.message);
                }
            } catch (error) {
                console.error('Error fetching user details:', error);
            }
        },
        editUser(user) {
            // Logic to edit user details
            console.log('Edit user:', user);
        }
    }
};
</script>
