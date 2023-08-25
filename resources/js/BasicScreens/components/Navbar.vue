<template>
    <nav>
        <div class="logo-container">
            <div class="logo-img-container">
                <img src="../assets/logo.png" alt="logo" class="logo-img">
            </div>
            <h2 class="logo-text">Boardify</h2>
        </div>

        <div class="nav-links-container">
            <ul class="nav-links">
                <li class="nav-link-item"><RouterLink to="" class="link link-active">Home</RouterLink></li>
                <li class="nav-link-item"><RouterLink to="" class="link">Products</RouterLink></li>
                <li class="nav-link-item"><RouterLink to="" class="link">About</RouterLink></li>
                <li class="nav-link-item"><RouterLink to="" class="link">Contact</RouterLink></li>
            </ul>
            <div class="nav-user-profile">
                <img src="../assets/logo.png" alt="">
            </div>
        </div>
    </nav>
</template>

<style scoped>
    /* Navbar */
    nav {
        width: 100%;
        background: #212b2a;
        padding: 10px 8%;

        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Logo */
    .logo-container {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    .logo-img-container {
        width: 50px;
        height: 50px;
    }

    .logo-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }
    .logo-text {
        color: #eee;
        letter-spacing: 1px;
    }

    /* Nav-links */
    .nav-links-container {
        display: flex;
        align-items: center;
        gap: 35px;
    }
    .nav-links {
        display: flex;
        gap: 5px;
    }

    .nav-link-item {
        list-style-type: none; 
    }

    .link {
        padding: 8px 12px;
        border-radius: 15px;
    }

    .link-active {
        color: #fff;
        font-weight: bold;
        letter-spacing: 0.4px;
        background: #030f11;
    }

    .link:hover {
        background: #333738;
    }

    .nav-user-profile {
        width: 35px;
        height: 35px;
        cursor: pointer;
    }

    .nav-user-profile > img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }
    

   @media (max-width: 767px) {
        nav {
            padding: 10px 3%;
        }
   }
</style>