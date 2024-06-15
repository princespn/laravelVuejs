<template>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Update user profile</div>
            <div class="card-body">
                <form @submit.prevent="UpdateAction">
                    <div class="input-group mb-3">
                        <input type="text" readonly v-model="item.email" class="form-control" name="email" placeholder="Please Enter E-mail" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" v-model="item.name" class="form-control" name="name" placeholder="Please Enter Name" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" v-model="item.phone" class="form-control" name="phone" placeholder="Please Enter Phone" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" v-model="item.password" class="form-control" name="password" placeholder="Please Enter Password">
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" v-model="item.password_confirmation" class="form-control" name="password_confirmation" placeholder="Please Enter Confirm Password">
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            item: {
                name: "",
                phone: "",
                email: "",
                password: "",
                password_confirmation: ""
            }
        };
    },
    mounted() {
        this.loadProfile();
    },
    methods: {
        async loadProfile() {
            try {
                const token = localStorage.getItem('token');

                if (!token) {
                   // this.$router.push({ name: 'login' });
                    this.$router.push('/login');
                   // return;
                }

                const response = await axios.get('/api/profile', {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                });

                if (response.data.status) {
                    this.item = response.data.user;
                } else {
                    console.error('Failed to fetch profile:', response.data.message);
                }
            } catch (error) {
                console.error('Error fetching profile data:', error);
            }
        },
        async UpdateAction() {
            try {
                const token = localStorage.getItem('token');

                const response = await axios.post('/api/user-profile', this.item, {
                    headers: {
                        'Authorization': `Bearer ${token}`, // Ensure to replace with the correct token
                        'Content-Type': 'application/json'
                    }
                });

                if (response.data.status) {


                    this.$router.push('/login');

                    alert('Profile updated successfully');
                } else {

                    this.$router.push('/profile');
                    console.error('Failed to update profile:', response.data.message);
                }
            } catch (error) {
                console.error('Error updating profile:', error);
            }
        }
    }
};
</script>
