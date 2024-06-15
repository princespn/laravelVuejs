<template>
    <div class="content-wrapper">
    <div id="app" class="wrapper">
        <nav class="main-header navbar navbar-expand  navbar-light border-bottom sidebar-dark-primary">
        <div class="sidebar">
            <ul class="navbar-nav">

<li class="nav-item">
<router-link to="/" class="col-md-8"><strong>Home</strong></router-link>
</li>
<li class="nav-item">
<router-link to="/login" class="col-md-8">Sign In</router-link>
</li>
<li class="nav-item">
<router-link to="/register" class="col-md-8">Sign Up</router-link>
</li>
<li class="nav-item">
<router-link to="/profile" class="col-md-8">Profile</router-link>
</li>
<li class="nav-item">
    <router-link to="/dashbord" class="col-md-8">Dashbord</router-link>
</li>

<li class="nav-item">
    <router-link to="/products" class="col-md-8">Products</router-link>
</li>

<li class="nav-item">
    
    <router-link to="/logout" class="col-md-8">Logout</router-link>
</li>


</ul>
</div>
</nav>
</div>

    <div class="card-heade content">
    <router-view></router-view>
    </div>

</div>

</template>