<template>
    <Navbar></Navbar>

    <div class="main">
        <div class="user-profile-container">
            <div class="user-profile-upper flex-between">
                <h3>Profile</h3>
                <span>Joined in 2023</span>
                <div class="user-img-container">
                    <img src="./assets/awais3.jpg" alt="">
                </div>
            </div>
            
            <div class="user-profile-lower">
                <div class="flex-between">
                    <h3>Account id: 10101010</h3>
                </div>

                <div class="flex-between">
                    <h3>Muhammad Awais</h3>
                    <a href="#" class="link">Change Name</a>
                </div>

                <div class="flex-between">
                    <h3>awaiskhan9335@gmail.com</h3>
                    <a href="#" class="link">Change Email</a>
                </div>
            </div>
        </div>
    </div>

    <Footer></Footer>
</template>

<script>
    import Footer from './components/Footer.vue';
    import Navbar from './components/Navbar.vue';
    export default {
        components: {
            Navbar,    
            Footer,
        }    
    }
</script>

<style scoped>

    .main {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 25px;
        color: #fff;
    }
    .user-profile-container {
        box-shadow: 0 0 3px 0 #fff;
        border-radius: 20px;
    }

    .user-profile-upper {
        padding: 20px 20px 75px 20px;
        background: #030f11;
        border-radius: 20px 20px 0 0;
        position: relative;
    }

    .user-img-container {
        width: auto;
        height: 140px;

        position: absolute;
        margin-bottom: -180px;
    }

    .user-img-container > img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 15px;
    }

    .user-profile-lower {
        padding: 85px 20px 20px 20px;
    }
    .flex-between {
        display: flex;
        justify-content: space-between;
        gap: 100px;
        align-items: center;
        margin-bottom: 10px;
    }

    .link {
        text-decoration: underline;
    }

    .link:hover {
        color: #fff;
        letter-spacing: 0px;
        font-weight: 500;
    }
</style>