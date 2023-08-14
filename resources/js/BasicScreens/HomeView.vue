<template>
  <div class="home-container">
    <div class="home-bg-img-container">
      <img src="./assets/bg.png" alt="">
    </div>
    <div class="bg-img-shadow"></div>

    <div class="greeting-container">
      <div class="greeting">
        <div class="logo-container">
          <img src="./assets/logo.png" alt="">
        </div>
        <h3>With us, YOU play games!</h3>
        <div class="links-container">
          <RouterLink to="/signup">Signup</RouterLink>
          <RouterLink to="/login">Login</RouterLink>
        </div>
      </div>
    </div>
  </div>  
</template>

<script>
  export default {
    data() {
      return { 
        numbers: 13,
      }
    }
  }
</script>

<style scoped>

  .home-bg-img-container {
    width: 100vw;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 0 !important;
  }

  .greeting-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;

    display: flex;
    justify-content: center;
    align-items: center;
  }

  .greeting {
    background: #404a4c;
    color: #fff;
    padding: 35px;
    border-radius: 10px;
    opacity: 0.95;

    display: grid;
    place-items: center;
  }

  .logo-container {
    width: 80px;
    height: 80px;
    margin-bottom: 10px;
    border-radius: 50%;
    overflow: hidden;
  }

  .logo-container > img {
    border-radius: 50%;
  }

  h3 {
    letter-spacing: 0.5px;
  }

  .links-container {
    text-align: center;
    margin-top: 18px;
  }

  a {
    text-decoration: none;
    color: #fff;
    letter-spacing: 0.7px;
    background: #0e0f11;
    margin: 0 5px;
    padding: 8px 10px;
    border-radius: 5px;
  }

  a:hover {
      box-shadow: 0 0 3px 0 #fff;
  }


  /* Shadow over bg image */
  .bg-img-shadow {
    position: absolute;
    top: 0;
    left: 0;
    background: #000;
    width: 100%;
    height: 100%;
    opacity: 0.3;
  }

</style>




