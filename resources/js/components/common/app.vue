<template>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <ul class="nav navbar-nav">
                <li class="navbar-brand">

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
    </div>
</nav>

<div class="container">
    <router-view></router-view>
</div>
</template>
