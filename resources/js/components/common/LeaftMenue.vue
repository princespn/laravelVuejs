<template>
    
    <div class="wrapper d-flex h-100">
    <nav id="mainSidebar" class="h-100">
        <div class="d-flex flex-column flex-shrink-0 p-3">
            <!-- first a -->
            <div class="d-flex align-items-center justify-content-between mb-3 mb-md-0 me-md-auto w-100">
              <!-- logo for LG screen -->
              <span class="fs-4 logo-lg only-d-lg">
               logo
              </span>
            
              <!-- for SM screen - close -->
              <span class="d-none" id="sidebarUntoggleBtn">
                <i class="bi bi-x-circle-fill"></i>
              </span>
            </div>
            <!-- first a ends -->
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
              <!-- accounts -->
              <p class="mt-2 mb-1 text-secondary text-small">DASHBOARD</p>
              <li class="nav-item">

                <router-link to="/" class="nav-link active" aria-current="page"><i class="bi bi-house-door-fill me-2"></i>Home</router-link>
               
               
              </li>
             
              <!-- products -->
              <p class="mt-2 mb-1 text-secondary text-small">PRODUCTS</p>
              <li>
                <router-link to="/products" class="nav-link active" aria-current="page"><i class="bi bi-table me-2"></i>Products</router-link>
               
              </li>
  
              <!-- accounts -->
              <p class="mt-2 mb-1 text-secondary text-small">ACCOUNTS</p>
              <li>

                <router-link to="/login" class="nav-link" aria-current="page"> <i class="bi bi-box-arrow-right me-2"></i> Sign in</router-link>
               
                
              </li>
              <li>
                <router-link to="/register" class="nav-link" aria-current="page"><i class="bi bi-person-circle me-2"></i>Registration</router-link>
               
                
              </li>
              <li>
                <router-link to="/profile" class="nav-link" aria-current="page"><i class="bi bi-at me-2"></i>My Profile</router-link>
               
                
              </li>
              <!-- Theme -->
              <p class="mt-2 mb-1 text-secondary text-small">USERS</p>
              <li>
                <router-link to="/dashbord" class="nav-link" aria-current="page"><i class="bi bi-file-font me-2"></i>Users</router-link>
               
               
              </li>
              <!-- others -->
              <p class="mt-2 mb-1 text-secondary text-small">OTHERS</p>
              <li>
                <a href="../404/index.html" class="nav-link">
                  <i class="bi bi-4-circle-fill me-2"></i>
                  404
                </a>
              </li>
              <li>
                <a href="../blank-page/index.html" class="nav-link">
                  <i class="bi bi-file-earmark-fill me-2"></i>
                  Blank Page
                </a>
              </li>
              
              <li>
                <router-link to="/logout" class="nav-link"><i class="bi bi-file-earmark-text me-2"></i>Logout</router-link>
                
              </li>
            </ul>
          </div>
      
</nav>

</div>
</template>

<script>
export default {

}
</script>