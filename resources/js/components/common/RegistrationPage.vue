<template>
    <div class="d-flex align-items-center py-4">
        <div class="form-signin w-100 m-auto text-center">
          <h1 class="h3 mb-3 fw-normal">Sign up for free</h1>
        

            <div class="input-group mb-3">
                <input type="text" v-model="item.name" class="form-control" name="name" placeholder="Please Enter Name" required>
            </div>
            <div class="input-group mb-3">
                <input type="text" v-model="item.phone" class="form-control" name="phone" placeholder="Please Enter Phone" required>
            </div>
            <div class="input-group mb-3">
                <input type="text" v-model="item.email" class="form-control" name="email" placeholder="Please Enter E-mail" required>
            </div>
            <div class="input-group mb-3">
                <input type="password" v-model="item.password" class="form-control" name="password" placeholder="Please Enter Password" required>
            </div>
            <div class="input-group mb-3">
                <input type="password" v-model="item.password_confirmation" class="form-control" name="password" placeholder="Please Enter confirm Password" required>
            </div>

            <div class="col-4">
                <button type="submit" @click="SignupAction" class="btn btn-primary btn-block btn-flat">Sign Up</button>
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
                name: "",
                phone: "",
                email: "",
                password: "",
            }

        }
    },
    mounted() {
        console.log('Component mounted.')
    },

    methods: {

        async SignupAction() {

            try {

                const response = await axios.post('api/register', this.item).then(res => {

                    if (response.data.status) {

                        this.$router.push('/login');

                    } else {
                        //alert(response.data.message);
                        this.$router.push('/register');
                    }

                })
            } catch (e) {
                console.log();

            }

        },
    }
}
</script>
