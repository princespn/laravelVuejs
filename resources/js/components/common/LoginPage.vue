<template>
<div class="col-md-8">
    <div class="card">
        <div class="card-header">Please fill below field.</div>

        <div class="card-body">

            <div class="input-group mb-3">
                <input type="email" class="form-control" v-model="item.email" name="email" placeholder="Please Enter E-mail">
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" v-model="item.password" name="password" placeholder="Please Enter Password">
            </div>

            <div class="col-4">
                <button type="submit" @click="loginAction" class="btn btn-primary btn-block btn-flat">Login</button>
            </div>

        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';

export default {

    data() {
        return {
            list: [],
            item: {
                email: "",
                password: "",
            }

        }
    },
    mounted() {
        console.log('Component mounted.')
    },

    methods: {

        async loginAction() {
            try {
                const response = await axios.post('/api/login', this.item);
               // alert(response.data);
                if (response.data.status) {
         
                    localStorage.setItem('token', response.data.token);

                    this.$router.push('/profile');

                } else {
                    alert(response.data.message);

                    this.$router.push('/login');
                }
            } catch (error) {
                console.error('Error during login:', error);
            }
        }

    },
}
</script>
