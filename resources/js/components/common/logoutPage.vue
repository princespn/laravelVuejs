<template>
<div class="container-fluid">
    <h1>Home page amit </h1>
</div>
</template>

          
          
<script>
export default {

    mounted() {
        this.logout();
    },

    methods: {
        async logout() {

            try {
                const response = await axios.get('/api/logout');
                // alert(response.data);
                if (response.data) {


            // Clear authentication token or session information
         
                    localStorage.removeItem('token');

                    this.$router.push('/login');

                } else {
                    //alert(response.data.message);

                    this.$router.push('/dashbord');
                }
            } catch (error) {
                console.error('Error during login:', error);
            }


           
        }
    }
}
</script>
